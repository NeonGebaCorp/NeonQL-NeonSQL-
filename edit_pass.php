<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the login page if the user is not authenticated
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);

    if ($newPassword) {
        // Hash the new password securely using the password_hash() function
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Store the hashed password securely (e.g., in a database)
        file_put_contents("pass.txt", $hashedPassword);

        // Redirect to the admin panel or another location
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "New password not provided.";
    }
}
?>
