<!-- whiteboard.php

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

	if (isset($_GET['sessionCode'])) {
		$_SESSION['sessionCode'] = $_GET['sessionCode'];
	}
	if (isset($_GET['sessionName'])) {
		$_SESSION['sessionName'] = $_GET['sessionName'];
	}

?>

<html lang="en">
    <header>
        <title>White Board</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link rel="stylesheet" type="text/css" href="./css/styles2.css">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="./js/script_whiteboard.js"></script>
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<!--<script type="text/javascript" src="./js/board.js"></script> -->
    </header>
    <!--
    <div class="topHeader">
        <a href="./landing_login_signup.html">Logout</a>
        <a href="./profile.html">Profile</a>
        <a href="./landing_home.html">Home</a>
    </div>
  -->
  <body class="m-auto">
    <?php include("include/header_session.php") ?>
	<?php 	include "processChat.php" ?>
	<div class="container" style="width:980px">
	    <h1><?php echo "Class Name: ".$_SESSION['sessionName']; ?></h1>
		<div class="mb-1" style="color:#dfd7c3"> <?php echo "Code: ".$_SESSION['sessionCode']; ?></div>

	    <div class="board" style="background-color:#f6f7f7">
	        <h3>White Board:</h3>
	        <canvas class="drawSection" id="board" width="585" height="450" style="width:585;height:450;background-color:white"></canvas>
			<!--<div id="coordinates"></div>-->
			<div class="toolbar mt-2 p-1 justify-content-center align-items-center d-flex">
				<form>
					<div class="mr-2 mt-3 btn btn-light btn-sm active" style="float:left;" id="pen">
						<i class="fa fa-pen"></i>
					</div>
					<div class="mr-2 mt-3 btn btn-light btn-sm" style="float:left;" id="eraser">
						<i class="fa fa-eraser"></i>
					</div>
					<div class="mr-3 mt-3" style="float:left;">
						Color: 
						<input type="color" id="color">
					</div>	
					<div class="mr-3 mt-3" style="float:left;">
						Width:
						<input type="number" min="1" max="10" value="1" id="width">
					</div>
					<div class="mr-2 mt-3 btn btn-light btn-sm" style="float:left;" id="undo">
						<i class="fa fa-undo"></i>
					</div>
					<div class="mr-2 mt-3 btn btn-light btn-sm" style="float:left;" id="redo">
						<i class="fa fa-redo"></i>
					</div>
				</form>
			</div>
	    </div>

		<div id="logFile" style="display: none;" class="<?php echo "chats/".$_SESSION['logLocation'] ?>"></div>
	    <div class="chatWindow" style="background-color:#f6f7f7">
	        <h3 class="mb-1" style="background-color:#f6f7f7">Classroom Chat:</h3>
	        <div class="display container" id="chatBox" style="overflow:scroll;background-color:white">
				<?php $logFile = $_SESSION['logLocation'];
					if(file_exists("chats/".$logFile) && filesize("chats/".$logFile) > 0){
						$handle = fopen("chats/".$logFile, "r");
						$contents = fread($handle, filesize("chats/".$logFile));
						fclose($handle);
						echo $contents;
				}?>
			</div>
			<form name="message" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	        	<textarea name="userMsg" style="resize: none;" class="enter" id="userMsg"></textarea>
				<input class="mr-1 subButtons" style="float:right" name="submitMsg" type="submit" id="submitMsg" value="SEND" />
			</form>
	    </div>

	    <br style="clear : both;">


	</div>

    <?php include("include/footer.php") ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
