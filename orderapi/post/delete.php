<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Methods: POST, DELETE");
// header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
// // // Makes IE to support cookies
// header("Content-Type: application/json; charset=utf-8");


if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}
include_once '../../orderconfig/Database.php';
include_once '../../ordermodels/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data=json_decode(file_get_contents("php://input"));



$post->order_id = $_POST["order_id"];

if($post->delete()) {
    echo json_encode(
     array('message'=> 'Post DELETED')
    );

} else {
    echo json_encode(
        array('message'=> 'Post Not DELETED')
    );
} 