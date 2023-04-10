<!DOCTYPE html>
<html>
<head>
	<title>Insert Item</title>
	<link rel="stylesheet" href="styles.css">
	<script>

    function backHome()
    {
        window.location.href="home.php";
    }

          function init() 
    {
        homeButton.addEventListener("click", backHome);
    }

          window.addEventListener("DOMContentLoaded", init);
    </script>
</head>
<body>
<form id="item-form" method="post">
  <label for="title">Title:</label>
  <input type="text" name="title" required><br>

  <label for="description">Description:</label>
  <textarea name="description" required></textarea><br>

  <label for="category">Category:</label>
  <input type="text" name="category" required><br>

  <label for="price">Price:</label>
  <input type="number" name="price" step="0.01" required><br>

  <input type="submit" value="Submit">
</form>

<div id="message-success" style="display: none;">Item inserted</div>
<div id="message-limit" style="display: none;">Sorry, you have already posted 3 items today.</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('#item-form').submit(function(event) {
    event.preventDefault();

    $.ajax({
      type: 'post',
      url: 'insert_item.php',
      data: $('#item-form').serialize(),
      success: function(response) {
        if (response == 'success') {
          $('#message-success').show();
          $('#message-limit').hide();
        } else if (response == 'limit_exceeded') {
          $('#message-success').hide();
          $('#message-limit').show();
        } else {
          alert('Failed to insert item.');
        }
      },
      error: function() {
        alert('Failed to insert item.');
      }
    });
  });
});
</script>
</body>
</html>
