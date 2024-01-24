const salesData = [
  { month: 'January', sales: 120 },
  { month: 'February', sales: 150 },
  { month: 'March', sales: 170 },
  { month: 'April', sales: 180 },
  { month: 'May', sales: 200 },
  { month: 'June', sales: 220 },
  { month: 'July', sales: 210 },
];

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