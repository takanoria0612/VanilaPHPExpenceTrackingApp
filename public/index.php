<?php
require_once '../config/Database.php';
require_once '../controller/DashboardController.php';
require_once '../controller/ExpenseController.php';
// Add other required controllers here

session_start();

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Check for logged-in user
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    // If no user is logged in, redirect to the login page
    header('Location: login.php');
    exit;
}

// Remove the base path from the request URI to work in subdirectory
$basePath = '/phpusdproject/public';
$requestUri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$requestPath = trim($requestUri, '/');

// Simple routing
switch ($requestPath) {
    case '':
    case 'index.php':
        // Show Dashboard
        $dashboardController = new DashboardController($db);
        $expenseReports = $dashboardController->showExpenseReports($userId);
        require '../view/DashboardView.php';
        break;
    case 'new_expense.php':
        // Direct to new expense form, placeholder for actual view include
        $expenseController = new ExpenseController($db);
        $expenseController->createExpenseReport($userId);
        break;
    
    case 'edit_expense':
        $applicationNo = $_GET['applicationNo'] ?? null;
        $expenseController = new ExpenseController($db);
        $expenseReport = $expenseController->getExpenseReportByApplicationNo($applicationNo);
    
        if (!$expenseReport) {
            // Handle error if the expense report does not exist
            header('Location: dashboard.php'); // Adjust the redirect as necessary
            exit;
        }
    
        // Pass $expenseReport to the view for pre-populating the form
        require '../view/EditExpenseFormView.php';
        break;


    // Define additional cases as needed for other URLs
    default:
        // Redirect to an error page or the dashboard if the route is undefined
        header('HTTP/1.0 404 Not Found');
        require '../view/404.php';
        break;
}

// The 404.php file should handle undefined routes gracefully
