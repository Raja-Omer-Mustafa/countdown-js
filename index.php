<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Test
        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        </script>
    </head>
    <body>
        <div id="clockremaining"></div>
        <div id="temp"></div>
        <button onclick="changeValue()">Change a Storage Item</button>
        <script>

            function changeValue() {
                var date = Date.now();
                console.log(date);
              localStorage.setItem("mytime", date);
            }
            $(document).ready(function() {
                if(!localStorage.getItem("mytime")) {
                    localStorage.setItem("mytime", Date.now());
                }
                console.log(localStorage.getItem("mytime"));
                
                function settimedauctioncountdowndiv(){
                    var date = '<?php echo date('Y-m-d H:i:s');?>';
                    var exp_date = '<?php echo strtotime(date('2021-07-16 12:00:00')); ?>';  
                    var now = '<?php echo time();?>';
                    alert("settimedauctioncountdowndiv function called - date=" + date + " - exp_date=" + exp_date+ " - now=" + now);
                    if (now < exp_date) {
                      var rAFCallback = function showRemaining(callback){
                          var server_end = rAFCallback.exp_date * 1000;
                          var server_now = rAFCallback.now * 1000;
                          var _second = 1000;
                          var _minute = _second * 60;
                          var _hour = _minute * 60;
                          var _day = _hour *24
                          var timer;
                          var distance = (server_end - server_now)  - (1000 * rAFCallback.timercounter);
                          // console.log(distance);
                          // var distance = callback;
                          // var distance = (server_end - server_now)  - (1000*timercounter);
                          if (distance < 0 ) {
                             console.log("yes");
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
                          rAFCallback.timercounter=rAFCallback.timercounter+1;
                          window.requestAnimationFrame( rAFCallback );
                      }
                      rAFCallback = rAFCallback.bind(rAFCallback);
                      rAFCallback.now = now;
                      rAFCallback.exp_date = exp_date;
                      rAFCallback.timercounter = 0;
                      rAFCallback(); // = requestAnimationFrame( rAFCallback );  
                      // timer = setInterval(showRemaining, 1000);
                    } else {
                        //alert("Times Up");
                        $('#clockremaining').html('<span style="color:#FFF;">Lot Finished</span>');
                    }
                }
                settimedauctioncountdowndiv();
                window.addEventListener("storage", function myFunction(event) {
                    $('#temp').html('A change was made in the storage area');
                });
            });
        </script>
    </body>
</html>