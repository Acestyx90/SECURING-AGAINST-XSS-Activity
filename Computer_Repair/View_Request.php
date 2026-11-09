<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$sql = "
SELECT
    s.request_id,
    t.technician_name,
    s.customer_name,
    s.service_type,
    s.added_by,
    s.last_updated
FROM service_requests s
JOIN technicians t
ON s.technician_id = t.technician_id
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Service Requests</title>
</head>
<body>

<h2>Service Requests</h2>
<p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> | <a href="index.php">Dashboard</a> | <a href="logout.php">Logout</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Request ID</th>
        <th>Technician</th>
        <th>Customer</th>
        <th>Service</th>
        <th>Added By</th>
        <th>Last Updated</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc())
        {
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row['request_id']); ?></td>
            <td><?php echo htmlspecialchars($row['technician_name']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($row['service_type']); ?></td>
            <td><?php echo htmlspecialchars($row['added_by']); ?></td>
            <td><?php echo htmlspecialchars($row['last_updated']); ?></td>

            <td>
                <a href="edit_request.php?id=<?php echo $row['request_id']; ?>">
                    Edit
                </a>

                |

                <a href="delete_request.php?id=<?php echo $row['request_id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this request?');">
                    Delete
                </a>
            </td>
        </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='7' style='text-align: center;'>No service requests found.</td></tr>";
    }
    ?>
</table>

<br><br>

<a href="index.php">Back</a>

</body>
</html>