<!-- endClass.php

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
	$chatMsg = ' has left the classroom';

	// ------------------------------------------------------------------------------- change the class status to ended if owner ends class
	$query = "SELECT * FROM usersession WHERE SessionID = ? AND UserID = ?";
	if ($statement = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($statement, 'ii', $_SESSION['classID'], $_SESSION['userId']);
		mysqli_stmt_execute($statement);
		$result = mysqli_stmt_get_result($statement);
		$row = mysqli_fetch_array($result);
		// ------------------------------------------------ checking it is the owner
		if($row && $row[2] == 1){
			$query = "UPDATE usersession SET Status = ? WHERE SessionID = ? AND UserID = ?";
			runBindedQuery(0, $_SESSION['classID'], $_SESSION['userId'], 'iii', $db, $query);
			// ------------------------------------------------------------------------------------ update chat message
			$chatMsg = ' has ended class';
			// ------------------------------------------------------------------------------- change the class status for the student too
			$query = "SELECT * FROM usersession WHERE SessionID = ? AND UserID != ?";
			if ($statement = mysqli_prepare($db, $query)) {
				mysqli_stmt_bind_param($statement, 'ii', $_SESSION['classID'], $_SESSION['userId']);
				mysqli_stmt_execute($statement);
				$result = mysqli_stmt_get_result($statement);
				$row = mysqli_fetch_array($result);
				if($row){
					$query = "UPDATE usersession SET Status = ? WHERE SessionID = ? AND UserID != ?";
					runBindedQuery(0, $_SESSION['classID'], $_SESSION['userId'], 'iii', $db, $query);
				}
			}
		}
	}

	date_default_timezone_set('America/New_York');
	$timeRn = date("g:i A");

	// ----------------------------------------------- update chat log with session left message
	$fp = fopen("chats/".$_SESSION['logLocation'], 'a');
	fwrite($fp,'<div class="container" style="text-align:center">'
			   .'<div class="row pl-3" style="font-size:0.8em;font-weight:bold"><i>'.$_SESSION['userName'].$chatMsg.'</i></div>'
			   .'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div></div>'
			   .'<div style="clear:both"></div>');
	fclose($fp);
	// ----------------------------------------------- alert the other user in session that this user has left
	$query = "SELECT * FROM chat WHERE SessionID = ? AND UserID != ?";
	if ($statement = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($statement, 'ii', $_SESSION['classID'], $_SESSION['userId']);
		mysqli_stmt_execute($statement);

		$result = mysqli_stmt_get_result($statement);
		$row = mysqli_fetch_array($result);
		if($row){
			$logName = $row[3];

			$fp = fopen("chats/".$logName, 'a');
			fwrite($fp,'<div class="container" style="text-align:center">'
					   .'<div class="row pl-3" style="font-size:0.8em;font-weight:bold"><i>'.$_SESSION['userName'].$chatMsg.'</i></div>'
					   .'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div></div>'
					   .'<div style="clear:both"></div>');
			fclose($fp);
		}
	}

	//---------------------------------------------- change nav bar display for no joined session
	$sessStatHome = "sessZero";
	$sessStatClass = "sessOne";
	$_SESSION['sessStatHome'] = $sessStatHome;
	$_SESSION['sessStatClass'] = $sessStatClass;
	header("Location: landing_home.php");
?>
