<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Users object
  $Users = new Users($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $Users->mail = $data->mail;
  $Users->nickname = $data->nickname;
  $Users->password = $data->password;

  // Create Users
  if($Users->create()) {
    echo json_encode(
      array('message' => 'Users Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Users Not Created')
    );
  }
