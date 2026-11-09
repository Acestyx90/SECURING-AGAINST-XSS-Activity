<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if(isset($_POST['save']))
{
    $tech = $_POST['technician_id'];
    $customer = $_POST['customer_name'];
    $service = $_POST['service_type'];
    
    
    $added_by = $_SESSION['username'];

    
    $sql = "INSERT INTO service_requests
            (technician_id, customer_name, service_type, added_by)
            VALUES
            ('$tech', '$customer', '$service', '$added_by')";

    if($conn->query($sql))
    {
        echo "<p style='color:green;'>Request Added Successfully!</p>";
    }
    else
    {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Service Request</title>
</head>
<body>

<h2>Add Service Request</h2>
<p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>

<form method="POST">

    <label>Technician:</label>

    <select name="technician_id" required>
        <?php
        $result = $conn->query("SELECT * FROM technicians");

        while($row = $result->fetch_assoc())
        {
            echo "<option value='".$row['technician_id']."'>";
            echo $row['technician_name'];
            echo "</option>";
        }
        ?>
    </select>

    <br><br>

    <label>Customer Name:</label>
    <input type="text" name="customer_name" required>

    <br><br>

    <label>Service Type:</label>
    <input type="text" name="service_type" required>

    <br><br>

    <input type="submit" name="save" value="Add Request">

</form>

<br><br>

<a href="index.php">Back</a>

</body>
</html>