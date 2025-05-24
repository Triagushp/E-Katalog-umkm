@extends('layouts_dashboard.app')

@section('contents')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .card-custom {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .card-header-custom {
      background-color: #f8f9fa;
      border-bottom: 1px solid #e9ecef;
    }
    .trend-up {
      color: green;
    }
    .trend-down {
      color: red;
    }
    .chart-container {
      height: 200px;
    }
    canvas {
      width: 100% !important;
      height: 200px !important;
    }
    .stat-text {
      font-size: 1.25rem;
      font-weight: bold;
    }
    .stat-small {
      font-size: 0.875rem;
      color: #6c757d;
    }
    .card-body-custom {
      padding: 1.5rem;
    }
  </style>

  <div class="container py-4">
    <div class="row g-4">
      <!-- Card Penjualan -->
      <div class="col-md-6">
        <div class="card card-custom">
          <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted">Total Penjualan</h6>
              <div class="stat-text">Rp 350K</div>
              <small class="trend-up">▲ 8.56K vs last 7 days</small>
            </div>
            <div class="text-end">
              <span class="stat-small">Last 7 days</span>
            </div>
          </div>
          <div class="card-body-custom">
            <div class="chart-container mt-3">
              <canvas id="salesChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Kunjungan -->
      <div class="col-md-6">
        <div class="card card-custom">
          <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted">Total Kunjungan</h6>
              <div class="stat-text">1600</div>
              <small class="trend-down">▼ 3% vs last 7 days</small>
            </div>
            <div class="text-end">
              <span class="stat-small">Last 7 days</span>
            </div>
          </div>
          <div class="card-body-custom">
            <div class="chart-container mt-3">
              <canvas id="visitChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Chart Penjualan
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Sales',
          data: [50, 55, 60, 65, 75, 90, 85],
          borderColor: '#3b82f6',
          backgroundColor: 'rgba(59, 130, 246, 0.1)',
          tension: 0.4,
          fill: true,
          pointRadius: 0
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          x: { display: false },
          y: { display: false }
        }
      }
    });

    // Chart Kunjungan
    const visitCtx = document.getElementById('visitChart').getContext('2d');
    new Chart(visitCtx, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Visits',
          data: [300, 250, 200, 220, 240, 260, 230],
          borderColor: '#ef4444',
          backgroundColor: 'rgba(239, 68, 68, 0.1)',
          tension: 0.4,
          fill: true,
          pointRadius: 0
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          x: { display: false },
          y: { display: false }
        }
      }
    });
  </script>
@endsection