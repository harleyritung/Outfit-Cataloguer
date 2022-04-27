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

  <script type="text/javascript">
    function inputValidate() {
      var input = document.getElementById("ArticleName").value;
      if (input.length > 0) {
        if (input.trim().length === 0) {
          document.getElementById("UpdateButton").disabled = true;

          inputHelp.textContent = "⚠ Name cannot contain only spaces.";
          document.getElementById("ArticleName").style.borderColor = 'red';
        } else {
          document.getElementById("UpdateButton").disabled = false;

          inputHelp.textContent = "";
          document.getElementById("ArticleName").style.borderColor = null;
        }
      } else {
        document.getElementById("UpdateButton").disabled = true;

        inputHelp.textContent = "⚠ Name cannot be blank.";
        document.getElementById("ArticleName").style.borderColor = 'red';
      }
    }

    function checkForEnter(key) {
      if (key.keyCode == 13) {
        key.preventDefault();
      }
    }
  </script>
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

  <!-- content -->
  <section>
    <form enctype="multipart/form-data" action="?command=update_item" method="post" onsubmit="return validate('Name', 'Formality', 'Type');">
      <!-- Image upload -->
      <div class="col-md-4">
        <div class="container spaced-from-tb">
          <?php
          if (!empty($error_msg)) {
            echo "<div class='alert alert-danger'>$error_msg</div>";
          }
          ?>
          <div class="img-container" style="text-align:center;">
            <img src=" data:image/jpg;charset=utf8;base64,<?php echo base64_encode($item['item_image']); ?>" alt="Preview image of clothing article." class="img-thumbnail mini">
          </div>
          <br>
          <!-- upload button -->
          <div class="text-center">
            <button class="btn btn-primary" type="submit" id="UpdateButton">Update Item</button>
            <input type="hidden" name="ID" value="<?php echo $item['item_id'] ?>">
          </div>
        </div>
      </div>

      <!-- Attribute selection -->
      <div class="col-md-8" style="padding-bottom: 2rem;">
        <!-- Required attributes -->
        <div class="col-md-6" id="scroll-Div">
          <div class="container spaced-from-tb">
            <div class="container">
              <h1 class="display-6">Required Attributes</h1>
              <hr class="m-2">

              <!-- Article Name -->
              <div class="mb-2">
                <label for="ArticleName" class="form-label">Article Name:</label>
                <input type="text" class="form-control" id="ArticleName" name="Name" value="<?php echo $item['item_name']; ?>" onkeypress="checkForEnter(event)">
              </div>
              <div id="inputHelp" class="form-text" style="color:red;"></div>
              <hr class="m-2">

              <!-- Formality -->
              <p class="mb-2">Formality:</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Formality" value="Casual" id="flexRadioCasual" <?php if ($item['item_formality'] === 'Casual') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioCasual">
                  Casual
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Formality" value="BusinessCasual" id="flexRadioBusinessCasual" <?php if ($item['item_formality'] === 'BusinessCasual') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioBusinessCasual">
                  Business casual
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Formality" value="SemiFormal" id="flexRadioSemiFormal" <?php if ($item['item_formality'] === 'SemiFormal') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioSemiFormal">
                  Semi-formal
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Formality" value="Formal" id="flexRadioFormal" <?php if ($item['item_formality'] === 'Formal') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioFormal">
                  Formal
                </label>
              </div>
              <hr class="m-2">

              <!-- Type Selection -->
              <p class="mb-2">Type:</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Type" value="Top" id="flexRadioTop" <?php if ($item['item_type'] === 'Top') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioTop">
                  Top
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Type" value="Bottom" id="flexRadioBottom" <?php if ($item['item_type'] === 'Bottom') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioBottom">
                  Bottom
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Type" value="FullBody" id="flexRadioFullBody" <?php if ($item['item_type'] === 'FullBody') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioFullyBody">
                  Full body
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Type" value="Accessory" id="flexRadioAccessory" <?php if ($item['item_type'] === 'Accessory') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioAccessory">
                  Accessory
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Type" value="Shoes" id="flexRadioShoes" <?php if ($item['item_type'] === 'Shoes') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioShoes">
                  Shoes
                </label>
              </div>
            </div>
          </div>
        </div>
        <!-- Optional attributes -->
        <div class="col-md-6" id="scroll-Div">
          <div class="container spaced-from-tb">
            <div class="container">
              <h1 class="display-6">Optional Attributes</h1>
              <hr class="m-2">
              <p class="mb-2">Style:</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Style" value="Sport" id="flexRadioSport" <?php if ($item['item_style'] === 'Sport') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioSport">
                  Sport
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Style" value="Preppy" id="flexRadioPreppy" <?php if ($item['item_style'] === 'Preppy') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioPreppy">
                  Preppy
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Style" value="Boho" id="flexRadioBoho" <?php if ($item['item_style'] === 'Boho') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioBoho">
                  Boho
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Style" value="Grunge" id="flexRadioGrunge" <?php if ($item['item_style'] === 'Grunge') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioGrunge">
                  Grunge
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Style" value="Streetwear" id="flexRadioStreetwear" <?php if ($item['item_style'] === 'Streetwear') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioStreetwear">
                  Streetwear
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Style" value="Null" id="flexRadioNullStyle" <?php if ($item['item_style'] === NULL) echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioNullStyle">
                  Null
                </label>
              </div>
              <hr class="m-2">

              <!-- Pattern Selection -->
              <p class="mb-2">Pattern:</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Pattern" value="Plain" id="flexRadioPlain" <?php if ($item['item_pattern'] === 'Plain') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioPlain">
                  Plain
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Pattern" value="Striped" id="flexRadioStriped" <?php if ($item['item_pattern'] === 'Striped') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioStriped">
                  Striped
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Pattern" value="Graphic" id="flexRadioGraphic" <?php if ($item['item_pattern'] === 'Graphic') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioGraphic">
                  Graphic
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Pattern" value="Dots" id="flexRadioDots" <?php if ($item['item_pattern'] === 'Dots') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioDots">
                  Dots
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Pattern" value="Null" id="flexRadioNullPattern" <?php if ($item['item_pattern'] === NULL) echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioNullPattern">
                  Null
                </label>
              </div>
              <hr class="m-2">

              <!-- Material Selection -->
              <p class="mb-2">Material:</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Cotton" id="flexRadioCotton" <?php if ($item['item_material'] === 'Cotton') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioCotton">
                  Cotton
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Denim" id="flexRadioDenim" <?php if ($item['item_material'] === 'Denim') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioDenim">
                  Denim
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Leather" id="flexRadioLeather" <?php if ($item['item_material'] === 'Leather') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioLeather">
                  Leather
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Synthetic" id="flexRadioSynthetic" <?php if ($item['item_material'] === 'Synthetic') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioSynthetic">
                  Synthetic
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Wool" id="flexRadioWool" <?php if ($item['item_material'] === 'Wool') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioWool">
                  Wool
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Khaki" id="flexRadioKhaki" <?php if ($item['item_material'] === 'Khaki') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioKhaki">
                  Khaki
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Material" value="Null" id="flexRadioNullMaterial" <?php if ($item['item_material'] === NULL) echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioNullMaterial">
                  Null
                </label>
              </div>
              <hr class="m-2">

              <!-- Color Selection -->
              <p class="mb-2">Color:</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Black" id="flexRadioBlack" <?php if ($item['item_color'] === 'Black') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioBlack">
                  Black
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Brown" id="flexRadioBrown" <?php if ($item['item_color'] === 'Brown') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioBrown">
                  Brown
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="White" id="flexRadioWhite" <?php if ($item['item_color'] === 'White') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioWhite">
                  White
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Grey" id="flexRadioGrey" <?php if ($item['item_color'] === 'Grey') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioGrey">
                  Grey
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Blue" id="flexRadioBlue" <?php if ($item['item_color'] === 'Blue') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioBlue">
                  Blue
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Green" id="flexRadioGreen" <?php if ($item['item_color'] === 'Green') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioGreen">
                  Green
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Yellow" id="flexRadioYellow" <?php if ($item['item_color'] === 'Yellow') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioYellow">
                  Yellow
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Orange" id="flexRadioOrange" <?php if ($item['item_color'] === 'Orange') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioOrange">
                  Orange
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Red" id="flexRadioRed" <?php if ($item['item_color'] === 'Red') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioRed">
                  Red
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Pink" id="flexRadioPink" <?php if ($item['item_color'] === 'Pink') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioPink">
                  Pink
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Purple" id="flexRadioPurple" <?php if ($item['item_color'] === 'Purple') echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioPurple">
                  Purple
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Color" value="Null" id="flexRadioNullColor" <?php if ($item['item_color'] === NULL) echo 'checked'; ?>>
                <label class="form-check-label" for="flexRadioNullColor">
                  Null
                </label>
              </div>
              <br>
              <br>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>

  <footer>
    <nav class="navbar fixed-bottom navbar-light bg-light" aria-label="breadcrumb">
      <div class="container-fluid" style="padding-top: 0.5rem;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?command=edit_clothes">Edit Clothes</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a class="active-link" href="?command=command=edit_item">Edit Item</a></li>
          </ol>
        </nav>
        <small style="justify-content: right;">Copyright &copy; 2022 Nathan Hartung &amp; Vivine Zheng</small>
      </div>
    </nav>
  </footer>

  <script type="text/javascript">
    document.getElementById("ArticleName").addEventListener("keyup", function() {
      inputValidate();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  <script src="js/main.js"></script>
</body>

</html>