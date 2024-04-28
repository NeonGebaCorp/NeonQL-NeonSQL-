<?php
error_reporting(E_ALL);
http_response_code(200);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $dataName = $_POST['dataName'];

    if (empty($password) || empty($dataName)) {
        http_response_code(403);
        echo json_encode(["error" => "403", "reason" => "Password or Data Name not provided"]);
        exit;
    }

    if ($password !== hash('sha256', file_get_contents("pass.txt"))) {
        http_response_code(403);
        echo json_encode(["error" => "403", "reason" => "Password Incorrect"]);
        exit;
    }

    $dataPath = "./databases/" . $dataName;

    if (!file_exists($dataPath)) {
        http_response_code(404);
        echo json_encode(["error" => "404", "reason" => "File Not Found"]);
        exit;
    }

    if (unlink($dataPath)) {
        http_response_code(200);
        echo json_encode(["error" => "200", "reason" => "File Deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "500", "reason" => "Error Deleting File"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "405", "reason" => "Invalid Request Method"]);
}
