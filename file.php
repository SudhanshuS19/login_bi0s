<?php
$target= "/var/www/html/uploads/";
$Filename=$_FILES['resume']['name'];
$TmpName=$_FILES['resume']['tmp_name'];
$destination= $target.$Filename;
move_uploaded_file($TmpName,$destination);
echo "File Uploaded Successfully";
?>