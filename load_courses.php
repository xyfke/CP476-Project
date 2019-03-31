<?php
    
    function loadCourse($db, $userType, $statusType) {
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userID'];
        }
        else {
            return "";
        }

        // this is for finished sessions
        if ($statusType == 0) {
            $query = "SELECT SessionName, Timestamp From session INNERJOIN usersession ON 
            usersession.SessionID = session.SessionID WHERE Status=?";
            if ($statement = mysqli_prepare($db, $query)) {
                mysqli_stmt_bind_param($statement, 'i', $statusType);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
            }
        }
        else {
            $query = "SELECT SessionName, Timestamp From session INNERJOIN usersession ON 
            usersession.SessionID = session.SessionID WHERE Status=? and UserType=?";
            if ($statement = mysqli_prepare($db, $query)) {
                mysqli_stmt_bind_param($statement, 'ii', $statusType, $userType);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
            }
        }

        return $result;
    }


?>