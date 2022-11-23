<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Plants_collection.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog plants_collection object
  $plants_collection = new Plants_collection($db);

  // Get raw plants_collectioned data
  $data = json_decode(file_get_contents("php://input"));

  $plants_collection->owner_id = $data->owner_id;
  $plants_collection->plant_id = $data->plant_id;
  $plants_collection->name = $data->name;
  $plants_collection->picture_path = $data->picture_path;

  // Create plants_collection
  if($plants_collection->create()) {
    echo json_encode(
      array('message' => 'plants_collection Created')
    );
  } else {
    echo json_encode(
      array('message' => 'plants_collection Not Created')
    );
  }

