<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM service_requests WHERE technician_id='$id'");


$conn->query("DELETE FROM technicians WHERE technician_id='$id'");

header("Location: View_Technician.php");
exit();
?>