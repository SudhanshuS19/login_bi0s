<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect("localhost", "nameless", "1234", "bios");
?>
