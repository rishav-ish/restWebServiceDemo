<?php

	include_once "../config/database.php";
	include_once "../objects/student.php";
	
	
	$database = new Database();
	$db = $database->get_connection();
	
	$student = new Student($db);        //Passing database connection to constructor....
	
	if($__SERVER["REQUEST_METHOD"]== "POST"){
		
		$student->name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : die("Name attribute can't be empty");
		$student->email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : die("Email attribute can't be empty");
		$student->mobno = isset($_POST['mobno']) ? htmlspecialchars($_POST['mobno']) : die("Mobile Number attribute field can't be empty");
		$student->address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : die("Address attribute field can't be empty");
		$student->coarses = isset($_POST['coarses']) ? htmlspecialchars($_POST['coarses']) : die("Coarses attribute field can't be empty");
	
	}else{
		die("Please use Post method to connect.");
	}
	
	
	 
	/* $student->name = $_POST['name'];
	$student->email = $_POST['email'];
	$student->mobno = $_POST['mobno'];
	$student->address = $_POST['address'];
	$student->coarses = $_POST['coarses']; */
	 
	if($student->create()){
		$stud_arr = array(
			"status" => true,
			"message" => "Successfully Updated!"
		
		);
	}else{
		$stud_arr = array(
			"status" => false,
			"message" => "Student with same mobile number already exists."
		);
	}
	
	print_r(json_encode($stud_arr));
	
?>