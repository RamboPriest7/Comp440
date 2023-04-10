
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

        $dbhost = "localhost:3308";
        $dbuser = "root";
   	    $dbpass = "";
        $dbname = "comp440";

    	$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    	if ( ! $db ) // connection failed
   	 {
       	 print "<p>Could not connect to database</p>";
       	 print ( mysqli_connect_error() );
       	 print "</body></html>";
         mysqli_close($db);
         die();  // go no further than this line!
   	}
    	else
    	{
        //print "<p>Connection succeeded</p>";
        //  var_dump($db);
              error_log("Hi I am an error and db username is " . $dbuser . "\r\n");     
    	}

	//var_dump($_POST);
	$newLusername = $_POST["lusername"];
	$newLpassword = $_POST["lpassword"];

	$query = "SELECT username, password FROM users;";
	$result = mysqli_query($db, $query);

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

	<br />
    	<input type="button" id="initButton" value="Initialize DB">
	</body>
</html>