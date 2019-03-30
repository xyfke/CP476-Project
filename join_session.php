<?php

session_start();
include 'include/functions.php';

$db = getDB();

if (isset($_POST["sessionCode"])) {
    $userID = $_SESSION['userId'];
    $sessionCode = $_POST["sessionCode"];

    $query = "SELECT * From session WHERE sessionCode=?";
    if ($statement = mysqli_prepare($db, $query)) {

		// insert params
		mysqli_stmt_bind_param($statement, 'i', $sessionCode);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_array($result);

        if($row){
			$sessionID = $row[0];
			$sessionName = $row[1];
            $query = "INSERT INTO usersession (UserID, SessionID, UserType, Status) VALUES (?, ?, 2, 1)";
            if ($statement = mysqli_prepare($db, $query)) {
                // insert params
                mysqli_stmt_bind_param($statement, 'ii', $userID, $sessionID);
                mysqli_stmt_execute($statement);
            }
            echo json_encode(array('status' => 'ok'));
			// ------------------------------------------------------------------------------------------------- create chat session logs
			$num = rand();
			$time = time();
			$logLocation = $num . $time .".html";
			$query = "INSERT INTO chat (UserID, SessionID, LogLocation) VALUES (?,?,?)";
			if ($statement = mysqli_prepare($db, $query)) {
				// insert params
				mysqli_stmt_bind_param($statement, 'iis', $userID, $sessionID, $logLocation);
				mysqli_stmt_execute($statement);
			}

			$_SESSION['classID'] = $sessionID;
			$_SESSION['logLocation'] = $logLocation;
			$sessStatHome = "sessOne";
			$sessStatClass = "sessThree";
			$_SESSION['sessStatHome'] = $sessStatHome;
			$_SESSION['sessStatClass'] = $sessStatClass;

			date_default_timezone_set('America/New_York');
			$timeRn = date("g:i A");
			$query = "SELECT * FROM chat WHERE SessionID = ? AND UserID != ?";

			$fp = fopen("chats/".$logLocation, 'a');
			fwrite($fp,'<div class="container" style="text-align:center">'
					   .'<div class="row pl-3" style="font-size:0.8em;font-weight:bold"><i>'.$_SESSION['userName'].' has joined the chat</i></div>'
					   .'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div></div>'
					   .'<div style="clear:both"></div>');
			fclose($fp);

			if ($statement = mysqli_prepare($db, $query)) {
				mysqli_stmt_bind_param($statement, 'ii', $_SESSION['classID'], $_SESSION['userId']);
				mysqli_stmt_execute($statement);

				$result = mysqli_stmt_get_result($statement);
				$row = mysqli_fetch_array($result);
				if($row){
					$logName = $row[3];

					$fp = fopen("chats/".$logName, 'a');
					fwrite($fp,'<div class="container" style="text-align:center">'
							   .'<div class="row pl-3" style="font-size:0.8em;font-weight:bold"><i>'.$_SESSION['userName'].' has joined the chat</i></div>'
							   .'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div></div>'
							   .'<div style="clear:both"></div>');
				    fclose($fp);
				}
			}

		    header("Location: whiteboard.php?sessionCode=".$sessionCode."&sessionName=".$sessionName);
        }
		else {
            echo json_encode(array('status' => 'fail'));
			header("Location: landing_home.php");
        }

    }
    else {
        echo json_encode(array('status' => 'fail'));
		header("Location: landing_home.php");
    }

}



?>
