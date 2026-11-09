<?php
session_start();
require_once 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }

            $stmt->close();
        } else {
            $error = "Database Error: " . htmlspecialchars($conn->error);
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Computer Repair and IT Services</title>
</head>
<body>

    <!-- Fake Warning Message (Assignment Demonstration) -->
    <div style="
        background-color: #dc3545;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    ">
        ⚠ SECURITY ALERT: Suspicious activity detected on your account.
        Please log in immediately to verify your identity or your account may be temporarily suspended.
    </div>

    <script>
        window.onload = function() {
            alert("WARNING! Unusual login activity has been detected. Please verify your account credentials immediately.");
        };
    </script>

    <div style="width: 400px; margin: 50px auto; font-family: Arial, sans-serif;">
        <h2>User Login</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">

            <div style="margin-bottom: 15px;">
                <label>Username:</label><br>
                <input type="text" name="username" required style="width: 100%; padding: 8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Password:</label><br>
                <input type="password" name="password" required style="width: 100%; padding: 8px;">
            </div>

            <button type="submit" style="
                padding: 10px 15px;
                background: #28a745;
                color: white;
                border: none;
                cursor: pointer;
            ">
                Login
            </button>

        </form>

        <p style="margin-top: 20px;">
            Don't have an account?
            <a href="register.php">Register here</a>.
        </p>
    </div>

</body>
</html>