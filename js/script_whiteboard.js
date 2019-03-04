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
	var toolBtns = document.querySelectorAll(".toolbarItems");
	var changed = [0, 0, 0, 0 ,0];

	for (i = 0; i < toolBtns.length; i++) {
		toolBtns[i].addEventListener("click", function() {
			index = this.classList[1];
			if (changed[index] == 0){
				this.style.backgroundColor = "#808080";
				changed[index] = 1;
			}
			else{
				this.style.backgroundColor = "#FFFFFF";
				changed[index] = 0;
			}
		});
	}
}
