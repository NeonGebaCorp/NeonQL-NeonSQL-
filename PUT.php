<?php
/*
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $dataname = $_POST['dataname'];
    $data = $_POST['data'];

    if (empty($password) || empty($dataname) || empty($data)) {
        echo json_encode(["error" => "403", "reason" => "Password, Data Name, or Data not provided"]);
    } else {
        $savedPassword = trim(file_get_contents("pass.txt"));

        if ($password === $savedPassword) {
            $dataPath = "./databases/" . $dataname;

            if (file_put_contents($dataPath, $data) !== false) {
                echo json_encode(["error" => "200", "reason" => "Data Added Successfully"]);
            } else {
                echo json_encode(["error" => "500", "reason" => "Error Adding Data"]);
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
    $dataName = $_POST['dataname'];
    $data = $_POST['data'];
    
    if ($dataName && $data) {
        $dataPath = "./databases/" . $dataName;
        $written = file_put_contents($dataPath, $data);
        if ($written !== false) {
            echo '{"error": "200", "reason": "Data Added Successfully"}';
        } else {
            echo '{"error": "500", "reason": "Error Adding Data"}';
        }
    } else {
        echo '{"error": "403", "reason": "Data Name or Data not provided"}';
    }
} else {
    echo '{"error": "403", "reason": "Unauthorized"}';
}
?>