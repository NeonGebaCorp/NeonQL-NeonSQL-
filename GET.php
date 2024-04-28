<?php
// Disable error reporting
error_reporting(0);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the password and data name from the POST request
    $password = $_POST['password'];
    $dataname = $_POST['dataname'];

    // Check if the password and data name are provided
    if (empty($password) || empty($dataname)) {
        // Return an error message if not
        echo json_encode(["error" => "403", "reason" => "Password or Data Name not provided"]);
    } else {
        // Get the saved password from the file
        $savedPassword = trim(file_get_contents("pass.txt"));

        // Compare the provided password with the saved password
        if ($password === $savedPassword) {
            // Authentication successful, proceed with data retrieval
            $dataPath = "./databases/" . $dataname;

            // Check if the data file exists
            if (file_exists($dataPath)) {
                // Read the data from the file and return it
                $data = file_get_contents($dataPath);
                echo $data;
            } else {
                // Return a "file not found" error message
                echo json_encode(["error" => "404", "reason" => "File Not Found"]);
            }
        } else {
            // Return an "unauthorized" error message
            echo json_encode(["error" => "403", "reason" => "Password Incorrect"]);
        }
    }
} else {
    // Return an "invalid request method" error message
    echo json_encode(["error" => "405", "reason" => "Invalid Request Method"]);
}
?>
