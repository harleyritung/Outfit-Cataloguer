<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="" value="viewport" content="width=device-width, initial-scale=1">

  <meta name="" value="author" content="Nathan Hartung, Vivine Zheng">
  <meta name="" value="description" content="A website for uploading clothing and generating outfits based on user input.">
  <meta name="" value="keywords" content="outfit maker, outfit creator, outfit inspiration, outfit cataloguer, wardorbe organizer">

  <title>Outfit Cataloguer</title>

  <!-- Local CSS file -->
  <link rel="stylesheet" href="styles/main.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <header class="col-12">
    <!-- Home and settings navbar -->
    <nav id="topnav" class="navbar navbar-expand-lg navbar-light bg-transparent">
      <div class="container-fluid">
        <a class="navbar-brand" href="?command=home">Outfit Cataloguer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="?command=home">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            Hello there, <?= $_SESSION["name"] ?>!
          </span>
        </div>
      </div>
    </nav>

    <!-- Page navbar -->
    <div class="container-fluid">
      <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item page-nav-item">
          <a class="nav-link active" href="?command=upload_clothes" aria-current="page">Upload Clothes</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link" href="?command=edit_clothes">Edit Clothes</a>
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

  <!-- content -->
<section>
    <!-- Upload clothes form -->
    <form enctype="multipart/form-data" action="?command=upload_clothes" method="post" onsubmit="return validate('Name', 'Formality', 'Type');">

      <!-- Image upload -->
      <div class="col-md-4">
        <div class="container spaced-from-tb">
          <h1 class="display-6 underlined ps-1">Upload Picture</h1>
          <?php
            if (!empty($error_msg)) {
              echo "<div class='alert alert-danger'>$error_msg</div>";
            }
          ?>
          <label for="image_input" style="margin-bottom: 1rem;">Images can be no larger than 2 MB.</label>
          <div class="input-group mb-3">
              <input type="file" class="form-control" id="image_input" accept="image/jpeg, image/png, image/jpg" name="article_img">
            </div>
          <div class="img-container">
            <!-- <input type="file" id="image_input" accept="image/jpeg, image/png, image/jpg" name="article_img"> -->
            <div id="display_image"></div>
          </div>
          <br>
          <!-- upload button -->
          <button class="btn btn-primary submit-button" type="submit">Upload to Wardrobe</button>
        </div>
      </div>

  <!-- Attribute selection -->
  <div class="col-md-8" id="scroll-Div" style="padding-bottom: 2rem;">
      <!-- Required attributes -->
      <div class="col-md-6">
        <div class="container spaced-from-tb">
          <div class="container">
            <h1 class="display-6">Required Attributes</h1>
            <hr class="m-2">

            <!-- Article Name -->
            <div class="mb-2">
              <label for="ArticleName" class="form-label">Article Name:</label>
              <input type="text" class="form-control" id="ArticleName" name="Name" placeholder="Name">
            </div>
            <hr class="m-2">

            <!-- Formality Selection -->
            <p class="mb-2">Formality:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Formality" value="Casual" id="flexRadioCasual">
              <label class="form-check-label" for="flexRadioCasual">
                Casual
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Formality" value="BusinessCasual" id="flexRadioBusinessCasual">
              <label class="form-check-label" for="flexRadioBusinessCasual">
                Business casual
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Formality" value="SemiFormal" id="flexRadioSemiFormal">
              <label class="form-check-label" for="flexRadioSemiFormal">
                Semi-formal
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Formality" value="Formal" id="flexRadioFormal">
              <label class="form-check-label" for="flexRadioFormal">
                Formal
              </label>
            </div>
            <hr class="m-2">

            <!-- Type Selection -->
            <p class="mb-2">Type:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Type" value="Top" id="flexRadioTop">
              <label class="form-check-label" for="flexRadioTop">
                Top
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Type" value="Bottom" id="flexRadioBottom">
              <label class="form-check-label" for="flexRadioBottom">
                Bottom
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Type" value="FullBody" id="flexRadioFullBody">
              <label class="form-check-label" for="flexRadioFullBody">
                Full body
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Type" value="Accessory" id="flexRadioAccessory">
              <label class="form-check-label" for="flexRadioAccessory">
                Accessory
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Type" value="Shoes" id="flexRadioShoes">
              <label class="form-check-label" for="flexRadioShoes">
                Shoes
              </label>
            </div>
            <hr class="m-2">
          </div>
        </div>
      </div>

      <!-- Optional attributes -->
      <div class="col-md-6">
        <div class="container spaced-from-tb">
          <div class="container">
            <h1 class="display-6">Optional Attributes</h1>
            <hr class="m-2">
            <p class="mb-2">Style:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Style" value="Sport" id="flexRadioSport">
              <label class="form-check-label" for="flexRadioSport">
                Sport
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Style" value="Preppy" id="flexRadioPreppy">
              <label class="form-check-label" for="flexRadioPreppy">
                Preppy
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Style" value="Boho" id="flexRadioBoho">
              <label class="form-check-label" for="flexRadioBoho">
                Boho
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Style" value="Grunge" id="flexRadioGrunge">
              <label class="form-check-label" for="flexRadioGrunge">
                Grunge
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Style" value="Streetwear" id="flexRadioStreetwear">
              <label class="form-check-label" for="flexRadioStreetwear">
                Streetwear
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Style" value="Null" id="flexRadioStyleNull" checked>
              <label class="form-check-label" for="flexRadioStyleNull">
                Null
              </label>
            </div>
            <hr class="m-2">

            <!-- Pattern Selection -->
            <p class="mb-2">Pattern:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Pattern" value="Plain" id="flexRadioPlain">
              <label class="form-check-label" for="flexRadioPlain">
                Plain
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Pattern" value="Stripes" id="flexRadioStripes">
              <label class="form-check-label" for="flexRadioStripes">
                Stripes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Pattern" value="Graphic" id="flexRadioGraphic">
              <label class="form-check-label" for="flexRadioGraphic">
                Graphic
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Pattern" value="Dots" id="flexRadioDots">
              <label class="form-check-label" for="flexRadioDots">
                Dots
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Pattern" value="Null" id="flexRadioPatternNull" checked>
              <label class="form-check-label" for="flexRadioPatternNull">
                Null
              </label>
            </div>
            <hr class="m-2">

            <!-- Material Selection -->
            <p class="mb-2">Material:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Cotton" id="flexRadioCotton">
              <label class="form-check-label" for="flexRadioCotton">
                Cotton
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Denim" id="flexRadioDenim">
              <label class="form-check-label" for="flexRadioDenim">
                Denim
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Leather" id="flexRadioLeather">
              <label class="form-check-label" for="flexRadioLeather">
                Leather
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Synthetic" id="flexRadioSynthetic">
              <label class="form-check-label" for="flexRadioSynthetic">
                Synthetic
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Wool" id="flexRadioWool">
              <label class="form-check-label" for="flexRadioWool">
                Wool
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Khaki" id="flexRadioKhaki">
              <label class="form-check-label" for="flexRadioKhaki">
                Khaki
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Material" value="Null" id="flexRadioMaterialNull" checked>
              <label class="form-check-label" for="flexRadioMaterialNull">
                Null
              </label>
            </div>
            <hr class="m-2">

            <!-- Color Selection -->
            <p class="mb-2">Color:</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Black" id="flexRadioBlack">
              <label class="form-check-label" for="flexRadioBlack">
                Black
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Brown" id="flexRadioBrown">
              <label class="form-check-label" for="flexRadioBrown">
                Brown
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="White" id="flexRadioWhite">
              <label class="form-check-label" for="flexRadioWhite">
                White
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Grey" id="flexRadioGrey">
              <label class="form-check-label" for="flexRadioGrey">
                Grey
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Blue" id="flexRadioBlue">
              <label class="form-check-label" for="flexRadioBlue">
                Blue
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Green" id="flexRadioGreen">
              <label class="form-check-label" for="flexRadioGreen">
                Green
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Yellow" id="flexRadioYellow">
              <label class="form-check-label" for="flexRadioYellow">
                Yellow
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Orange" id="flexRadioOrange">
              <label class="form-check-label" for="flexRadioOrange">
                Orange
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Red" id="flexRadioRed">
              <label class="form-check-label" for="flexRadioRed">
                Red
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Pink" id="flexRadioPink">
              <label class="form-check-label" for="flexRadioPink">
                Pink
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Purple" id="flexRadioPurple">
              <label class="form-check-label" for="flexRadioPurple">
                Purple
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Color" value="Null" id="flexRadioColorNull" checked>
              <label class="form-check-label" for="flexRadioColorNull">
                Null
              </label>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <nav class="navbar fixed-bottom navbar-light bg-light" aria-label="breadcrumb">
      <div class="container-fluid" style="padding-top: 0.5rem;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a class="active-link" href="?command=upload_clothes">Upload Clothes</a></li>
          </ol>
        </nav>
        <small style="justify-content: right;">Copyright &copy; 2022 Nathan Hartung &amp; Vivine Zheng</small>
      </div>
    </nav>
  </footer>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">
    // Displays image after using file input
    const image_input = document.querySelector("#image_input");
    image_input.addEventListener("change", function() {
      const reader = new FileReader();
      reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        // alert if img larger than 2mb
        if (this.files[0].size > 2097152) {
            alert("Uploaded image cannot be greater than 2mb");
        }
        // else display img
        else {
        document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;
        }
    });
      reader.readAsDataURL(this.files[0]);
    });
  </script>
</body>

</html>