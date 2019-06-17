<?php
	
	include_once "../config/database.php";
	include_once "../objects/student.php";
	
	$database = new Database();
	$db = $database->get_connection();
	
	$student = new Student($db);
	
	if( $_SERVER["REQUEST_METHOD"] == "POST"){
		
		$student->id = htmlspecialchars(intval($_POST['id']));
		$student->name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : $student->generate('name');
		$student->email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : $student->generate('email');
		$student->mobno = isset($_POST['mobno']) ? htmlspecialchars($_POST['mobno']) : $student->generate("mobno");
		$student->address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : $student->generate('address');
		$student->coarses = isset($_POST['coarses']) ? htmlspecialchars($_POST['coarses']) : $student->generate('coarses');
		
	}else{
		die("Please use post method to connect.");
	}
	
	 
	/* $student->id = $_POST['id'];
	$student->name = $_POST['name'];
	$student->address = $_POST['address'];
	$student->coarses = $_POST['coarses'];
	$student->mobno = $_POST['mobno'];
	 */
	 
	if($student->update()){
		$stud_arr = array(
			"status" => true,
			"message" => "Successfully updated!"
		);
	}else{
		$stud_arr = array(
			"status" => false,
			"message" => "Unsuccessfull, sorry can't update. It's look like you are not connected!"
		);
	}
	
	print_r(json_encode($stud_arr));
	
?>