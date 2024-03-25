<?php
require_once '../config/Database.php';
require_once '../controller/LoginController.php';

// Start session
session_start();

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate LoginController
$loginController = new LoginController($db);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt to login
    $loginController->login($username, $password);
}