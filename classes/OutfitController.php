<?php

define ('SITE_ROOT', realpath(dirname(__FILE__)));

class OutfitController
{
    private $command;

    private $db;

    // If using Monolog (with Composer)
    //private $logger;

    public function __construct($command)
    {
        //***********************************
        // If we use Composer to include the Monolog Logger
        // global $log;
        // $this->logger = new \Monolog\Logger("OutfitController");
        // $this->logger->pushHandler($log);
        //***********************************

        $this->command = $command;

        $this->db = new Database();
    }

    public function run()
    {
        switch ($this->command) {
            case "logout":
                $this->delete_session();
                session_start();
                $this->login();
                break;
            case "login":
                $this->login();
                break;
            case "create_account":
                $this->create_account();
                break;
            case "home":
                $this->home();
                break;
            case "profile":
                $this->profile();
                break;
            case "edit_profile":
                $this->edit_profile();
                break;
            case "create_outfits":
                $this->create_outfits();
                break;
            case "edit_clothes":
                $this->edit_clothes();
                break;
            case "saved_outfits":
                $this->saved_outfits();
                break;
            case "upload_clothes":
                $this->upload_clothes();
                break;
            default:
                $this->login();
                break;
        }
    }

    public function delete_session()
    {
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(), '', 0, '/');
    }

    // Display the login page (and handle login logic)
    private function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $this->db->query("select * from project_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["uid"] = $data[0]["uid"];
                    header("Location: ?command=home");
                } else {
                    $error_msg = "Wrong password";
                }
            }
            // user doesn't exist
            else {
                $error_msg = "No user with that email exists";
            }
        }
        include("templates/login.php");
    }

    public function create_account()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $this->db->query("select * from project_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                 $error_msg = "Error checking for user";
            } 

            // user already exists
            if (!empty($data)) {
                $error_msg = "Account with this email already exists";
            }
            // user doesn't exist
            else {
                if ($_POST["password1"] === $_POST["password2"]) {
                    $pw_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d!@#$%&*?]{8,}$/";
                    // password meets requirements
                    if (preg_match($pw_regex, $_POST["password1"]) === 1) {
                        $insert = $this->db->query("insert into project_user (name, email, password) values (?, ?, ?);", 
                        "sss", 
                        $_POST["name"], 
                        $_POST["email"], 
                        password_hash($_POST["password1"], PASSWORD_DEFAULT));
                        if ($insert === false) {
                            $error_msg = "Error inserting user";
                        } 
                        else {
                            $data = $this->db->query("select * from project_user where email = ?;", "s", $_POST["email"]);
                            $_SESSION["name"] = $_POST["name"];
                            $_SESSION["email"] = $_POST["email"];
                            $_SESSION["uid"] = $data[0]["uid"];
                            header("Location: ?command=home");
                        }
                    }
                    // password fails regex
                    else {
                        $error_msg = "Make sure password meets requirements";
                    }
                }
                // passwords don't match
                else {
                    $error_msg = "Passwords don't match";
                }
            }
        }
        include("templates/create_account.php");
    }

    public function home()
    {
        include("templates/home.php");
    }

    public function profile()
    {
        include("templates/profile.php");
    }

    public function edit_profile() {
        // user edited profile
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["name"] = $_POST["name"];

            $update = $this->db->query("update project_user set email=?, name=? where uid=?;", "ssi", $_POST["email"], $_POST["name"], 
            $_SESSION["uid"]);
            if ($update === false) {
                $error_msg = "Error updating profile";
            }
            else {
                header("Location: ?command=profile");
            }
        }
        include("templates/edit_profile.php");
    }

    public function create_outfits() {
        include("templates/create_outfits.php");
    }

    public function edit_clothes() {
        $list_of_clothes = $this->db->query("select * from project_article where uid = ?;", "s", $_SESSION["uid"]);
        include("templates/edit_clothes.php");
    }

    public function saved_outfits() {
        include("templates/saved_outfits.php");
    }

    public function upload_clothes() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_FILES['article_img']['tmp_name'])) {
                // print_r($_FILES);
                $img_name = basename($_FILES['article_img']['tmp_name']); 
                // echo "site root: " . SITE_ROOT;
                $img_uploaded = move_uploaded_file($_FILES['article_img']['tmp_name'], SITE_ROOT . "/../images/$img_name");                    
            }
            else {
                $img_name = NULL;
            }
            // if user is trying to submit an image and it isn't uploaded
            if (!$img_uploaded && ($img_name !== NULL)) {
                $error_msg = "Error uploading image, please try again.";
            } 
            // image uploaded successfully or no image submitted
            else {
                // change optional attrs to NULL instead of "Null" if applicable
                $optional_attrs = [
                    "style" => $_POST["Style"],
                    "pattern" => $_POST["Pattern"],
                    "material" => $_POST["Material"],
                    "color" => $_POST["Color"]
                ];
                foreach ($optional_attrs as $key => $value) {
                    if ($value === "Null") {
                        $optional_attrs[$key] = NULL;
                    }
                }
                // Insert into db
                $insert = $this->db->query(
                    "insert into project_article (item_name, uid, item_formality, item_type, item_style, item_pattern, 
                    item_material, item_color, item_image_path) values (?, ?, ?, ?, ?, ?, ?, ?, ?);",
                    "sisssssss",
                    $_POST["Name"],
                    $_SESSION["uid"],
                    $_POST["Formality"],
                    $_POST["Type"],
                    $optional_attrs["style"], 
                    $optional_attrs["pattern"], 
                    $optional_attrs["material"], 
                    $optional_attrs["color"],
                    $img_name
                );
                if (!$insert) {
                    $error_msg = "File upload failed, please try again.";
                }
            }
        }

        include("templates/upload_clothes.php");
    }
}
