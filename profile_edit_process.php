<!-- profile_edit_process.php

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
	include 'include/functions.php';

	$db = getDB();
	// define variables to hold form values
	$userName = $_SESSION['userName'];
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
	$email = $_SESSION['email'];
	$shortBio = $_SESSION['shortBio'];
	$picName = $_SESSION['picName'];
	// define variables to hold form error messages
	$userNameErr = $firstNameErr = $lastNameErr = $emailErr = $passwordOldErr = $passwordNewErr = $passwordRepeatErr = $shortBioErr = $picNameErr = "";
	// define variables to hold form error styling (initialized at non-error)
	$userNameStyle = $firstNameStyle = $lastNameStyle = $emailStyle = $passwordOldStyle = $passwordNewStyle = $passwordRepeatStyle = $shortBioStyle = $picNameStyle = "#f5f5dc";
	$formValid = true;
	$correctPassword = false;
	$errorDisplay = "none";
	// if the sign up form was submitted, go on with the validation checks
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// ----------------------------------------------------------------------------- validate first name
		$validFormat = "/^[A-Za-z\s]+$/";
		if(!preg_match($validFormat, $_POST["firstName"])){
			$firstNameErr = "Only letters and white space allowed for first name";
			$formValid = false;
			if(empty($_POST["firstName"])){
				$firstNameErr = "First name is required";
			}
			// wrong format changes form to its red error display
			$firstNameStyle = "red";
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
			$lastNameStyle = "red";
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
			$emailStyle = "red";
		}
		elseif ($_POST["email"] != $_SESSION['email']){
			// check if email already exists
			$query = "SELECT * FROM user WHERE Email = ?";
			$emails = runBindedQuery($_POST["email"], -1, -1, 's', $db, $query);
			$row = mysqli_fetch_row($emails);
			if ($row){
				// if it does create error state for email
				$emailErr = "Email already exists";
				$formValid = false;
				$emailStyle = "red";
			}
		}
		// save value entered so that it doesn't have to be re-typed
		$email = $_POST["email"];
		// ----------------------------------------------------------------------------- validate old password
		$validFormatPass = "/^.{6,18}$/";
		if(preg_match($validFormatPass, $_POST["passwordOld"])){
			// if input is proper format
			$query = "SELECT * FROM user WHERE Username = ?";
			$users = runBindedQuery($userName, -1, -1, 's', $db, $query);
			$row = mysqli_fetch_row($users);
			if ($row){
				// and if username exists
				$fields = array_values($row);
				$userHash = $fields[4];
				if(password_verify($_POST["passwordOld"], $userHash)){
					// and if username matches password, then old password is valid
					$correctPassword = true;
				}
			}
		}
		if (!$correctPassword){
			$formValid = false;
			$passwordOldErr = "Incorrect password";
			// wrong format changes form to its red error display
			$passwordOldStyle = "red";
			// new password will also show error since it will be re-typed too
			$passwordNewStyle = "red";
			// password repeat will also show error since it will be re-typed too
			$passwordRepeatStyle = "red";
		}
		// ----------------------------------------------------------------------------- validate new password
		$validFormat = "/^.{6,18}$/";
		if(!preg_match($validFormat, $_POST["passwordNew"]) && isset($_POST["checkPassChange"])){
			$passwordNewErr = "New password should be between 6 and 18 characters";
			$formValid = false;
			if(empty($_POST["password"])){
				$passwordNewErr = "New password is required";
			}
			// wrong format changes form to its red error display
			$passwordNewStyle = "red";
			// old password will also show error since it will be re-typed too
			$passwordOldStyle = "red";
			// password repeat will also show error since it will be re-typed too
			$passwordRepeatStyle = "red";
		}
		// ----------------------------------------------------------------------------- validate password repeat
		if((empty($_POST["passwordRepeat"]) || $_POST["passwordNew"] != $_POST["passwordRepeat"]) && isset($_POST["checkPassChange"])){
			$passwordRepeatErr = "Passwords should match";
			$formValid = false;
			if(empty($_POST["passwordRepeat"])){
				$passwordRepeatErr = "Password repeat is required";
			}
			// wrong format changes form to its red error display
			$passwordRepeatStyle = "red";
			// old password will also show error since it will be re-typed too
			$passwordOldStyle = "red";
			// new password will also show error since it will be re-typed too
			$passwordNewStyle = "red";
		}
		// ----------------------------------------------------------------------------- validate short bio
		if(strlen($_POST["shortBio"]) > 5000){
			$shortBioErr = "Bio should not be longer than 5,000 characters";
			$formValid = false;
			// wrong format changes form to its red error display
			$shortBioStyle = "red";
		}
		// save value entered so that it doesn't have to be re-typed
		$shortBio = $_POST["shortBio"];
		// ----------------------------------------------------------------------------- if form is not valid then display errors
		if (!$formValid){
			$errorDisplay = "block";
		}
		// ----------------------------------------------------------------------------- if form is valid then change profile
		else{
			if (isset($_POST["checkPassChange"])){
				$password = password_hash($_POST["passwordNew"], PASSWORD_DEFAULT);
				$query = "UPDATE user SET FirstName = ?, LastName = ?, UserPassword = ?, Email = ?, ShortBio = ?, PicName = ?
						  WHERE Username = ?";
				runBindedQueryLong($firstName, $lastName, $password, $email, $shortBio, $picName, $userName, "sssssss", $db, $query);
				header("Location: logOut.php");
			}
			else{
				$query = "UPDATE user SET FirstName = ?, LastName = ?, Email = ?, ShortBio = ?, PicName = ?
						  WHERE Username = ?";
				runBindedQueryLong($firstName, $lastName, $email, $shortBio, $picName, $userName, -1, "ssssss", $db, $query);
				$_SESSION['userName'] = $userName;
				$_SESSION['firstName'] = $firstName;
				$_SESSION['lastName'] = $lastName;
				$_SESSION['email'] = $email;
				$_SESSION['shortBio'] = $shortBio;
				$_SESSION['picName'] = $picName;
				header("Location: landing_home.php");
			}
		}
	}

?>
