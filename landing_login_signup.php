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
<?php
include 'landing_process.php';
?>

<html lang = "en">
	<head>
		<title> Log In or Sign Up </title>
		<meta charset = "utf-8" />
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body class="m-auto">
		<nav id="loginHeader" class="navbar navbar-expand py-3">
			<div class="accountText col-md-3"></div>
			<div class="col-md-9">
				<form name="loginForm" method="post" class="nav float-right" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="mr-1">
						<div class="loginFormTitles"> Username </div>
						<input type="text" name="userNameLog" class="roundTextBox" value="<?php echo $userNameLog ?>">
					</div>
					<div class="mr-1">
						<div class="loginFormTitles"> Password </div>
						<input type="password" name="passwordLog" class="roundTextBox">
					</div>
					<div class="mr-1">
						<div style="color:red; visibility: <?php echo $failDisplay ?>">
							<?php echo $logErr ?>
						</div>
						<input type="submit" name="logIn" value="LOG IN" class="subButtons"/>
					</div>
				</form>
			</div>
		</nav>

		<div class="row">
			<div class="col-md-6 mt-4">
				<form id="signupForm" name="signupForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div id="signupFormTitle"> Join us to start! </div>
					<div class="mb-1 mx-4">
						<input type="text" name="userName" placeholder="Username" class="<?php echo 'form-control ' . $userNameClass?>" value="<?php echo $userName ?>">
					</div>
					<div class="row mb-1 mx-4">
						<input type="text" name="firstName" placeholder="First Name" class="<?php echo 'form-control col-sm-6 ' . $firstNameClass?>" value="<?php echo $firstName ?>">
						<input type="text" name="lastName" placeholder="Last Name" class="<?php echo 'form-control col-sm-6 ' . $lastNameClass?>" value="<?php echo $lastName ?>">
					</div>
					<div class="mb-1 mx-4">
						<input type="text" name="email" placeholder="Email" class="<?php echo 'form-control ' . $emailClass?>" value="<?php echo $email ?>">
					</div>
					<div class="row mb-2 mx-4">
						<input type="password" name="password" placeholder="New Password" class="<?php echo 'form-control col-sm-6 ' . $passwordClass?>">
						<input type="password" name="passwordRepeat" placeholder="Repeat Password" class="<?php echo'form-control col-sm-6 ' . $passwordRepeatClass?>">
					</div>
					<div class="mb-2">
						<input type="submit" name="signUp" value="SIGN UP" id="signupSubButton"/>
					</div>
					<div class="pl-4 pb-2" style="color:red; text-align:left; display: <?php echo $errorDisplay ?>">
						<?php if ($userNameErr != ""){echo $userNameErr;echo "<br>";}?>
						<?php if ($firstNameErr != ""){echo $firstNameErr;echo "<br>";}?>
						<?php if ($lastNameErr != ""){echo $lastNameErr;echo "<br>";}?>
						<?php if ($emailErr != ""){echo $emailErr;echo "<br>";}?>
						<?php if ($passwordErr != ""){echo $passwordErr;echo "<br>";}?>
						<?php if ($passwordRepeatErr != ""){echo $passwordRepeatErr;echo "<br>";}?>
					</div>
				</form>
			</div>
			<div id="signupImg" class="col-md-6 mt-2">
				<img src="images/logo_big.png" alt="Signup Image" style="width:100%;height:100%;object-fit:contain;"/>
			</div>
		</div>

		<?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
