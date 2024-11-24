<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Users</title>
</head>

<body>
    <div class="wrapper">
        <h2>Users List</h2>
        <?php
        include 'config.php';
        $page = "";
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        $limit = 2;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM users LIMIT {$offset},{$limit}";
        $query = mysqli_query($conn,$sql) or die("SQL Query Failed");
        if (mysqli_num_rows($query) > 0) {
            
        
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age </th>
                    <th scope="col">Edit </th>
                    <th scope="col">Delete </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($row = mysqli_fetch_assoc($query)){
                   
                    
                    ?>
                <tr>

                    <td scope="row"><?php echo $row['Id']
                    ?></td>
                    <td><?php echo $row['Name']
                    ?></td>
                    <td><?php echo $row['Email_Id']
                    ?></td>
                    <td><?php echo $row['Age']
                    ?></td>
                    <td><a href="edit-form.php?id=<?php echo $row['Id'] ?>"><button>Edit</button></a></td>
                    <td><a href="delete-user.php?id=<?php echo $row['Id'] ?>"><button>Delete</button></a></td>
                </tr>

                <?php } ?>


            </tbody>
        </table>
     
        <?php 
        }
        
        else{
            echo "<h2>No Record Found</h2>";
        } 
        $sql1= "SELECT * FROM users";
        $result =mysqli_query($conn,$sql1) or die("Query Failed" . mysqli_error());
        $total_record = mysqli_num_rows($result);
        $total_pages = ceil($total_record / $limit);
        echo " <ul class='pagination'>" ;
        if ($page <= 1) {
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        echo " <li class='page-item {$disabled}'>
        
                <a class='page-link' href='users.php?page=". ($page - 1) . "'>Previous</a>
            </li>";
          for ($i=1; $i <= $total_pages ; $i++) { 
            if ($page == $i) {
                $active = "active";
            }
            else{
                $active = "";
            }
            echo "  <li class='page-item {$active} '><a class='page-link' href='users.php?page={$i}'>{$i}</a></li>";
          }
          if ($page >= $total_pages) {
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
          echo "  <li class='page-item {$disabled}'>
                <a class='page-link' href='users.php?page=". ($page + 1) . "'>Next</a>
            </li> </ul >" ;
        ?>
         
    </div>

</body>

</html>