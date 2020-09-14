<?php
// header('Access-Control-Allow_Origin: *');
// header('Access-Control-Allow_headers: *');
// header('Access-Control-Expose_headers: ');

// header('Content-type: application/json');
// header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');

// header("Access-Control-Allow-Headers:X-Requested-With, Content-Type, Authorization");
// // // Makes IE to support cookies
// header("Content-Type: application/json; charset=utf-8");



// if (isset($_SERVER['HTTP_ORIGIN'])) {
//     header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//     header('Access-Control-Allow-Credentials: true');
//     header('Access-Control-Max-Age: 86400');    // cache for 1 day
// }
// // Access-Control headers are received during OPTIONS requests
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//         header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//     exit(0);
// }
// echo "You have CORS!";

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


// array holding allowed Origin domains
// $allowedOrigins = array(
	
// 		"https://localhost:3000",
//         "http://localhost:3000",
		
//         "http://localhost:3000",
//         "https://192.168.2.106:3000"
//   );
   
//   if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] != '') {
// 	foreach ($allowedOrigins as $allowedOrigin) {
// 	  if (preg_match('#' . $allowedOrigin . '#', $_SERVER['HTTP_ORIGIN'])) {
// 		header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
// 		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
// 		header('Access-Control-Max-Age: 1000');
// 		header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
// 		break;
// 	  }
// 	}
//   }
include_once '../../orderconfig/Database.php';
include_once '../../ordermodels/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read();
$num=$result->rowCount();

if($num>0){
$posts_arr = array();
$posts_arr['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){
extract($row);

$post_item = array(
'order_id'=>$order_id,
'id'=>$id,
'prod_name' => $prod_name,
'prod_code' => $prod_code,
'prod_brand'=> $prod_brand,
'prod_price' => $prod_price,
'email'=>$email,
'firstName'=>$firstName,
'lastName'=>$lastName,
'prod_saleprice'=>$prod_saleprice,
'prod_image'=>$prod_image,
'quantity'=>$quantity,
'prod_type'=>$prod_type,
'prod_size'=>$prod_size,
'prod_color'=>$prod_color,
'prod_category'=>$prod_category,
'address'=>$address,
'payment'=>$payment


);

array_push($posts_arr['data'],$post_item);
}
echo json_encode($posts_arr);
}else{
echo json_encode(
array('message' => 'No post found') 
);

}