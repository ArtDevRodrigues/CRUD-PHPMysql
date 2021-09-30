<?php
$myUserSQL = "rootart";
$myPassSQL = "root1234";
$dataBaseUsed = "agenda";


$mysqli = new mysqli("localhost", $myUserSQL, $myPassSQL, $dataBaseUsed);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>