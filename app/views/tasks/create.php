<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<h1>Create New Task</h1>

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="">
    <input type="text" name="title" placeholder="Task title"><br><br>

    <textarea name="description" placeholder="Task description"></textarea><br><br>

    <select name="priority">
        <option value="low">Low</option>
        <option value="medium" selected>Medium</option>
        <option value="high">High</option>
    </select><br><br>

    <input type="date" name="due_date"><br><br>

    <button type="submit">Create Task</button>
</form>

<br>
<a href="index.php?url=task/index">Back to Tasks</a>

</body>
</html>