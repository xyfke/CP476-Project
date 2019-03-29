<?php

session_start();
include 'include/functions.php';

$db = getDB();

if (isset($_GET["sessionID"])) {
    $userID = $_SESSION['userId'];
    $sessionID = $_GET["sessionID"];

    $query = "SELECT sessionID From session WHERE sessionID=?";
    if ($statement = mysqli_prepare($db, $query)) {

		// insert params
		mysqli_stmt_bind_param($statement, 'i', $sessionID);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $match = mysqli_num_rows($result);

        //echo $match;

        if ($match == 0) {
            echo json_encode(array('status' => 'fail'));
        }
        else {
            $query = "INSERT INTO usersession (UserID, SessionID, UserType, Status) VALUES (?, ?, 2, 1)";
            if ($statement = mysqli_prepare($db, $query)) {
                // insert params
                mysqli_stmt_bind_param($statement, 'ii', $userID, $sessionID);
                mysqli_stmt_execute($statement);
            }
            echo json_encode(array('status' => 'ok'));
        }

    }
    else {
        echo json_encode(array('status' => 'fail'));
    }
}



?>