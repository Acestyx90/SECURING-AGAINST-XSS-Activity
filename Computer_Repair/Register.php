<?php

require_once 'db.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    $first_name = htmlspecialchars(trim($_POST['first_name']), ENT_QUOTES, 'UTF-8');
    $last_name  = htmlspecialchars(trim($_POST['last_name']), ENT_QUOTES, 'UTF-8');
    $username   = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
    $password   = $_POST['password'];

    if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($password)) {

        
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password)
        ) {

            $message = "<p style='color: red;'>Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.</p>";

        } else {

            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, password) VALUES (?, ?, ?, ?)");

            if ($stmt) {

                $stmt->bind_param("ssss", $first_name, $last_name, $username, $hashed_password);

                if ($stmt->execute()) {

                    $message = "<p style='color: green;'>Registration successful! You can now <a href='login.php'>Login here</a>.</p>";

                } else {

                    if ($conn->errno == 1062) {
                        $message = "<p style='color: red;'>Error: Username already taken. Choose a different one.</p>";
                    } else {
                        $message = "<p style='color: red;'>Error: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8') . "</p>";
                    }

                }

                $stmt->close();

            } else {

                $message = "<p style='color: red;'>Database Error: " . htmlspecialchars($conn->error, ENT_QUOTES, 'UTF-8') . "</p>";

            }

        }

    } else {

        $message = "<p style='color: red;'>Please fill in all required fields.</p>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Computer Repair and IT Services</title>
</head>
<body>

<div style="width: 400px; margin: 50px auto; font-family: Arial, sans-serif;">

    <h2>User Registration</h2>

    <?php echo $message; ?>

    <form action="register.php" method="POST">

        <div style="margin-bottom: 15px;">
            <label>First Name:</label><br>
            <input type="text" name="first_name" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Last Name:</label><br>
            <input type="text" name="last_name" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Username:</label><br>
            <input type="text" name="username" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Password:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 8px;">
            <br>
            <small>
                Password must be at least 8 characters long and contain:
                1 uppercase letter, 1 lowercase letter, and 1 number.
            </small>
        </div>

        <button type="submit" style="padding: 10px 15px; background: #007BFF; color: white; border: none; cursor: pointer;">
            Register
        </button>

    </form>

    <p style="margin-top: 20px;">
        Already have an account?
        <a href="login.php">Login here</a>.
    </p>

</div>

</body>
</html>