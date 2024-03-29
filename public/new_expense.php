<?php
// public/new_expense.php
require_once '../config/Database.php';
require_once '../controller/ExpenseController.php';

session_start();

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Check for logged-in user
$userId = $_SESSION['user_id'] ?? null;


// Process the form submission
$expenseController = new ExpenseController($db);


if (!$userId) {
    // If no user is logged in, redirect to the login page
    header('Location: login.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $_POST['userId'] = $userId; // ここで $userId はセッションから取得したものを使用
    $success = $expenseController->createExpenseReport($_POST);
    if ($success) {
        header('Location: index.php'); // Redirect to the dashboard if success
        exit;
    } else {
        $error_message = "経費報告の作成に失敗しました。"; // Error handling
    }
}

// Display the expense report creation form
require_once '../view/CreateExpenseFormView.php';
