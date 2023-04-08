@extends('../layout')
@section('content')
<h3 class="mt-4 text-center">STATISTIK PENGUNJUNG WEBSITE<br><span style="font-size:15px">Tahun 2023</span></h3>
<center>
<canvas id="myChart" style="width:100%;max-width:600px" class="mt-4"></canvas>
</center>

@section('js')
<script>
var xValues = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
var yValues = [65, 59, 80, 81, 56, 55, 40, 80, 81, 56, 55, 40];
var barColors = [
  'rgba(255, 99, 132, 0.2)',
  'rgba(255, 159, 64, 0.2)',
  'rgba(255, 205, 86, 0.2)',
  'rgba(75, 192, 192, 0.2)',
  'rgba(54, 162, 235, 0.2)',
  'rgba(153, 102, 255, 0.2)',
  'rgba(201, 203, 207, 0.2)',
  'rgba(75, 192, 192, 0.2)',
  'rgba(54, 162, 235, 0.2)',
  'rgba(153, 102, 255, 0.2)',
  'rgba(201, 203, 207, 0.2)',
  'rgba(201, 203, 207, 0.2)'
];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }],
    }
  }
});
</script>
@stop
@stop