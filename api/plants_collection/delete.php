<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Plants_collection.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog plants_collection object
  $plants_collection = new Plants_collection($db);

  // Get raw plants_collection data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $plants_collection->id = $data->id;

  // Delete plants_collection
  if($plants_collection->delete()) {
    echo json_encode(
      array('message' => 'plants_collection Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'plants_collection Not Deleted')
    );
  }

