<?php
// Initialize error variables
$loginError = false;
$passwordFileNotAvailable = false;

// Define the correct username and password
$correctUsername = "admin";
$correctPassword = "admin";

// Check if the user is submitting the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Assign the entered username and password to variables
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
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPassword'])) {
    // Handle password change here
    $newPassword = $_POST['newPassword'];
    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_SHA256);
        file_put_contents('pass.txt', $hashedPassword);
    }
} else {
    // Start the session if not already started
    session_start();

    // Check if the user is authenticated
    $authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];

    // Check if the password file exists
    if (file_exists('pass.txt')) {
        $password = file_get_contents('pass.txt');
    } else {
        $passwordFileNotAvailable = true;
    }
}

// Include Bootstrap CSS
echo '<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>';

// Display the content based on authentication
if (!$authenticated) {
    // Login Form
    echo '
    <div class="container mt-4">
        <h1>Admin Panel</h1>
        <div class="card mt-4">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                ';
    if ($loginError) {
        echo '<div class="alert alert-danger">
                    Incorrect username or password. Please try again.
                </div>';
    }
    echo '
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
    </div>';
} else {
    // Password Editor
    echo '
    <div class="container mt-4">
        <h1>Admin Panel</h1>
        <div class="card mt-4">
            <div class="card-header">
                Edit Password (pass.txt)
            </div>
            <div class="card-body">
                ';
    if ($passwordFileNotAvailable) {
        echo '<div class="alert alert-warning">
                    Password file (pass.txt) is not available. You can create it below.
                </div>';
    }
    echo '
                <form method="post" action="admin_panel.php">
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Password</button>
                </form>
            </div>
        </div>
    </div>';

    // Script Management
    echo '
    <div class="container mt-4">
        <h1>Admin Panel</h1>
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
    </div>';
}
?>
