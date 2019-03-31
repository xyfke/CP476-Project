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

<?php
	session_start();
	if (!isset($_SESSION['userName'])){
		header("Location: landing_login_signup.php");
    }
    
    include "include/functions.php";
    include "load_courses.php";

    $db = getDB();

?>

<html lang="en">
    <header>
        <title>Home Page</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link rel="stylesheet" type="text/css" href="./css/styles2.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
        <h1><?php echo "Hello " . $_SESSION['firstName'] . "!"?> </h1>

        <div class="container">
            <div class="row">
                <div class="division col-md-4">
                    <h2 class="sessionHeading">Session in Progress</h2>
                        <?php
                            $inProg = loadCourse($db, 2, 1, $_SESSION['userId']);

                            while ($row = mysqli_fetch_array($inProg)) {
                                $params = "whiteboard.php?sessionCode=".urlencode($row[2])."&sessionName=".urlencode($row[0]);
                                $phpdate = strtotime( $row[1] );
                                $date = date( 'M-d', $phpdate );
                        ?>
                        <div class="sessionClass">
                        <div class="title"><a href='<?php echo $params; ?>'><?php echo $row[0]; ?></a></div>
                        <div class="date"><?php echo $date; ?></div>
                        <br style="clear:both;">
                        </div>
                        <?php 
                            }
                        ?>
                </div>
                <div class="division col-md-4">
                    <h2 class="sessionHeading">Session Taught</h2>
                    <?php
                        $inTeach = loadCourse($db, 1, 1, $_SESSION['userId']);

                        while ($row = mysqli_fetch_array($inTeach)) {
                            $params = "whiteboard.php?sessionCode=".urlencode($row[2])."&sessionName=".urlencode($row[0]);
                            $phpdate = strtotime( $row[1] );
                            $date = date( 'M-d', $phpdate );
                    ?>
                    <div class="sessionClass">
                    <div class="title"><a href='<?php echo $params; ?>'><?php echo $row[0]; ?></a></div>
                    <div class="date"><?php echo $date; ?></div>
                    <br style="clear:both;">
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <div class="division col-md-4">
                    <h2 class="sessionHeading">Session Completed</h2>
                    <?php
                        $inCom = loadCourse($db, 1, 0, $_SESSION['userId']);

                        while ($row = mysqli_fetch_array($inCom)) {
                            $params = "whiteboard.php?sessionCode=".urlencode($row[2])."&sessionName=".urlencode($row[0]);
                            $phpdate = strtotime( $row[1] );
                            $date = date( 'M-d', $phpdate );
                    ?>
                    <div class="sessionClass">
                    <div class="title"><a href='<?php echo $params; ?>'><?php echo $row[0]; ?></a></div>
                    <div class="date"><?php echo $date; ?></div>
                    <br style="clear:both;">
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
        


        

        

        <?php include("include/footer.php") ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
