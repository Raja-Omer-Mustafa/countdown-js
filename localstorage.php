<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div id="clockremaining"></div>
<script>

$(document).ready(function() {
    var timercounter=0;//for the counter
    var date = localStorage.hasOwnProperty("date") ? localStorage.getItem("date") : '<?php echo date('Y-m-d H:i:s');?>';
    var exp_date = localStorage.hasOwnProperty("exp_date") ? localStorage.getItem("exp_date") : '<?php echo strtotime(date('2021-07-16 12:00:00')); ?>';  
    var now = localStorage.hasOwnProperty("now") ? localStorage.getItem("now") : '<?php echo time();?>';
    // var date = '<?php echo date('Y-m-d H:i:s');?>';
    // var exp_date = '<?php echo strtotime(date('2021-07-16 12:00:00')); ?>';  
    // var now = '<?php echo time();?>';
    var isActive = true;
    // var totalActiveTabs = 1;
    localStorage.setItem("date", date);
    localStorage.setItem("exp_date", exp_date);
    localStorage.setItem("now", now);
    localStorage.setItem("timercounter", timercounter);
    // console.log(localStorage.hasOwnProperty('totalActiveTabs'));
    // if (localStorage.hasOwnProperty("totalActiveTabs")) {
    //   var activeTabs = parseInt(localStorage.getItem("totalActiveTabs"));
    //   activeTabs++;
    //   localStorage.setItem("totalActiveTabs", activeTabs);
    // }
    // else {
    //   localStorage.setItem("totalActiveTabs", totalActiveTabs);
    // }
    // localStorage.setItem("totalActiveTabs", totalActiveTabs);
    function settimedauctioncountdowndiv(){
      alert("settimedauctioncountdowndiv function called - date=" + date + " - exp_date=" + exp_date+ " - now=" + now);
      if (now < exp_date) {
        var server_end = exp_date * 1000;
        var server_now = now * 1000;
        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour *24
        var timer;
        function showRemaining(){
            // timercounter = parseInt(localStorage.getItem("timercounter"));
            var distance = (server_end - server_now)  - (1000*timercounter);
            if (distance < 0 ) {
               clearInterval( timer );
               $('#clockremaining').html('<span style="color:#FFF;">Lot Finished</span>');
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
            $('#clockremaining').html(countdowninnerHTML);
            if (isActive) {
              timercounter=timercounter+1;
              localStorage.setItem("timercounter", timercounter);
            }
            else {
              timercounter=timercounter+1;
            }
            
            
            console.log(isActive);
        }
        timer = setInterval(showRemaining, 1000);
      } else {
          //alert("Times Up");
          $('#clockremaining').html('<span style="color:#FFF;">Lot Finished</span>');
      }
    }
    settimedauctioncountdowndiv();
    window.addEventListener("storage", function myFunction(event) {
      timercounter = parseInt(localStorage.getItem("timercounter"));
      // console.log(timercounter);
      date = localStorage.getItem("date");
      exp_date = localStorage.getItem("exp_date");  
      now = localStorage.getItem("now");
    });
    $(window).focus(function() {
      isActive = true;
      console.log("Focus");
    });
    $(window).blur(function() {
      isActive = false
      console.log("Blur");
    });
    // $(window).on("beforeunload", function() {
    //   if (localStorage.hasOwnProperty("totalActiveTabs")) {
    //     var activeTabs = parseInt(localStorage.getItem("totalActiveTabs"));
    //     if (activeTabs > 1) {
    //       activeTabs--;
    //       localStorage.setItem("totalActiveTabs", activeTabs);
    //     }
    //     else {
    //       localStorage.removeItem("totalActiveTabs");
    //     }
        
    //   }
    //   else {
    //     localStorage.setItem("totalActiveTabs", totalActiveTabs);
    //   }
    // });
    
});
</script>
</body>
</html>