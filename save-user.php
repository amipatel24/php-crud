<?php
include 'config.php';
if (isset($_POST['register'])) {

    if ($_FILES['file_upload']['name'] != ''  ) {
        $file_name= $_FILES['file_upload']['name'];
        $temp_name= $_FILES['file_upload']['tmp_name'];
        $extention= pathinfo($file_name,PATHINFO_EXTENSION);
        $valid_extention = array("jpg","png","jpeg","webp");
        if (in_array($extention,$valid_extention)== false) {
            $error[] = "This extention file not allowed, please choose a JPG OR PNG file";
        }
      
        $new_name =  rand() . "." . $extention;
        $path = "images/" .$new_name;
        if (empty($error) == true) {
            move_uploaded_file($temp_name,$path);
        }
        else{
            print_r($error);
            die();
        }

       
    
    
    $Name= mysqli_real_escape_string($conn, $_POST['name']);
    $Email= $_POST['email'];
    $Password = md5($_POST['password']);
    $Age =  $_POST['age'];
     $sql = "SELECT * FROM users WHERE Email_Id = '{$Email}'";
    $query = mysqli_query($conn,$sql) or die("Users Query Failed");
    if (mysqli_num_rows($query) > 0) {
        echo "<p style=color:red>user already exit </p>";
    }
    else{
    $sql1 ="INSERT INTO users (Name,Email_Id,Password,profile_img,Age) 
            VALUES ('{$Name}','{$Email}','{$Password}','{$new_name}',{$Age});";
            if (mysqli_query($conn,$sql1)) {
    
                header("Location:{$hostName}/login.php");
            }
                else{
                    die("insertquery failed");
            

}

    }
}
else{
    echo "please chooes profile";
}
mysqli_close($conn);
}
?>