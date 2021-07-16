<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div>
        Timezone: 
        <?php
            date_default_timezone_set("Asia/Karachi");
            echo date_default_timezone_get();
        ?>
        <br />
        <strong>You can get timezone from user and set</strong>
    </div>
    <button id="clear-storage" style="display: none" type="button">clear storage!</button>
    <!-- timer class is must don't forget to add -->
    <!-- id should be passed in init function in js -->
    <div id="clockremaining_1" class="timer"></div>
    <div id="clockremaining_2" class="timer"></div>
    <div id="clockremaining_3" class="timer"></div>
    <div id="clockremaining_4" class="timer"></div>
<script>

$(document).ready(function() {
    // $( "#clear-storage" ).trigger( "click" );
    var debug = false, isActive = false;
    var data = [];


    function settimedauctioncountdowndiv(bidlotid, exp_date){
        if (debug)
            console.log(exp_date);

        var staticDate = '<?php echo date('Y-m-d H:i:s');?>';
        var staticNow = '<?php echo time();?>';

        var hasdID = `#${bidlotid}`;
        if (localStorage.hasOwnProperty(bidlotid)) {
            data[bidlotid] = JSON.parse(localStorage.getItem(bidlotid));
        }
        else {
            data[bidlotid] = {
                timercounter: 0,
                date: staticDate,
                exp_date: exp_date,
                now: staticNow
            };
            localStorage.setItem(bidlotid, JSON.stringify(data[bidlotid]));
        }
        if (debug)
            console.log(data);
        // alert("settimedauctioncountdowndiv function called - date=" + data[bidlotid].date + " - exp_date=" + data[bidlotid].exp_date+ " - now=" + data[bidlotid].now);
        if (data[bidlotid].now < data[bidlotid].exp_date) {
            var server_end = data[bidlotid].exp_date * 1000;
            var server_now = data[bidlotid].now * 1000;
            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour *24
            var timer;
            function showRemaining() {
                var distance = (server_end - server_now)  - (1000*data[bidlotid].timercounter);
                if (distance < 0 ) {
                    clearInterval( timer );
                    $(hasdID).html('<span style="color:#000;">Lot Finished</span>');
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor( (distance % _day ) / _hour );
                var minutes = Math.floor( (distance % _hour) / _minute );
                var seconds = Math.floor( (distance % _minute) / _second );
                var countdowninnerHTML = '';
                if (days) {
                    if(days>1){
                        countdowninnerHTML += days + ' days ';
                    }else{
                        countdowninnerHTML += days + ' day ';
                    }
                }
                countdowninnerHTML += hours+ 'hrs ' + minutes+ 'mins ' + seconds+ ' secs left';
                console.log("Works");
                $(hasdID).html(countdowninnerHTML);
                if (isActive) {
                    data[bidlotid].timercounter=data[bidlotid].timercounter+1;
                    localStorage.setItem(bidlotid, JSON.stringify(data[bidlotid]));
                }
                else {
                    data[bidlotid].timercounter=data[bidlotid].timercounter+1;
                }
                if (debug)
                    console.log(isActive);
            }
            timer = setInterval(showRemaining, 1000);
        } else {
            if (debug)
                console.log("Finish");
            $(hasdID).html('<span style="color:#000;">Lot Finished</span>');
        }
    }

    settimedauctioncountdowndiv('clockremaining_1', '<?php echo strtotime(date("2021-07-16 17:00:00")); ?>');
    settimedauctioncountdowndiv('clockremaining_2', '<?php echo strtotime(date("2021-07-16 18:20:00")); ?>');
    settimedauctioncountdowndiv('clockremaining_3', '<?php echo strtotime(date("2021-07-16 19:40:00")); ?>');
    settimedauctioncountdowndiv('clockremaining_4', '<?php echo strtotime(date("2021-07-16 20:10:00")); ?>');


    window.addEventListener("storage", function myFunction(event) {
        $( "div.timer" ).each(function( index ) {
            var id = $( this ).attr( "id" );
            if (localStorage.hasOwnProperty(id)) {
                data[id] = JSON.parse(localStorage.getItem(id));
                data[id].timercounter = parseInt(data[id].timercounter);
            }
            else {
                location.reload();
            }
            
        });
        // if (!localStorage.hasOwnProperty('isActive')) {
        //     isActive = localStorage.getItem('isActive');
        // }
    });
    $(window).focus(function() {
        console.log("Focus");
        // localStorage.setItem('isActive', true);
        isActive = true;
        if (debug)
            console.log("Focus");
    });
    $(window).blur(function() {
        // localStorage.setItem('isActive', false);
        isActive = false;
        if (debug)
            console.log("Blur");
    });
    $( "#clear-storage" ).click(function() {
        localStorage.clear();
        location.reload();
    });
    $(window).bind('beforeunload',function(){
        localStorage.clear();
        location.reload();
    });


});
</script>
</body>
</html>