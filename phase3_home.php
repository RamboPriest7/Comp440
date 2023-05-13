<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Database Design</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>

  function eButtonClicked()
    {
    window.location.href="most_expensive.php";
    }
  function twoButtonClicked()
  {
    window.location.href="twoItems.php";
  }
  function reviewClicked()
  {
    window.location.href="reviewCheck.php";
  }
  function mostitemsClicked()
  {
    window.location.href="mostItems.php";
  }
  function favoriteClicked()
  {
    window.location.href="favorites.php";
  }

  function exClicked()
  {
    window.location.href="excellent.php";
  }
  function nopoorClicked()
  {
    window.location.href="noPoor.php";
  }
  function allpoorClicked()
  {
    window.location.href="allPoor.php";
  }
  function q9Clicked()
  {
    window.location.href="query9.php";
  }
  function pairClicked()
  {
    window.location.href="excellentPair.php";
  }
  function returnHome()
  {
    window.location.href="home.php";
  }
  

  function init() 
    {
      expensiveButton.addEventListener("click", eButtonClicked);
      twoitemButton.addEventListener("click", twoButtonClicked);
      reviewcheckButton.addEventListener("click", reviewClicked);
      mostitemsButton.addEventListener("click", mostitemsClicked);
      favoriteButton.addEventListener("click", favoriteClicked);
      excellentButton.addEventListener("click", exClicked);
      nopoorButton.addEventListener("click", nopoorClicked);
      allpoorButton.addEventListener("click", allpoorClicked);
      q9Button.addEventListener("click", q9Clicked);
      pairButton.addEventListener("click", pairClicked);
      homeButton.addEventListener("click", returnHome);
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
        <label id="welcome-sign">Welcome to the Phase 3 Page!</label>
        <input type="button" class="btn" id="expensiveButton" value="See Most Expensive">
        <input type="button" class="btn" id="twoitemButton" value="Second Feautre?">
        <input type="button" class="btn" id="reviewcheckButton" value="See Reviews">
        <input type="button" class="btn" id="mostitemsButton" value="Most Items">
        <input type="button" class="btn" id="favoriteButton" value="Favorite Users">
        <input type="button" class="btn" id="excellentButton" value="Excellent User Items">
        <input type="button" class="btn" id="nopoorButton" value="No Poor Reviews Posted">
        <input type="button" class="btn" id="allpoorButton" value="All Poor Reviews Given">
        <input type="button" class="btn" id="q9Button" value="9th Query">
        <input type="button" class="btn" id="pairButton" value="Excellent Pairs">
        <input type="button" class="btn" id="homeButton" value="Return to Home">
      </div>
    </div>
    
  </div>
</body>
  </html>