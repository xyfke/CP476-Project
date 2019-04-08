<!-- help.php

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

<html lang = "en">
	<head>
		<title> Help </title>
		<meta charset = "utf-8" />
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="css/styles2.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script type="text/javascript" src="./js/script_header.js"></script>
	</head>

	<body class="m-auto">
		<?php include("include/header.php") ?>

		<h1>HALPPPPPPPPPPPP PAGE</h1>
		<h2>How do I create or join a classroom session?</h2>
		<div class="pl-3 ml-3 border border-primary" style="max-width:88%">
			<p>In the navigation bar, click on CLASSROOM to either create or
				join a learning session.
			</p>
			<img src="images/help/classroom.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both" class="pt-2">If creating one, enter the name that
			you wish to give it and click Create; if joining, enter the code for the
			session you wish to join.
			</p>
			<img src="images/help/session.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both" class="pt-2">Once a session is created, you can see the code generated underneath
				the title. This is the code that anyone else can enter to join.
			</p>
			<img src="images/help/code.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both"></p>
		</div>

		<h2>What can I do during a classroom session?</h2>
		<div class="pl-3 ml-3 border border-primary" style="max-width:88%">
			<p>The classroom consists of a white board and a chat. Pick a color, pick a width, and draw! The toolbar also includes an undo and redo button.
				To chat, enter your message and click Send. If you wish to browse the website during class, don't worry, just click where you want to
				navigate to at the top (navigation bar) and you'll be able to come back to class at any time. You can even log out without affecting the class!
			</p>
			<img src="images/help/whiteboard.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both"></p>
		</div>

		<h2>How do I come back to class?</h2>
		<div class="pl-3 ml-3 border border-primary" style="max-width:88%">
			<p>To go back to a previous session, first navigate to your home page by clicking the logo!
			</p>
			<img src="images/help/home.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both" class="pt-2">Once you're there, you will be greeted with a history of all your classroom sessions: the ones you're currently
				attending, currently teaching, and a list of previously terminated sessions. You are able to click any of the currently attending or teaching
				sessions to return to class! Another way to go back to a session from anywhere in the website is to click on CLASSROOM at the top and enter
				the code in the Join Class option.
			</p>
			<img src="images/help/history.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both"></p>
		</div>

		<h2>How do I end a classroom session?</h2>
		<div class="pl-3 ml-3 border border-primary" style="max-width:88%">
			<p>If you are the creator of the class, you can end the class at any time by clicking on END CLASS at the top of the classroom page. If you did not
				create the class, you will not have this option.
			</p>
			<img src="images/help/end_class.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both"></p>
		</div>

		<h2>How can I see or change my personal information?</h2>
		<div class="pl-3 ml-3 border border-primary" style="max-width:88%">
			<p>You have a profile page! To view it, click on PROFILE in the navigation bar at the top.
			</p>
			<img src="images/help/profile.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both" class="pt-2"> If you wish to change your information, click on Edit Profile at the bottom of the page. You can tell us more
				about yourself with a short bio, and even upload a profile picture. The only thing you cannot change is your username; members of the site
				only know you by your username, so we don't want to confuse them!
			</p>
			<img src="images/help/edit_profile.jpg" alt="Signup Image" style="width:60%;" class="col-12"/>
			<p style="clear:both"></p>
		</div>

		<h2 style="clear:both">Contact Information</h2>
		<div class="pl-3 ml-3 border border-primary" style="max-width:88%">
			<p>If you need further assistance. Please contact <a href="mailto:more5580@mylaurier.ca">David</a> for quick response <a href="mailto:kexx7130@mylaurier.ca"><strike>Fafa</strike></a> (she's nicer. but she afks too much).</p>
			<p style="clear:both"></p>
		</div>

		<?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
