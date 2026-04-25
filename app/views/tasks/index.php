<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<h1>My Tasks</h1>

<p>Welcome, <?php echo $_SESSION["user"]; ?></p>

<a href="index.php?url=auth/logout">Logout</a>

<a href="index.php?url=task/create">Create New Task</a>

<br><br>

<form method="get" action="index.php">
    <input type="hidden" name="url" value="task/index">

    <input type="text" name="search" placeholder="Search task title"
           value="<?php echo $search ?? ''; ?>">

    <select name="status">
        <option value="">All</option>
        <option value="pending" <?php if (($status ?? '') == 'pending') echo 'selected'; ?>>Pending</option>
        <option value="completed" <?php if (($status ?? '') == 'completed') echo 'selected'; ?>>Completed</option>
    </select>

    <button type="submit">Search</button>
</form>

<hr>

<?php if (empty($tasks)): ?>
    <p>No tasks found.</p>
<?php else: ?>

    <?php foreach ($tasks as $task): ?>
        <div class="task-card">
            <h3><?php echo $task["title"]; ?></h3>
            <p><?php echo $task["description"]; ?></p>
            <p>Status: <?php echo $task["status"]; ?></p>
            <p>Priority: <?php echo $task["priority"]; ?></p>
            <p>Due date: <?php echo $task["due_date"]; ?></p>
            <a href="index.php?url=task/edit/<?php echo $task["id"]; ?>">Edit</a>
<br>
            <a href="index.php?url=task/delete/<?php echo $task["id"]; ?>"
   onclick="return confirm('Are you sure you want to delete this task?');">
   Delete
</a>
        </div>
        <hr>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>