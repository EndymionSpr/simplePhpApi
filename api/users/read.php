<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Users object
  $Users = new Users($db);

  // Users read query
  $result = $Users->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any useregories
  if($num > 0) {
        // user array
        $user_arr = array();
        $user_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $user_item = array(
            'id' => $id,
            'nickname' => $nickname
          );

          // Push to "data"
          array_push($user_arr['data'], $user_item);
        }

        // Turn to JSON & output
        echo json_encode($user_arr);

  } else {
        // No useregories
        echo json_encode(
          array('message' => 'No Users Found')
        );
  }
