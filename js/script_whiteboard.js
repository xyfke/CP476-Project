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
loadFunctions(board);

setInterval(chatRefresh, 2500);
setInterval(redraw, 100);

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
		logoImgSess.src = "images/sessZero.png";
	});
	logo.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		logoImgSess.src = "images/sessThree.png";
	});
	// ----------------------------------------------------------- end class link responsiveness
	var sessionLinkSess = document.querySelector("#sessionLinkSess");
	sessionLinkSess.addEventListener("mouseover", function(){
		// update logo to one that would display when class ends
		logoImgSess.src = "images/sessZero.png";
	});
	sessionLinkSess.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		logoImgSess.src = "images/sessThree.png";
	});
	// ----------------------------------------------------------- help link responsiveness
	var help = document.querySelector("#help");
	help.addEventListener("mouseover", function(){
		// update logo to one that would display in other pages
		logoImgSess.src = "images/sessZero.png";
	});
	help.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		logoImgSess.src = "images/sessThree.png";
	});
	// ----------------------------------------------------------- profile link responsiveness
	var prof = document.querySelector("#profileText");
	prof.addEventListener("mouseover", function(){
		// update logo to one that would display in other pages
		logoImgSess.src = "images/sessZero.png";
	});
	prof.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		logoImgSess.src = "images/sessThree.png";
	});
	// ----------------------------------------------------------- log out link responsiveness
	var logOutLink = document.querySelector("#logOutText");
	logOutLink.addEventListener("mouseover", function(){
		logoImgSess.src = "images/sessZero.png";
	});
	logOutLink.addEventListener("mouseout", function(){
		// update logo to one that displays in classroom
		logoImgSess.src = "images/sessThree.png";
	});
}

// ----------------------------------------------------------------------------------------- chat refresh
function chatRefresh(){
	var logFile = $("#logFile").attr('class');
	$("#chatBox").load(logFile);
	$("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
}

function board(){
	var canvas = document.querySelector("#board").getContext("2d");
    var c = document.querySelector("#board");
    var msg = document.querySelector("#coordinates");
    var paint = false;
    //var lines = new Array();
	//var count = -1;
	var lineID = -1;

    //console.log(lines);

    $('#board').mousedown(function (e){
        var mouseX = e.clientX - c.getBoundingClientRect().left; //- this.offsetLeft;
        var mouseY = e.clientY - c.getBoundingClientRect().top; //- this.offsetTop;
		paint = true;

		// create line and add point
		$.ajax({
			type : "GET",
			async : false,
			url : "create_points.php",
			data : {"x" : mouseX, "y" : mouseY},
			dataType : 'json',
			success : function (d) {
				if (d['status'] == "ok") {
					lineID = d['lineId'];
				}
			}
		});

        //lines.push(new Array());
        //addCoordinate(mouseX, mouseY);
        redraw(canvas);
    });

    $('#board').mousemove(function(e) {
        var mouseX = e.clientX - c.getBoundingClientRect().left; //- this.offsetLeft;
        var mouseY = e.clientY - c.getBoundingClientRect().top;
        if (paint) {

			// add point
            $.ajax({
				type : "GET",
				async : false,
				url : "create_points.php",
				data : {"x" : mouseX, "y" : mouseY, "lineId" : lineID},
				dataType : 'json',
				success : function (d) {
					if (d['status'] == "ok") {
						lineID = d['lineId'];
					}
				}
			});
            redraw(canvas);
        }
        msg.innerHTML = "<" + mouseX + ", " + mouseY + ">";
    });

    $('#board').mouseup(function(e){
        paint = false;
    });

    $('#board').mouseleave(function(e){
        paint = false;
	});

	/*function addCoordinate(x, y) {
		lines[count].push(new Array(x, y));
	}*/

}

function redraw(canvas) {
	var canvas = document.querySelector("#board").getContext("2d");
	canvas.clearRect(0, 0, canvas.canvas.width, canvas.canvas.height);
	var lines;

	// create line and add point
	$.ajax({
		type : "GET",
		async : false,
		url : "create_points.php",
		data : {"retrieve" : true},
		dataType : 'json',
		success : function (d) {
			lines = convertResult(d);
		}
	});

	console.log(lines);

	for (var lineNum = 0; lineNum < lines.length; lineNum++) {
		for (var pos = 0; pos < lines[lineNum].length; pos++) {
			if (pos == 0) {
				canvas.beginPath();
				canvas.lineWidth = "2";
				canvas.strokeStyle = "green";
				canvas.moveTo(lines[lineNum][pos][0], lines[lineNum][pos][1]);
			}
			else {
				canvas.lineTo(lines[lineNum][pos][0], lines[lineNum][pos][1]);
			}
		}
		canvas.stroke();
	}

}

function convertResult(d) {
	var lines = new Array();
	var lineID = -1;
	var counter = -1;

	for (var i = 0; i < d.length; i++) {
		if (d[i]['LineID'] != lineID) {
			lines.push(new Array());
			counter++;
			lineID = d[i]['LineID'];
		}
		lines[counter].push(new Array(d[i]['PointX'], d[i]['PointY']));
	}

	return lines;
}

//http://192.168.64.2/CP476-Project/whiteboard.php?sessionCode=18001429071553985758&sessionName=Hello+World
