<?php

    include 'include/functions.php';

    session_start();

    $db = getDB();

    if (isset($_GET['lineId']) && isset($_GET['transparent'])) {

        $lineId = $_GET['lineId'];
        $trans = $_GET['transparent'];
        $sql = "UPDATE line SET Transparent = ? WHERE LineID = ?";

        if ($statement = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($statement, 'di', $trans ,$lineId);
            mysqli_stmt_execute($statement);

            echo json_encode(array('status' => 'ok'));
        }
        else {
            echo json_encode(array('status' => 'fail'));
        }


        // PLO : Need for later
        /*$lineId = $_GET['lineId'];
        $sql = "SELECT point.LineID, PointX, PointY, Color, Width FROM point INNER JOIN 
        line ON line.LineID = point.LineID WHERE point.LineID = ? ORDER BY PointID";

        if ($statement = mysqli_prepare($db, $sql)) {
            
            mysqli_stmt_bind_param($statement, 'i', $lineId);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            $rows = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
    
            echo json_encode($rows);
        }
        else {
            echo json_encode(array('status' => 'fail'));
        }*/
    }
    // PLO: Need for later
    else if (isset($_GET['lineId']) && isset($_GET['delete'])) {
        $lineId = $_GET['lineId'];

        $sql = "DELETE FROM line WHERE LineID=?";
        if ($statement = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($statement, 'i', $lineId);
            mysqli_stmt_execute($statement);

            $sql = "DELETE FROM point WHERE LineID=?";
            if ($statement = mysqli_prepare($db, $sql)) {
                mysqli_stmt_bind_param($statement, 'i', $lineId);
                mysqli_stmt_execute($statement);
                echo json_encode(array('status' => 'ok'));
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