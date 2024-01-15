<?php 

class Database {
    public $pdo;

    public function __construct($db="test", $user="root", $pwd="", $host="localhost:3307") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected to $db succesfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insertuser($name, $email, $hash) {
        $sql = "INSERT INTO users (username, email, hash)
        VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        
        $statement->execute([$name, $email, $hash]);
    }

    public function insertcar($stuff) {
        $sql = "INSERT INTO cars (username, email, hash)
        VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        
        $statement->execute([$stuff]);
    }

    public function insertrental($stuff) {
        $sql = "INSERT INTO rentals (username, email, hash)
        VALUES (?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        
        $statement->execute([$stuff]);
    }



    public function select($username = null) {
        if ($username != null) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $result = $stmt->fetch();
        } else {
            $stmt = $this->pdo->query("SELECT * FROM users");
            $result = $stmt->fetchAll();
        }
        return ($result);
    }

    public function update($id, $username, $email) {
        $sql = "UPDATE users SET username=?, email=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $email, $id]);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM ? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$table, $id]);
    }

}
?>