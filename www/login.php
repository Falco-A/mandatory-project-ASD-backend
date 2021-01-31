<?php
function cors() {
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}

cors();

$host = '192.168.100.3';
$username = 'generic_user';
$password = getenv('MYSQL_USER_PASSWORD');
$dbname = 'ASD_exam';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname) or die('Connessione fallita: ' . $conn->connect_error);

// prepare and bind
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss",
                $_POST["username"],
                $_POST["password"]);
$stmt->execute();

$stmt->store_result();

if($stmt->fetch() == 1){
    $stmt->free_result();
    $stmt->close();
    $conn->close();

    exit('ACCESS_SUCCESS');
} else {
    $stmt->free_result();
    $stmt->close();
    $conn->close();

    exit('ACCESS_FAILURE');
}
?>
