<?php
  class Plants {
    // DB Stuff
    private $conn;
    private $table = 'Plants';

    // Properties
    public $id;
    public $plant_name;
    public $plant_type;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        plant_name,
        plant_type
      FROM
        ' . $this->table . '
      ORDER BY
        plant_type DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Plants
  public function read_single(){
    // Create query
    $query = 'SELECT
          id,
          plant_name
          plant_type
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->plant_name = $row['plant_name'];
      $this->plant_type = $row['plant_type'];
  }

  // Create Plants
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      plant_name = :plant_name
      plant_type = :plant_type';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->plant_name = htmlspecialchars(strip_tags($this->plant_name));
  $this->plant_type = htmlspecialchars(strip_tags($this->plant_type));

  // Bind data
  $stmt-> bindParam(':plant_name', $this->plant_name);
  $stmt-> bindParam(':plant_type', $this->plant_type);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Plants
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      plant_name = :plant_name
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->plant_name = htmlspecialchars(strip_tags($this->plant_name));
  $this->id = htmlspecialchars(strip_tags($this->id));

  // Bind data
  $stmt-> bindParam(':plant_name', $this->plant_name);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Plants
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
