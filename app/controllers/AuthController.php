<?php
session_start();

require_once "core/Controller.php";

class AuthController extends Controller
{
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = $_POST["password"];

            if (empty($name) || empty($email) || empty($password)) {
                $this->view("auth/register", ["error" => "All fields are required."]);
                return;
            }

            $user = $this->model("User");

            if ($user->register($name, $email, $password)) {
                $this->view("auth/register", ["success" => "User registered successfully."]);
            } else {
                $this->view("auth/register", ["error" => "Registration failed."]);
            }

        } else {
            $this->view("auth/register");
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = htmlspecialchars($_POST["email"]);
            $password = $_POST["password"];

            $user = $this->model("User");
            $loggedUser = $user->login($email, $password);

            if ($loggedUser) {
                $_SESSION["user_id"] = $loggedUser["id"];
                $_SESSION["user"] = $loggedUser["name"];

                header("Location: index.php?url=task/index");
                exit;

            } else {
                $this->view("auth/login", ["error" => "Invalid credentials"]);
            }

        } else {
            $this->view("auth/login");
        }
    }

    public function logout()
    {
        session_destroy();

        header("Location: index.php?url=auth/login");
        exit;
    }
}