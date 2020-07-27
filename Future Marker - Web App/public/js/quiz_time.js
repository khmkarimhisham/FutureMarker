 
var minutes = document.getElementById("time").innerText;
var start = new Date().getTime();

var countDownDate = start + minutes * 60000;

var x = setInterval(function () {

    var now = new Date().getTime();
    var distance = countDownDate - now;

    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("time").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";


    if (distance < 0) {
        clearInterval(x);
        document.getElementById("time").innerHTML = "time-out";
        jQuery('#ajaxSubmit').click();
 
    }
}, 1000);


