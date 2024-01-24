const productSalesData = [
  { product: 'Product 1', sales: 120 },
  { product: 'Product 2', sales: 150 },
  { product: 'Product 3', sales: 170 },
  { product: 'Product 4', sales: 180 },
  { product: 'Product 5', sales: 200 },
  { product: 'Product 6', sales: 220 },
  { product: 'Product 7', sales: 210 },
];

const ctx1 = document.getElementById('myChart1').getContext('2d');
const chart1 = new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: productSalesData.map(data => data.product),
    datasets: [{
      label: 'Meilleurs ventes par produit',
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