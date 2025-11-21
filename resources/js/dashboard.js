import Chart from 'chart.js/auto';

document.addEventListener("DOMContentLoaded", function() {
    
    // Kunin ang API URL mula sa hidden input o meta tag (kasi hindi gagana ang Blade {{ }} dito)
    const apiUrl = document.getElementById('chart-data-url').value;

    // 1. INITIALIZE CHARTS
    
    // Bar Chart
    const ctxMain = document.getElementById('mainChart').getContext('2d');
    let mainChart = new Chart(ctxMain, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Count / Stock Level',
                data: [],
                backgroundColor: '#B0DB9C',
                borderColor: '#8AB973',
                borderWidth: 1,
                borderRadius: 4,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });

    // Doughnut Chart
    const ctxStock = document.getElementById('stockChart').getContext('2d');
    let stockChart = new Chart(ctxStock, {
        type: 'doughnut',
        data: {
            labels: ['Healthy Stock', 'Low Stock'],
            datasets: [{
                data: [],
                backgroundColor: ['#D1E7DD', '#F8D7DA'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // 2. FUNCTION TO FETCH & UPDATE DATA
    function updateCharts(categoryId = 'all') {
        fetch(`${apiUrl}?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                // Update Bar Chart
                mainChart.data.labels = data.labels;
                mainChart.data.datasets[0].data = data.data;
                
                if(categoryId === 'all') {
                    mainChart.data.datasets[0].label = 'Number of Products';
                } else {
                    mainChart.data.datasets[0].label = 'Current Stock Level';
                }
                mainChart.update();

                // Update Doughnut Chart
                stockChart.data.datasets[0].data = data.stockHealth;
                stockChart.update();
            })
            .catch(error => console.error('Error fetching chart data:', error));
    }

    // 3. LOAD INITIAL DATA
    updateCharts('all');

    // 4. EVENT LISTENER FOR DROPDOWN
    const filterDropdown = document.getElementById('categoryFilter');
    if(filterDropdown) {
        filterDropdown.addEventListener('change', function() {
            updateCharts(this.value);
        });
    }
});