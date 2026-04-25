<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<h1>User Register</h1>

<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color:green;"><?php echo $success; ?></p>
<?php endif; ?>

<form method="post" action="">
    <input type="text" name="name" placeholder="Name"><br><br>

    <input type="email" name="email" placeholder="Email"><br><br>

    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Register</button>
</form>
    <br>
<p>
    Already have an account?
    <a href="index.php?url=auth/login">Login</a>
</p>

</body>
</html>