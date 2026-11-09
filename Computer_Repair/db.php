<?php

$conn = new mysqli("localhost", "root", "", "computer_repair_db");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>