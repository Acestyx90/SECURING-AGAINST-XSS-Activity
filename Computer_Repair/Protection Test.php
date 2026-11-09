<?php
require_once 'db.php';

$result = $conn->query("SELECT first_name FROM users");

while ($row = $result->fetch_assoc()) {
    echo htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8') . "<br>";
}
?>