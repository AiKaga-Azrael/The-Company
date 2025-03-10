<?php
session_start();

include '../classes/User.php';

$user_obj = new User;
$all_users = $user_obj->getAllUsers();//$all_users is the array that holds all the values retrieved by the function getAllUsers

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FONT AWESOME CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dashboard</title>
</head>
  <body>
    <nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom:80px">
        <div class="container">
          <a href="dashboard.php" class="navbar-brand">
            <h1 class="h3">The Company</h1>
          </a>

       <div class="navbar-nav">
        <span class="navbar-text"><?= $_SESSION['username'] ?></span>
        <form action ="../actions/logout.php" method="post" class="d-flex ms-2">
          <button type="submit" class="text-danger bg-transparent border-0">Log Out</button>
        </form>
      </div>
    </div>
  </nav>

  <main class="row justify-content-center gx-0"><!--to show the collected data from the form-->
    <div class="col-6">
      <h2 class="text-center">USER LIST</h2>

      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th><!-- for photo --></th>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th><!-- for action buttons --></th>
          </tr>
       </thead>
       <tbody>
          <!--loops through all the users-->
          <?php
            while($user = $all_users->fetch_assoc()){//while loop is used to search for all the users array 
          ?>
            <tr>
                <td>
                    <?php
                    if($user['photo']){
                    ?>
                      <img src="../assets/images/<?=$user['photo']?>" alt="<?=$user['photo']?>" class="d-block mx-auto dashboard-photo">
                    <?php
                    } else {
                    ?>
                      <i class="fas fa-user text-secondary d-block text-center dashboard-icon"></i>
                    <?php
                    }
                    ?>
                </td>
                <td><?= $user['id'] ?></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['username'] ?></td>
                <td>
                  <?php
                  if($_SESSION['id'] == $user['id']){//if the logged in user is same as user stored in our data (checked by itsID, only then the below icons appear ONLY on matched user. the icons will not appear on other users because their id does not match with logged in id)
                  ?>
                    <a href="edit-user.php" class="btn btn-outline-warning" title="Edit">
                      <i class ="far fa-pen-to-square"></i>
                    </a>
                    <a href="delete-user.php" class="btn btn-outline-danger" title="Delete">
                      <i class ="far fa-trash-can"></i>
                    </a>
                  <?php
                  }
                  ?>
                </td>
                </tr>
              <?php
              }
              ?>
              </tbody>
      </table>
    </div>
  </main>
</body>
</html>