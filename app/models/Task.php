<?php

require_once "core/Database.php";

class Task
{
    private $conn;
    private $table = "tasks";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($userId, $title, $description, $priority, $dueDate)
    {
        $sql = "INSERT INTO " . $this->table . " 
                (user_id, title, description, priority, due_date)
                VALUES (:user_id, :title, :description, :priority, :due_date)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":user_id" => $userId,
            ":title" => $title,
            ":description" => $description,
            ":priority" => $priority,
            ":due_date" => $dueDate
        ]);
    }

    public function getAllByUser($userId)
    {
        $sql = "SELECT * FROM " . $this->table . " 
                WHERE user_id = :user_id 
                ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":user_id" => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($taskId, $userId)
    {
        $sql = "DELETE FROM " . $this->table . " 
                WHERE id = :id AND user_id = :user_id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":id" => $taskId,
            ":user_id" => $userId
        ]);
    }

    public function getById($taskId, $userId)
    {
        $sql = "SELECT * FROM " . $this->table . " 
                WHERE id = :id AND user_id = :user_id 
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":id" => $taskId,
            ":user_id" => $userId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($taskId, $userId, $title, $description, $priority, $dueDate, $status)
    {
        $sql = "UPDATE " . $this->table . " 
                SET title = :title,
                    description = :description,
                    priority = :priority,
                    due_date = :due_date,
                    status = :status
                WHERE id = :id AND user_id = :user_id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":title" => $title,
            ":description" => $description,
            ":priority" => $priority,
            ":due_date" => $dueDate,
            ":status" => $status,
            ":id" => $taskId,
            ":user_id" => $userId
        ]);
    }

    public function searchAndFilter($userId, $search, $status, $priority)
    {
        $sql = "SELECT * FROM " . $this->table . " 
                WHERE user_id = :user_id";

        $params = [
            ":user_id" => $userId
        ];

        if (!empty($search)) {
            $sql .= " AND title LIKE :search";
            $params[":search"] = "%" . $search . "%";
        }

        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[":status"] = $status;
        }

        if (!empty($priority)) {
            $sql .= " AND priority = :priority";
            $params[":priority"] = $priority;
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countAll($userId)
{
    $sql = "SELECT COUNT(*) FROM tasks WHERE user_id = :user_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([":user_id" => $userId]);
    return $stmt->fetchColumn();
}

public function countCompleted($userId)
{
    $sql = "SELECT COUNT(*) FROM tasks WHERE user_id = :user_id AND status = 'completed'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([":user_id" => $userId]);
    return $stmt->fetchColumn();
}

public function countPending($userId)
{
    $sql = "SELECT COUNT(*) FROM tasks WHERE user_id = :user_id AND status = 'pending'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([":user_id" => $userId]);
    return $stmt->fetchColumn();
}
}