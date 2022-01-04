<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MK Grafika Komputer & Visualisasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        
        .chartMenu {
            width: 100vw;
            height: 40px;
            background: #1A1A1A;
            color: rgba(255, 26, 104, 1);
        }
        
        .chartMenu p {
            padding: 10px;
            font-size: 20px;
        }
        
        .chartCard {
            width: 100vw;
            height: calc(100vh - 40px);
            background: rgba(32, 30, 31, 0.884);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chartBox {
            width: 1000px;
            padding: 20px;
            border-radius: 20px;
            border: solid 3px rgb(73, 71, 71);
            background: white;
        }
    </style>
</head>

<body>
    <div class="chartCard">
        <div class="chartBox">
            <canvas id="myChart"></canvas>
            <button onclick="updateChart()">Fetch Data JS</button>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fetch Block
        function updateChart() {
            async function fetchData() {
                const url = 'http://localhost/UAS/financialreport.json';
                const response = await fetch(url);
                // wait until the request has been completed
                const datapoints = await response.json();
                console.log(datapoints);
                return datapoints;
            };

            fetchData().then(datapoints => {
                const month = datapoints.financialreport[0].financial.map(
                    function(index) {
                        return index.month;
                    })
                const sale = datapoints.financialreport[0].financial.map(
                    function(index) {
                        return index.sale;
                    })
                const mounthlysales = datapoints.financialreport.map(
                    function(index) {
                        return index.mounthlysales;
                    })

                console.log(mounthlysales);
                //console.log(revenue);
                myChart.config.data.datasets[0].label = mounthlysales;
                myChart.config.data.labels = month;
                myChart.config.data.datasets[0].data = sale;
                myChart.update();
            });
        }

        // setup 
        const data = {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Weekly Sales',
                data: [18, 12, 6, 9, 12, 3, 9],
                backgroundColor: [
                    '#48120E',
                    '#AB3E16',
                    '#EFAA52',
                    '#E7CC8F',
                    '#F8F3E6',
                    '#DDE2E3',
                    '#9AACB8'
                ],
                borderColor: [
                    '#48120E',
                    '#AB3E16',
                    '#EFAA52',
                    '#E7CC8F',
                    '#F8F3E6',
                    '#DDE2E3',
                    '#9AACB8'
                ],
                borderWidth: 1
            }]
        };

        // config 
        const config = {
            type: 'bar',
            data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // render init block
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

</body>

</html>