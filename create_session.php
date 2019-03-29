<?php

session_start();
include 'include/functions.php';

$db = getDB();

if (isset($_POST["sessionName"])) {
    $userID = $_SESSION['userId'];
    $sessionName = $_POST["sessionName"];

    $query = "INSERT INTO sessionClass (SessionName) VALUES (?)";
    if ($statement = mysqli_prepare($db, $query)) {
		
		// insert params
		mysqli_stmt_bind_param($statement, 's', $sessionName);
		mysqli_stmt_execute($statement);
	}

    $query = "SELECT LAST_INSERT_ID() FROM sessionClass";
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

    header("Location: whiteboard.php?sessionID=".$sessionID);


}



?>