<?php 
  class Users {
    // DB stuff
    private $conn;
    private $table = 'Users';

    // Users Properties
    public $id;
    public $nickname;
    public $password;
    public $mail;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT u.password , u.id, u.nickname, u.mail, u.created_at
                                FROM ' . $this->table . ' u
                                ORDER BY
                                  u.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Users
    public function read_single() {
          // Create query
          $query = 'SELECT u.password, u.id, u.nickname, u.mail, u.created_at
                                    FROM ' . $this->table . ' u
                                    WHERE
                                      u.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->mail = $row['mail'];
          $this->nickname = $row['nickname'];
          $this->password = $row['password'];
    }

    // Check if user exists
    public function does_user_exist() {
      // Create query
      $query = 'SELECT u.password, u.id, u.nickname, u.mail, u.created_at
                                FROM ' . $this->table . ' u
                                WHERE
                                  u.nickname = ?

                                LIMIT 0,1';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->nickname);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->nickname = $row['nickname'];
      $this->password = $row['password'];
}

    // Create Users
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET mail = :mail, nickname = :nickname, password = :password';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->mail = htmlspecialchars(strip_tags($this->mail));
          $this->nickname = htmlspecialchars(strip_tags($this->nickname));
          $this->password = htmlspecialchars(strip_tags($this->password));

          // Bind data
          $stmt->bindParam(':mail', $this->mail);
          $stmt->bindParam(':nickname', $this->nickname);
          $stmt->bindParam(':password', $this->password);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Users
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET mail = :mail, nickname = :nickname, password = :password, 
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->mail = htmlspecialchars(strip_tags($this->mail));
          $this->nickname = htmlspecialchars(strip_tags($this->nickname));
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->password = htmlspecialchars(strip_tags($this->password));

          // Bind data
          $stmt->bindParam(':mail', $this->mail);
          $stmt->bindParam(':nickname', $this->nickname);
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':password', $this->password);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Users
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }