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
loadFunctions(chatRefresh);
setInterval(chatRefresh, 2500);

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
	var logoImgSess = document.querySelector("#logoImgSess");
	// ----------------------------------------------------------- logo link responsiveness
	var logo = document.querySelector("#logo");
	logo.addEventListener("mouseover", function(){
		// update logo to one that would display in other pages
		var homeImg = logoImgSess.classList[0];
		logoImgSess.src = "images/" + homeImg + ".png";
	});
	logo.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		var classImg = logoImgSess.classList[1];
		logoImgSess.src = "images/" + classImg + ".png";
	});
	// ----------------------------------------------------------- end class link responsiveness
	var sessionLinkSess = document.querySelector("#sessionLinkSess");
	sessionLinkSess.addEventListener("mouseover", function(){
		// update logo to one that would display when class ends
		logoImgSess.src = "images/sessZero.png";
	});
	sessionLinkSess.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		var classImg = logoImgSess.classList[1];
		logoImgSess.src = "images/" + classImg + ".png";
	});
	// ----------------------------------------------------------- help link responsiveness
	var help = document.querySelector("#help");
	help.addEventListener("mouseover", function(){
		// update logo to one that would display in other pages
		var homeImg = logoImgSess.classList[0];
		logoImgSess.src = "images/" + homeImg + ".png";
	});
	help.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		var classImg = logoImgSess.classList[1];
		logoImgSess.src = "images/" + classImg + ".png";
	});
	// ----------------------------------------------------------- profile link responsiveness
	var prof = document.querySelector("#profileText");
	prof.addEventListener("mouseover", function(){
		// update logo to one that would display in other pages
		var homeImg = logoImgSess.classList[0];
		logoImgSess.src = "images/" + homeImg + ".png";
	});
	prof.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		var classImg = logoImgSess.classList[1];
		logoImgSess.src = "images/" + classImg + ".png";
	});
	// ----------------------------------------------------------- log out link responsiveness
	var logOutLink = document.querySelector("#logOutText");
	logOutLink.addEventListener("mouseover", function(){
		// update logo to one that would display when class ends
		logoImgSess.src = "images/sessZero.png";
	});
	logOutLink.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		var classImg = logoImgSess.classList[1];
		logoImgSess.src = "images/" + classImg + ".png";
	});
}

// ----------------------------------------------------------------------------------------- chat refresh
function chatRefresh(){
	var logFile = $("#logFile").attr('class');
	$("#chatBox").load(logFile);
	$("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
	//-----------------------------------------------------------also refresh logo
	$("#logo").load($("#logo").children());
}
