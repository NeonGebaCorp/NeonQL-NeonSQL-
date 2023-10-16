<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['newPassword'];

    if ($newPassword) {
        // Store the new password securely (e.g., hash and salt it)
        file_put_contents("pass.txt", hash('sha256', $newPassword));

        // Redirect to admin panel or another location
        header("Location: admin_panel.php");
    } else {
        echo "New password not provided.";
    }
}
?>