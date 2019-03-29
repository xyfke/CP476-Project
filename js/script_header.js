/* script_header.js
	CP476 Final Project

	Author 1:  David Moreno-Bautista
	ID 1:      151925580
	Email 1:   more5580@mylaurier.ca

	Author 2:  Xiang Ke
	ID 2:	   150617130
	Email 2:   kexx7130@mylaurier.ca

	Version  2019-03-02
	*/

window.onload = start;

function start() {
	var logoImg = document.querySelector("#logoImg");
	// ----------------------------------------------------------- classroom link responsiveness
	var sessionLink = document.querySelector("#sessionLink");
	sessionLink.addEventListener("mouseover", function(){
		// update logo to one that would display in classroom
		var classImg = logoImg.classList[1];
		logoImg.src = "images/" + classImg + ".png";
	});
	sessionLink.addEventListener("mouseout", function(){
		// update logo to one that displays in other pages
		var homeImg = logoImg.classList[0];
		logoImg.src = "images/" + homeImg + ".png";
	});
	// ----------------------------------------------------------- log out link responsiveness
	var logOutLink = document.querySelector("#logOutTextHome");
	logOutLink.addEventListener("mouseover", function(){
		// update logo to one that would display when session ends
		logoImg.src = "images/sessZero.png";
	});
	logOutLink.addEventListener("mouseout", function(){
		// update logo to one that displays in other pages
		var homeImg = logoImg.classList[0];
		logoImg.src = "images/" + homeImg + ".png";
	});

	var joinBtn = document.querySelector("#join");
	joinBtn.addEventListener("click", function() {
		makeSomeCalls();
	})
}

function makeSomeCalls() {
	var select = $('#sessionID').val();
	var sessionPortion = "sessionID=" + select;

	$.ajax({
        type : "GET",
        async : false,
        url : "join_session.php",
        data : sessionPortion,
        dataType : 'json',
        success : function (d) {
            if (d.status == "ok") {
				window.location.replace("whiteboard.php?sessionCode=" + select);
			}
        }
    });

	
}
