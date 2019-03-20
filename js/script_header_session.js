/* script_header_session.js
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
		var sessionLinkSess = document.querySelector("#sessionLinkSess");
		var logoImgSess = document.querySelector("#logoImgSess");
		sessionLinkSess.addEventListener("mouseover", function(){
			// update logo to left spotlight lit up
			logoImgSess.src = "images/logo_og.png";
		});
		sessionLinkSess.addEventListener("mouseout", function(){
			// update logo to no spotlight lit up
			logoImgSess.src = "images/logo_single.png";
		});
}
