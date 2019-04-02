<!-- header_session.php

	CP476 Final Project

	Author 1:  David Moreno-Bautista
	ID 1:      151925580
	Email 1:   more5580@mylaurier.ca

	Author 2:  Xiang Ke
	ID 2:	   150617130
	Email 2:   kexx7130@mylaurier.ca

	Version  2019-03-02
	-->

<nav class="header navbar navbar-expand">
	<div class="nav col-md-6">
		<div id="logo" class="mr-2">
			<a href="browseInClass.php?page=landing_home">
				<img src="images/sessThree.png" alt="Logo Image" id="logoImgSess"/>
			</a>
		</div>
		<a href="endClass.php" class="sessionLinkRun pt-4" id="sessionLinkSess" <?php if($_SESSION['classOwnerPerm'] == ' END CLASS '){
																						echo 'style="display:block">'.$_SESSION['classOwnerPerm'].'</a>';}
																						else{echo 'style="display:none"></a>';}?>
	</div>
	<div class="col-md-6">
		<div class="nav float-right">
			<a href="browseInClass.php?page=help" id="help" class="mt-2">
				<img src="images/help.png" alt="Help Image" style="width:100%;height:100%;object-fit:contain;"/>
			</a>
			<a href="browseInClass.php?page=profile" class="headerLinks mr-2 mt-4" id="profileText"> PROFILE </a>
			<a href="browseInClass.php?page=logout" class="headerLinks mt-4" id="logOutText"> LOG OUT </a>
		</div>
	</div>
</nav>
