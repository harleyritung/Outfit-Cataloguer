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
          <a class="nav-link" href="?command=edit_clothes">Edit Clothes</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link active" href="?command=create_outfits" aria-current="page">Create Outfits</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link" href="?command=saved_outfits">Saved Outfits</a>
        </li>
      </ul>
    </div>
  </header>

  <!-- Page content begins -->
  <div class="container-fluid" id="scroll-Div">
    <div class="col-md-6">
      <div class="container spaced-from-tb">
        <div class="col-12">
          <p class="m-2">Select clothes to be included in generated outfits:</p>
          <div class="row">
            <div class="col-8" id="clothesSearchContainer">
              <form class="d-flex m-2">
                <input class="form-control border-end-0" type="search" placeholder="Search here..." aria-label="Search"
                  style="border-radius: 0;
              border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;">
                <button class="btn btn-outline-success" type="submit" style="border-radius: 0; border-top-right-radius: 0.25rem;
              border-bottom-right-radius: 0.25rem;">Search</button>
              </form>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-12 border p-2">
              <img src="images/150x150.png" alt="150x150 grey image placeholder box." class="img-thumbnail">
              <img src="images/150x150.png" alt="150x150 grey image placeholder box." class="img-thumbnail">
            </div>
          </div>
        </div>

        <!-- Style Filtering -->
        <div class="row p-2">
          <div class="col-6">
            <p class="mb-2">Select styles:</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckSport">
              <label class="form-check-label" for="flexCheckSport">
                Sport
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckRelaxed">
              <label class="form-check-label" for="flexCheckRelaxed">
                Relaxed
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckOversized">
              <label class="form-check-label" for="flexCheckOversized">
                Oversized
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckFall">
              <label class="form-check-label" for="flexCheckFall">
                Fall
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckPreppyAcademic">
              <label class="form-check-label" for="flexCheckPreppyAcademic">
                Preppy/academic
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDate">
              <label class="form-check-label" for="flexCheckDate">
                Date
              </label>
            </div>
          </div>
          <div class="col-6">
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
          </div>
        </div>
      </div>
    </div>

    <!-- Pattern Filtering -->
    <div class="col-md-3">
      <div class="container spaced-from-tb">
        <div class="container">
          <p class="mb-2">Include clothes with these patterns:</p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSolid">
            <label class="form-check-label" for="flexCheckSolid">
              Solid
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckFlannelPlaid">
            <label class="form-check-label" for="flexCheckFlannelPlaid">
              Flannel/plaid
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckStriped">
            <label class="form-check-label" for="flexCheckStriped">
              Striped
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSequin">
            <label class="form-check-label" for="flexCheckSequin">
              Sequin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSpottedDots">
            <label class="form-check-label" for="flexCheckSpottedDots">
              Spotted/dots
            </label>
          </div>
          <br>
          <p class="mb-2">Include clothes of these materials:</p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckCotton">
            <label class="form-check-label" for="flexCheckCotton">
              Cotton
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckJean">
            <label class="form-check-label" for="flexCheckJean">
              Jean
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSilk">
            <label class="form-check-label" for="flexCheckSilk">
              Silk
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckPolyester">
            <label class="form-check-label" for="flexCheckPolyester">
              Polyester
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckKnit">
            <label class="form-check-label" for="flexCheckKnit">
              Knit
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckCorduroy">
            <label class="form-check-label" for="flexCheckCorduroy">
              Corduroy
            </label>
          </div>
        </div>
      </div>
    </div>

     <!-- Top Filtering -->
    <div class="col-md-3">
      <div class="container spaced-from-tb">
        <div class="container">
          <p class="mb-2">Include these tops:</p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckTShirt">
            <label class="form-check-label" for="flexCheckTShirt">
              T-shirt
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckLongSleeve">
            <label class="form-check-label" for="flexCheckLongSleeve">
              Long sleeve
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSweater">
            <label class="form-check-label" for="flexCheckSweater">
              Sweater
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSweatshirt">
            <label class="form-check-label" for="flexCheckSweatshirt">
              Sweatshirt
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckButtonUp">
            <label class="form-check-label" for="flexCheckButtonUp">
              Button up
            </label>
          </div>
          <br>

          <!-- Bottom Filtering -->
          <p class="mb-2">Include these bottoms:</p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckShorts">
            <label class="form-check-label" for="flexCheckShorts">
              Shorts
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckJeans">
            <label class="form-check-label" for="flexCheckJeans">
              Jeans
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSkirt">
            <label class="form-check-label" for="flexCheckSkirt">
              Skirt
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSweatpants">
            <label class="form-check-label" for="flexCheckSweatpants">
              Sweatpants
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckSlacks">
            <label class="form-check-label" for="flexCheckSlacks">
              Slacks
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckKhakis">
            <label class="form-check-label" for="flexCheckKhakis">
              Khakis
            </label>
          </div>
          <br>
          <br>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-success">Generate</button>
      </div>
      <br>
      <br>
      <br>
      <br>
    </div>
  </div>

  <!-- Page content ends -->

  <footer>
    <nav class="navbar fixed-bottom navbar-light bg-light" aria-label="breadcrumb">
      <div class="container-fluid" style="padding-top: 0.5rem;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a class="active-link"
                href="?command=create_outfits">Create Outfits</a></li>
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