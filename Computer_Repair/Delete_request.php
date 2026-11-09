<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM service_requests WHERE request_id='$id'");

header("Location: View_Request.php");
exit();
?>