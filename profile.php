<!-- profile.php

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
?>

<html lang="en">
    <header>
        <title>My Profile</title>
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

		<div style="width:980px">
			<h1>My Profile</h1>
	        <div class="leftPortion">
	            <table>
	                <tr>
	                    <td>Username: </td>
	                    <td>hello123</td>
	                </tr>
	                <tr>
	                    <td>First Name: </td>
	                    <td>David</td>
	                </tr>
	                <tr>
	                    <td>Last Name: </td>
	                    <td>Moreno</td>
	                </tr>
	                <tr>
	                    <td>Email: </td>
	                    <td>david@gmail.com</td>
	                </tr>
	                <tr>
	                    <td>Password: </td>
	                    <td>*********</td>
	                </tr>
	                <tr>
	                    <td>Short Bio: </td>
	                    <td>My Name is David. I like to play Fortnite! I am a CS student a Laurier.</td>
	                </tr>
	            </table>
	        </div>

	        <div class="rightPortion">
	            <table>
	                <tr>
	                    <td>Current Profile Picture:</td>
	                </tr>
	                <tr>
	                    <td><img src="./images/image9.jpg"></td>
	                </tr>
	            </table>
	        </div>
			<br style="clear:both;">
	        <br>
	        <button onclick="window.location.href='./profile_edit.php'" class="subButtons">Edit Profile</button>
		</div>

        <?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
