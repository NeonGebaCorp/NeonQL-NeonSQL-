<?php

// Check if the NEON Engine SQL extension is loaded
if (!extension_loaded('neon')) {
    $response = [
        'error' => [
            'code' => 500,
            'message' => 'Neon Engine SQL extension is not loaded',
        ],
    ];

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
}

// Your code to interact with the NEON Engine SQL here

// Example:
// $connection = neon_connect('host', 'username', 'password');
// $result = neon_query($connection, 'SELECT * FROM table');

// If there's an error, send a response with the error message
if (neon_error($connection)) {
    $response = [
        'error' => [
            'code' => neon_errno($connection),
            'message' => neon_error($connection),
        ],
    ];

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
}

// If everything is successful, send a success message
$response = ["message" => "Neon Engine SQL query successful"];

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

?>
