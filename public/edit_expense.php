<?php
// /public/edit_expense.php
require_once '../config/Database.php';
require_once '../model/UserDataModel.php';
require_once '../controller/ExpenseController.php';

session_start();

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Check for logged-in user
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header('Location: login.php');
    exit;
}

$expenseController = new ExpenseController($db);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize POST array
    $postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    // Update the expense report
    $updateStatus = $expenseController->updateExpenseReport($postData);

    if ($updateStatus) {
        header('Location: dashboard.php'); // Change 'dashboard.php' to the actual dashboard page if different
        exit;
    } else {
        $error_message = "経費報告の更新に失敗しました。";
    }
}

// Get the applicationNo from the query string
$applicationNo = $_GET['applicationNo'] ?? null;
if (!$applicationNo) {
    // Redirect to an error page or show an error message
    exit('申請番号が必要です。');
}
// Corrected method name to fetch expense report details
$expenseReport = $expenseController->getExpenseReport($applicationNo);
if (!$expenseReport) {
    exit('経費報告が見つかりません。');
}
// Include the view that contains the edit form
require_once '../view/EditExpenseFormView.php';
