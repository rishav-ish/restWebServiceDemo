<?php

	class Student {
	
		
		private $conn;
		private $table_name = 'student';
		
		public $id = null;
		public $name = null;
		public $email = null;
		public $mobno = null;
		public $address = null;
		public $coarses = null;
		
		
		public function  __construct($db){
			$this->conn = $db;
		}
		
		
		
		function create(){
			
			if($this->isAlreadyExist()){
				return false;
			}
			
			
			$query = "INSERT INTO ".$this->table_name." ( name,email,mobno,address,coarses) VALUES (?,?,?,?,?);";
			
			
			
			$stmt = $this->conn->prepare($query);
			
			$stmt->bind_param("sssss",$this->name,$this->email,$this->mobno,$this->address,$this->coarses);
			
			if($stmt->execute()){
				
				$this->id = $this->conn->insert_id;
				return true;
			}
			
			return false;
			
		}
		
		function read(){
			
			$query = "SELECT * FROM ".$this->table_name;
			
			$stmt = $this->conn->prepare($query);
			
			
			if($stmt->execute()){
				
				return $stmt;
				
				
			}
			
		}
		
		function update(){
			
		
			$query = "UPDATE ".$this->table_name." SET name = '".$this->name."', email = '".$this->email."', mobno= '".$this->mobno."', address = '".$this->address."', coarses = '".$this->coarses."' WHERE id = ".$this->id;
			
			//$query = "UPDATE ".$this->table_name." SET name = ?, email = ?, mobno = ?, address = ?, coarses = ? WHERE id = ?";
			
			$stmt = $this->conn->prepare($query);
			
			//$stmt->bind_param("ssssss",$student->name,$student->email,$student->mobno,$student->address,$student->coarses,$student->id);
			
			
			if($stmt->execute()){
				return true;
			}
			
			return false;
		}
		
		
		
		function isAlreadyExist(){
			
			$query = "SELECT * FROM ".$this->table_name." WHERE mobno = ?";
			
			
			
		
			
			$stmt = $this->conn->prepare($query);
			
			$stmt->bind_param("s",$this->mobno);
			
		
			$stmt->execute();
			
			$result = $stmt->get_result();
			
			if($result->num_rows > 0){
				return true;
			}else{
				return false;
			}
			
		}
		
		
		function delete(){
			
			$query = "DELETE FROM ".$this->table_name." WHERE id = '".$this->id."';";
			
			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute()){
				return true;
			}
				return false;
			
			
		}
		
		
		function generate($key){
			
			$query = "SELECT $key from " .$this->table_name." WHERE id = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s",$this->id);
			
			if($stmt->execute()){
				$result = $stmt->get_result();
				
				if($result->num_rows > 0){
					
					return $result->fetch_assoc()[$key];
					
				}else{
					die("Id does not exists");
				}
				
				return $result->fetch_assoc()[$key];
				
			}else{
				die("You are not yet connected.");
			}
		}
		
	}