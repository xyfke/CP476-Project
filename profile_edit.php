<!-- profile_edit.php

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

	if (!isset($_SESSION['userName'])){
		header("Location: landing_login_signup.php");
	}

	include 'profile_edit_process.php';

?>

<html lang="en">
    <header>
        <title>Edit My Profile</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link rel="stylesheet" type="text/css" href="./css/styles2.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script type="text/javascript" src="./js/script_header.js"></script>
	</header>
    <body class="m-auto">
        <!--
        <div class="topHeader">
            <a href="./landing_login_signup.html">Logout</a>
            <a href="./profile.html">Profile</a>
            <a href="./landing_home.html">Home</a>
        </div>
      -->
      <?php include("include/header.php") ?>

        <form style="width:980px" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<h1>Edit My Profile</h1>
            <div class="leftPortion">
                <table>
                    <tr>
                        <td>Username: </td>
                        <td><?php echo $userName?></td>
                    </tr>
                    <tr>
                        <td style="color:<?php echo $firstNameStyle?>">First Name: </td>
                        <td><input type="text" name="firstName" value="<?php echo $firstName?>" class="roundTextBox"></td>
                    </tr>
                    <tr>
                        <td style="color:<?php echo $lastNameStyle?>">Last Name: </td>
                        <td><input type="text" name="lastName" value="<?php echo $lastName?>" class="roundTextBox"></td>
                    </tr>
                    <tr>
                        <td style="color:<?php echo $emailStyle?>">Email: </td>
                        <td><input type="text" name="email" value="<?php echo $email?>" class="roundTextBox"></td>
                    </tr>
                    <tr>
                        <td style="color:<?php echo $shortBioStyle?>">Short Bio: </td>
                        <td><textarea name="shortBio" rows="10" cols="30" class="roundTextBox"><?php echo $shortBio?></textarea></td>
                    </tr>
					<tr>
                        <td style="color:<?php echo $passwordOldStyle?>">Password: </td>
                        <td><input type="password" name="passwordOld" class="roundTextBox"></td>
                    </tr>
                    <tr>
                        <td style="color:<?php echo $passwordNewStyle?>">Enter New Password: </td>
                        <td><input type="password" name="passwordNew" placeholder="(only if changing)" class="roundTextBox"></td>
                    </tr>
                    <tr>
                        <td style="color:<?php echo $passwordRepeatStyle?>">New Password: </td>
                        <td><input type="password" name="passwordRepeat" placeholder="(re-enter if changed)" class="roundTextBox"></td>
                    </tr>
                </table>
            </div>

            <div class="rightPortion">
                <table>
                    <tr>
                        <td style="color:<?php echo $picNameStyle?>">Current Profile Picture:</td>
                    </tr>
                    <tr>
                        <td><img src="./images/user/<?php echo $picName?>.png"></td>
                    </tr>
                    <tr>
                        <td><input name="picName" type="file"></td>
                    </tr>
                </table>
            </div>

            <br style="clear:both;">
            <br>

	        <div class="checkboxText" style="color:<?php echo $checkPassStyle?>"><input name="checkPassChange" type="checkbox" class="checkbox">I changed my password</div>
	        <br>
	        <button type="submit" class="subButtons">Done</button>
		</form>
		<div style="color:red; display: <?php echo $errorDisplay ?>">
			<?php if ($userNameErr != ""){echo $userNameErr;echo "<br>";}?>
			<?php if ($firstNameErr != ""){echo $firstNameErr;echo "<br>";}?>
			<?php if ($lastNameErr != ""){echo $lastNameErr;echo "<br>";}?>
			<?php if ($emailErr != ""){echo $emailErr;echo "<br>";}?>
			<?php if ($passwordOldErr != ""){echo $passwordOldErr;echo "<br>";}?>
			<?php if ($passwordNewErr != ""){echo $passwordNewErr;echo "<br>";}?>
			<?php if ($passwordRepeatErr != ""){echo $passwordRepeatErr;echo "<br>";}?>
			<?php if ($shortBioErr != ""){echo $shortBioErr;echo "<br>";}?>
			<?php if ($picNameErr != ""){echo $picNameErr;echo "<br>";}?>
		</div>

        <?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
