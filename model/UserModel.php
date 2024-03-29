<?php
// model/UserModel.php
class UserModel {
    private $db;
    private $table = 'users';

    // Constructor with DB
    public function __construct($db) {
        $this->db = $db;
    }

    // Authenticate User
    public function authenticate($username, $password) {
        $query = 'SELECT userId, username, password FROM ' . $this->table . ' WHERE username = :username';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind data
        $stmt->bindParam(':username', $username);

        // Execute query
        $stmt->execute();

        if($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $stored_password = $row['password']; // Password is stored as plain text
            if($password === $stored_password) { // Compare plain text passwords
                // Return user ID if password is correct
                return $row['userId'];
            }
        }

        // Return false if authentication fails
        return false;
    }

    // Register new user
    public function register($username, $password) {
        $query = 'INSERT INTO ' . $this->table . ' (username, password) VALUES (:username, :password)';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind data
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Store password as plain text

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    
    

}
?>
