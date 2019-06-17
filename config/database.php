<?php

	class DataBase{
		
		private $host = 'localhost';
		private $db_name = 'api';
		private $username = 'root';
		private $password = '';             //secret ..
		private $conn = null;
		
		function get_connection(){
			
			$this->conn = new mysqli($this->host,$this->username,$this->password,$this->db_name);
			
			if($this->conn->connect_error){
				die('unable to make conection');
			}
			
			return $this->conn;
			
		}
		
	}