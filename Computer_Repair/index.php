<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Computer Repair System</title>
</head>
<body>

    <h1>Computer Repair and IT Services</h1>

    <a href="add_technician.php">Add Technician</a><br><br>

    <a href="View_Technician.php">View Technicians</a><br><br>

    <a href="Add_Request.php">Add Service Request</a><br><br>

    <a href="View_Request.php">View Service Requests</a>

</body>
</html>
