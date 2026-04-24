<?php
header('Content-Type: application/json');
require_once __DIR__ . '/class/Website.php';

$website = new Website();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = isset($_POST['uname']) ? trim($_POST['uname']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $licence = isset($_POST['licence']) ? trim($_POST['licence']) : '';
    $adhar = isset($_POST['adhar']) ? trim($_POST['adhar']) : '';

    if (empty($uname) || empty($phone) || empty($email) || empty($address) || empty($password) || empty($licence) || empty($adhar)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields']);
        exit;
    }

    $result = $website->user_signup($uname, $phone, $email, $address, $password, $licence, $adhar);

    if ($result['status'] === 'success') {
        // Optionally auto-login after signup
        // session_start();
        // $_SESSION['user_id'] = $result['user_id'];
        // $_SESSION['user_logged_in'] = true;
    }

    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}