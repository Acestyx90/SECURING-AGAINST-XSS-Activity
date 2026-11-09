<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM service_requests WHERE request_id='$id'");
$row = $result->fetch_assoc();

if(isset($_POST['update']))
{
    $customer = $_POST['customer_name'];
    $service = $_POST['service_type'];

    $conn->query("UPDATE service_requests
                  SET customer_name='$customer',
                      service_type='$service'
                  WHERE request_id='$id'");

    header("Location: View_Request.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Request</title>
</head>
<body>

<h2>Edit Service Request</h2>

<form method="POST">

    Customer Name:
    <input type="text" name="customer_name"
           value="<?php echo $row['customer_name']; ?>" required>

    <br><br>

    Service Type:
    <input type="text" name="service_type"
           value="<?php echo $row['service_type']; ?>" required>

    <br><br>

    <input type="submit" name="update" value="Update Request">

</form>

<br><br>

<a w_Request.phpBack</a>

</body>
</html>