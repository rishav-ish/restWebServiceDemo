<?php

	include_once "../config/database.php";
	include_once "../objects/student.php";
	
	$database = new Database();
	$db = $database->get_connection();
	
	$student = new Student($db);
	
	if($_SERVER["REQUEST_METHOD"]=="GET")
		$student->id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : die("Please provide id");
	else
		die("Please use get method to connect");
	
	if($student->delete()){
		$stud_arr = array(
			"status" => true,
			"message" => "Successfully deleted"
		);
	}else{
		$stud_arr = array(
			"status" => false,
			"message" => "Unsuccessful , unable to delete"
		);
		
	}
	
	print_r(json_encode($stud_arr));
	
?>