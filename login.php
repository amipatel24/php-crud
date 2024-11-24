<?php
include 'config.php';
if (isset($_POST['login'])) {
        
    $email= $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE Email_Id = '{$email}' AND Password = '{$password}'";
    $query = mysqli_query($conn,$sql) or die("SQL Query Failed");
    if (mysqli_num_rows($query)> 0) {
        session_start();
        while ($row = mysqli_fetch_assoc($query)) {
            $_SESSION['user_name'] = $row['Name'];
            $_SESSION['user_id'] = $row['Id'];
            $_SESSION['user_email'] = $row['Email_Id'];
            header("Location:{$hostName}/users.php");
        }
    }
    else{
        echo "<div class=alert alert-danger>username and password not matched.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="form-wrapper">
        <h2>Login</h2>
<form action=<?php echo $_SERVER['PHP_SELF'] ?>  method="POST">


  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>

  <button type="submit" name="login" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>