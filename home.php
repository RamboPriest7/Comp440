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
	function returnToHome()
	{
	    window.location.href="index.html";
	}

	function itemHome()
  {
    window.location.href="insert_item_form.php";
  }
          function init() 
    {
      initButton.addEventListener("click", iButtonClicked);
	    returnButton.addEventListener("click", returnToHome);
      itemButton.addEventListener("click", itemHome);

    }

          window.addEventListener("DOMContentLoaded", init);
    </script>
  </head>
  <body>
     <?php
        session_start();
	//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	  // echo $_SESSION['username'];
	//}
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
        <input type="button" class="btn" id="initButton" value="Initialize DB">
        <input type="button" class="btn" id="returnButton" value="Sign Out">
        <input type="button" class="btn" id="itemButton" value="Add Items">
      </div>
    </div>
    
  </div>
</body>
  </html>