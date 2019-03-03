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

window.onload = start; // Make sure everything's rendered before starting
function start(){
	// get bottom table object and then the images within it
	var bottomTable = document.getElementsByClassName("bottomTable")[0];
	var smallImgs = bottomTable.getElementsByTagName("img");

	// create event for each image
	for(i = 0; i < smallImgs.length; i++){
		// create mouse hover event
		smallImgs[i].addEventListener("mouseover", function(){
			this.style.transform = "scale(1.1, 1.1)";
		});
		smallImgs[i].addEventListener("mouseout", function(){
			this.style.transform = "scale(1, 1)";
		});

		// create mouse click event
		smallImgs[i].addEventListener("click", function(){
			// get centre table object, image, and title to be able to replace it
			var centreTable = document.getElementsByClassName("innerCentre")[0];
			var centreImg = centreTable.getElementsByTagName("img")[0];
			var centreTitle = document.querySelector("h4");
			// save centre image and title
			var tempSrc = centreImg.src;
			var tempTitle = centreTitle.innerHTML;
			// get bottom table object and the images and titles within it again in case of order change
			var bottomTable2 = document.getElementsByClassName("bottomTable")[0];
			var smallImgs2 = bottomTable.getElementsByTagName("img");
			var smallTitles = bottomTable.getElementsByTagName("a");

			// replace center image with larger version of thumbnail image
			centreImg.src = "images/medium/" + this.src.slice(-10,-4) + ".jpg";
			// find current object index in possible re-ordered lists
			var j = 0;
			while (this.src != smallImgs2[j].src){
				j++;
			}
			// replace centre title with thumbnail title
			centreTitle.innerHTML = smallTitles[j].innerHTML;

			// replace thumbnail image with smaller version of centre image
			this.src = "images/small/" + tempSrc.slice(-10,-4) + ".jpg";
			// replace thumbnail title with centre title
			smallTitles[j].innerHTML = tempTitle;
		});
	}
}
