<?php
//controller/DashboardController.php
require_once '../model/UserDataModel.php';

class DashboardController {
    private $userDataModel;

    public function __construct($db) {
        $this->userDataModel = new UserDataModel($db);
    }

    public function showExpenseReports($userId) {
        $result = $this->userDataModel->getExpenseReports($userId);
        $expenseReports = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($expenseReports, $row);
        }

        return $expenseReports;
    }
    // Corrected the method call to match an existing method in UserDataModel

}
