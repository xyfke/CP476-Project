/* script_whiteboard.js
	CP476 Final Project

	Author 1:  David Moreno-Bautista
	ID 1:      151925580
	Email 1:   more5580@mylaurier.ca

	Author 2:  Xiang Ke
	ID 2:	   150617130
	Email 2:   kexx7130@mylaurier.ca

	Version  2019-03-02
	*/

// ----------------------------------------------------------------------------------------- load all functions on window load
function loadFunctions(func) {
	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	}
	else {
		window.onload = function() {
			if (oldonload) {
				oldonload();
			}
			func();
		}
	}
}
loadFunctions(toolButtons);
loadFunctions(navLogo);

// ----------------------------------------------------------------------------------------- tool buttons
function toolButtons() {
	// get all the tool buttons
	var toolBtns = document.querySelectorAll(".toolbarItems");
	// initialize their "chosen" value as not picked
	var picked = [0, 0, 0, 0 ,0];

	// walk through all the buttons
	for (i = 0; i < toolBtns.length; i++) {
		toolBtns[i].addEventListener("click", function() {
			// on click, get it's index number (saved on the classlist)
			index = this.classList[1];
			if (picked[index] == 0){
				// if it is not picked, walk through all the buttons and set to not picked
				// (in case there is another currently picked button)
				var j;
				for(j = 0; j < picked.length; j++){
					picked[j] = 0;
					toolBtns[j].style.backgroundColor = "#FFFFFF"
				}
				// change its background color to "picked" color
				this.style.backgroundColor = "#808080";
				// change its value to "picked"
				picked[index] = 1;
			}
			else{
				// if it is already picked, change its background color to "not picked"
				this.style.backgroundColor = "#FFFFFF";
				// also change its value to "not picked"
				picked[index] = 0;
			}
		});
	}
}

// ----------------------------------------------------------------------------------------- nav bar
function navLogo() {
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
