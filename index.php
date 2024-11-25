<?php
session_start();
require 'config.php';  

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['view'])) {
    $Dir = '/var/www/html/uploads/';
<<<<<<< HEAD
=======
    
>>>>>>> cb017f9 (updating)
    $files = array_diff(scandir($Dir), array('..', '.'));
    
    if (count($files) > 0) {
        echo "<h2>All Uploaded Files:</h2>";
        echo "<ul>";
        
        foreach ($files as $file) {
            $fileUrl = "/uploads/" . urlencode($file); 

          
            echo "<li><a href='$fileUrl'>" . htmlspecialchars($file) . "</a></li>";
        }
        
        echo "</ul>";
    } else {
        echo "No files uploaded yet.";
    }

} else {
    echo "<h1>Hi, How are you?</h1>";
    echo '<form action="file.php" method="post" enctype="multipart/form-data">
            <label for="resume">Select a file to upload</label><br><br>
            <input type="file" name="resume" id="resume"><br><br>
            <input type="submit" value="Upload File"><br><br>
          </form>';
    echo '<form action="" method="get">
            <button type="submit" name="view">View all uploaded files</button>
          </form>';
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Index</title>
</head>
<body>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
