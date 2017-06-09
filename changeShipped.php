<!-- 
User can edit all of the information. 
SaRang Chun
-->
<style>
	h2 {
		color: #008080;
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
	input {
		margin: 0.5em;
	}
</style>
<h2>Update Order Informaion</h2>

<?php
    
	//Fetches brings the first row from a bookToEdit 
    $row = $bookToEdit->fetch();
	
    $id = $row['TransactionID'];
	$name = $row['Name'];
	$address = $row['Address'];
	$city = $row['City'];
	$state = $row['State'];
	$zip = $row['Zip'];
	$phone = $row['Phone'];
	$email = $row['Email'];
	$note = $row['Notes'];
	$shipping = $row['Shipped'];
	
	
	//Basic configuration form for the submit button 
    echo "<form method='post' action=''>$id<br />";
	
	echo "<form method='post' action=''>Name :
          <input type='text'
                 name='name' value='$name'><br />";
				 
	echo "<form method='post' action=''>Address :
          <input type='text'
                 name='address' value='$address'><br />";

	echo "<form method='post' action=''>City :
          <input type='text'
                 name='city' value='$city'><br />";

	echo "<form method='post' action=''>State :
          <input type='text'
                 name='state' value='$state'><br />";
	
	echo "<form method='post' action=''>Zip :
          <input type='text'
                 name='zip' value='$zip'><br />";
    
	echo "<form method='post' action=''>Phone :
          <input type='text'
                 name='phone' value='$phone'><br />";	
				 
	echo "<form method='post' action=''>Email :
          <input type='text'
                 name='email' value='$email'><br />";	
				 
	echo "<form method='post' action=''>Notes :
          <textarea
                 name='notes' rows = '10' cols = '40'>$note</textarea><br />";
	
				 
	echo "<form method='post' action=''>Shipping Status :
		  <input type='checkbox' name='shipping'				 
					 value='$shipping' checked><br />";				 
	
				

	
	

	
	//Send all information in form along with the submit button. 
	echo "<form method ='post' action=''><input type='hidden' name='id' value='$id'>";
    echo "<input type='hidden' name='action' value='update'>";
    echo "<input type='submit' value='UPDATE' name='submit' id='btn'></form>";
    
?>