<?php
/*
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    
    if (empty($password)) {
        echo json_encode(["error" => "403", "reason" => "Password not provided"]);
    } else {
        $savedPassword = trim(file_get_contents("pass.txt"));

        if ($password === $savedPassword) {
            echo json_encode(["error" => "200", "reason" => "Login Correct"]);
        } else {
            echo json_encode(["error" => "403", "reason" => "Password Incorrect"]);
        }
    }
} else {
    echo json_encode(["error" => "405", "reason" => "Invalid Request Method"]);
}
*/
?>
<?php
if ($_POST['password'] === hash('sha256', file_get_contents("pass.txt"))) {
    echo '{"error": "200", "reason": "Login Correct"}';
} else {
    echo '{"error": "403", "reason": "Unauthorized"}';
}
?>