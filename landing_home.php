<!-- landing_home.php

	CP476 Final Project

	Author 1:  David Moreno-Bautista
	ID 1:      151925580
	Email 1:   more5580@mylaurier.ca

	Author 2:  Xiang Ke
	ID 2:	   150617130
	Email 2:   kexx7130@mylaurier.ca

	Version  2019-03-02
	-->

<html lang="en">
    <header>
        <title>Home Page</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link rel="stylesheet" type="text/css" href="./css/styles2.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </header>
    <body>
        <!--
        <div class="topHeader">
            <a href="./landing_login_signup.html">Logout</a>
            <a href="./profile.html">Profile</a>
            <a href="./landing_home.html">Home</a>
        </div>
      -->

        <?php include("include/header.php") ?>
        <h1>Hello David!</h1>

        <div class="division">
            <h2 class="sessionHeading">Session in Progress</h2>
            <div class="sessionClass">
                <div class="title"><a href="./whiteboard.php">Introduction to Programming & Introduction League of Legend</a></div>
                <div class="date">Feb 22</div>
                <br style="clear:both;">
            </div>
            <div class="sessionClass">
              <div class="title"><a href="./whiteboard.php">Introduction to Fortnite</a></div>
              <div class="date">Feb 22</div>
              <br style="clear:both;">
            </div>
        </div>


        <div class="division">
            <h2 class="sessionHeading">Session Taught</h2>
        </div>

        <div class="division">
            <h2 class="sessionHeading">Session Completed</h2>
        </div>

        <?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>