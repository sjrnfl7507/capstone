<?php
	//Making function of database connection.
	function connect_to_database($dbname) {
		try {
			$user = "root";
			
			
			$dbh = new PDO('mysql:host=localhost;dbname=' . $dbname, $user);
			return $dbh;
			echo "Connected";
		}
		
        catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}
?>