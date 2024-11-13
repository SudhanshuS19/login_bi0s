<?php
session_start();
require 'config.php';

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM data WHERE username='$usernameemail' OR email='$usernameemail'");
    if ($usernameemail=='admin' and $password=='admin'){
        header("Location: admin.php");
        exit();
    }
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row["username"]; 
            header("Location: index.php");
            exit();        
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post" autocomplete="off">
        <label for="usernameemail">Username or Email :</label>
        <input type="text" name="usernameemail" id="usernameemail" required><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">New User? Register Here!</a><br>
</body>
</html>
