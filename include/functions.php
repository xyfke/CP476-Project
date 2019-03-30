<?php
include 'include/config.php';
/*
Defines functions to connect to the Database, retrieve the result and
return them.
*/

function getDB()
{
	// connect to the DB and returns a reference to the DB
	// Connect to MySQL
	$db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	// Error checking
	if (!$db) {
		print "Error - Could not connect to MySQL";
		exit;
	}
	$error = mysqli_connect_error();
	if ($error != null) {
		$output = "<p>Unable to connet to database</p>". $error;
		exit($output);
	}
	return $db;
}

function runQuery($db, $query) {
	// takes a reference to the DB and a query and returns the results of running the query on the database
	$result = mysqli_query($db, $query);
	if (!$result) {
	    print "Error - the query could not be executed";
	    $error = mysqli_error();
	    print "<p>" . $error . "</p>";
	    exit;
	}
	return $result;
}

function runBindedQuery($param1, $param2, $param3, $type, $db, $query){
    if ($statement = mysqli_prepare($db, $query)) {
        // bind parameters s - string, b - blob, i - int, etc
		if ($param2 == -1){
			// if there's only one parameter
	        mysqli_stmt_bind_param($statement, $type, $param1);
		}
		else if ($param3 == -1){
			// if there's only two parameters
	        mysqli_stmt_bind_param($statement, $type, $param1, $param2);
		}
		else{
			// if there's three parameters
			mysqli_stmt_bind_param($statement, $type, $param1, $param2, $param3);
		}
        // execute query
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        return $result;
    }
}

function runBindedQueryLong($param1, $param2, $param3, $param4, $param5, $param6, $param7, $type, $db, $query){
    if ($statement = mysqli_prepare($db, $query)) {
        // bind parameters s - string, b - blob, i - int, etc
		if ($param6 == -1){
			// if there's only five parameters
	        mysqli_stmt_bind_param($statement, $type, $param1, $param2, $param3, $param4, $param5);
		}
		else if ($param7 == -1){
			// if there's only six parameters
	        mysqli_stmt_bind_param($statement, $type, $param1, $param2, $param3, $param4, $param5, $param6);
		}
		else{
			// if there's seven parameters
			mysqli_stmt_bind_param($statement, $type, $param1, $param2, $param3, $param4, $param5, $param6, $param7);
		}
        // execute query
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        return $result;
    }
}

?>
