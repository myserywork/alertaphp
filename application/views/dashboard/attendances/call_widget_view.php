<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
    .call-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .call-widget .call-status {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .call-widget .call-timer {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .call-widget .call-button {
        display: block;
        text-align: center;
        padding: 8px 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 0 auto;
        width: fit-content;
    }

    .call-widget .call-button:hover {
        background-color: #0056b3;
    }
</style>

<div class="call-widget">
    <div class="call-status">Pronto para iniciar a chamada</div>
    <div class="call-timer">00:00:00</div>
    <button class="call-button" id="startButton"><i class="fas fa-phone"></i> Ligar para o Paciente</button>
    <button class="call-button" id="endButton" style="display: none;"><i class="fas fa-phone-slash"></i> Encerrar Chamada</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    var callStartTime;
    var callTimerInterval;

    function startCallTimer() {
        callStartTime = new Date().getTime();

        callTimerInterval = setInterval(function() {
            var currentTime = new Date().getTime();
            var timeElapsed = currentTime - callStartTime;

            var hours = Math.floor((timeElapsed % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeElapsed % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeElapsed % (1000 * 60)) / 1000);

            hours = padTimeValue(hours);
            minutes = padTimeValue(minutes);
            seconds = padTimeValue(seconds);

            var timerText = hours + ":" + minutes + ":" + seconds;
            document.querySelector('.call-timer').textContent = timerText;
        }, 1000);
    }

    function stopCallTimer() {
        clearInterval(callTimerInterval);
    }

    function padTimeValue(value) {
        return value < 10 ? "0" + value : value;
    }

    document.querySelector('#startButton').addEventListener('click', function() {
        document.querySelector('.call-status').textContent = 'Em chamada';
        document.querySelector('#startButton').style.display = 'none';
        document.querySelector('#endButton').style.display = 'block';

        startCallTimer();
    });

    document.querySelector('#endButton').addEventListener('click', function() {
        stopCallTimer();
        document.querySelector('.call-status').textContent = 'Chamada encerrada';
        document.querySelector('#endButton').style.display = 'none';
    });
</script>
