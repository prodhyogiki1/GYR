<?php
header('Content-Type: application/json');
require_once __DIR__ . '/class/Website.php';

$website = new Website();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields']);
        exit;
    }

    $result = $website->user_signin($email, $password);

    if ($result['status'] === 'success') {
        // Start session and store user data
        session_start();
        $_SESSION['user_id'] = $result['user']['id'];
        $_SESSION['user_name'] = $result['user']['uname'];
        $_SESSION['user_email'] = $result['user']['email'];
        $_SESSION['user_phone'] = $result['user']['phone'];
        $_SESSION['user_address'] = $result['user']['address'];
        $_SESSION['user_logged_in'] = true;
    }

    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}