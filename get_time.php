<?php
date_default_timezone_set('Asia/Kolkata');
$dt = date("Y-m-d H:i:s");
echo json_encode(['date_time' => $dt]);
?>
