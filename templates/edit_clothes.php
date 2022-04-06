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
  <link rel="stylesheet" href="styles/main.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body">
  <header class="col-12">
    <!-- Home and settings navbar -->
    <nav id="topnav" class="navbar navbar-expand-lg navbar-light bg-transparent">
      <div class="container-fluid">
        <a class="navbar-brand" href="?command=home">Outfit Cataloguer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="?command=home">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Settings
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="?command=profile">Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="?command=logout">Logout</a></li>
              </ul>
            </li>
          </ul>
          <span class="navbar-text">
            Hello there, <?=$_SESSION["name"]?>!
          </span>
        </div>
      </div>
    </nav>

    <!-- Page navbar -->
    <div class="container-fluid">
      <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item page-nav-item">
          <a class="nav-link" href="?command=upload_clothes">Upload Clothes</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link active" href="?command=edit_clothes" aria-current="page">Edit Clothes</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link" href="?command=create_outfits">Create Outfits</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link" href="?command=saved_outfits">Saved Outfits</a>
        </li>
      </ul>
    </div>
  </header>

  <!-- Page content begins -->
  <div class="col-md-8" id="scroll-Div">
    <div class="container spaced-from-tb">
      <p class="m-2">Select a piece of clothing to edit.</p>
      <div class="row">
        <div class="container-fluid">
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <a href="#" class="image-link">
            <img src="images/200x200.svg" alt="200x200 grey image placeholder box." class="img-thumbnail">
          </a>
          <br>
          <br>
        </div>
      </div>
      <br>
    </div>
  </div>

  <!-- Formality Filtering -->
  <div class="col-md-4">
    <div class="container spaced-from-tb">
      <div class="container">
        <p>Filter by:</p>
        <hr class="m-2">
        <p class="mb-2">Formality</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckCasual">
          <label class="form-check-label" for="flexCheckCasual">
            Casual
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckBusinessCasual">
          <label class="form-check-label" for="flexCheckBusinessCasual">
            Business casual
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckSemiFormal">
          <label class="form-check-label" for="flexCheckSemiFormal">
            Semi-formal
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckFormal">
          <label class="form-check-label" for="flexCheckFormal">
            Formal
          </label>
        </div>

        <!-- Type Filtering -->
        <hr class="m-2">
        <p class="mb-2">Type</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckTop">
          <label class="form-check-label" for="flexCheckTop">
            Top
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckBottom">
          <label class="form-check-label" for="flexCheckBottom">
            Bottom
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Full body
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckAccessory">
          <label class="form-check-label" for="flexCheckAccessory">
            Accessory
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckShoes">
          <label class="form-check-label" for="flexCheckShoes">
            Shoes
          </label>
        </div>
        <br>
        <br>
      </div>
    </div>
  </div>
  <!-- Page content ends -->

  <footer>
    <nav class="navbar fixed-bottom navbar-light bg-light" aria-label="breadcrumb">
      <div class="container-fluid" style="padding-top: 0.5rem;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a class="active-link" href="?command=edit_clothes">Edit
                Clothes</a></li>
          </ol>
        </nav>
        <small style="justify-content: right;">Copyright &copy; 2022 Nathan Hartung &amp; Vivine Zheng</small>
      </div>
    </nav>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>

</html>