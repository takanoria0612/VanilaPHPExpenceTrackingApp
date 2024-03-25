<?php
//public/create expense report
require_once '../config/Database.php';
require_once '../controller/ExpenseController.php';

session_start();

// Check for logged-in user
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate expense controller
$expenseController = new ExpenseController($db);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'userId' => $_SESSION['user_id'], // Assuming user ID is stored in session
        'date' => $_POST['date'],
        'routeName' => $_POST['routeName'],
        'applicant' => $_POST['applicant'],
        'stationName1' => $_POST['stationName1'],
        'stationName2' => $_POST['stationName2'],
        'amount' => $_POST['amount'],
        'remarks' => $_POST['remarks'],
    ];

    if ($expenseController->createExpenseReport($data)) {
        header('Location: index.php?success=create');
    } else {
        echo "An error occurred.";
    }
}
