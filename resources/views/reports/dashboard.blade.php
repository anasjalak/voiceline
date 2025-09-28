<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calls Per Users Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

  <style>
    canvas {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 20px;
      margin-top: 30px;
      margin-left: 20px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
    }

    #circleChart, #solvedChart, #receivedChart {
      margin: auto;
      display: block;
      margin: 40px auto;
      max-width: 300px;
      position: relative;
      z-index: 10;
    }

    .container h5 {
      margin-top: 20px;
      margin-left: 20px;
      color: #EC8305;
    }

    .table thead.custom-header th {
      background-color: #EC8305 !important;
      color: #ffffff !important;
      border-color: rgba(0,0,0,0.08) !important;
      vertical-align: middle;
      font-weight: 600;
      text-align: center;
    }
  </style>
</head>
<body>
    <ul style="list-style:none; padding:0;">
  <li><a href="/reports">📦 تقرير الأصناف</a></li>
  <li><a href="/reports/calls-per-user">👤 تقرير المستخدمين</a></li>
</ul>
  <div class="container mt-4">
    <h5>Calls Per Users Report:</h5>

    <!-- Filter Form -->
    <form id="filterForm">
      <label for="period">Days/Duration:</label>
      <select name="period" id="period">
        <option value="">-- Select --</option>
        <option value="week">this week</option>
        <option value="month">this month</option>
        <option value="last_month">last month</option>
        <option value="custom">custom days</option>
      </select>

      <div id="custom-range" style="margin-top:10px; display:none">
        From: <input type="date" name="from" id="from">
        To: <input type="date" name="to" id="to">
        <button type="button" id="filterBtn">search</button>
      </div>
    </form>
     
    <!-- Charts -->
    <div class="container mt-4">
      <div class="row text-center">
        <div class="col-md-4">
          <canvas id="circleChart"></canvas>
          <p>All Calls</p>
        </div>
        <div class="col-md-4">
          <canvas id="receivedChart"></canvas>
          <p>Submitted</p>
        </div>
        <div class="col-md-4">
          <canvas id="solvedChart"></canvas>
          <p>Escalated</p>
        </div>
        
            <div class="col-md-4">
      <canvas id="resolvedChart"></canvas>
      <p>Resolved</p>
    </div>
      </div>
     
    </div>

    <!-- Table -->
    <table id="reportTable" class="table table-striped table-bordered text-center">
      <thead class="custom-header">
        <tr>
          <th>User</th>
          <th>Received Calls</th>
          <th>Resolved</th>
          <th>Submitted</th>
          <th>Escalated</th>
 
         
        </tr>
      </thead>
      <tbody>
        @foreach($report as $row)
        <tr>
          <td>{{ $row->name }}</td>
          <td>{{ $row->Received_Calls }}</td>
          <td>{{ $row->Resolved }}</td>
                    <td>{{ $row->Submitted }}</td>
                    <td>{{ $row->Escalated }}</td>
       
           
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
     
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let periodSelect = document.getElementById("period");
      let customRange = document.getElementById("custom-range");
      let filterBtn = document.getElementById("filterBtn");

      const ctxAll = document.getElementById('circleChart').getContext('2d');
      const ctxReceived = document.getElementById('receivedChart').getContext('2d');
      const ctxSolved = document.getElementById('solvedChart').getContext('2d');
   const ctxResolved = document.getElementById('resolvedChart').getContext('2d');
      const colors = ["#FF6384","#36A2EB","#FFCE56","#4BC0C0","#9966FF","#FF9F40"];

      const chartOptions = {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
          datalabels: {
            color: '#000',
            font: { weight: 'bold' },
            formatter: (value, context) => {
              const dataset = context.chart.data.datasets[0].data;
              const total = dataset.reduce((sum, val) => sum + val, 0);
              const percentage = ((value / total) * 100).toFixed(1);
              return percentage + "%";
            }
          }
        }
      };

      let chartAll, chartCompleted, chartResolved,chartScheduled;

      function renderCharts(users) {
        if (chartAll) chartAll.destroy();
        if (chartCompleted) chartCompleted.destroy();
        if (chartScheduled) chartScheduled.destroy();
 if (chartResolved) chartResolved.destroy();
        chartAll = new Chart(ctxAll, {
          type: 'doughnut',
          data: {
            labels: users.map(u => u.name),
            datasets: [{
              data: users.map(u => parseInt(u.Received_Calls)),
              backgroundColor: colors
            }]
          },
          options: chartOptions,
          plugins: [ChartDataLabels]
        });

        chartCompleted = new Chart(ctxReceived, {
          type: 'doughnut',
          data: {
            labels: users.map(u => u.name),
            datasets: [{
              data: users.map(u => parseInt(u.Submitted)),
              backgroundColor: colors
            }]
          },
          options: chartOptions,
          plugins: [ChartDataLabels]
        });
// pi chart for In_Progress
        chartScheduled = new Chart(ctxSolved, {
          type: 'doughnut',
          data: {
            labels: users.map(u => u.name),
            datasets: [{
              data: users.map(u => parseInt(u.Escalated)),
              backgroundColor: colors
            }]
          },
          options: chartOptions,
          plugins: [ChartDataLabels]
        });
        chartResolved = new Chart(ctxResolved, {
    type: 'doughnut',
    data: {
      labels: users.map(u => u.name),
      datasets: [{
        data: users.map(u => parseInt(u.Resolved)),
        backgroundColor: colors
      }]
    },
    options: chartOptions,
    plugins: [ChartDataLabels]
  });
      }

      function loadReport() {
        let period = periodSelect.value;
        let from = document.getElementById("from").value;
        let to = document.getElementById("to").value;

        let url = "{{ route('dashboard.data') }}" + "?period=" + period;
        if (period === "custom") {
          url += "&from=" + from + "&to=" + to;
        }

        fetch(url)
          .then(response => response.json())
          .then(data => {
             
            let tbody = document.querySelector("#reportTable tbody");
            tbody.innerHTML = "";
            data.forEach(row => {
              tbody.innerHTML += `
                <tr>
                  <td>${row.name}</td>
                  <td>${row.Received_Calls}</td>
                   <td>${row.Resolved}</td>
                  <td>${row.Submitted}</td>
                  <td>${row.Escalated}</td>
                  
               
        
               
                </tr>`;
            });

            // عشان نغذي او نملى الجارت
            renderCharts(data);
          });
      }

      
      periodSelect.addEventListener("change", function() {
        if (this.value === "custom") {
          customRange.style.display = "block";
        } else {
          customRange.style.display = "none";
          loadReport();
        }
      });

      filterBtn.addEventListener("click", function() {
        loadReport();
      });

      
      loadReport();
    });
  </script>
</body>
</html>
