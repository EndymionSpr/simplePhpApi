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
  $Users->nickname = isset($_GET['nickname']) ? $_GET['nickname'] : die();
  $temp_password = isset($_GET['password']) ? $_GET['password'] : die();

  // Get Nickname and Password
  $Users->does_user_exist();

  // Make JSON
  /* print_r(json_encode($Users_arr)); */
  if ($Users->password == $temp_password) 
  {
    return True;
  }
  else 
  {
    return False;
  }
