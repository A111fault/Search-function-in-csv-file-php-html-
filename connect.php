<?php

$con = new mysqli('localhost', 'root', '', 'search');

if (!$con) {
    die(mysqli_error($con));
}
?>