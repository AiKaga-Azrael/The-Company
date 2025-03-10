<?php
session_start();

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
    <title>Delete User</title>
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom:80px">
    <div class="container">
      <a href="dashboard.php" class="navbar-brand">
        <h1 class="h3">The Company</h1>
      </a>

      <div class="navbar-nav">
        <span class="navbar-text"><?= $_SESSION['full_name'] ?></span>
        <form action ="../actions/logout.php" method="post" class="d-flex ms-2">
          <button type="submit" class="text-danger bg-transparent border-0">Log Out</button>
        </form>
      </div>
    </div>
  </nav>

  <main class="row justify-content-center">
    <div class="col-4 text-center">
      <i class="fas fa-triangle-exclamation text-warning display-4 d-block mb-2"></i>
        <h2 class="text-danger mb-5">DELETE ACCOUNT</h2>

        <p class="fw-bold">Are you sure you wnat to delete your account?</p>

        <div class="row">
          <div class="col">
            <a href="dashboard php" class="btn btn-secondary w-180">Cancel</a>
          </div>
        <div class="col">
          <form action="../actions/delete-user.php" method="post">
            <button type="submit" class="btn btn-outline-danger w-180">Delete</button>
          </form>
        </div>
        </div>
    </div>
  </main>