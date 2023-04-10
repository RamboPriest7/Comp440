<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Database Design</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      //$(document).ready(function(){
        //$(".signup-form").hide();
        //$(".signup").css("background","none");

      $(document).ready(function(){
	$(".login-form").hide();
	$(".login").css("background","none");

        $(".login").click(function(){
          $(".signup-form").hide();
          $(".login-form").show();
          $(".signup").css("background","none");
          $(".login").css("background","#fff");
        });

        $(".signup").click(function(){
          $(".signup-form").show();
          $(".login-form").hide();
          $(".signup").css("background","#fff");
          $(".login").css("background","none");
        });

        $(".btn").click(function(){
          $(".input").val("");
        });
      });
        function checkPassword()
        {
	  passwordCheck.innerHTML = "";
          var passContents = password.value;
          var cPassContents = cpassword.value;
          if (passContents === cPassContents)
          {
              //do nothing
          }
          else
          {
              passwordCheck.innerHTML = "<span style='color: red;'>ERROR: password entries should match</span>";
          }
        }

	function usernameError()
	{
	   usernameCheck.innerHTML = "<span style='color: red;'>ERROR: username already taken</span>";
	}

	function emailError()
	{
	   emailCheck.innerHTML = "<span style='color: red;'>ERROR: email already registered</span>";
	}

        //init function
        function init()
        {
          //variables
          password = document.getElementById("password");
          cpassword = document.getElementById("cpassword");

	  //event listeners
	  password.addEventListener("input", function (event) { checkPassword(); });
	  cpassword.addEventListener("input", function (event) { checkPassword(); });

        }
  
        window.addEventListener("DOMContentLoaded", init);
        
    </script>
  </head>
  <body>

  <div class="wrapper">
    <div class="header">
      <label class="header-title">Database Design</label>
      <br />
      <label class="header-sub">By: Erik and James</label>
    </div>

    <div class="container">
      
      <div class="login">Log In</div>
      <div class="signup">Sign Up</div>
      
       <form class="signup-form" method="post" action="registration.php">
          <label class="input-label">Enter an email address:</label>
	  <div id="emailCheck"> </div>
          <input type="text" id="email" name="email" placeholder="Email Address" class="input" required><br />

          <label class="input-label">Enter your first name:</label>
          <input type="text" id="firstName" name="firstName" placeholder="First Name" class="input" required><br />

          <label class="input-label">Enter your last name:</label>
          <input type="text" id="lastName" name="lastName" placeholder="Last Name" class="input" required><br />

          <label class="input-label">Enter a username:</label>
	  <div id="usernameCheck"> </div>
          <input type="text" id="username" name="username" placeholder="Username" class="input" required>
	 

          <label class="input-label">Enter a password:</label>
          <input type="password" id="password" name="password" placeholder="Password" class="input" required><br />

          <label class="input-label">Confirm password:</label>
          <div id="passwordCheck"> </div>
          <input type="password" id="cpassword" placeholder="Password" class="input" required>
          <!- this div is so we can check for matching password entries ->
          <br />

          <input type="submit" name="submit" id="regButton" value="Create Account">
	  <!- please don't add a class to the submit object, it breaks the code ->
       </form>

      
      <form class="login-form" method="post" action="login.php">
          <label class="input-label">Enter your username:</label>
          <input type="text" id="lusername" name="lusername" placeholder="Username" class="input" required><br />

          <label class="input-label">Enter your password:</label>
          <input type="password" id="lpassword" name="lpassword" placeholder="Password" class="input" required><br />

          <input type="submit" name="submit" id="loginButton" value="Log In">
	  <!- please don't add a class to the submit object, it breaks the code ->

          <span><a href="#">I forgot my username or password</a></span>
       </form>
      
    </div>
  </div>

  <?php

     if(isset($_GET["flag1"]))
     {
	echo '<script type="text/javascript">',
	     'usernameError();',
	     '</script>';
     }
     if(isset($_GET["flag2"]))
     {
         echo '<script type="text/javascript">',
	     'emailError();',
	     '</script>';
     }

  ?>
  </html>