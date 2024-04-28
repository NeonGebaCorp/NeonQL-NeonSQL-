<?php
// Turn off error reporting to prevent sensitive information from being leaked
error_reporting(0);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted password
    $password = $_POST['password'];

    // Check if the password is empty
    if (empty($password)) {
        // Return an error message if the password is not provided
        echo json_encode(["error" => "403", "reason" => "Password not provided"]);
    } else {
        // Read the contents of the "pass.txt" file
        $savedPassword = trim(file_get_contents("pass.txt"));

        // Compare the submitted password with the saved password
        if ($password === $savedPassword) {
            // Return a success message if the passwords match
            echo json_encode(["error" => "200", "reason" => "Login Correct"]);
        } else {
            // Return an error message if the passwords do not match
            echo json_encode(["error" => "403", "reason" => "Password Incorrect"]);
        }
    }
} else {
    // Return an error message if the request method is not POST
    echo json_encode(["error" => "405", "reason" => "Invalid Request Method"]);
}
?>


<?php
// Check if the submitted password matches the hash of the saved password
if ($_POST['password'] === hash('sha256', file_get_contents("pass.txt"))) {
    // Return a success message if the passwords match
    echo '{"error": "200", "reason": "Login Correct"}';
} else {
    // Return an error message if the passwords do not match
    echo '{"error": "403", "reason": "Unauthorized"}';
}
?>
