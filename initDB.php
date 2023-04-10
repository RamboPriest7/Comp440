<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Database Design</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function iButtonClicked()
    {
            window.location.href="initDB.php";
    }
    function returnToHomePage()
    {
        window.location.href="home.php";
    }

          function init() 
    {
        initButton.addEventListener("click", iButtonClicked);
        returnHomepageButton.addEventListener("click", returnToHomePage);

    }

          window.addEventListener("DOMContentLoaded", init);
    </script>
  </head>
  <body>

<?php 
    $mysql_host = "localhost:3308";
    $mysql_database = "comp440";
    $mysql_user = "root";
    $mysql_password = "";
    # MySQL with PDO_MYSQL  
    $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

    
    $query = file_get_contents("ProjDB.sql");

    $stmt = $db->prepare($query);

    if ($stmt->execute()){
         //echo "Success";
    }else{ 
         echo "Fail";
    }
?>


  <div class="wrapper">
    <div class="header">
      <label class="header-title">Database Design</label>
      <br />
      <label class="header-sub">By: Erik & James</label>
    </div>

    <div class="container">
      <div class="home-style">
        <label id="welcome-sign">Welcome to the Home Page!</label>
	<div style='color: purple;'> Success </div>
        <input type="button" class="btn" id="initButton" value="Initialize DB">
        <input type="button" class="btn" id="returnHomepageButton" value="Return to Home Page">
      </div>
    </div>
    
  </div>
</body>
  </html>