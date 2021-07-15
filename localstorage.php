<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div id="clockremaining_1" class="timer"></div>
    <div id="clockremaining_2" class="timer"></div>
    <div id="clockremaining_3" class="timer"></div>
    <div id="clockremaining_4" class="timer"></div>
<script>

$(document).ready(function() {
    var debug = false;
    function init(id){
        var hasdID = `#${id}`, data = [];
        if (localStorage.hasOwnProperty(id)) {
            data[id] = JSON.parse(localStorage.getItem(id));
        }
        else {
            data[id] = {
                timercounter: 0,
                date: '<?php echo date('Y-m-d H:i:s');?>',
                exp_date: '<?php echo strtotime(date('2021-07-16 12:00:00')); ?>',
                now: '<?php echo time();?>'
            };
            localStorage.setItem(id, JSON.stringify(data[id]));
        }
        var isActive = true;
        function settimedauctioncountdowndiv(){
          alert("settimedauctioncountdowndiv function called - date=" + data[id].date + " - exp_date=" + data[id].exp_date+ " - now=" + data[id].now);
          if (data[id].now < data[id].exp_date) {
            var server_end = data[id].exp_date * 1000;
            var server_now = data[id].now * 1000;
            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour *24
            var timer;
            function showRemaining(){
                var distance = (server_end - server_now)  - (1000*data[id].timercounter);
                if (distance < 0 ) {
                   clearInterval( timer );
                   $(hasdID).html('<span style="color:#FFF;">Lot Finished</span>');
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
                $(hasdID).html(countdowninnerHTML);
                if (isActive) {
                  data[id].timercounter=data[id].timercounter+1;
                  localStorage.setItem(id, JSON.stringify(data[id]));
                }
                else {
                  data[id].timercounter=data[id].timercounter+1;
                }
                if (debug)
                    console.log(isActive);
            }
            timer = setInterval(showRemaining, 1000);
          } else {
              $(hasdID).html('<span style="color:#FFF;">Lot Finished</span>');
          }
        }
        settimedauctioncountdowndiv();
        window.addEventListener("storage", function myFunction(event) {
            $( "div.timer" ).each(function( index ) {
                var id = $( this ).attr( "id" )
                data[id] = JSON.parse(localStorage.getItem(id));
                data[id].timercounter = parseInt(data[id].timercounter);
            });
            
        });
        $(window).focus(function() {
          isActive = true;
          if (debug)
            console.log("Focus");
        });
        $(window).blur(function() {
          isActive = false
          if (debug)
            console.log("Blur");
        });
    }
    init('clockremaining_1');
    init('clockremaining_2');
    init('clockremaining_3');
    init('clockremaining_4');
});
</script>
</body>
</html>