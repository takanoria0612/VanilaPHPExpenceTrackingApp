<?php
require_once '../config/Database.php';
require_once '../controller/ExpenseController.php';

session_start();

// Database connection
$database = new Database();
$db = $database->connect();

$expenseController = new ExpenseController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // サニタイズとバリデーションはここで行います
    $updateSuccess = $expenseController->updateExpenseReport($_POST);

    if ($updateSuccess) {
        // 更新が成功したら、ダッシュボードまたは適切なページにリダイレクト
        header('Location: index.php');
        exit;
    } else {
        // 更新が失敗したら、エラーメッセージを表示するか、エラーハンドリングを行います
        // エラーメッセージをセッションに設定するなど
        $_SESSION['error_message'] = '経費報告の更新に失敗しました。';
        header('Location: edit_expense?applicationNo=' . urlencode($_POST['applicationNo']));
        exit;
    }
}
?>
