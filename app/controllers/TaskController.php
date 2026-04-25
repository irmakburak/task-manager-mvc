<?php

session_start();

require_once "core/Controller.php";

class TaskController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION["user_id"])) {
            $this->view("auth/login", ["error" => "Please login first."]);
            return;
        }

        $taskModel = $this->model("Task");

        $search = $_GET["search"] ?? "";
        $status = $_GET["status"] ?? "";

        $tasks = $taskModel->searchAndFilter(
            $_SESSION["user_id"],
            $search,
            $status
        );

        $this->view("tasks/index", [
            "tasks" => $tasks,
            "search" => $search,
            "status" => $status
        ]);
    }

    public function create()
    {
        if (!isset($_SESSION["user_id"])) {
            $this->view("auth/login", ["error" => "Please login first."]);
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $title = htmlspecialchars($_POST["title"]);
            $description = htmlspecialchars($_POST["description"]);
            $priority = $_POST["priority"];
            $dueDate = $_POST["due_date"];

            if (empty($title)) {
                $this->view("tasks/create", [
                    "error" => "Title is required."
                ]);
                return;
            }

            $taskModel = $this->model("Task");

            $taskModel->create(
                $_SESSION["user_id"],
                $title,
                $description,
                $priority,
                $dueDate
            );

            header("Location: index.php?url=task/index");
            exit;
        }

        $this->view("tasks/create");
    }

    public function delete($id)
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?url=auth/login");
            exit;
        }

        $taskModel = $this->model("Task");

        $taskModel->delete($id, $_SESSION["user_id"]);

        header("Location: index.php?url=task/index");
        exit;
    }

    public function edit($id)
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?url=auth/login");
            exit;
        }

        $taskModel = $this->model("Task");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $title = htmlspecialchars($_POST["title"]);
            $description = htmlspecialchars($_POST["description"]);
            $priority = $_POST["priority"];
            $dueDate = $_POST["due_date"];
            $status = $_POST["status"];

            $taskModel->update(
                $id,
                $_SESSION["user_id"],
                $title,
                $description,
                $priority,
                $dueDate,
                $status
            );

            header("Location: index.php?url=task/index");
            exit;
        }

        $task = $taskModel->getById($id, $_SESSION["user_id"]);

        $this->view("tasks/edit", [
            "task" => $task
        ]);
    }
}