<!-- create_session.php

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

if (isset($_POST["sessionName"])) {
    $userID = $_SESSION['userId'];
    $sessionName = $_POST["sessionName"];

	$num = rand();
	$time = time();
	$sessionCode = $num . $time;

    $query = "INSERT INTO session (SessionName, SessionCode) VALUES (?, ?)";
    if ($statement = mysqli_prepare($db, $query)) {

		// insert params
		mysqli_stmt_bind_param($statement, 'ss', $sessionName, $sessionCode);
		mysqli_stmt_execute($statement);
	}

    $query = "SELECT LAST_INSERT_ID() FROM session";
    if ($statement = mysqli_prepare($db, $query)) {

		// insert params
		mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_array($result);
        $sessionID = $row[0];
	}

    $query = "INSERT INTO usersession (UserID, SessionID, UserType, Status) VALUES (?,?, 1, 1)";
    if ($statement = mysqli_prepare($db, $query)) {
		// insert params
		mysqli_stmt_bind_param($statement, 'ii', $userID, $sessionID);
		mysqli_stmt_execute($statement);
    }

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

    header("Location: whiteboard.php?sessionCode=".$sessionCode."&sessionName=".$sessionName);


}



?>
