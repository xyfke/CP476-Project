<!-- landing_process.php

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
	session_start();
	include 'include/functions.php';

	$db = getDB();
	// ---------------------------------------------------------------------------------------------------------------------------------- SIGN UP VALIDATION
	// define variables to hold form values
	$userName = $firstName = $lastName = $email = "";
	// define variables to hold form error messages
	$userNameErr = $firstNameErr = $lastNameErr = $emailErr = $passwordErr = $passwordRepeatErr = "";
	// define variables to hold form error styling (initialized at non-error)
	$userNameClass = $firstNameClass = $lastNameClass = $emailClass = $paswordClass = $passwordRepeatClass = "";
	$formValid = true;
	$errorDisplay = "none";
	// if the sign up form was submitted, go on with the validation checks
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signUp"])) {
		// ----------------------------------------------------------------------------- validate user name
		$validFormat = "/^[A-Za-z0-9]+$/";
		if(!preg_match($validFormat, $_POST["userName"])){
			$userNameErr = "Only letters and numbers allowed for user name";
			$formValid = false;
			if(empty($_POST["userName"])){
				$userNameErr = "User name is required";
			}
			// wrong format changes form to its red error display
			$userNameClass = "is-invalid";
		}
		else{
			// check if username already exists
			$query = "SELECT * FROM user WHERE Username = ?";
			$users = runBindedQuery($_POST["userName"], -1, -1, 's', $db, $query);
			$row = mysqli_fetch_row($users);
			if ($row){
				// if it does create error state for user
				$userNameErr = "User already exists";
				$formValid = false;
				$userNameClass = "is-invalid";
			}
		}
		// save value entered so that it doesn't have to be re-typed
		$userName = $_POST["userName"];
		// ----------------------------------------------------------------------------- validate first name
		$validFormat = "/^[A-Za-z\s]+$/";
		if(!preg_match($validFormat, $_POST["firstName"])){
			$firstNameErr = "Only letters and white space allowed for first name";
			$formValid = false;
			if(empty($_POST["firstName"])){
				$firstNameErr = "First name is required";
			}
			// wrong format changes form to its red error display
			$firstNameClass = "is-invalid";
		}
		// save value entered so that it doesn't have to be re-typed
		$firstName = $_POST["firstName"];
		// ----------------------------------------------------------------------------- validate last name
		$validFormat = "/^[A-Za-z\s]+$/";
		if(!preg_match($validFormat, $_POST["lastName"])){
			$lastNameErr = "Only letters and white space allowed for last name";
			$formValid = false;
			if(empty($_POST["lastName"])){
				$lastNameErr = "Last name is required";
			}
			// wrong format changes form to its red error display
			$lastNameClass = "is-invalid";
		}
		// save value entered so that it doesn't have to be re-typed
		$lastName = $_POST["lastName"];
		// ----------------------------------------------------------------------------- validate email
		$validFormat = "/^[A-Za-z0-9]+@[A-Za-z0-9]+.[A-Za-z0-9]+$/";
		if(!preg_match($validFormat, $_POST["email"])){
			$emailErr = "Email should be of the format xx@yyy.zzz";
			$formValid = false;
			if(empty($_POST["email"])){
				$emailErr = "Email is required";
			}
			// wrong format changes form to its red error display
			$emailClass = "is-invalid";
		}
		else{
			// check if email already exists
			$query = "SELECT * FROM user WHERE Email = ?";
			$emails = runBindedQuery($_POST["email"], -1, -1, 's', $db, $query);
			$row = mysqli_fetch_row($emails);
			if ($row){
				// if it does create error state for email
				$emailErr = "Email already exists";
				$formValid = false;
				$emailClass = "is-invalid";
			}
		}
		// save value entered so that it doesn't have to be re-typed
		$email = $_POST["email"];
		// ----------------------------------------------------------------------------- validate password
		$validFormat = "/^.{6,18}$/";
		if(!preg_match($validFormat, $_POST["password"])){
			$passwordErr = "Password should be between 6 and 18 characters";
			$formValid = false;
			if(empty($_POST["password"])){
				$passwordErr = "Password is required";
			}
			// wrong format changes form to its red error display
			$passwordClass = "is-invalid";
			// password repeat will also show error since it will be re-typed too
			$passwordRepeatClass = "is-invalid";
		}
		// ----------------------------------------------------------------------------- validate password repeat
		if(empty($_POST["passwordRepeat"]) || $_POST["password"] != $_POST["passwordRepeat"]){
			$passwordRepeatErr = "Passwords should match";
			$formValid = false;
			if(empty($_POST["passwordRepeat"])){
				$passwordRepeatErr = "Password repeat is required";
			}
			// wrong format changes form to its red error display
			$passwordRepeatClass = "is-invalid";
			// password will also show error since it will be re-typed too
			$passwordClass = "is-invalid";
		}
		// ----------------------------------------------------------------------------- if form is not valid then display errors
		if (!$formValid){
			$errorDisplay = "block";
		}
		// ----------------------------------------------------------------------------- if form is valid then process registration
		else{
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$shortBio = "Nothing here yet...";
			$picName = "0.png";
			$query = "INSERT INTO user (Username, FirstName, LastName, UserPassword, Email, ShortBio, PicName)
					  VALUES (?, ?, ?, ?, ?, ?, ?)";
			runBindedQueryLong($userName, $firstName, $lastName, $password, $email, $shortBio, $picName, "sssssss", $db, $query);
			$_SESSION['userName'] = $userName;
			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;
			$_SESSION['email'] = $email;
			$_SESSION['shortBio'] = $shortBio;
			$_SESSION['picName'] = $picName;

			$query = "SELECT * FROM user WHERE Username = ?";
			$users = runBindedQuery($userName, -1, -1, 's', $db, $query);
			$row = mysqli_fetch_row($users);
			$fields = array_values($row);
			$userId = $fields[0];

			header("Location: landing_home.php");
		}
	}

	// ---------------------------------------------------------------------------------------------------------------------------------- LOG IN VALIDATION
	// define variables to hold form values
	$userNameLog = "";
	// define variables to hold form error messages
	$logErr = ".";
	// define variables to hold form error styling (initialized at non-error)
	$logValid = false;
	$failDisplay = "hidden";
	// if the sign up form was submitted, go on with the validation checks
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logIn"])) {
		// ----------------------------------------------------------------------------- validate input
		$validFormatUser = "/^[A-Za-z0-9\s]+$/";
		$validFormatPass = "/^.{6,18}$/";
		if(preg_match($validFormatUser, $_POST["userNameLog"]) && preg_match($validFormatPass, $_POST["passwordLog"])){
			// if input is proper format
			$query = "SELECT * FROM user WHERE Username = ?";
			$users = runBindedQuery($_POST["userNameLog"], -1, -1, 's', $db, $query);
			$row = mysqli_fetch_row($users);
			if ($row){
				// and if username exists
				$fields = array_values($row);
				$userHash = $fields[4];
				if(password_verify($_POST["passwordLog"], $userHash)){
					// and if username matches password, then login is successful
					$logValid = true;
				}
				else{
					$logErr = "Wrong username or password";
				}
			}
			else{
				$logErr = "Wrong username or password";
			}
		}
		else{
			$logErr = "Wrong username or password";
		}
		// save username entered so that it doesn't have to be re-typed
		$userNameLog = $_POST["userNameLog"];

		// ----------------------------------------------------------------------------- if form is not valid then display errors
		if (!$logValid){
			$failDisplay = "visible";
		}
		// ----------------------------------------------------------------------------- if form is successful then send to home page
		else{
			$_SESSION['userName'] = $userNameLog;
			$_SESSION['firstName'] = $fields[2];
			$_SESSION['lastName'] = $fields[3];
			$_SESSION['email'] = $fields[5];
			$_SESSION['shortBio'] = $fields[6];
			$_SESSION['picName'] = $fields[7];
			$_SESSION['userId'] = $fields[0];

			header("Location: landing_home.php");
		}
	}
?>
