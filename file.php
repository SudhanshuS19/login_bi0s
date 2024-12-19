<?php
$target_dir = "/var/www/html/uploads/"; 
$extnsn = 'TXT';

$filename = $_FILES['resume']['name'];
$tmp_name = $_FILES['resume']['tmp_name'];
$fextension = strtoupper(pathinfo($filename, PATHINFO_EXTENSION)); 
$destination = $target_dir.basename($filename);

if ($fextension !== $extnsn) {
    echo("Invalid file type. Only .txt files are allowed.");
    exit(); 
}

$filename = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $filename); 
//pattern,replace

if (file_exists($target_dir.$filename)) {
    echo("File with this name already exists. Please rename your file and try again.");
    exit(); 
}

if (move_uploaded_file($tmp_name, $target_dir.$filename)) {
    echo "File uploaded successfully!";
} 
?>


