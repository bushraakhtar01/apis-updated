<?php
// header('Access-Control-Allow_Origin: *');
// header('Content-type: application/json');
// header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
//  Access-Control-Allow-Methods, Authorization, X-Requested-With, Origin, Accept');
// header('Access-Control-Request-Headers:content-type');
// header('Access-Control-Request-Method:POST');
// header('Access-Control-Allow-Credentials:true');


// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Methods: PUT");
// header("Access-Control-Allow-Headers: Content-Type, Authorization,X-Requested-With");

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



// $post->id = $data->id;

// $post->name = $data->name;
// $post->code = $data->code;
// $post->brand = $data->brand;
// $post->color = $data->color;
// $post->material = $data->material;
// $post->price = $data->price;
// $post->type = $data->type;
// $post->size_id = $data->size_id;
// $post->category_id = $data->category_id;
// $post->image = $data->image;
$post->id =  $_POST["id"];

$post->address =  $_POST["address"];
$post->payment =  $_POST["payment"];






if($post->update()) {
    echo json_encode(
     array('message'=> 'Post updated')
    );

} else {
    echo json_encode(
        array('message'=> 'Post Not updated')
    );
}

