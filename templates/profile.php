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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
          <a class="nav-link" href="?command=create_outfits">Create Outfits</a>
        </li>
        <li class="nav-item page-nav-item">
          <a class="nav-link" href="?command=saved_outfits">Saved Outfits</a>
        </li>
      </ul>
    </div>
  </header>

  <!-- Page content -->
  <div class="col-12">
    <div class="container spaced-from-tb">
      <h1 class="display-6 underlined">Profile</h1>
      <form action="?command=profile" method="post" onsubmit="return validate('email', 'name');">
      <div class="mb-3 row">
        <div class="col-md-2"></div>
        <label for="email" class="col-sm-1 col-form-label">Email:</label>
        <div class="col-sm-5">
          <input class="form-control" type="email" id="email" name="email" value="<?=$_SESSION["email"]?>" disabled readonly>
        </div>
        <!-- edit button -->
        <div class="col-md-1">
          <button type="button" class="edit" id="edit-email"><img src="images/edit-pencil.png" alt="Edit email button"></button>
        </div>
      </div>
      <div class="mb-3 row">
        <div class="col-md-2"></div>
        <label for="name" class="col-sm-1 col-form-label">Name:</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" id="name" name="name" value="<?=$_SESSION["name"]?>" disabled readonly>
          <div id="inputHelp" class="form-text" style="color:red;"></div>
        </div>
        <!-- edit button -->
        <div class="col-md-1">
          <button type="button" class="edit" id="edit-name"><img src="images/edit-pencil.png" alt="Edit name button"></button>
        </div>
        <!-- submit button -->
        <div class="row" style="margin-top: 20px">
          <div class="text-center">
            <a class="btn btn-secondary form" id="cancel-button" href="?command=profile" style="display: none">Cancel</a>
            <button class="btn btn-primary form" id="submit-button" type="submit" style="display: none">Save Changes</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>

  <footer>
    <nav class="navbar fixed-bottom navbar-light bg-light" aria-label="breadcrumb">
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?command=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a class="active-link"
                href="?command=profile">Profile</a></li>
          </ol>
        </nav>
        <small style="justify-content: right;">Copyright &copy; 2022 Nathan Hartung &amp; Vivine Zheng</small>
      </div>
    </nav>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">
    // iterates through edit buttons
    $(".edit").each(function() {
      $(this).bind("click", function() {
        validate('email', 'name');
        // disable "disabled" and readonly for form input
        if ($(this).attr("id") == "edit-email") {
          $("#email").attr("disabled", false);
          $("#email").attr("readonly", false);
        }   
        else {
          $("#name").attr("disabled", false);
          $("#name").attr("readonly", false);
        }
        $(".form").each(function() {
          // display form buttons
          $(this).css("display", "");
        })
      })
    });

    // name regex
    var regex = new RegExp("[^a-zA-Z' -]");
    // regex = new RegExp('!@#$%^&*(){}[]~`:;\d<>,.?/|=+_"');
    $("#name").keyup(() => {
      // if name contains something other than letters, -, or '
      if (regex.test($("#name").val())) {
        $("#inputHelp").text("⚠ Name cannot contain special characters.");
      }
      else {
        $("#inputHelp").text("");
      }
    });
  </script>
</body>

</html>