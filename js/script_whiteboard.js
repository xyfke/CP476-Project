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

window.onload = start;

function start() {
  var btn;

  function changeColor(event) {
    btn.style.backgroundColor = "#808080";
  }

  var toolBtns = document.querySelectorAll(".toolbarItems");
  for (i = 0; i < toolBtns.length; i++) {

    toolBtns[i].style.backgroundColor = "#FFFFFF";
    toolBtns[i].onclick = changeColor;
    /* toolBtns[i].addEventListener("onclick", function() {
      toolBtns[i].style.backgroundColor = "#808080";
    });*/
  }
}
