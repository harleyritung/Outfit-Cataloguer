<?php

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
                // session_start();
                $this->delete_session();
                session_start();
                $this->login();
                break;
            case "login":
                // session_start();
                $this->login();
                break;
            case "create_account":
                // session_start();
                $this->create_account();
                break;
            case "home":
                // session_start();
                $this->home();
                break;
            case "profile":
                // session_start();
                $this->profile();
                break;
            case "upload_clothes":
                // session_start();
                $this->upload_clothes();
                break;
            case "edit_clothes":
                // session_start();
                $this->edit_clothes();
                break;
            case "edit_item":
                $this->edit_item();
                break;
            case "remove_item":
                $this->remove_item();
                break;
            case "create_outfits":
                // session_start();
                $this->create_outfits();
                break;
            case "saved_outfits":
                // session_start();
                $this->saved_outfits();
                break;
            default:
                // session_start();
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
    private function login()
    {
        if (isset($_POST["email"])) {
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
                    $insert = $this->db->query(
                        "insert into project_user (name, email, password) values (?, ?, ?);",
                        "sss",
                        $_POST["name"],
                        $_POST["email"],
                        password_hash($_POST["password1"], PASSWORD_DEFAULT)
                    );
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

    public function home()
    {
        include("templates/home.php");
    }

    public function profile()
    {
        include("templates/profile.php");
    }

    public function upload_clothes()
    {
        $print = "";
        $status = $statusMsg = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $status = 'error';
            if (!empty($_FILES['article_img']['name'])) {
                $fileName = basename($_FILES['article_img']['name']);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Allow certain file formats 
                $allowTypes = array('jpg', 'jpeg', 'png');
                if (in_array($fileType, $allowTypes)) {
                    $image = $_FILES['article_img']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));

                    if ($imgContent !== "") {
                        // Insert image content into database 
                        $insert = $this->db->query(
                            "insert into project_article (item_name, uid, item_formality, item_type, item_style, item_pattern, 
                    item_material, item_color, item_image) values (?, ?, ?, ?, ?, ?, ?, ?, ?);",
                            "sissssssb",
                            $_POST["Name"],
                            $_SESSION["uid"],
                            $_POST["Formality"],
                            $_POST["Type"],
                            $_POST["Style"],
                            $_POST["Pattern"],
                            $_POST["Material"],
                            $_POST["Color"],
                            addslashes(file_get_contents($image))
                        );

                        if ($insert) {
                            $status = 'success';
                            $statusMsg = "File uploaded successfully.";
                        } else {
                            $statusMsg = "File upload failed, please try again.";
                        }
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.';
                }
            }
        }
        echo $statusMsg;

        include("templates/upload_clothes.php");
    }

    public function edit_clothes()
    {
        $list_of_clothes_json = $this->db->query("select item_name from project_article where uid = ?;", "s", $_SESSION["uid"]);
        $list_of_clothes_json = json_encode($list_of_clothes_json);
        echo $list_of_clothes_json;

        $list_of_clothes = $this->db->query("select * from project_article where uid = ?;", "s", $_SESSION["uid"]);
        include("templates/edit_clothes.php");
    }

    public function edit_item()
    {
        $statusMsg = $status = '';
        $status = 'error';
        $item = $this->db->query("select * from project_article where item_id = ?;", "s", $_POST["item_to_edit"]);
        $item = $item[0];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Update") {
                $update = $this->db->query(
                    "update project_article set item_name = ?, item_formality = ?, item_type = ?, item_style = ?, item_pattern = ?, 
            item_material = ?, item_color = ? where item_id = ?;",
                    "sssssssb",
                    $_POST["Name"],
                    $_POST["Formality"],
                    $_POST["Type"],
                    $_POST["Style"],
                    $_POST["Pattern"],
                    $_POST["Material"],
                    $_POST["Color"],
                    $_POST['item_to_edit']
                );
                if ($update) {
                    $status = 'success';
                    $statusMsg = "Article updated successfully.";
                } else {
                    $statusMsg = "Article update failed, please try again.";
                }
                echo $statusMsg;
            }
        }

        include("templates/edit_item.php");
    }

    public function remove_item()
    {
        $statusMsg = $status = '';
        $status = 'error';
        $delete = $this->db->query("delete from project_article where item_id = ?;", "s", $_POST["item_to_remove"]);

        if ($delete) {
            $status = 'success';
            $statusMsg = "Article deleted successfully.";
        } else {
            $statusMsg = "Article deletion failed, please try again.";
        }

        $list_of_clothes = $this->db->query("select * from project_article where uid = ?;", "s", $_SESSION["uid"]);
        header("Location: ?command=edit_clothes");
    }

    public function create_outfits()
    {
        include("templates/create_outfits.php");
    }

    public function saved_outfits()
    {
        include("templates/saved_outfits.php");
    }
}
