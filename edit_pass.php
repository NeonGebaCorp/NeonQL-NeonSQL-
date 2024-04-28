<?php
// Start the session to manage user authentication
session_start();

// Check if the user is authenticated, if not redirect to the login page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new password from the POST request and sanitize it
    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);

    // Check if the new password is provided
    if ($newPassword) {
        // Hash the new password securely using the password_hash() function
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Store the hashed password securely (e.g., in a database)
        // In this example, the hashed password is saved to a text file for simplicity
        file_put_contents("pass.txt", $hashedPassword);

        // Redirect to the admin panel or another location
        header("Location: admin_panel.php");
        exit;
    } else {
        // Display an error message if the new password is not provided
        echo "New password not provided.";
    }
}
?>
