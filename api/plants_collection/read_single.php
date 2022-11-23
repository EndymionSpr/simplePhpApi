<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Plants_collection.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog plants_collection object
  $plants_collection = new Plants_collection($db);

  // Get ID
  $plants_collection->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get plants_collection
  $plants_collection->read_single();

  // Create array
  $post_arr = array(
    'id' => $plants_collection->id,
    'title' => $plants_collection->title,
    'body' => $plants_collection->body,
    'author' => $plants_collection->author,
    'category_id' => $plants_collection->category_id,
    'category_name' => $plants_collection->category_name
  );

  // Make JSON
  print_r(json_encode($post_arr));