<?php
include 'config.php';
if(isset($_POST['Edit'])){
    
    if ($_FILES['new_img']['name'] == '') {
        $file_name = $_POST['old_img'];
    }
    else {
        $error = [];
     $name = $_FILES['new_img']['name'];
     $tmp_name = $_FILES['new_img']['tmp_name'];
     $Extention = pathinfo($name,PATHINFO_EXTENSION);
     $valid_extention = array('jpg','jpeg','png');
     if (in_array($Extention,$valid_extention) == false) {
        $error[] = "This extention file not allowed, please choose a JPG OR PNG file";    
     }
     $file_name = rand() . "." . $Extention;
     $path = "images/" .$file_name;
     if (empty($error) == true) {
        move_uploaded_file($tmp_name,$path);
     }
     else{
        print_r($error);
        die();
     }
     

    }
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
 $sql = "UPDATE users SET Name='{$name}',Email_Id='{$email}',Age={$age},profile_img='{$file_name}' WHERE Id={$id}";
    $result = mysqli_query($conn,$sql) or die("Sql query failedd");
    if (mysqli_query($conn,$sql)) {
        header("Location:{$hostName}/users.php");
    }
    else{
        die(mysqli_error());
    }
}
?>