<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="Nathan Hartung, Vivine Zheng">
  <meta name="description" content="A website for uploading clothing and generating outfits based on user input.">
  <meta name="keywords" content="outfit maker, outfit creator, outfit inspiration, outfit cataloguer, wardorbe organizer">

  <title>Outfit Cataloguer</title>

  <!-- Local CSS file -->
  <link rel="stylesheet" href="styles/main.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <script type="text/javascript">
    function checkForEnter(key) {
      if (key.keyCode == 13) {
        key.preventDefault();
      }
    }

    function switchMode() {
      if (document.getElementById("searching").hidden === true) {
        document.getElementById("filtering").hidden = true;
        document.getElementById("searching").hidden = false;
      } else {
        document.getElementById("filtering").hidden = false;
        document.getElementById("searching").hidden = true;
      }
    }

    function filter_casual() {
      var ajax = new XMLHttpRequest();
      ajax.open("GET", "?command=filter_casual", true);
      ajax.responseType = "json";
      ajax.send();

      ajax.addEventListener("load", function() {
        if (this.status == 200) { // worked 
          list_of_clothes = this.response;
          document.write(list_of_clothes);
          displaySearch();
        }
      });
    }

    function displaySearch() {
      document.getElementById("viewAll").hidden = true;
      document.getElementById("searchResult").hidden = false;
      document.getElementById("searchResult").innerHTML = list_of_clothes;
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

  <!-- Page content begins -->
  <div class="col-xl-8" id="scroll-Div">
    <div class="container spaced-from-tb">
      <?php if (count($list_of_clothes) > 0) { ?>
        <p class="m-2">Select a piece of clothing to edit.</p>
        <div class="row">
          <div class="container-fluid" id="viewAll">
            <?php foreach ($list_of_clothes as $article) : ?>
              <div class="col-lg-3 col-md-6 col-sm-6" name="article">
                <div class="rounded" style="text-align:center; background-color:beige; margin:0.25rem;">
                  <span name="item_name">
                    <?php echo $article['item_name']; ?>
                  </span>
                </div>
                <div style="text-align:center;">
                  <img src=" data:image/jpg;charset=utf8;base64,<?php echo base64_encode($article['item_image']); ?>" alt="Preview image of clothing article." width="226" height="226" class="img-thumbnail">
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="text-start" style="margin:0.25rem;">
                      <form action="?command=edit_item" method="post">
                        <input type="hidden" name="item_to_edit" value="<?php echo $article['item_id'] ?>" />
                        <button class="btn btn-success" type="submit">Edit Item</button>
                      </form>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="text-end" style="margin:0.25rem;">
                      <form action="?command=remove_item" method="post">
                        <input type="hidden" name="item_to_remove" value="<?php echo $article['item_id'] ?>" />
                        <button class="btn btn-danger" type="submit">Remove</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <br>
            <br>
          </div>
          <div class="container-fluid" id="searchResult">
          </div>
        </div>
      <?php
      } else {
        echo '<p class="m-2">No clothes have been uploaded to the database yet.</p>';
      } ?>
      <br>
    </div>
  </div>

  <!-- Formality Filtering -->
  <div class="col-xl-4 col-md col-sm">
    <div class="container spaced-from-tb">
      <div class="container">
        <div id="searching" hidden>
          <h1 class="display-6">Search Mode</h1>
          <p>Search for an article by name...</p>
          <form method="post">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Enter your search here..." id="searchValue" name="searchValue" onkeypress="checkForEnter(event)" onkeyup="search()" />
              <input type="submit" class="btn btn-primary" value="Search" id="searchBtn" name="searchBtn" onclick="search()" />
            </div>
          </form>
          <br>
          <div class="text-end">
            <button type="button" class="btn btn-warning" onclick="switchMode();">Switch to Filter Mode</button>
          </div>
          <br>
        </div>
        <div id="filtering">
          <h1 class="display-6">Filter Mode</h1>
          <p>Filter by:</p>
          <hr class="m-2">
          <p class="mb-2">Formality</p>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckCasual" onclick="filter_casual()">
            <label class="form-check-label" for="flexCheckCasual">
              Casual
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckBusinessCasual" onclick="filter_businesscasual()">
            <label class="form-check-label" for="flexCheckBusinessCasual">
              Business casual
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckSemiFormal" onclick="filter_semiformal()">
            <label class="form-check-label" for="flexCheckSemiFormal">
              Semi-formal
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="" name="flexRadioFormality" id="flexCheckFormal" onclick="filter_formal()">
            <label class="form-check-label" for="flexCheckFormal">
              Formal
            </label>
          </div>

          <div hidden>
            <!-- Type Filtering -->
            <hr class="m-2">
            <p class="mb-2">Type</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckTop" onclick="filterTop()">
              <label class="form-check-label" for="flexCheckTop">
                Top
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckBottom" onclick="filterBottom()">
              <label class="form-check-label" for="flexCheckBottom">
                Bottom
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckDefault" onclick="filterFullbody()">
              <label class="form-check-label" for="flexCheckDefault">
                Full body
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckAccessory" onclick="filterAccessory()">
              <label class="form-check-label" for="flexCheckAccessory">
                Accessory
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioType" value="" id="flexCheckShoes" onclick="filterShoes()">
              <label class="form-check-label" for="flexCheckShoes">
                Shoes
              </label>
            </div>
          </div>
          <br>
          <div class="text-end">
            <button type="button" class="btn btn-warning" onclick="switchMode();">Switch to Search Mode</button>
          </div>
        </div>
        <br>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>

</html>