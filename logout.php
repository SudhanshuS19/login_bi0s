<?php
<<<<<<< HEAD
=======
session_start();
>>>>>>> cb017f9 (updating)
require 'config.php';
$_SESSION=[];
session_unset();
session_destroy();
header("Location: login.php");
?>