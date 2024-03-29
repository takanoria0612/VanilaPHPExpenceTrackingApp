<?php
//model/UserDataModel.php
class UserDataModel {
    private $db;
    private $table = 'userData';

    // Constructor with DB connection
    public function __construct($db) {
        $this->db = $db;
    }

    // Get all expense reports for a user
    public function getExpenseReports($userId) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE userId = :userId';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind ID
        $stmt->bindParam(':userId', $userId);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single expense report
    public function getExpenseReport($applicationNo) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE applicationNo = :applicationNo LIMIT 0,1';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind ID
        $stmt->bindParam(':applicationNo', $applicationNo);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
    public function generateApplicationNo() {
        $currentDate = new DateTime();
        $datePart = $currentDate->format('ymd'); // YYMMDD の形式
    
        $query = "SELECT applicationNo FROM " . $this->table . " WHERE applicationNo LIKE :datePart ORDER BY applicationNo DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':datePart', $datePart . '%');
        $stmt->execute();
        $lastAppNo = $stmt->fetchColumn();
    
        if ($lastAppNo) {
            $lastNumber = (int)substr($lastAppNo, 6, 2); // 8桁のうち、年月日を除いた後ろの数字部分
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
    
        return $datePart . str_pad($newNumber, 2, '0', STR_PAD_LEFT); // 新しい番号を2桁にパディング
    }

    // Create expense report
    public function createExpenseReport($data) {
        $query = 'INSERT INTO ' . $this->table . '
            (applicationNo, userId, date, routeName, applicant, stationName1, stationName2, amount, remarks)
            VALUES (:applicationNo, :userId, :date, :routeName, :applicant, :stationName1, :stationName2, :amount, :remarks)';


        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Sanitize and bind data
        $applicationNo = $this->generateApplicationNo();
        $userId = htmlspecialchars(strip_tags($data['userId'] ?? ''));
        $date = htmlspecialchars(strip_tags($data['date'] ?? ''));
        $routeName = htmlspecialchars(strip_tags($data['routeName'] ?? ''));
        $applicant = htmlspecialchars(strip_tags($data['applicant'] ?? ''));
        $stationName1 = htmlspecialchars(strip_tags($data['stationName1'] ?? ''));
        $stationName2 = htmlspecialchars(strip_tags($data['stationName2'] ?? ''));
        $amount = htmlspecialchars(strip_tags($data['amount'] ?? ''));
        $remarks = htmlspecialchars(strip_tags($data['remarks'] ?? ''));

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(':applicationNo', $applicationNo); 
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':routeName', $routeName);
        $stmt->bindParam(':applicant', $applicant);
        $stmt->bindParam(':stationName1', $stationName1);
        $stmt->bindParam(':stationName2', $stationName2);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindParam(':remarks', $remarks);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Update expense report
    public function updateExpenseReport($data) {
        $query = 'UPDATE ' . $this->table . '
                  SET date = :date, routeName = :routeName, applicant = :applicant,
                      stationName1 = :stationName1, stationName2 = :stationName2,
                      amount = :amount, remarks = :remarks
                  WHERE applicationNo = :applicationNo';
    
        // Prepare statement
        $stmt = $this->db->prepare($query);
    
        // Sanitize and bind data
        // applicationNo は更新しないため、ここでのバインドは不要
        $stmt->bindParam(':date', htmlspecialchars(strip_tags($data['date'])));
        $stmt->bindParam(':routeName', htmlspecialchars(strip_tags($data['routeName'])));
        $stmt->bindParam(':applicant', htmlspecialchars(strip_tags($data['applicant'])));
        $stmt->bindParam(':stationName1', htmlspecialchars(strip_tags($data['stationName1'])));
        $stmt->bindParam(':stationName2', htmlspecialchars(strip_tags($data['stationName2'])));
        $stmt->bindParam(':amount', htmlspecialchars(strip_tags($data['amount'])), PDO::PARAM_INT);
        $stmt->bindParam(':remarks', htmlspecialchars(strip_tags($data['remarks'])));
        $stmt->bindParam(':applicationNo', htmlspecialchars(strip_tags($data['applicationNo'])));
    
        // Execute query
        if($stmt->execute()) {
            return true;
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // // Delete expense report
    // public function deleteExpenseReport($applicationNo) {
    //     $query = 'DELETE FROM ' . $this->table . ' WHERE applicationNo = :applicationNo';

    //     // Prepare statement
    //     $stmt = $this->db->prepare($query);

    //     // Bind ID
    //     $stmt->bindParam(':applicationNo', $applicationNo);

    //     // Execute query
    //     if($stmt->execute()) {
    //         return true;
    //     }

    //     // Print error if something goes wrong
    //     printf("Error: %s.\n", $stmt->error);
    //     return false;
    // }
    // Retrieve all expense reports for a specific user
    public function getExpenseReportsByUserId($userId) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE userId = :userId';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind ID
        $stmt->bindParam(':userId', $userId);

        // Execute query
        $stmt->execute();

        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, $row);
        }

        return $results;
    }

    // Retrieve a single expense report by its application number
    public function getExpenseReportByApplicationNo($applicationNo) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE applicationNo = :applicationNo LIMIT 1';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind application number
        $stmt->bindParam(':applicationNo', $applicationNo);

        // Execute query
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    // Existing code...

    public function deleteExpenseReport($applicationNo) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE applicationNo = :applicationNo';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Clean up and bind data
        $applicationNo = htmlspecialchars(strip_tags($applicationNo));

        // Bind data
        $stmt->bindParam(':applicationNo', $applicationNo);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
        
    }
    public function searchExpenseReportsByDate($userId, $date) {
        $datePart = date('ymd', strtotime($date)); // 日付から年月日の部分を取得
        $applicationNoLike = $datePart . '%'; // LIKE句で使用するために%を追加
    
        $query = "SELECT * FROM " . $this->table . " WHERE userId = :userId AND applicationNo LIKE :applicationNoLike";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        // 正しいパラメーター名`:applicationNoLike`を使用してバインド
        $stmt->bindParam(':applicationNoLike', $applicationNoLike);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
