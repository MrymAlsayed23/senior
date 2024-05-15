<?php
session_start();
$bid = $_GET['bid']; 
$uid = $_SESSION['uid'];

require("../connection.php");
if(isset($_POST["rating_data"]))
{

	$data = array( //may be we need to add rid
		// ':user_name'		=>	$_POST["user_name"],
		// ':user_rating'		=>	$_POST["rating_data"],
		':urating'		=>	$_POST["rating_data"],
		// ':user_review'		=>	$_POST["user_review"],
		// ':datetime'			=>	time()
	);

	$query = "INSERT INTO rating (uid, urating, bid) VALUES (:uid :urating, :bid)";
	$statement = $db->prepare($query);
	$statement->execute($data);

	echo "Your Review & Rating Successfully Submitted";

}

//second Page

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "SELECT * FROM rating ORDER BY rid DESC";

	$result = $db->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row){
		$review_content[] = array(
			'urating'		=>	$row["urating"],
			'uid'		=>	$row["uid"],
			'bid'		=>	$row["bid"]

		);

		if($row["urating"] == '5'){
			$five_star_review++;
		}

		if($row["urating"] == '4'){
			$four_star_review++;
		}

		if($row["urating"] == '3'){
			$three_star_review++;
		}

		if($row["urating"] == '2'){
			$two_star_review++;
		}

		if($row["urating"] == '1'){
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["urating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}
?>