<div id="countdown_div">
    <div class="section-title">
        <div class="container">
            <h3>
                Comienzo de temporada
            </h3>
        </div>
    </div>
    <div class="container text-white py-3">
        <div id="countdown" style="font-size: 2.5em; text-align: center; font-family: Helvetica,Arial,sans-serif!important; line-height: 1em;">
            <div id="days" class="text-center" style="padding: 0 .15rem; display: inline-block;"></div>
            <div class="text-center" style="min-width: 12px; display: inline-block;">:</div>
            <div id="hours" class="text-center" style="padding: 0 .15rem; min-width: 47px; display: inline-block;"></div>
            <div class="text-center" style="min-width: 12px; display: inline-block;">:</div>
            <div id="minutes" class="text-center" style="padding: 0 .15rem; min-width: 47px; display: inline-block;"></div>
            <div class="text-center" style="min-width: 12px; display: inline-block;">:</div>
            <div id="seconds" class="text-center" style="padding: 0 .15rem; min-width: 47px; display: inline-block; color: #ffdb03"></div>
        </div>
        <div id="countdown-text" style="font-size: 2.5em; text-align: center; line-height: .5rem; font-family: Helvetica,Arial,sans-serif!important;">
            <div id="days" class="text-center" style="display: inline-block;">
                <span style="font-size: .5rem">DÍAS</span>
            </div>
            <div class="text-center" style="min-width: 12px; display: inline-block;"></div>
            <div id="hours" class="text-center" style="min-width: 47px; display: inline-block;">
                <span style="font-size: .5rem">HORAS</span>
            </div>
            <div class="text-center" style="min-width: 12px; display: inline-block;"></div>
            <div id="minutes" class="text-center" style="min-width: 47px; display: inline-block;">
                <span style="font-size: .5rem">MINUTOS</span>
            </div>
            <div class="text-center" style="min-width: 12px; display: inline-block;"></div>
            <div id="seconds" class="text-center" style="min-width: 47px; display: inline-block">
                <span style="font-size: .5rem">SEGUNDOS</span>
            </div>
        </div>
        <script>
            var end = new Date('10/17/2019 0:00 AM');

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;

            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {

                    clearInterval(timer);
                    $("#countdown_div").addClass('d-none');
                    // document.getElementById('countdown_div').innerHTML = 'EXPIRED!';

                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                $('.days').val(days);
                if (hours   < 10) {hours   = "0"+hours;}
                if (minutes < 10) {minutes = "0"+minutes;}
                if (seconds < 10) {seconds = "0"+seconds;}
                document.getElementById('days').innerHTML = days;
                document.getElementById('hours').innerHTML = hours;
                document.getElementById('minutes').innerHTML = minutes;
                document.getElementById('seconds').innerHTML = seconds;
            }

            timer = setInterval(showRemaining, 1000);
        </script>
    </div>
</div>