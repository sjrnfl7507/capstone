<!DOCTYPE html>
<!--
This is the Modeling page for handling orders information from customers
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Order List</title>

        <?php
			ini_set ( 'display_errors', 1 ); // Displaying error!
			error_reporting ( E_ALL | E_STRICT ); 
			// Show all errors plus strict error reporting.
		?>	
    </head>
    <body>
		
		<h1>ORDER LIST</h1>
		
		<?php 
			
			try {
				
				//Connecte to database 
				include 'dbPdo.php';
				//Get the functions
				include 'functions.php';
				
				$db = connect_to_database("leftbank_paypal");
				$db2 = connect_to_database("leftbank_unicenta");

				
				//Get the desired action
				if(isset($_POST['action'])){
					$action = $_POST['action'];
				}
				else if(isset($_GET['action'])){
					$action = $_GET['action'];
				}
				else{
					$action = "display";
				}
				
				
				switch($action) {
					
					//User clicked the change, can change orders information of a customer
					case "change":
						//Id is from the view page
						$id = $_GET['id'];
						$bookToEdit = getOrderById($db, $id);
						include 'change.php';
						break;
					
					//User clicked the change, can change shipped orders information of a customer
					case "changeShipped":
						//Id is from the view page
						$id = $_GET['id'];
						$bookToEdit = getOrderById($db, $id);
						include 'changeShipped.php';
						break;
											
					case "update":
						//Set default time
						date_default_timezone_set('America/Los_Angeles');
						$date = date('Y-m-d H:i:s', time());
						//$_POST variables are from change.php 
						$id = $_POST['id'];
						$name = $_POST['name'];
						$address = $_POST['address'];
						$city = $_POST['city'];
						$state = $_POST['state'];
						$zip = $_POST['zip'];
						$phone = $_POST['phone'];
						$email = $_POST['email'];
						$note = $_POST['notes'];
						//if shipping is checked from update page(change.php)
						if(isset($_POST['shipping'])){
							$shipping = "'" . $date . "'";						
						//if shipping is unchecked	
						} else if(!isset($_POST['shipping'])){
							$shipping = "NULL";
						} else{
							
						}
						//Update function for changed information 
						$updated = updateOrder($db, $id, $name, $address, $city, $zip, $phone, $email, $note, $shipping);
						include 'updateSuccess.php';
						
						break;
					
										
					
					case "updateAll":
					
						//Set default time
						date_default_timezone_set('America/Los_Angeles');
						$date = date('Y-m-d H:i:s', time());
						
						//if shipping is checked 
						if(isset($_POST['checkList'])){
							$checkLists = $_POST['checkList'];
							$shipping = "'" . $date . "'";
							if(is_array($checkLists)){
								foreach($checkLists as $id){	
									$updated = updateOrderById($db, $id, $shipping);
								}
							} else {
								$updated = updateOrderById($db, $id, $shipping);
							}
							echo "<h3>Update Successed.</h3><br />";
						//if shipping is unchecked	
						} else {
							echo "<h3>There is no changed shipping information.</h3><br />";
						}					
						break;
					
					case "display":
						
						$orders= getOrders($db);
						include 'viewOrders.php';
						break;
						
					case "displayShippedOrders":
						
						
						$orders=getShippedOrders($db);
						$update=deleteOldInfo($db);
						include 'viewShippedOrders.php';
						break;	
				}
					
				echo "<a href='javascript:history.back()'>Back to previous page</a>";
				echo "<br /><br />";
				echo "<a href='notification.php'>Back to notification box</a>";

				} catch (PDOException $e) {
				$error_message = $e->getMessage();
				echo $error_message;
				exit();
				}
			
		
		?>
    </body>
</html>