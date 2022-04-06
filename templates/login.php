<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="Nathan Hartung, Vivine Zheng">
  <meta name="description" content="A website for uploading clothing and generating outfits based on user input.">
  <meta name="keywords"
    content="outfit maker, outfit creator, outfit inspiration, outfit cataloguer, wardorbe organizer">

  <title>Outfit Cataloguer</title>

  <!-- Local CSS file -->
  <!-- <link rel="stylesheet" href="styles/main.css"> -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<header class="col-12">
    <!-- Home and settings navbar -->
    <nav id="topnav" class="navbar navbar-expand-lg navbar-light bg-transparent">
      <div class="container-fluid">
        <a class="navbar-brand" href="?command=login">Outfit Cataloguer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
</header>

<div class="container" style="margin-top: 15px;">
    <div class="row col-xs-8 text-center">
    <h1>Log in</h1>
        <p> Welcome back to Outfit Cataloguer. To log in, enter your information below.</p>
        <small>
            Don't have an account? Click <a href="?command=create_account">here</a>
        </small>
    </div>
    <div class="row justify-content-center">
        <?php
            // print_r($_SESSION);
            // print_r($data);
            $error_msg;
            if (!empty($error_msg)) {
                echo "<div class='alert alert-danger'>$error_msg</div>";
            }
        ?>
        <div class="col-4">
        <form action="?command=login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"/>
            </div>
            <div class="text-center">                
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </form>
        </div>
    </div>
</div>

<footer>
<nav class="navbar fixed-bottom navbar-light bg-light" aria-label="breadcrumb">
    <div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a class="active-link"
            href="?command=login">Login</a></li>
        </ol>
    </nav>
    <small style="justify-content: right;">Copyright &copy; 2022 Nathan Hartung &amp; Vivine Zheng</small>
    </div>
</nav>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
crossorigin="anonymous"></script>
<script src="js/main.js"></script></body>
</html>