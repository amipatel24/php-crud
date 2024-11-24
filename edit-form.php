<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
</head>
<body>  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<div class="form-wrapper">
    <h2>Edit Form</h2>
    <?php
    $user_id = $_GET['id'];
    include 'config.php';
    $sql = "SELECT * FROM users WHERE Id={$user_id}";
    $query = mysqli_query($conn,$sql) or die("SQL Query Failed");
    if (mysqli_num_rows($query) > 0) {
      
    
    ?>
<form action="update-user.php" enctype="multipart/form-data" method="POST">
  <?php
  while ($row = mysqli_fetch_assoc($query)) {
   
  ?>
  <div class="form-group" style="display:none">
    <label for="name">ID</label>
    <input type="text" class="form-control" id="id" name="id" placeholder="Enter Your Id" value='<?php echo $row['Id'] ?>'>
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" value='<?php echo $row['Name'] ?>'>
  </div>

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value='<?php echo $row['Email_Id'] ?>'>
    
  </div>

  <div class="form-group">
    <label for="age">Age</label>
    <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age" value='<?php echo $row['Age'] ?>'>
  </div>
  <div class="form-group">
    <label for="file">Profile</label>
    <input type="file" class="form-control-file"  name="new_img">
    <?php echo $row['profile_img'] ?>
    <input  type="hidden" class="form-control-file"  name="old_img" value='<?php echo htmlspecialchars($row['profile_img']) ?>'>
  </div>
  <div class="image-preview">
    <img src="images/<?php echo $row['profile_img'] ?>" width="200px" height="200px" alt="">
  </div>
  <button type="submit" name="Edit" class="btn btn-primary">Submit</button>
  <?php } ?>
</form>
<?php } ?>
</div>
</html>