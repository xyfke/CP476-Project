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
		var sessionLink = document.querySelector("#sessionLink");
		var logoImg = document.querySelector("#logoImg");
		sessionLink.addEventListener("mouseover", function(){
			// update logo to left spotlight lit up
			logoImg.src = "images/logo_single.png";
		});
		sessionLink.addEventListener("mouseout", function(){
			// update logo to no spotlight lit up
			logoImg.src = "images/logo_og.png";
		});
}
