<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<h1>My Tasks</h1>

<p>Welcome, <?php echo $_SESSION["user"]; ?></p>

<!-- DASHBOARD STATS -->
<div class="stats">
    <div class="card">
        <h3>Total Tasks</h3>
        <p><?php echo $total; ?></p>
    </div>

    <div class="card">
        <h3>Completed</h3>
        <p><?php echo $completed; ?></p>
    </div>

    <div class="card">
        <h3>Pending</h3>
        <p><?php echo $pending; ?></p>
    </div>
</div>

<!-- ACTION BUTTONS -->
<a href="index.php?url=auth/logout">Logout</a>
<a href="index.php?url=task/create">Create New Task</a>

<br><br>

<!-- FILTER FORM -->
<form method="get" action="index.php">
    <input type="hidden" name="url" value="task/index">

    <input type="text" name="search" placeholder="Search task title"
           value="<?php echo $search ?? ''; ?>">

    <select name="status">
        <option value="">All Status</option>
        <option value="pending" <?php if (($status ?? '') == 'pending') echo 'selected'; ?>>Pending</option>
        <option value="completed" <?php if (($status ?? '') == 'completed') echo 'selected'; ?>>Completed</option>
    </select>

    <select name="priority">
        <option value="">All Priority</option>
        <option value="low" <?php if (($priority ?? '') == 'low') echo 'selected'; ?>>Low</option>
        <option value="medium" <?php if (($priority ?? '') == 'medium') echo 'selected'; ?>>Medium</option>
        <option value="high" <?php if (($priority ?? '') == 'high') echo 'selected'; ?>>High</option>
    </select>

    <button type="submit">Search</button>
</form>

<hr>

<!-- TASK LIST -->
<?php if (empty($tasks)): ?>
    <p>No tasks found.</p>
<?php else: ?>

    <?php foreach ($tasks as $task): ?>
        <div class="task-card">

            <h3><?php echo $task["title"]; ?></h3>

            <p><?php echo $task["description"]; ?></p>

            <!-- STATUS -->
            <p>
                Status:
                <?php if ($task["status"] == "completed"): ?>
                    <span style="color:green; font-weight:bold;">Completed</span>
                <?php else: ?>
                    <span style="color:orange; font-weight:bold;">Pending</span>
                <?php endif; ?>
            </p>

            <!-- PRIORITY -->
            <p>
                Priority:
                <?php if ($task["priority"] == "high"): ?>
                    <span style="color:red; font-weight:bold;">High</span>

                <?php elseif ($task["priority"] == "medium"): ?>
                    <span style="color:orange; font-weight:bold;">Medium</span>

                <?php else: ?>
                    <span style="color:green; font-weight:bold;">Low</span>
                <?php endif; ?>
            </p>

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