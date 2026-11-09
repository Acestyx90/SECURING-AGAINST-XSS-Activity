<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
include 'db.php';

$result = $conn->query("SELECT * FROM technicians");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Technicians</title>
</head>
<body>

<h2>Registered Technicians</h2>

<table border="1">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Contact</th>
    <th>Actions</th>
</tr>

<?php
while($row = $result->fetch_assoc())
{
?>
<tr>
    <td><?php echo $row['technician_id']; ?></td>
    <td><?php echo $row['technician_name']; ?></td>
    <td><?php echo $row['contact_number']; ?></td>

    <td>
        <a href="edit_technician.php?id=<?php echo $row['technician_id']; ?>">
            Edit
        </a>

        |

        <a href="delete_technician.php?id=<?php echo $row['technician_id']; ?>"
           onclick="return confirm('Are you sure you want to delete this technician?');">
            Delete
        </a>
    </td>
</tr>
<?php
}
?>

</table>

<br><br>

<a href="index.php">Back</a>

</body>
</html>