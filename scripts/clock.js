
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

$(function(){

    // Cache some selectors

    var clock_digital = $('#clock_digital'),
        alarm = clock_digital.find('.alarm'),
        ampm = clock_digital.find('.ampm');

    // Map digits to their names (this will be an array)
    var digit_to_name = 'zero one two three four five six seven eight nine'.split(' ');

    // This object will hold the digit elements
    var digits = {};

    // Positions for the hours, minutes, and seconds
    var positions = [
        'h1', 'h2', ':', 'm1', 'm2', ':', 's1', 's2'
    ];

    // Generate the digits with the needed markup,
    // and add them to the clock_digital

    var digit_holder = clock_digital.find('.digits');

    $.each(positions, function(){

        if(this == ':'){
            digit_holder.append('<div class="dots">');
        }
        else{

            var pos = $('<div>');

            for(var i=1; i<8; i++){
                pos.append('<span class="d' + i + '">');
            }

            // Set the digits as key:value pairs in the digits object
            digits[this] = pos;

            // Add the digit elements to the page
            digit_holder.append(pos);
        }

    });

    // Add the weekday names

    var weekday_names = 'MON TUE WED THU FRI SAT SUN'.split(' '),
        weekday_holder = clock_digital.find('.weekdays');

    $.each(weekday_names, function(){
        weekday_holder.append('<span>' + this + '</span>');
    });

    var weekdays = clock_digital.find('.weekdays span');

    // Run a timer every second and update the clock_digital

    (function update_time(){

        // Use moment.js to output the current time as a string
        // hh is for the hours in 12-hour format,
        // mm - minutes, ss-seconds (all with leading zeroes),
        // d is for day of week and A is for AM/PM

        var now = moment().format("hhmmssdA");

        digits.h1.attr('class', digit_to_name[now[0]]);
        digits.h2.attr('class', digit_to_name[now[1]]);
        digits.m1.attr('class', digit_to_name[now[2]]);
        digits.m2.attr('class', digit_to_name[now[3]]);
        digits.s1.attr('class', digit_to_name[now[4]]);
        digits.s2.attr('class', digit_to_name[now[5]]);

        // The library returns Sunday as the first day of the week.
        // Stupid, I know. Lets shift all the days one position down, 
        // and make Sunday last

        var dow = now[6];
        dow--;

        // Sunday!
        if(dow < 0){
            // Make it last
            dow = 6;
        }

        // Mark the active day of the week
        weekdays.removeClass('active').eq(dow).addClass('active');

        // Set the am/pm text:
        ampm.text(now[7]+now[8]);

        // Schedule this function to be run again in 1 sec
        setTimeout(update_time, 1000);

    })();

    // Switch the theme

    $('a.button').click(function(){
        clock_digital.toggleClass('light dark');
    });

});
