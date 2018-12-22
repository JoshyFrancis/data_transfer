
(function ($) {
    "use strict";

    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = window.mozRequestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            function (cb) { setTimeout(cb, 1000 / 60); };
    }

    var $h = $("#hour"),
        $m = $("#minute"),
        $s = $("#second");

    function computeTimePositions($h, $m, $s) {
        var now = new Date(),
            h = now.getHours(),
            m = now.getMinutes(),
            s = now.getSeconds(),
            ms = now.getMilliseconds(),
            degS = (s * 6) + (6 / 1000 * ms),
            degM = (m * 6) + (6 / 60 * s) + (6 / (60 * 1000) * ms),
            degH = (h * 30) + (30 / 60 * m);

        $s.css({ "transform": "rotate(" + degS + "deg)" });
        $m.css({ "transform": "rotate(" + degM + "deg)" });
        $h.css({ "transform": "rotate(" + degH + "deg)" });

        window.requestAnimationFrame(function () {
            computeTimePositions($h, $m, $s);
        });
    }

    function setUpFace() {
        var x,
            fragment = document.createDocumentFragment();


        function getTick(n) {
            var tickClass = "smallTick",
                tickBox = $("<div class=\"faceBox\"></div>"),
                tick = $("<div></div>"),
                tickNum = "";

            if (n % 5 === 0) {
                tickClass = (n % 15 === 0) ? "largeTick" : "mediumTick";
                tickNum = $("<div class=\"tickNum\"></div>").text(n / 5).css({ "transform": "rotate(-" + (n * 6) + "deg)" });
                if (n >= 50) {
                    tickNum.css({ "left": "-0.3em" });
                }
            }


            tickBox.append(tick.addClass(tickClass)).css({ "transform": "rotate(" + (n * 6) + "deg)" });
            tickBox.append(tickNum);
            return tickBox;
        }

        for (x = 1; x <= 60; x += 1) {
            fragment.appendChild(getTick(x)[0]);
        }

        $("#clock").append(fragment);
    }

    function setSize() {
        var b = $("#clock").parent(),
            w = b.width(),
            x = Math.floor(w / 30) - 1,
            px = (x > 15 ? 16 : x) + "px";


        $("#clock").css({ "font-size": px });
    }

     
	setSize();
	setUpFace();
	computeTimePositions($h, $m, $s);
	$(window).on("resize", setSize);
       
}(jQuery));


//invokes functions as soon as window loads
window.onload = function(){
	time();
	ampm();
	whatDay();
	setInterval(function(){
		time();
		ampm();
		whatDay();
	}, 1000);
};


//gets current time and changes html to reflect it
function time(){
	var date = new Date(),
		hours = date.getHours(),
		minutes = date.getMinutes(),
		seconds = date.getSeconds();

	//make clock a 12 hour clock instead of 24 hour clock
	hours = (hours > 12) ? (hours - 12) : hours;
	hours = (hours === 0) ? 12 : hours;

	//invokes function to make sure number has at least two digits
	hours = addZero(hours);
	minutes = addZero(minutes);
	seconds = addZero(seconds);

	//changes the html to match results
	document.getElementsByClassName('hours')[0].innerHTML = hours;
	document.getElementsByClassName('minutes')[0].innerHTML = minutes;
	document.getElementsByClassName('seconds')[0].innerHTML = seconds;
}

//turns single digit numbers to two digit numbers by placing a zero in front
function addZero (val){
	return (val <= 9) ? ("0" + val) : val;
}

//lights up either am or pm on clock
function ampm(){
	var date = new Date(),
		hours = date.getHours(),
		am = document.getElementsByClassName("am")[0].classList,
		pm = document.getElementsByClassName("pm")[0].classList;
	
		
	(hours >= 12) ? pm.add("light-on") : am.add("light-on");
	(hours >= 12) ? am.remove("light-on") : pm.remove("light-on");
}

//lights up what day of the week it is
function whatDay(){
	var date = new Date(),
		currentDay = date.getDay(),
		days = document.getElementsByClassName("day");

	//iterates through all divs with a class of "day"
	for (x in days){
		//list of classes in current div
		var classArr = days[x].classList;

		(classArr !== undefined) && ((x == currentDay) ? classArr.add("light-on") : classArr.remove("light-on"));
	}
}
