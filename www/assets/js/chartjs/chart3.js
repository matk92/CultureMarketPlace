const productCategoryData = [
  { category: 'Electronics', sales: 120 },
  { category: 'Books', sales: 150 },
  { category: 'Clothing', sales: 170 },
  { category: 'Food', sales: 180 },
  { category: 'Furniture', sales: 200 },
];

const ctx = document.getElementById('myChart3').getContext('2d');
const myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: productCategoryData.map(data => data.category),
    datasets: [{
      label: 'Categories de produits vendus',
      data: productCategoryData.map(data => data.sales),
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)'
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