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

// Extract the path from REQUEST_URI
$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$requestPath = trim(str_replace($basePath, '', $parsedUrl['path']), '/');

// コントローラーのインスタンス化
$dashboardController = new DashboardController($db);
$expenseController = new ExpenseController($db);

// Simple routing
switch ($requestPath) {
    case '':
    case 'index.php':

        if (isset($_GET['search'])) {
            if (!empty($_GET['searchDate'])) {
                $searchDate = $_GET['searchDate'];
                $date = new DateTime($searchDate);

                // 日付を指定の形式でフォーマット
                $formattedDate = $date->format('Y/m/d');
                // 日付の形式が正しいかチェック
                if (DateTime::createFromFormat('Y-m-d', $searchDate) !== false) {
                    // 日付が正しい場合、検索を実行
                    $expenseReports = $expenseController->searchExpenseReports($userId, $searchDate);
                    // 検索結果の件数
                    $searchResultCount = count($expenseReports);
                } else {
                    // 日付の形式が不正
                    $warningMessage = "不正な日付形式です。";
                    $expenseReports = [];
                }
            } else {
                // 日付が選択されていない
                $warningMessage = "日付を選択してください。";
                $expenseReports = $dashboardController->showExpenseReports($userId);
            }
        } else {
            // 検索が行われていない場合の通常のリスト表示処理
            $expenseReports = $dashboardController->showExpenseReports($userId);
        }
                
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
        // Correct method name is getExpenseReport
        $expenseReport = $expenseController->getExpenseReport($applicationNo);
    
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
