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
		logoImg.src = "images/sessThree.png";
	});
	sessionLink.addEventListener("mouseout", function(){
		// update logo to one that displays in other pages
		logoImg.src = "images/sessZero.png";
	});
	// ----------------------------------------------------------- home page link responsiveness
	var homeTitles = document.getElementsByClassName("title");
	var i;
	for(i = 0; i < homeTitles.length; i++){
		homeTitles[i].addEventListener("mouseover", function(){
			// update logo to one that would display in classroom
			logoImg.src = "images/sessThree.png";
		});
		homeTitles[i].addEventListener("mouseout", function(){
			// update logo to one that displays in other pages
			logoImg.src = "images/sessZero.png";
		});
	}

	// ------------------------------------------------------------ join classroom responsiveness
	var joinBtn = document.querySelector("#join");
	joinBtn.addEventListener("click", function() {
		makeSomeCalls();
	});
}

function makeSomeCalls() {
	var select = $('#sessionCode').val();
	var sessionPortion = "sessionCode=" + select;
	var errorMessage = document.querySelector("#errorMessage");

	$.ajax({
		type : "GET",
		async : false,
        url : "join_session.php",
        data : sessionPortion,
        dataType : 'json',
        success : function (d) {
			//alert(d["status"]);
			//window.location.replace("whiteboard.php?sessionCode=" + select);
            if (d.status == "ok") {
				/*alert(d["sessionCode"]);
				alert(d["sessionName"]);*/
				window.location.replace("whiteboard.php?sessionCode=" + d["sessionCode"] + "&sessionName=" + encodeURI(d["sessionName"]));
			}
			else {
				errorMessage.innerHTML = "Cannot locate session";
			}
        }
    });


}
