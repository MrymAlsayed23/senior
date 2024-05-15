<?php
session_start();
$bid = $_POST['bid']; 
$uid = $_POST['uid'];

require("../connection.php");
if(isset($_POST["rating_data"]))
{

	// $data = array( //may be we need to add rid
	// 	// ':user_name'		=>	$_POST["user_name"],
	// 	// ':user_rating'		=>	$_POST["rating_data"],
	// 	':urating'		=>	$_POST["rating_data"],
	// 	// ':user_review'		=>	$_POST["user_review"],
	// 	// ':datetime'			=>	time()
	// );

	$query = "INSERT INTO rating (uid, urating, bid) VALUES (:uid :urating, :bid)";
	$statement = $db->prepare($query);
	$statement->execute([
		"bid"=> $bid,
		"uid"=> $uid,
		':urating'=>$_POST["rating_data"],
	]);

	echo "Your Review & Rating Successfully Submitted";

}

//second Page

?>