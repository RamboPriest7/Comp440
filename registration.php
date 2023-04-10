<!DOCTYPE html>
<html>
	<head>
		<title>idk</title>
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

	$newUsername = $_POST["username"];
	$newPassword = $_POST["password"];
	$newFirstName = $_POST["firstName"];
	$newLastName = $_POST["lastName"];
	$newEmail = $_POST["email"];

	//here i'm gonna check for duplicate username and email
	$query = "SELECT username, email FROM users;";
	$result = mysqli_query($db, $query);
	$failCheck = false;

	while ($row = mysqli_fetch_row($result))
	{
	    if($row[0] == $newUsername) //if the username is already in the database
	    {
	    	$failCheck = true;
	    	header("Location: registrationFail.php?flag1=true");
	    }

	    if($row[1] == $newEmail) //if the email is already in the database
	    {
	    	$failCheck = true;
	      header("Location: registrationFail.php?flag2=true");
	    }

	}
	// prevent SQL attacks
	if($failCheck==false){
		$insertQ = "INSERT INTO users (username, password, firstName, lastName, email) VALUES (?, ?, ?, ?, ?)";

		$stmt = $db->prepare($insertQ);
		$stmt->bind_param("sssss", $newUsername, $newPassword, $newFirstName, $newLastName, $newEmail);
		$stmt->execute();
	        session_start();
	        $_SESSION['loggedin'] = true;
	        $_SESSION['username'] = $newUsername;

		header("Location: home.php");
	}

	?>

	<p>Registration successful</p>
	</body>
</html>