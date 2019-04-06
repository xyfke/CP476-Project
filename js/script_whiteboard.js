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

// -------------------------------------------------------------------------------------- drawing on board
function board(){

	var canvas = document.querySelector("#board").getContext("2d");
    var c = document.querySelector("#board");
    var paint = false;
	var lineID = -1;

	var userDraw = new Array();
	var undoList = new Array();
	
	// set cursor image in board
	$('#board').css("cursor", "url('/CP476-Project/images/marker.png') 0 32,auto");

	// create line with coordinates when mouse down after getting x & y coordinates
    $('#board').mousedown(function (e){
        var mouseX = e.clientX - c.getBoundingClientRect().left; 
        var mouseY = e.clientY - c.getBoundingClientRect().top; 
		paint = true;

		var color = $('#color').val();
		var width = $('#width').val();

		
		undoList.length = 0;

		// ajax call to add line and also set the lineId, for future to add more points
		$.ajax({
			type : "GET",
			async : false,
			url : "create_points.php",
			data : {"x" : mouseX, "y" : mouseY, "color" : color,  "width" : width},
			dataType : 'json',
			success : function (d) {
				if (d['status'] == "ok") {
					lineID = d['lineId'];
					userDraw.unshift(new Array(lineID, color));
				}
			}
		});
    });

	// add point to line when mouse is dragging
    $('#board').mousemove(function(e) {
        var mouseX = e.clientX - c.getBoundingClientRect().left;
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
            
        }
    });

	// set continue to paint to false when mouse is out of bound or mouse is no longer dragging
    $('#board').mouseup(function(e){
        paint = false;
    });

    $('#board').mouseleave(function(e){
		paint = false;
	});


	// get color
	
	$('#undo').click(function () {

		if (userDraw.length > 0) {

			$.ajax({
				type : "GET",
				async : false,
				url : "undo.php",
				data : {"lineId" : userDraw[0][0], "color" : "#FFFFFF"},
				dataType : 'json',
				success : function (d) {
					undoList.unshift(new Array(userDraw[0][0], userDraw[0][1]));
					userDraw.shift();
				}
			});

			// future use
			/*$.ajax({
				type : "GET",
				async : false,
				url : "undo.php",
				data : {"lineId" : userDraw[userDraw.length -1], "save" : true},
				dataType : 'json',
				success : function (d) {
					undoList.unshift(new Array());
					for (var i = 0; i < d.length; i++) {
						if (i == 0) {
							undoList[0].push(new Array(d[i]['Color'], d[i]['Width'], d[i]['PointX'], d[i]['PointY']));
						}
						else {
							undoList[0].push(new Array(d[i]['PointX'], d[i]['PointY']));
						}
					}
				}
			});
			$.ajax({
				type : "GET",
				async : false,
				url : "undo.php",
				data : {"lineId" : userDraw[userDraw.length -1], "delete" : true},
				dataType : 'json',
				success : function (d) {
					if (d['status'] == "ok") {
						userDraw.pop();
					}
				}
			});*/
		}
		
	});

	
	$('#redo').click(function() {
		var color = "black";
		var width = 1;
		
		if (undoList.length > 0) {

			$.ajax({
				type : "GET",
				async : false,
				url : "undo.php",
				data : {"lineId" : undoList[0][0], "color" : undoList[0][1]},
				dataType : 'json',
				success : function (d) {
					userDraw.unshift(new Array(undoList[0][0], undoList[0][1]));
					undoList.shift();
				}
			});
			
		}
	});

	window.onbeforeunload = function(event) {
		for (var i = 0; i < undoList.length; i++) {
			$.ajax({
				type : "GET",
				async : false,
				url : "undo.php",
				data : {"lineId" : undoList[i][0], "delete" : true},
				dataType : 'json',
				success : function (d) {
					if (d['status'] == "ok") {
					}
				}
			});
		}
	}

	window.close = function(event) {
		for (var i = 0; i < undoList.length; i++) {
			$.ajax({
				type : "GET",
				async : false,
				url : "undo.php",
				data : {"lineId" : undoList[i][0], "delete" : true},
				dataType : 'json',
				success : function (d) {
					if (d['status'] == "ok") {
					}
				}
			});
		}
	}



}

// ------------------------------------------------------------------------------------- update board
function redraw(canvas) {
	// get canvas and clear it
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

	//console.log(lines);

	// get all points and colours from line and draw on board
	for (var lineNum = 0; lineNum < lines.length; lineNum++) {
		for (var pos = 0; pos < lines[lineNum].length; pos++) {
			if (pos == 0) {
				canvas.beginPath();
				canvas.lineWidth = lines[lineNum][pos][1];
				canvas.strokeStyle = lines[lineNum][pos][0];
			}
			else {
				canvas.lineTo(lines[lineNum][pos][0], lines[lineNum][pos][1]);
			}
		}
		canvas.stroke();
	}

}

// ------------------------------------------------------------------------------ convert json to 2d array
function convertResult(d) {
	var lines = new Array();
	var lineID = -1;
	var counter = -1;

	// format: lines[counter][0] = {Color, Width}, lines[counter][n] = {PointX, PointY} where n != 0
	for (var i = 0; i < d.length; i++) {
		if (d[i]['LineID'] != lineID) {
			lines.push(new Array());
			counter++;
			lineID = d[i]['LineID'];
			lines[counter].push(new Array(d[i]['Color'], d[i]['Width']));
		}
		lines[counter].push(new Array(d[i]['PointX'], d[i]['PointY']));
	}

	return lines;
}
