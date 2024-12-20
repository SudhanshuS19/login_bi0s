<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'config.php';

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    
    
    if (isset($_POST['remember'])){
        $remember = $_POST['remember'];
    }
    
    
    $stmt = $conn->prepare("SELECT * FROM data WHERE username=? OR email=?");
    $stmt->bind_param("ss", $usernameemail, $usernameemail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($usernameemail == 'admin' && $password == 'admin') {
        $_SESSION["admin"] = "ok";
        header("Location: admin.php");
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            
            if (isset($_POST['remember'])) {
                if ($usernameemail === $row["email"]) {
                    setcookie("remememail", $_SESSION["email"], time() + 86400); 
                    setcookie("rememuser", "", time() - 3600); 
                } else {
                    setcookie("rememuser", $_SESSION["username"], time() + 86400); 
                    setcookie("remememail", "", time() - 3600); 
                }
                setcookie("remem", $remember, time() + 86400); 
            } else {
                setcookie("remememail", "", time() - 3600);
                setcookie("rememuser", "", time() - 3600);
                setcookie("remem", "", time() - 3600);
            }

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
<iframe src="https://winters0x64.xyz/about/" style="border:none; display: block; margin-left: auto; margin-right: auto;" height="400" width="900" title="Lob is to bi0s"></iframe>    
<p><a href="https://tenor.com/view/scuze-corgi-corgi-smile-gif-17372363576878719262" target="iframe_a">🐐</a></p>  
    <h2>Login</h2>
    <form action="" method="post" autocomplete="off">
        <label for="usernameemail">Username or Email :</label>
        <input type="text" name="usernameemail" id="usernameemail" 
               value="<?php echo isset($_COOKIE['rememuser']) ? $_COOKIE['rememuser'] : (isset($_COOKIE['remememail']) ? $_COOKIE['remememail'] : ''); ?>" required><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required><br>

        <input type="checkbox" name="remember" class="check" <?php echo isset($_COOKIE["remem"]) ? 'checked' : ''; ?>> Remember Me
        
        <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">New User? Register Here!</a><br>
</body>
</html>
