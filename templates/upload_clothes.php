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

<body>
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
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autocomplete="on">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
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
    <div class="col-md-4 file-upload-container">
      <div class="container spaced-from-tb">
        <h1 class="display-6 underlined ps-1">Upload Picture</h1>
        <label for="upload-picture">Upload here:</label>
        <input style="color: black;" type="file" id="upload-picture" name="upload picture area" accept="image/*">
        <div class="drop-zone" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
          <p class="drop-zone-text">Or drag a picture here</p>
        </div>
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
            <p class="mb-2">Formality:</p>
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
            <hr class="m-2">

            <!-- Type Selection -->
            <p class="mb-2">Type:</p>
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
            <hr class="m-2">
          </div>
        </div>
        <!-- upload button -->
        <form>
          <button class="submit-button" form="POST" type="submit">Upload to Wardrobe</button>
        </form>
      </div>
      <!-- </div> -->
      <!-- Optional attributes -->
      <div class="col-md-6">
        <div class="container spaced-from-tb">
          <div class="container">
            <h1 class="display-6">Optional Attributes</h1>
            <hr class="m-2">
            <p class="mb-2">Style:</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckSport">
              <label class="form-check-label" for="flexCheckSport">
                Sport
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckPreppy">
              <label class="form-check-label" for="flexCheckPreppy">
                Preppy
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckBoho">
              <label class="form-check-label" for="flexCheckBoho">
                Boho
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckGrunge">
              <label class="form-check-label" for="flexCheckGrunge">
                Grunge
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckStreetwear">
              <label class="form-check-label" for="flexCheckStreetwear">
                Streetwear
              </label>
            </div>
            <hr class="m-2">

            <!-- Pattern Selection -->
            <p class="mb-2">Pattern:</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckPlain">
              <label class="form-check-label" for="flexCheckPlain">
                Plain
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckStripes">
              <label class="form-check-label" for="flexCheckStripes">
                Stripes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckGraphic">
              <label class="form-check-label" for="flexCheckGraphic">
                Graphic
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDots">
              <label class="form-check-label" for="flexCheckDots">
                Dots
              </label>
            </div>
            <hr class="m-2">

            <!-- Material Selection -->
            <p class="mb-2">Material:</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckCotton">
              <label class="form-check-label" for="flexCheckCotton">
                Cotton
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDenim">
              <label class="form-check-label" for="flexCheckDenim">
                Denim
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckLeather">
              <label class="form-check-label" for="flexCheckLeather">
                Leather
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckSynthetic">
              <label class="form-check-label" for="flexCheckSynthetic">
                Synthetic
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckWool">
              <label class="form-check-label" for="flexCheckWool">
                Wool
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckKhaki">
              <label class="form-check-label" for="flexCheckKhaki">
                Khaki
              </label>
            </div>
            <hr class="m-2">

            <!-- Color Selection -->
            <p class="mb-2">Color:</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckBlack">
              <label class="form-check-label" for="flexCheckBlack">
                Black
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckBrown">
              <label class="form-check-label" for="flexCheckBrown">
                Brown
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckWhite">
              <label class="form-check-label" for="flexCheckWhite">
                White
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckGrey">
              <label class="form-check-label" for="flexCheckGrey">
                Grey
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckBlue">
              <label class="form-check-label" for="flexCheckBlue">
                Blue
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckGreen">
              <label class="form-check-label" for="flexCheckGreen">
                Green
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckYellow">
              <label class="form-check-label" for="flexCheckYellow">
                Yellow
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckOrange">
              <label class="form-check-label" for="flexCheckOrange">
                Orange
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckRed">
              <label class="form-check-label" for="flexCheckRed">
                Red
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckPink">
              <label class="form-check-label" for="flexCheckPink">
                Pink
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckPurple">
              <label class="form-check-label" for="flexCheckPurple">
                Purple
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
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a class="active-link"
                href="?command=upload_clothes">Upload Clothes</a></li>
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