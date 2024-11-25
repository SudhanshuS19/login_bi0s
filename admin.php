<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h2>Welcome Admin</h2>
    <form method="POST">
        <label for="deleteuser">Username (to be deleted)</label>
        <input type="text" name="deleteuser" id="deleteuser">
        <button type="submit" name="button">Delete user</button>
        <br><br>
        <hr>
        <br>
        <label for="oldusername">Old Username</label>
        <input type="text" name="oldusername" id="oldusername">
        <label for="newusername">New Username</label>
        <input type="text" name="newusername" id="newusername">
        <button type="submit" name="click">Change username</button>
        <br><br>
        <button type="button" onclick="location.href='add.php'">Add New User</button>
        <hr>
        <h3>To view all users:</h3>
        <button type="submit" name="user">Click Here!</button>
        <br>
        <hr>
        <br>
        <button type="button" onclick="location.href='logout.php'">Logout</button>
    </form>

<?php
require 'config.php';
session_start();
if ($_SESSION['admin']!="ok") {
    header("Location: login.php");
    exit(); 

}
print_r($_SESSION);
//else{
//     header("Location:login.php");
// }
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// if (!isset($_SESSION["username"]) || $_SESSION["username"] !== 'admin') {
//     header("Location: login.php");
//     exit(); 

// if ($_SESSION["login"]!=true) {
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['click'])) { 
        $oldusername = mysqli_real_escape_string($conn, $_POST['oldusername']); 
        $newusername = mysqli_real_escape_string($conn, $_POST['newusername']);
        $query = "UPDATE data SET username='$newusername' WHERE username='$oldusername'";
        mysqli_query($conn, $query);
    }

    if (isset($_POST['button'])) {
        $username = mysqli_real_escape_string($conn, $_POST['deleteuser']);
        $query = "DELETE FROM data WHERE username='$username'";
        mysqli_query($conn, $query);
    }

    if (isset($_POST['user'])) {
        $result = mysqli_query($conn, "SELECT * FROM data");

        if (mysqli_num_rows($result) > 0) {
            echo '<table class="data-table">';
            echo '<tr class="data-heading">';
            echo "<br>";

            while ($property = mysqli_fetch_field($result)) {
                echo '<th>' . htmlspecialchars($property->name) . '</th>';
            }
            echo '</tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $item) {
                    echo '<td>' . htmlspecialchars($item) . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>'; 
        } else {
            echo 'No records found.';
        }
    }
}
?>
</body>
</html>