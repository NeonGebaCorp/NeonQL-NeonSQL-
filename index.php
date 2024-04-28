<?php

// Check if the NEON Engine SQL extension is loaded
if (!extension_loaded('neon')) {
    // If the NEON Engine SQL extension is not loaded, create an error response
    $response = [
        'error' => [
            'code' => 500, // Internal Server Error
            'message' => 'Neon Engine SQL extension is not loaded',
        ],
    ];

    // Send the response as JSON with appropriate headers
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);

    // Immediately exit the script to prevent further execution
    exit;
}

// Your code to interact with the NEON Engine SQL here

// Example:
// $connection = neon_connect('host', 'username', 'password');
// $result = neon_query($connection, 'SELECT * FROM table');

// After interacting with the NEON Engine SQL, check if there's an error
if (neon_error($connection)) {
    // If there's an error, create an error response
    $response = [
        'error' => [
            'code' => neon_errno($connection), // Error code
            'message' => neon_error($connection), // Error message
        ],
    ];

    // Send the response as JSON with appropriate headers
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);

    // Immediately exit the script to prevent further execution
    exit;
}

// If everything is successful, create a success response
$response = ["message" => "Neon Engine SQL query successful"];

// Send the response as JSON with appropriate headers
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

?>
