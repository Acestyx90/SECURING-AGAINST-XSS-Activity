<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    
    $conn = new mysqli("localhost", "root", "", "computer_repair_db");
} catch (mysqli_sql_exception $e) {

    
    echo "<style>
            body { background:black; color:#00ff00; font-family:Courier; }
            h1 { font-size:48px; }
          </style>";
    echo "<h1>⚠ SYSTEM COMPROMISED ⚠</h1>";
    echo "<p>This is a <strong>simulation only</strong>. No real attack occurred.</p>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";

    exit();
}
?>
<?php
include 'db.php';

if(isset($_POST['save']))
{
    $name = $_POST['technician_name'];
    $contact = $_POST['contact_number'];

    $sql = "INSERT INTO technicians
            (technician_name, contact_number)
            VALUES
            ('$name','$contact')";

    $conn->query($sql);

    echo "Technician Added!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Technician</title>
</head>
<body>

<h2>Add Technician</h2>

<form method="POST">

    Name:
    <input type="text" name="technician_name" required>

    <br><br>

    Contact:
    <input type="text" name="contact_number" required>

    <br><br>

    <input type="submit" name="save" value="Save">

</form>

<br>

<a href="index.php">Back</a>

</body>
</html>
