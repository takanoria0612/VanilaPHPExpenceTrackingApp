<?php
//controller/ExpenseController.php
require_once '../model/UserDataModel.php';

class ExpenseController {
    private $userDataModel;

    public function __construct($db) {
        $this->userDataModel = new UserDataModel($db);
    }

    // Handle creation of a new expense report
    public function createExpenseReport($data) {
        return $this->userDataModel->createExpenseReport($data);
    }

    // Handle update of an existing expense report
    public function updateExpenseReport($data) {
        return $this->userDataModel->updateExpenseReport($data);
    }

    // Handle deletion of an existing expense report
    public function deleteExpenseReport($applicationNo) {
        return $this->userDataModel->deleteExpenseReport($applicationNo);
    }

    // Handle retrieval of all expense reports for a specific user
    public function getExpenseReportsByUser($userId) {
        // Correcting the method name to match the defined method in UserDataModel
        return $this->userDataModel->getExpenseReports($userId);
    }
    // Handle retrieval of a single expense report by its application number
    public function getExpenseReport($applicationNo) {
        return $this->userDataModel->getExpenseReportByApplicationNo($applicationNo);
    }
    public function searchExpenseReports($userId, $date) {
        return $this->userDataModel->searchExpenseReportsByDate($userId, $date);
    }
    
}
