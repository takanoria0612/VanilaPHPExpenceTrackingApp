<?php
// delete_expense.php
require_once '../config/Database.php';
require_once '../controller/ExpenseController.php';

session_start();

// Check for logged-in user
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$database = new Database();
$db = $database->connect();

$expenseController = new ExpenseController($db);

// Check if an application number is provided
if (isset($_GET['applicationNo'])) {
    $applicationNo = $_GET['applicationNo'];
    
    if ($expenseController->deleteExpenseReport($applicationNo)) {
        // Redirect to dashboard with a success message
        header('Location: index.php?success=delete');
    } else {
        // Redirect to dashboard with an error message
        header('Location: index.php?error=delete');
    }
} else {
    // Redirect to dashboard if no application number is provided
    header('Location: index.php');
}

exit;
?>
