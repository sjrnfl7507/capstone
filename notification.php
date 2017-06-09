<!DOCTYPE html>
<!-- Notication for book orders  
-->
<html lang="en">
<meta http-equiv="refresh" content="30" >
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
	
	function showUser(str) {
		
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
			
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("").innerHTML = this.responseText;
				
			}
		};
		
		xmlhttp.open("GET","orderList.php?="+str,true);
		xmlhttp.send();
	}

</script>
<style>
<!-- style for box-->
	p {
		font-size: 20px;
		color: black;
	}
	h1 {
		font-size: 3em; 
		color: red;
		text-shadow: 2px 4px yellow;
		display: inline;
		margin: 0 0 0 0;
		background-color: yellow;
	}
	.blink{

text-decoration: blink;

-webkit-animation-name: blinker;

-webkit-animation-duration: 0.4s;

-webkit-animation-iteration-count:infinite;

-webkit-animation-timing-function:ease-in-out;

-webkit-animation-direction: alternate;

}
@-webkit-keyframes blinker {

	0%   {top: 0px; left: 100px; background: blue;}
  
    50%  {top: 100px; left: 100px; background: yellow;}


}
	h3 {
		display: inline-block;
		position: relative;
		color: #008080;
	}
	
	#container {	
		left: 0.5em;
		bottom: 0.5em;
		position: fixed;
		padding: 0.1px;
		width: 185px;
		height: 90px;
		background: white;
		border: 5px solid #008080; 
		border-radius: 15px;
		text-align: center;
	}
	#btn {
		
		background-color: #e7e7e7;
		border: 1px solid #008080;
		border-radius: 15px;
		font-size: 15px;
		color: #008080;
		margin: 4px 0 0 0;
	}

	#btn:hover {
		background-color: lightgrey;
	}
	
</style>
	<?php
		ini_set ( 'display_errors', 1 ); // Displaying error!
		error_reporting ( E_ALL | E_STRICT ); 
		// Show all errors plus strict error reporting.
	?>
</head>
<!-- Show the notification box-->
<div id = "container">
<body onload = "showUser('0')"> 
	
	<h1 id="order" class="blink"> 
	
	<?php
	
		include 'dbPdo.php';
		include 'functions.php';
		$db = connect_to_database("leftbank_paypal");
		$result = numberOfOrders($db);
		
		
		echo $result;
	
	?>
	</h1>
	
	<h3>ORDER(s)</h3>
	
<form action="orderList.php">
	<button id="btn">Order info</button>
</form>

</body>
</div>
</html>