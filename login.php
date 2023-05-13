
<!DOCTYPE html>
<html>
	<head>
	    <title>Login</title>
	    <script>
		function iButtonClicked()
		{
	    	    window.location.href="initDB.php";
		}

	        function init()	
		{
		    initButton.addEventListener("click", iButtonClicked);
		}

        	window.addEventListener("DOMContentLoaded", init);
	    </script>
	</head>
	<body>
	<?php

        require ("dbConnect.php");

    	if ( ! $conn ) // connection failed
   	 {
       	 print "<p>Could not connect to database</p>";
       	 print ( mysqli_connect_error() );
       	 print "</body></html>";
         mysqli_close($conn);
         die();  // go no further than this line!
   	}
    	else
    	{
        //print "<p>Connection succeeded</p>";
        //  var_dump($db);
              error_log("Hi I am an error and db username is " . $username . "\r\n");     
    	}

	//var_dump($_POST);
	$newLusername = $_POST["lusername"];
	$newLpassword = $_POST["lpassword"];

	$query = "SELECT username, password FROM users;";
	$result = mysqli_query($conn, $query);

	$successCheck = false;

	while ($row = mysqli_fetch_row($result))
	{
	if($row[0] == $newLusername AND $row[1] == $newLpassword)
	{
	    print("You have logged in successfully");
	    $successCheck = true;
	    session_start();
	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] = $newLusername;
	    header("Location: home.php");
	}
	}
	
	if($successCheck == false)
	{
	    print("Invalid login information");
	    header("Location: loginFail.html");
	}
	
	?>

	<br/>
	</body>
</html>