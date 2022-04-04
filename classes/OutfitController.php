<?php

class OutfitController {
    private $command;

    private $db;
    
    // If using Monolog (with Composer)
    //private $logger;

    public function __construct($command) {
        //***********************************
        // If we use Composer to include the Monolog Logger
        // global $log;
        // $this->logger = new \Monolog\Logger("OutfitController");
        // $this->logger->pushHandler($log);
        //***********************************

        $this->command = $command;

        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "logout":
                session_start();
                $this->delete_session();
                $this->login();
                break;
            case "login":
                session_start();
                $this->login();
                break;
            case "create_account":
                session_start();
                $this->create_account();
                break;  
            case "home":
                session_start();
                $this->home();
                break;
            case "profile":
                session_start();
                $this->profile();
                break;
            case "create_outfits":
                session_start();
                $this->create_outfits();
                break;
            case "edit_clothes":
                session_start();
                $this->edit_clothes();
                break;
            case "saved_outfits":
                session_start();
                $this->saved_outfits();
                break;
            case "upload_clothes":
                session_start();
                $this->upload_clothes();
                break;
            default:
                session_start();
                $this->login();
                break;
        }
    }

    public function delete_session() {
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(),'',0,'/');
    }

    // Display the login page (and handle login logic)
    private function login() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from project_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } 
            else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["uid"] = $data[0]["uid"];
                    header("Location: ?command=home");
                } 
                else {
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

    public function create_account() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from project_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } 
            // user already exists
            else if (!empty($data)) {
                $error_msg = "Account with this email already exists";
            } 
            // user doesn't exist
            else {
                if ($_POST["password1"] === $_POST["password2"]) {
                    $insert = $this->db->query("insert into project_user (name, email, password) values (?, ?, ?);", 
                    "sss", $_POST["name"], $_POST["email"], 
                    password_hash($_POST["password1"], PASSWORD_DEFAULT));
                    if ($insert === false) {
                        $error_msg = "Error inserting user";
                    } else {
                        $data = $this->db->query("select * from project_user where email = ?;", "s", $_POST["email"]);
                        $_SESSION["name"] = $_POST["name"];
                        $_SESSION["email"] = $_POST["email"];
                        $_SESSION["uid"] = $data[0]["uid"];
                        header("Location: ?command=home");
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

    public function home() {
        include("templates/home.php");
    }

    public function profile() {
        include("templates/profile.php");
    }

    public function create_outfits() {
        include("templates/create_outfits.php");
    }

    public function edit_clothes() {
        include("templates/edit_clothes.php");
    }

    public function saved_outfits() {
        include("templates/saved_outfits.php");
    }

    public function upload_clothes() {
        include("templates/upload_clothes.php");
    }
}