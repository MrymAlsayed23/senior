<?php
session_start();
require("../connection.php");
if (isset($_POST["submit"])) {
    try {
        $bid = $_POST['bid']; 
        $uid = $_POST['uid'];
        $urating = (int)$_POST['rating_data']; // Corrected array access

		$sql = "SELECT * FROM rating WHERE bid=$bid AND uid= $uid";
		$stm = $db->prepare($sql);
		$stm->execute();
		if ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
			$sqlup = "UPDATE rating SET urating = $urating WHERE uid= $uid AND bid=$bid";
			$stm4 = $db->prepare($sqlup);
			$stm4->execute();
		}
		else {
			$query = "INSERT INTO rating (uid, urating, bid) VALUES (:uid, :urating, :bid)";
			$statement = $db->prepare($query);
			$statement->execute([
				":uid" => $uid,
				":urating" => $urating,
				":bid" => $bid,
			]);
		}
			}
			

	catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>