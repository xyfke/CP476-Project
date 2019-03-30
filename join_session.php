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

		    header("Location: whiteboard.php?sessionCode=".$sessionCode."&sessionName=".$sessionName);
        }
		else {
            echo json_encode(array('status' => 'fail'));
        }

    }
    else {
        echo json_encode(array('status' => 'fail'));
    }

}



?>
