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
	$userNameStyle = $firstNameStyle = $lastNameStyle = $emailStyle = $passwordOldStyle = $passwordNewStyle = $passwordRepeatStyle = $shortBioStyle = $picNameStyle = $checkPassStyle = "#f5f5dc";
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
		// ----------------------------------------------------------------------------- validate short bio
		if(strlen($_POST["shortBio"]) > 5000){
			$shortBioErr = "Bio should not be longer than 5,000 characters";
			$formValid = false;
			// wrong format changes form to its red error display
			$shortBioStyle = "red";
		}
		// save value entered so that it doesn't have to be re-typed
		$shortBio = $_POST["shortBio"];
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
			$passwordOldErr = "Correct password required to verify changes";
		}
		// ----------------------------------------------------------------------------- validate new password
		$validFormat = "/^.{6,18}$/";
		if(!preg_match($validFormat, $_POST["passwordNew"]) && isset($_POST["checkPassChange"])){
			$passwordNewErr = "New password should be between 6 and 18 characters";
			$formValid = false;
			if(empty($_POST["passwordNew"])){
				$passwordNewErr = "New password is required if option is checked";
			}
		}
		if(!empty($_POST["passwordNew"]) && !isset($_POST["checkPassChange"])){
			$passwordNewErr = "It looks like you want to change your password, please check the option";
			$formValid = false;
			// wrong format changes form to its red error display
			$passwordNewStyle = "red";
			// password repeat will also show error since it will be re-typed too
			$passwordRepeatStyle = "red";
			// password change check will also show error since it will be re-checked too
			$checkPassStyle = "red";
		}
		// ----------------------------------------------------------------------------- validate password repeat
		if((empty($_POST["passwordRepeat"]) || $_POST["passwordNew"] != $_POST["passwordRepeat"]) && isset($_POST["checkPassChange"])){
			$passwordRepeatErr = "New passwords should match";
			$formValid = false;
			if(empty($_POST["passwordRepeat"])){
				$passwordRepeatErr = "New password repeat is required if option is checked";
			}
		}
		if(!empty($_POST["passwordRepeat"]) && !isset($_POST["checkPassChange"])){
			$passwordRepeatErr = "It looks like you want to change your password, please check the option";
			$formValid = false;
			// wrong format changes form to its red error display
			$passwordRepeatStyle = "red";
			// new password will also show error since it will be re-typed too
			$passwordNewStyle = "red";
			// password change check will also show error since it will be re-checked too
			$checkPassStyle = "red";
		}
		// ----------------------------------------------------------------------------- validate pic upload
		if (isset($_FILES["picName"])){
			$fileSplit = explode('.',$_FILES["picName"]["name"]);
			$fileExt = strtolower(end($fileSplit));
			$fileSize = $_FILES["picName"]["size"];
			if ($fileSize > 2097152){
				$picNameErr = "Picture upload cannot be bigger than 2MB";
				$formValid = false;
			}
			if(($fileExt != "png") && ($fileExt != "jpg") && ($fileExt != "jpeg")){
				$picNameErr = "Picture upload should be a PNG, JPG, or JPEG file";
				$formValid = false;
			}
			if ($fileSize == 0){
				$picNameErr = "Picture upload should be a valid file";
				$formValid = false;
			}
		}
		// ----------------------------------------------------------------------------- if form is not valid then display errors
		if (!$formValid){
			$errorDisplay = "block";
			// change password display to error, since it will have to be retyped
			$passwordOldStyle = "red";

			if (isset($_POST["checkPassChange"])){
				// new password will also show error since it will be re-typed too
				$passwordNewStyle = "red";
				// password repeat will also show error since it will be re-typed too
				$passwordRepeatStyle = "red";
				// password change check will also show error since it will be re-checked too
				$checkPassStyle = "red";
			}
			if (isset($_FILES["picName"])){
				// picture upload will also show error since it will be re-uploaded too
				$picNameStyle = "red";
			}
		}
		// ----------------------------------------------------------------------------- if form is valid then change profile
		else{
			if (isset($_FILES["picName"])){
				$fileLocation = $_FILES["picName"]["tmp_name"];
				$num = rand();
				$time = time();
				$picName = $num . $time . "." . $fileExt;
				move_uploaded_file($fileLocation,"images/user/".$picName);
			}
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
