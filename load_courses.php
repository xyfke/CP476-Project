<?php
    
    function loadCourse($db, $userType, $statusType, $userId) {

        // this is for finished sessions
        if ($statusType == 0) {
            $query = "SELECT SessionName, Timestamp, SessionCode From session INNER JOIN usersession ON 
            usersession.SessionID = session.SessionID WHERE Status=? and UserID=?";
            if ($statement = mysqli_prepare($db, $query)) {
                mysqli_stmt_bind_param($statement, 'ii', $statusType, $userId);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                return $result;
            }
        }
        else {
            $query = "SELECT SessionName, Timestamp, SessionCode From session INNER JOIN usersession ON 
            usersession.SessionID = session.SessionID WHERE Status=? and UserType=? and UserID=?";
            if ($statement = mysqli_prepare($db, $query)) {
                mysqli_stmt_bind_param($statement, 'iii', $statusType, $userType, $userId);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                return $result;
            }
        }

        return 7;

        
    }


?>