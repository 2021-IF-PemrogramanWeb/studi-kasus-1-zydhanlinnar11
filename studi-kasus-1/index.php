<?php

session_start();

if(!($_SESSION["loggedin"] ?? false)) {
    header('location: /studi-kasus-1/login');
    exit;
}

require_once "./config.php";
$sql = "SELECT * FROM JML_MHS WHERE 1";
if(($statement = mysqli_prepare($link, $sql)) === false) {
    header("location: /studi-kasus-1/");
    $_SESSION["warning"] = "Internal error";
    exit;
}
if (!mysqli_stmt_execute($statement)) {
    header("location: /studi-kasus-1/");
    $_SESSION["warning"] = "Internal error";
    mysqli_stmt_close($statement);
    exit;
}
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $id, $period, $val);
$result = [];
while (mysqli_stmt_fetch($statement)) {
    array_push($result, ['id' => $id, 'period' => $period, 'value' => $val]);
}
// var_dump(json_encode($result));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js" integrity="sha256-bC3LCZCwKeehY6T4fFi9VfOU0gztUa+S4cnkIhVPZ5E=" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/studi-kasus-1">Pemrograman Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="chart-nav" onclick="showChart()">Chart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#" id="table-nav" onclick="showTable()">Table</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/studi-kasus-1/logout">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="chart-container">
        <div class="d-flex justify-content-center">
            <h3 class="mx-auto">Grafik</h3>
        </div>
        <div class="d-flex justify-content-center">
            <div class="chart-container" style="position: relative; width:80vw">
                <canvas id="myChart" data-json="<?php echo htmlspecialchars(json_encode($result)) ?>"></canvas>
            </div>
        </div>
    </div>
    <div id="table-container" class="d-none">
        <div class="d-flex justify-content-center">
            <h3 class="mx-auto">Tabel</h3>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table" style="position: relative; width:80vw">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($result as $row) { ?>
                    <tr>
                <?php
                    echo '<th scope="row">' . $row['id'] . '</th>';
                    echo '<td>' . $row['period'] . '</td>';
                    echo '<td>' . $row['value'] . '</td>';
                ?>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const backgroundColor = [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ];
        const borderColor = [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ];

        const datas = JSON.parse(document.getElementById('myChart').dataset["json"])
        const chartBackground = []
        const chartBorder = []
        const chartLabels = []
        const chartValues = []
        datas.forEach(data => {
            chartBackground.push(backgroundColor[data.id % backgroundColor.length])
            chartBorder.push(borderColor[data.id % borderColor.length])
            chartLabels.push(data.period)
            chartValues.push(data.value)
        })
        // console.log()

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah mahasiswa S1 Teknik Informatika ITS',
                    data: chartValues,
                    backgroundColor: chartBackground,
                    borderColor: chartBorder,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const navTable = document.getElementById('table-nav')
        const navChart = document.getElementById('chart-nav')
        const tableContainer = document.getElementById('table-container')
        const chartContainer = document.getElementById('chart-container')

        function showTable() {
            navTable.classList.add("active")
            navChart.classList.remove("active")
            tableContainer.classList.remove("d-none")
            chartContainer.classList.add("d-none")
        }

        function showChart() {
            navChart.classList.add("active")
            navTable.classList.remove("active")
            chartContainer.classList.remove("d-none")
            tableContainer.classList.add("d-none")
        }
    </script>
</body>
</html>
