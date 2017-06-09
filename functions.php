<?php
	//Get book with a id.
	function getOrderById($db, $id) {
		$sql = "SELECT * FROM webtransactions WHERE TransactionID = '$id'";
		$result = $db->query($sql);
		return $result;
	}
	
	//Get data of webtransactions.
    function getOrders($db){
		//Query the database
		$sql = "SELECT * FROM webtransactions WHERE Shipped IS NULL"; 
		// new PDO query call	
		$result = $db->query($sql);
						
        return $result;
    }
	
	//Get data of book detail.
    function getDetails($db){
		//Query the database
		$sql = "SELECT * FROM bookdetail"; 
		// new PDO query call	
		$result = $db->query($sql);
						
        return $result;
    }
	
	function getBookDetailByISBN($db, $ISBNs) {
		$sql = "SELECT * FROM bookdetail WHERE ISBN = '$ISBNs'";
		$result = $db->query($sql);
		return $result;
	}
	
	//Update the order
	function updateOrder($db, $id, $name, $address, $city, $zip, $phone, $email, $note, $shipping) {
		$sql = "UPDATE webtransactions 
				SET Name='$name', Address='$address', City='$city', Zip='$zip', 
				Phone='$phone', Email='$email', Notes='$note', Shipped=$shipping
				WHERE TransactionID='$id'";
		//Prepare the query 
		$update = $db->prepare($sql);
		//Executes a prepared statement
		$update->execute();
		//returns number of rows impacted.
		return $update;
	}
	
	//Update the order
	function updateOrderById($db, $id, $shipping) {
		$sql = "UPDATE webtransactions 
				SET Shipped=$shipping
				WHERE TransactionID='$id'";
		//Prepare the query 
		$update = $db->prepare($sql);
		//Executes a prepared statement
		$update->execute();
		//returns number of rows impacted.
		return $update;
	}
	
	function numberOfOrders($db){
		$sql = "SELECT * FROM webtransactions WHERE Shipped IS NULL";
		$stmt = $db->query($sql);
		$result = $stmt->rowCount();
		return $result;
	}
	
	//Get data of webtransactions.
    function getShippedOrders($db){
		//Query the database
		$sql = "SELECT * FROM webtransactions WHERE Shipped IS NOT NULL"; 
		// new PDO query call	
		$result = $db->query($sql);
		
        return $result;
    }
	
	function deleteOldInfo($db){
		$sql = 'UPDATE webtransactions SET Address = "", City = "", State = "", Zip = "", 
		Phone = "" WHERE Shipped < NOW() - INTERVAL 60 DAY';
		$result = $db->query($sql);
		
		return $result;
	}
	
	
?>	