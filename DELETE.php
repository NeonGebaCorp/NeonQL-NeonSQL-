<?php
/*
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $dataname = $_POST['dataname'];
    
    if (empty($password) || empty($dataname)) {
        echo json_encode(["error" => "403", "reason" => "Password or Data Name not provided"]);
    } else {
        $savedPassword = trim(file_get_contents("pass.txt"));
        
        if ($password === $savedPassword) {
            $dataPath = "./databases/" . $dataname;
            
            if (file_exists($dataPath) && unlink($dataPath)) {
                echo json_encode(["error" => "200", "reason" => "File Deleted"]);
            } else {
                echo json_encode(["error" => "405", "reason" => "File Not Found or Cannot Be Deleted"]);
            }
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
// Authentication
if ($_POST['password'] === hash('sha256', file_get_contents("pass.txt"))) {
    // Authorized, proceed with data deletion.
    $dataName = $_POST['dataname'];
    $dataPath = "./databases/" . $dataName;

    // Verify the data file exists before attempting deletion.
    if (file_exists($dataPath)) {
        $deleted = unlink($dataPath);
        if ($deleted) {
            echo '{"error": "200", "reason": "File Deleted"}';
        } else {
            echo '{"error": "500", "reason": "Error Deleting File"}';
        }
    } else {
        echo '{"error": "404", "reason": "File Not Found"}';
    }
} else {
    echo '{"error": "403", "reason": "Unauthorized"}';
}
?>