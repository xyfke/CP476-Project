<!-- processChat.php

	CP476 Final Project

	Author 1:  David Moreno-Bautista
	ID 1:      151925580
	Email 1:   more5580@mylaurier.ca

	Author 2:  Xiang Ke
	ID 2:	   150617130
	Email 2:   kexx7130@mylaurier.ca

	Version  2019-03-02
	-->

<?php

include 'include/functions.php';
$db = getDB();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitMsg"]) && isset($_POST["userMsg"])) {
	$text = $_POST['userMsg'];
	date_default_timezone_set('America/New_York');
	$timeRn = date("g:i A");

	//--------------------------------------------------------------------------------------------------------------fill own chatlog
	$query = "SELECT * FROM chat WHERE SessionID = ? AND UserID = ?";
	if ($statement = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($statement, 'ii', $_SESSION['classID'], $_SESSION['userId']);
		mysqli_stmt_execute($statement);

		$result = mysqli_stmt_get_result($statement);
		$row = mysqli_fetch_array($result);
		$logName = $row[3];

		$fp = fopen("chats/".$logName, 'a');
		fwrite($fp,
			   '<div class="row pl-1 pr-1" style="float:right">
				   <div style="font-weight:bold;height:50px" class="pt-3 pr-1 ml-1">'.$_SESSION['userName'].'</div>'
			   	   .'<div style="width:50px;height:50px">
				       <img src="./images/user/'.$_SESSION['picName'].'" style="max-width:100%;max-height:100%">
				   </div>
			    </div>
				<div class="row" style="background-color:#ddfafa;clear:both;">'
				.'<div class="col-md-5"></div>'
				.'<div class="col-md-7">'
					.htmlspecialchars($text).'</div></div>'
				.'<div class="row" style="clear:both;">'
					.'<div class="col-md-5"></div>'
					.'<div class="col-md-7">'
						.'<div style="font-size:0.8em;float:left"><i>'.$timeRn.'</i></div></div></div>'
				.'<div style="clear:both"></div>');
		fclose($fp);
	}

	//--------------------------------------------------------------------------------------------------------------fill others chatlog
	$query = "SELECT * FROM chat WHERE SessionID = ? AND UserID != ?";
	if ($statement = mysqli_prepare($db, $query)) {
		mysqli_stmt_bind_param($statement, 'ii', $_SESSION['classID'], $_SESSION['userId']);
		mysqli_stmt_execute($statement);

		$result = mysqli_stmt_get_result($statement);
		$row = mysqli_fetch_array($result);
		if($row){
			$logName = $row[3];

			$fp = fopen("chats/".$logName, 'a');
			fwrite($fp,
				   '<div class="row pl-1 pr-1">'
				   	   .'<div style="width:50px;height:50px">
					       <img src="./images/user/'.$_SESSION['picName'].'" style="max-width:100%;max-height:100%">
					   </div>'
					   .'<div style="font-weight:bold;height:50px" class="pt-3 pr-1 ml-1">'.$_SESSION['userName'].'</div>'
				    .'</div>
					<div class="row">'
					.'<div class="col-md-8">'
						.htmlspecialchars($text).'</div>'
					.'<div class="col-md-4"></div></div>'
					.'<div class="row pl-3" style="font-size:0.8em"><i>'.$timeRn.'</i></div>'
					.'<div style="clear:both"></div>');
		    fclose($fp);
		}
	}
}
?>
