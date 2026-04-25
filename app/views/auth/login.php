<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<h1>User Login</h1>

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color:green;"><?php echo $success; ?></p>
<?php endif; ?>

<form method="post" action="">
    <input type="email" name="email" placeholder="Email"><br><br>

    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Login</button>
</form>
    <br>
<p>
    Don't have an account?
    <a href="index.php?url=auth/register">Register</a>
</p>

</body>
</html>