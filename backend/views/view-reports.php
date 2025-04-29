<h2>Reports Dashboard</h2>

<section class="report-cards">
  <div class="card">Total Sales: ₹50,000</div>
  <div class="card">Orders Today: 27</div>
  <div class="card">New Users This Week: 34</div>
</section>

<section class="charts">
  <canvas id="salesChart"></canvas>
  <canvas id="userChart"></canvas>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Example chart
const ctx = document.getElementById('salesChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed'],
        datasets: [{
            label: 'Sales (₹)',
            data: [10000, 15000, 12000],
            borderColor: 'green',
            fill: false
        }]
    }
});
</script>
