<?php
// Disable error reporting
error_reporting(0);
ini_set('display_errors', 0);

// Rest of your PHP code
// Define the correct username and password
$correctUsername = "admin";
$correctPassword = "admin";

// Check if the user is submitting the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    // Verify the credentials
    if ($enteredUsername === $correctUsername && $enteredPassword === $correctPassword) {
        // User is authenticated; set a session variable
        session_start();
        $_SESSION['authenticated'] = true;
    } else {
        $loginError = true; // Set a flag to display a login error message
    }
}

// Check if the user is authenticated
session_start();
$authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];

$passFilePath = 'pass.txt';
$passFileExists = file_exists($passFilePath);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPassword'])) {
    // Handle password change here
    $newPassword = $_POST['newPassword'];
    if (!empty($newPassword)) {
        $hashedPassword = hash('sha256', $newPassword);
        file_put_contents($passFilePath, $hashedPassword);
    }
}

// Read the password file
$password = $passFileExists ? file_get_contents($passFilePath) : '';

if (empty($password)) {
    // Password file doesn't exist or is empty; set a flag
    $passwordFileNotAvailable = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Admin Panel</h1>

        <?php if (!$authenticated) : ?>
            <!-- Login Form -->
            <div class="card mt-4">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <?php if (isset($loginError) && $loginError) : ?>
                        <div class="alert alert-danger">
                            Incorrect username or password. Please try again.
                        </div>
                    <?php endif; ?>
                    <form method="post" action="admin_panel.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <!-- Password Editor -->
            <div class="card mt-4">
                <div class="card-header">
                    Edit Password (pass.txt)
                </div>
                <div class="card-body">
                    <form method="post" action="admin_panel.php">
                        <?php if ($passwordFileNotAvailable) : ?>
                            <div class="alert alert-warning">
                                Password file (pass.txt) is not available. You can create it below.
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Password</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Script Management -->
        <div class="card mt-4">
            <div class="card-header">
                Manage Scripts
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="GET.php" target="_blank">Run GET.php</a>
                    </li>
                    <li class="list-group-item">
                        <a href="PUT.php" target="_blank">Run PUT.php</a>
                    </li>
                    <li class="list-group-item">
                        <a href="DELETE.php" target="_blank">Run DELETE.php</a>
                    </li>
                    <li class="list-group-item">
                        <a href="TESTAUTH.php" target="_blank">Run TESTAUTH.php</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>