<?php

    include 'include/functions.php';

    session_start();

    $db = getDB();

    if (isset($_GET['retrieve'])) {
        $sessionId = $_SESSION['classID'];
        
        $sql = "SELECT point.LineID, PointX, PointY FROM point INNER JOIN line ON line.LineID = point.LineID 
                WHERE SessionID = ? ORDER BY LineID, PointID";
        if ($statement = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($statement, 'i', $sessionId);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
    
            echo json_encode($rows);
        }
        else {
            echo json_encode(array('status' => 'fail'));
        }

        
        

    }
    else if (isset($_GET['x']) && isset($_GET['y'])) {

        $sessionId = $_SESSION['classID'];
        $x = $_GET['x'];
        $y = $_GET['y'];
        $lineID = 0;

        // if no line ID then it means new line, create line
        if (!isset($_GET['lineId'])) {
            // create new line
            $sql = "INSERT INTO line (SessionID) VALUES (?)";
            if ($statement = mysqli_prepare($db, $sql)) {
                mysqli_stmt_bind_param($statement, 'i', $sessionId);
                mysqli_stmt_execute($statement);
                $lineID = mysqli_insert_id($db);
            }
            else {
                echo json_encode(array('status' => 'fail'));
            }

        }
        else {
            $lineID = $_GET['lineId'];
        }

        if ($lineID != 0) {
            $sql = "INSERT INTO point (LineID, PointX, PointY) VALUES (?, ?, ?)";
            if ($statement = mysqli_prepare($db, $sql)) {
                mysqli_stmt_bind_param($statement, 'iii', $lineID, $x, $y);
                mysqli_stmt_execute($statement);
            }

            echo json_encode(array('status' => 'ok', 'lineId' => $lineID));
        }
    } 
    else {
        echo json_encode(array('status' => 'fail'));
    }




?>