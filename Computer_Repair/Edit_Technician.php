<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query(
"SELECT * FROM technicians WHERE technician_id='$id'"
);

$row = $result->fetch_assoc();

if(isset($_POST['update']))
{
    $name = $_POST['technician_name'];
    $contact = $_POST['contact_number'];

    $sql = "UPDATE technicians
            SET technician_name='$name',
                contact_number='$contact'
            WHERE technician_id='$id'";

    $conn->query($sql);

    header("Location: View_Technician.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Technician</title>
</head>
<body>

<h2>Edit Technician</h2>

<form method="POST">

Name:
<input type="text"
name="technician_name"
value="<?php echo $row['technician_name']; ?>">

<br><br>

Contact:
<input type="text"
name="contact_number"
value="<?php echo $row['contact_number']; ?>">

<br><br>

<input type="submit"
name="update"
value="Update">

</form>

</body>
</html>