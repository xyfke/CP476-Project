<!-- header.php

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
			<a href="landing_home.php">
				<img src="images/sessZero.png" alt="Logo Image" id="logoImg"/>
			</a>
		</div>
		<div class="headerLinks pt-4" id="sessionLink" data-toggle="modal" data-target="#myModal"> CLASSROOM </div>
	</div>
	<div class="col-md-6">
		<div class="nav float-right">
			<a href="help.php" id="help" class="mt-2">
				<img src="images/help.png" alt="Help Image" style="width:100%;height:100%;object-fit:contain;"/>
			</a>
			<a href="profile.php" class="headerLinks mr-2 mt-4"> PROFILE </a>
			<a href="logOut.php" class="headerLinks mt-4" id="logOutTextHome"> LOG OUT </a>
		</div>
	</div>

	<!-- The Modal -->
	<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

		<!-- Modal Header -->
		<div class="modal-header">
			<h4 class="modal-title">Create or Join Class Session</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

		<!-- Modal body -->
		<div class="modal-body container">
			<div class="row">
				<div class="col col-md-6">
					<form method="post" action="create_session.php">
						<h5>Create Class</h5>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Class Name" name="sessionName">
							<button type="submit" class="btn btn-primary mt-2">Create</button>
						</div>
					</form>
				</div>
				<div class="col col-md-6">
					<form>
						<h5>Join Class</h5>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Class Code" id="sessionCode" name="sessionCode">
							<button type="button" class="btn btn-primary mt-2" id="join">Join</button>
							<div class="text-danger" id="errorMessage"></div>
						</div>
					</form>
				</div>
			</div>

		</div>

		</div>
	</div>
	</div>
</nav>
