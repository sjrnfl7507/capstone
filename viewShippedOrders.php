<!DOCTYPE html>
<!--
View page for shipped Order List
-->
<html>
<head>
<style>

	.container {
		padding: 0.5em;
		box-sizing: border-box;
	}

	Table {
		border-collapse: collapse;
		width: 100%;
		text-align: center;
		border: 4px solid #008080;
	}

	table th, td {
		border: 2px solid #008080;
		padding: 0.4em;
	}
	
	#detail {
		margin: auto;
		border: 3px solid #008080;
		width: 95%;
	}
	#btn {
		
		background-color: #e7e7e7;
		border: 1px solid #008080;
		border-radius: 15px;
		font-size: 15px;
		color: #008080;
		margin: 1em;
	}

	#btn:hover {
		background-color: lightgrey;
	}
</style>
</head>
<body>


<?php
	try {
		echo '<div class="container">';
	
		echo "<table>";
		echo "<tr><th>Name</th>
			<th>TransID</th>
			<th width='35%'>Detail</th>
			<th>Address</th>
			<th>Contact</th>
			<th width='25%'>Notes</th>
			<th>Shipping</th>
			<th>Update</th></tr>";
			
		
		//$orders is the array for getting orders 
		foreach($orders as $row) {
			$name = $row['Name'];
			$id = $row['TransactionID'];
			//get the all ISBN data for one order
			$ISBNsAll =$row['ISBN'];
			//ISBN and Quantity information for each book
			$ISBNs = explode(",", $ISBNsAll);
			
			$address = $row['Address'];
			$city = $row['City'];
			$state = $row['State'];
			$zip = $row['Zip'];
			$phone = $row['Phone'];
			$email = $row['Email'];
			$note = $row['Notes'];
			$shipping = $row['Shipped'];
			//when mouse click action occurrs, get the id 
			$update =  "<a href='?action=changeShipped&id=$id'>Change</a>";
			
			
			echo '<td>' . $name . '</td> ';				
			echo '<td>' . $id . '</td> ';
			
			//Order Detail section
			echo "<td><table id=\"detail\">
			<tr><th>ISBN</th>
			<th>Q</th>
			<th>Title</th>
			<th>Section</th></tr>";
			$numberOfISBN = sizeof($ISBNs);
			for ($i = 0; $i < $numberOfISBN; $i++){
				$array = preg_split( '/(-)/', $ISBNs[$i]);
				$ISBN = $array[0];
				$quantity = $array[1];
				
				echo '<tr><td>' . $ISBN . '</td>';
				echo '<td>' . $quantity . '</td>';
			
				$bookDeatils = getBookDetailByISBN($db2, $ISBN);
				foreach($bookDeatils as $bookDeatil) {
					echo '<td>' . $bookDeatil['Title'] . '</td>';
					echo '<td>' . $bookDeatil['Section'] . '</td></tr>';
				}
			}
			echo "</table></td>";
				
				
			echo '<td>' . $address . ',' . $city . ','  . $state . ',' . $zip . '</td> ';
			echo '<td>' . $phone . '<br />' . $email . '</td> ';
			echo '<td>' . $note . '</td>';
			echo '<td>' . $shipping . '</td>';
			echo '<td>' . $update . '</td></tr>';
		}
		
		echo "</table>";
		
		echo "</div>";
		
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		echo $error_message;
		exit();
	}

?>


</body>
</html>