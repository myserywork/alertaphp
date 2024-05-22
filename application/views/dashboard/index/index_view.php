<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .dashboard-header {
            text-align: center;
            margin-bottom: 2em;
        }

        .dashboard-header h1 {
            color: #6d7982;
            font-weight: 500;
            margin-top: 10px;
        }

        .card {
            margin-bottom: 1.5em;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .chart-container {
            padding: 20px;
        }

        .chart-title {
            margin-bottom: 1.5em;
            color: #6d7982;
            font-weight: 500;
        }

        .row {
            margin-top: 1em;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="dashboard-header">
            <h1>Dashboard Hospitalar</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Total de Pacientes</div>
                    <div class="card-body">
                        <h2 class="card-title text-center"><?= $data['total_pacientes'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Distribuição por Gênero</div>
                    <div class="card-body chart-container">
                        <div id="genero-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Distribuição de Doenças Crônicas</div>
                    <div class="card-body chart-container">
                        <div id="doencas-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Distribuição por Faixa Etária</div>
                    <div class="card-body chart-container">
                        <div id="age-group-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var generoData = <?= json_encode($data['genero_distribution']) ?>;
            var generoCategories = generoData.map(function(item) { return item.genero; });
            var generoCounts = generoData.map(function(item) { return item.count; });

            var generoChart = new ApexCharts(document.querySelector("#genero-chart"), {
                chart: {
                    type: 'pie',
                    toolbar: {
                        show: false
                    }
                },
                series: generoCounts,
                labels: generoCategories,
                colors: ['#007bff', '#28a745', '#ffc107']
            });

            generoChart.render();

            var doencasData = <?= json_encode($data['doencas_distribution']) ?>;
            var doencasCategories = doencasData.map(function(item) { return item.nome; });
            var doencasCounts = doencasData.map(function(item) { return item.count; });

            var doencasChart = new ApexCharts(document.querySelector("#doencas-chart"), {
                chart: {
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Doenças',
                    data: doencasCounts
                }],
                xaxis: {
                    categories: doencasCategories,
                    labels: {
                        style: {
                            colors: '#6d7982',
                            fontWeight: '500'
                        }
                    }
                },
                colors: ['#dc3545']
            });

            doencasChart.render();

            var ageGroupData = <?= json_encode($data['age_group_distribution']) ?>;
            var ageGroupCategories = ageGroupData.map(function(item) { return item.age_group; });
            var ageGroupCounts = ageGroupData.map(function(item) { return item.count; });

            var ageGroupChart = new ApexCharts(document.querySelector("#age-group-chart"), {
                chart: {
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Pacientes',
                    data: ageGroupCounts
                }],
                xaxis: {
                    categories: ageGroupCategories,
                    labels: {
                        style: {
                            colors: '#6d7982',
                            fontWeight: '500'
                        }
                    }
                },
                colors: ['#17a2b8']
            });

            ageGroupChart.render();
        });
    </script>
</body>

</html>
