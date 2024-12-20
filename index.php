<?php
session_start();
require 'config.php';  

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRAZYY</title>
    <script>
        window.onload = function() {
            const nickname = prompt("Please enter your nickname:");

            if (nickname) {
                const greeting = document.createElement('h1');
                greeting.innerText = `Hi, ${nickname}! How are you?`;
                document.body.insertBefore(greeting, document.body.firstChild);
            }
        };
    </script>
</head>
<body>
<hr>
<div id="demo">
    <h2>Want to know what this website is for? <button type="button" onclick="loadDoc()">Know More</button></h2>
    <hr>
</div>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "ajax.txt", true);
  xhttp.send();
}
</script>

<?php
if (isset($_GET['view'])) {
    $Dir = '/var/www/html/uploads/';
    $files = array_diff(scandir($Dir), array('..', '.'));
    
    if (count($files) > 0) {
        echo "<h2>All Uploaded Files:</h2>";
        echo "<ul>";
        foreach ($files as $file) {
            $fileUrl = "/uploads/".urlencode($file); 
            echo "<li><a href='$fileUrl'>".htmlspecialchars($file) . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No files uploaded yet.";
    }
} else {
    echo '<form action="file.php" method="post" enctype="multipart/form-data">
            <label for="resume">Select a file to upload</label><br><br>
            <input type="file" name="resume" id="resume"><br><br>
            <input type="submit" value="Upload File"><br><br>
          </form>';
    echo '<form action="" method="get">
            <button type="submit" name="view">View all uploaded files</button>
          </form><br>';
    echo '<hr><br><form action="logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
          </form>';
}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><hr>

    <script>
        function fetchDateTime() {
            fetch('get_time.php')
                .then(response => response.json())  
                .then(data => {
                    const dateTime = data.date_time;
                    document.getElementById('date-time-display').innerText = 'Current Date and Time: ' + dateTime;
                })
                .catch(error => {
                    console.error('Error fetching date and time:', error);
                });
        }
    </script>
</head>
<body>

    <button onclick="fetchDateTime()">Get Date and Time</button>
    <div id="date-time-display"></div>

</body>
</html>
