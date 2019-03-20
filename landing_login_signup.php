<!-- landing_login_signup.php

	CP476 Final Project

	Author 1:  David Moreno-Bautista
	ID 1:      151925580
	Email 1:   more5580@mylaurier.ca

	Author 2:  Xiang Ke
	ID 2:	   150617130
	Email 2:   kexx7130@mylaurier.ca

	Version  2019-03-02
	-->

<html lang = "en">
	<head>
		<title> Log In or Sign Up </title>
		<meta charset = "utf-8" />
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<div style="overflow:hidden">
			<div id="loginHeader">
				<form name="loginForm" method="post">
					<div style="float:left; padding-left:500px; padding-top:14px">
						<div class="loginFormTitles"> Username </div>
						<input type="text" name="userName" class="roundTextBox">
					</div>
					<div style="float:left; padding-left:10px; padding-top:14px">
						<div class="loginFormTitles"> Password </div>
						<input type="password" name="password" class="roundTextBox">
					</div>
					<div style="float:left; padding-left:10px; padding-top:14px">
						<div style="visibility:hidden">.</div>
						<input type="submit" formaction="landing_home.php" name="submit" value="LOG IN" class="subButtons"/>
					</div>
				</form>
			</div>

			<div>
				<form id="signupForm" name="signupForm" method="post">
					<div id="signupFormTitle"> Join us to start! </div>
					<input type="text" name="userName" placeholder="Username" class="signupFormBox">
					<div>
						<input type="text" name="firstName" placeholder="First Name" class="signupFormBoxSmall">
						<input type="text" name="lastName" placeholder="Last Name" class="signupFormBoxSmall">
					</div>
					<input type="text" name="email" placeholder="Email" class="signupFormBox">
					<div>
						<input type="password" name="password" placeholder="New Password" class="signupFormBoxSmall">
						<input type="password" name="password" placeholder="Repeat Password" class="signupFormBoxSmall">
					</div>
					<div style="text-align:center">
						<input type="submit" formaction="landing_home.php" name="submit" value="SIGN UP" id="signupSubButton"/>
					</div>
				</form>
				<div id="signupImg">
					<img src="images/logo_big.png" alt="Signup Image" style="width:100%;height:100%;object-fit:contain;"/>
				</div>
			</div>
		</div>
		<?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
