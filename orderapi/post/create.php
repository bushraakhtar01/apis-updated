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
// header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
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




// // $post->name = $data->name;
// // $post->code = $data->code;
// // $post->brand = $data->brand;
// // $post->color = $data->color;
// // $post->material = $data->material;
// // $post->price = $data->price;
// // $post->type = $data->type;
// // $post->size_id = $data->size_id;
// // $post->category_id = $data->category_id;
// // $post->image = "string";

$post->prod_name = $_POST["prod_name"];
$post->prod_code =  $_POST["prod_code"];
$post->prod_brand =  $_POST["prod_brand"];
$post->prod_price =  $_POST["prod_price"];
$post->id =  $_POST["id"];
$post->prod_saleprice =  $_POST["prod_saleprice"];
$post->prod_image =  $_POST["prod_image"];
$post->quantity =  $_POST["quantity"];
$post->prod_type =  $_POST["prod_type"];
$post->prod_size =  $_POST["prod_size"];
$post->prod_color =  $_POST["prod_color"];
$post->prod_category =  $_POST["prod_category"];




// $post->prod_image = $_FILES["file"]["name"] ;


// $target_file = basename($_FILES["file"]["name"]);
// // $uploadOk = 1;
// // // Check if file already exists
// // if (file_exists($target_file)) {
// //     echo "Sorry, file already exists.";
// //     $uploadOk = 0;
// // }
// // // Check file size
// // if ($_FILES["file"]["size"] > 500000) {
// //     echo "Sorry, your file is too large.";
// //     $uploadOk = 0;
// // }
// // // Check if $uploadOk is set to 0 by an error
// // if ($uploadOk == 0) {
// //     echo "Sorry, your file was not uploaded.";
// // // if everything is ok, try to upload file
// // } else {
//     if (move_uploaded_file( ($_FILES["file"]["tmp_name"]),  $target_file  ))
//      {
//         echo "The file ".  $_FILES["file"]["name"]. " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }

if($post->create()) {
    echo json_encode(
     array('message'=> 'Post Created')
    );

} else {
    echo json_encode(
        array('message'=> 'Post Not Created')
    );
}

