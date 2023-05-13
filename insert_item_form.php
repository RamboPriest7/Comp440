<!DOCTYPE html>
<html>
<head>
	<title>Insert Item</title>
	<link rel="stylesheet" href="styles2.css">
	<script>

function returnToHomePage()
    {
        window.location.href="home.php";
    }
          function init() 
    {
          returnHomepageButton.addEventListener("click", returnToHomePage);
    }

          window.addEventListener("DOMContentLoaded", init);
    </script>
</head>
<body>

<form id="item-form" method="post" action="insert-item.php">
  <label for="title">Title:</label>
  <input type="text" name="title" required size="25"><br>

  <label for="description">Description:</label>
  <textarea name="description" rows="4" cols="75" required></textarea><br>

  <label for="category">Category:</label>
  <textarea name="category" rows="1" cols="20" required></textarea><br>

  <label for="price">Price:</label>
  <input type="number" name="price" step="0.01" required ><br>

  <input type="submit" value="Insert">
</form>

<input type="button" class="btn" id="returnHomepageButton" value="Return to Home Page">


</body>
</html>
