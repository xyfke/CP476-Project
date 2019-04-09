<?php

    include 'include/functions.php';

    session_start();

    $db = getDB();

    // For undo, by changing the lines to transparent
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
    }
    // For removing line from database when reloading or closing the page
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