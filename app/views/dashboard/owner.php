<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Owner Dashboard & ERP System</h2>
          <hr>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-3">
          <div class="card bg-primary text-white text-center p-3">
            <h3><?php echo $data['total_users']; ?></h3>
            <p>Total Users</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-success text-white text-center p-3">
            <h3><?php echo $data['total_revenue']; ?> EGP</h3>
            <p>Total Revenue</p>
          </div>
        </div>
        <div class="col-md-3">
          <a href="<?php echo URLROOT; ?>/manage_courses" class="btn btn-dark w-100 p-3">
            <i class="bi bi-journal-bookmark me-2"></i>Manage Courses
          </a>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-6">
          <h4>Weekly Financial Report</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Student</th>
                <th>Amount</th>
                <th>Gateway</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['latest_payments'] as $payment) : ?>
                <tr>
                  <td><?php echo $payment->full_name; ?></td>
                  <td><?php echo $payment->amount; ?> EGP</td>
                  <td><?php echo $payment->gateway; ?></td>
                  <td><?php echo date('Y-m-d', strtotime($payment->created_at)); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
          <h4>Traffic Performance</h4>
          <canvas id="trafficChart"></canvas>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('trafficChart').getContext('2d');
const trafficData = <?php echo json_encode($data['traffic_report']); ?>;
const labels = trafficData.map(item => item.date);
const counts = trafficData.map(item => item.count);

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'System Actions (Traffic)',
            data: counts,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
