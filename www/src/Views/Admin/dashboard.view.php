<div class="chart-container row row-between">
    <div class="column">
        <canvas id="myChart1"></canvas>
        <canvas id="myChart2"></canvas>
    </div>
    <div class="column">
        <canvas id="myChart3"></canvas>
    </div>
</div>


<!-- CHART 1 --------------------------------------------------------------------------------------- -->
<script>
    const productSalesData = <?= $productsSales ?>;

    const ctx1 = document.getElementById('myChart1').getContext('2d');
    const chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: productSalesData.map(data => data.product),
            datasets: [{
                label: 'Les produits les plus vendus',
                data: productSalesData.map(data => data.sales),
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
<!-- CHART 2 --------------------------------------------------------------------------------------- -->
<script>
    const salesData = <?= $salesByMonth ?>;

    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: salesData.map(data => data.month),
            datasets: [{
                label: 'Ventes par mois',
                data: salesData.map(data => data.sales),
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
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
<!-- CHART 3 --------------------------------------------------------------------------------------- -->
<script>
    const productCategoryData = <?= $salesByCategory ?>;;

    const ctx = document.getElementById('myChart3').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: productCategoryData.map(data => data.category),
            datasets: [{
                label: 'Ventes',
                data: productCategoryData.map(data => data.sales),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(0, 0, 255, 0.2)',
                    'rgba(255, 0, 255, 0.2)',
                    'rgba(0, 255, 0, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 255, 0, 0.2)',
                    'rgba(255, 0, 0, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(0, 255, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(0, 0, 255, 1)',
                    'rgba(255, 0, 255, 1)',
                    'rgba(0, 255, 0, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 255, 0, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(0, 255, 255, 1)',
                ],
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