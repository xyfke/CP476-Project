/* scripts.js
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
function start(){
	// get bottom table object and then the images within it
	var logo = document.getElementByID('logoImg');
	var sessionLink = document.getElementByID('sessionLink');

		// create mouse click event
	sessionLink.addEventListener("click", function(){
		if (sessionLink.innerHTML.equals("START SESSION")){
			sessionLink.innerHTML = "END SESSION"
			sessionLink.classList.remove("headerLinks");
			sessionLink.classList.add("sessionLinkRun");
			logo.src = "images/logo_single.png";
		}
		else{
			sessionLink.innerHTML = "START SESSION"
			sessionLink.classList.remove("sessionLinkRun");
			sessionLink.classList.add("headerLinks");
			logo.src = "images/logo_og.png";
		}
	});
}
