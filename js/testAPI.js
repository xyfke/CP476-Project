window.onload = start;

function start(){
    var canvas = document.querySelector("#board").getContext("2d");
    var c = document.querySelector("#board");
    var msg = document.querySelector("#coordinates");
    var paint = false;
    var lines = new Array();
    var count = -1;

    console.log(lines);

    $('#board').mousedown(function (e){
        var mouseX = e.pageX - c.getBoundingClientRect().left; //- this.offsetLeft;
        var mouseY = e.pageY - c.getBoundingClientRect().top; //- this.offsetTop;
        paint = true;
        count = count + 1;
        lines.push(new Array());
        addCoordinate(mouseX, mouseY);
        redraw();
    });

    $('#board').mousemove(function(e) {
        var mouseX = e.pageX - c.getBoundingClientRect().left; //- this.offsetLeft;
        var mouseY = e.pageY - c.getBoundingClientRect().top;
        if (paint) {
            addCoordinate(mouseX, mouseY);
            redraw();
        }
        msg.innerHTML = "<" + mouseX + ", " + mouseY + ">";
    }); 

    $('#board').mouseup(function(e){
        paint = false;
    });

    $('#board').mouseleave(function(e){
        paint = false;
    });

    function addCoordinate(x, y) {
        lines[count].push(new Array(x, y));
    }

    function redraw() {
        canvas.clearRect(0, 0, canvas.canvas.width, canvas.canvas.height);

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


}
