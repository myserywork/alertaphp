<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts Example</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- chart 1 -->
                <canvas id="chart1" width="400" height="300"></canvas>
            </div>
            <div class="col-md-6">
                <!-- chart 2 -->
                <canvas id="chart2" width="400" height="300"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- chart 3 -->
                <canvas id="chart3" width="400" height="300"></canvas>
            </div>
            <div class="col-md-6">
                <!-- chart 4 -->
                <canvas id="chart4" width="400" height="300"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- chart 5 -->
                <canvas id="chart5" width="400" height="300"></canvas>
            </div>
            <div class="col-md-6">
                <!-- chart 6 -->
                <canvas id="chart6" width="400" height="300"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- chart 7 -->
                <canvas id="chart7" width="400" height="300"></canvas>
            </div>
            <div class="col-md-6">
                <!-- chart 8 -->
                <canvas id="chart8" width="400" height="300"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- chart 9 -->
                <canvas id="chart9" width="400" height="300"></canvas>
            </div>
            <div class="col-md-6">
                <!-- chart 10 -->
                <canvas id="chart10" width="400" height="300"></canvas>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Chart 1
            var ctx1 = document.querySelector("#chart1").getContext("2d");
            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: ["1", "2", "3", "4", "5", "6", "7", "8"],
                    datasets: [{
                        label: "Temperatura",
                        data: [10, 12, 15, 18, 21, 24, 27, 30],
                        borderColor: "blue",
                        fill: false,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Chart 2
            var ctx2 = document.querySelector("#chart2").getContext("2d");
            new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: ["1", "2", "3", "4", "5", "6", "7"],
                    datasets: [{
                        label: "Pressão arterial",
                        data: [120, 125, 130, 135, 140, 145, 150],
                        backgroundColor: "green",
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Repeat the above code for other charts (chart3, chart4, etc.) with appropriate data and options.
        });
    </script>
</body>
</html>
