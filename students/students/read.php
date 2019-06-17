<?php
	
	include_once "../config/database.php";
	include_once "../objects/student.php";
	
	
	$database = new Database();
	$db = $database->get_connection();
	
	$student = new Student($db);
	
	$stmt = $student->read();
	
	$result = $stmt->get_result();
	
	
	if($result->num_rows > 0){
		
		$stud_arr = array();
		$stud_arr["students"] = array();
		
		while($row = $result->fetch_assoc()){
			
			$student_info = array(
				"id" => $row["id"],
				"name"=> $row["name"],
				"email"=> $row["email"],
				"mobno"=> $row["mobno"],
				"address" => $row["address"],
				"coarses" => $row["coarses"]
			);
			
			array_push($stud_arr["students"],$student_info);
			
		}
		
		print_r(json_encode($stud_arr["students"]));
		
	}else{
		$stud_arr = array(
			"status" => false,
			"message" => 'Sorry, there are no data to show you!'
		);
		
		print_r(json_encode($stud_arr));
	}
	
	
	
?>