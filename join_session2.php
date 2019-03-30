<?php

//echo json_encode(array("status"=>"ok"));
include 'include/functions.php';

session_start();

$db = getDB();


if (isset($_GET["sessionCode"])) {
    $userID = $_SESSION['userId'];
    $sessionID = $_GET["sessionCode"];

    $query = "SELECT * From session WHERE sessionCode=?";
    if ($statement = mysqli_prepare($db, $query)) {

		// insert params
		mysqli_stmt_bind_param($statement, 'i', $sessionID);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_array($result);

        if($row){
            $query = "INSERT INTO usersession (UserID, SessionID, UserType, Status) VALUES (?, ?, 2, 1)";
            if ($statement = mysqli_prepare($db, $query)) {
                // insert params
                mysqli_stmt_bind_param($statement, 'ii', $userID, $sessionID);
                mysqli_stmt_execute($statement);
            }
            $returns = array('status' => 'ok');
        }
		else {
            $returns = array('status' => 'fail');
        }

    }
    else {
        $returns = array('status' => 'fail');
    }
}
else {
    $returns = array('status' => 'fail');
}

echo json_encode($returns);



?>
