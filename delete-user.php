<?php
$user_id = $_GET['id'];
include 'config.php';
$sql = "DELETE FROM users WHERE Id={$user_id}";
if (mysqli_query($conn,$sql)) {
    header("Location:{$hostName}/users.php");
}
else{
    die(mysqli_error());
}

?>  