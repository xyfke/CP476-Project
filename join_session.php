<?php

session_start();
include 'include/functions.php';

$db = getDB();

if (isset($_GET["sessionCode"])) {
    $userID = $_SESSION['userId'];
    $sessionCode = $_GET["sessionCode"];

	date_default_timezone_set('America/New_York');
	$timeRn = date("g:i A");
	// -------------------------------------------- initialize chat message as already a member
	$chatMsg = "'s attention is back";

	// ----------------------------------------------------------- find the current session from database
    $query = "SELECT * From session WHERE sessionCode=?";
    if ($statement = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($statement, 'i', $sessionCode);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_array($result);

		// ----------------------------------------- if code matches the class code
        if($row){
			$sessionID = $row[0];
			$sessionName = $row[1];
			// --------------------------------------------------------------------- check if user is already a member of the class
			$query = "SELECT * FROM chat WHERE SessionID = ? AND UserID = ?";
			if ($statement = mysqli_prepare($db, $query)) {
				mysqli_stmt_bind_param($statement, 'ii', $sessionID, $userID);
				mysqli_stmt_execute($statement);

				$result = mysqli_stmt_get_result($statement);
				$row2 = mysqli_fetch_array($result);
				// --------------------------------------------------- if user is not a member, add user to the session
				if(!$row2){
		            $query = "INSERT INTO usersession (UserID, SessionID, UserType, Status) VALUES (?, ?, 2, 1)";
		            if ($statement = mysqli_prepare($db, $query)) {
		                // insert params
		                mysqli_stmt_bind_param($statement, 'ii', $userID, $sessionID);
		                mysqli_stmt_execute($statement);
		            }
					// ----------------------------------------------------------------------------------- create chat session log for user
					$num = rand();
					$time = time();
					$logLocation = $num . $time .".html";
					$query = "INSERT INTO chat (UserID, SessionID, LogLocation) VALUES (?,?,?)";
					if ($statement = mysqli_prepare($db, $query)) {
						// insert params
						mysqli_stmt_bind_param($statement, 'iis', $userID, $sessionID, $logLocation);
						mysqli_stmt_execute($statement);
					}
					//---------------------------------------------- remember user's ids
					$_SESSION['classID'] = $sessionID;
					$_SESSION['logLocation'] = $logLocation;
					//---------------------------------------------- change nav bar display for joined session
					$sessStatHome = "sessTwo";
					$sessStatClass = "sessThree";
					$_SESSION['sessStatHome'] = $sessStatHome;
					$_SESSION['sessStatClass'] = $sessStatClass;
					// -------------------------------------------- message for chat is about joining
					$chatMsg = ' has joined the class';
				}
			}

			if(!isset($logLocation)){
				$logLocation = $_SESSION['logLocation'];
			}

			// ----------------------------------------------- update chat log with session join message
			$fp = fopen("chats/".$logLocation, 'a');
			fwrite($fp,'<div class="container" style="text-align:center">'
					   .'<div class="row pl-3" style="font-size:0.8em;font-weight:bold"><i>'.$_SESSION['userName']. $chatMsg.'</i></div>'
					   .'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div></div>'
					   .'<div style="clear:both"></div>');
			fclose($fp);
			// ----------------------------------------------- alert the other user in session that this user has joined
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
							   .'<div class="row pl-3" style="font-size:0.8em;font-weight:bold"><i>'.$_SESSION['userName']. $chatMsg.'</i></div>'
							   .'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div></div>'
							   .'<div style="clear:both"></div>');
				    fclose($fp);
				}
			}

			// ---------------------------------------------------------------------------------------- display the classroom
		    echo json_encode(array('status' => 'ok', 'sessionCode' => $sessionCode, "sessionName" => $sessionName));
        }
		else {
            echo json_encode(array('status' => 'fail'));
        }

    }
    else {
        echo json_encode(array('status' => 'fail'));
    }

}
else {
	echo json_encode(array('status' => 'fail'));
}



?>
