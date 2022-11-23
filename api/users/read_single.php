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

  // Get ID
  $Users->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $Users->read_single();

  // Create array
  $Users_arr = array(
    'id' => $Users->id,
    'nickname' => $Users->nickname
  );

  // Make JSON
  print_r(json_encode($Users_arr));
