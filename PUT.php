<?php

// Authentication
function isPasswordValid($password) {
    $savedPassword = trim(file_get_contents("pass.txt"));
    return $password === hash('sha256', $savedPassword);
}

// Data handling
function saveData($dataName, $data) {
    if (!$dataName || !$data) {
        return json_encode(["error" => "403", "reason" => "Data Name or Data not provided"]);
    }

    $dataPath = "./databases/" . $dataName;
    $written = file_put_contents($dataPath, $data);

    if ($written === false) {
        return json_encode(["error" => "500", "reason" => "Error Adding Data"]);
    }

    return json_encode(["error" => "200", "reason" => "Data Added Successfully"]);
}

// Main
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    if (isPasswordValid($password)) {
        $response = saveData($_POST['dataname'], $_POST['data']);
    } else {
        $response = json_encode(["error" => "403", "reason" => "Unauthorized"]);
    }

    header('Content-Type: application/json');
    echo $response;
} else {
    header('Content-Type: application/json');
    echo json_encode(["error" => "405", "reason" => "Invalid Request Method"]);
}
