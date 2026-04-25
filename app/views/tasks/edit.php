<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<h1>Edit Task</h1>

<form method="post" action="">
    <input type="text" name="title" value="<?php echo $task['title']; ?>"><br><br>

    <textarea name="description"><?php echo $task['description']; ?></textarea><br><br>

    <select name="priority">
        <option value="low" <?php if ($task['priority'] == 'low') echo 'selected'; ?>>Low</option>
        <option value="medium" <?php if ($task['priority'] == 'medium') echo 'selected'; ?>>Medium</option>
        <option value="high" <?php if ($task['priority'] == 'high') echo 'selected'; ?>>High</option>
    </select><br><br>

    <select name="status">
        <option value="pending" <?php if ($task['status'] == 'pending') echo 'selected'; ?>>Pending</option>
        <option value="completed" <?php if ($task['status'] == 'completed') echo 'selected'; ?>>Completed</option>
    </select><br><br>

    <input type="date" name="due_date" value="<?php echo $task['due_date']; ?>"><br><br>

    <button type="submit">Update Task</button>
</form>

<br>
<a href="index.php?url=task/index">Back to Tasks</a>

</body>
</html>