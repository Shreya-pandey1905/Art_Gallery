<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['email']) && isset($_SESSION['user_id'])) {
    echo json_encode([
        'logged_in' => true,
        'email' => $_SESSION['email'],
        'user_id' => $_SESSION['user_id']
    ]);
} else {
    echo json_encode([
        'logged_in' => false,
        'message' => 'User not logged in or session expired.'
    ]);
}
?>
