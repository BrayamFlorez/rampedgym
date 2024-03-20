// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function crearGraficoPie(datos, etiquetas, backgroundColors, hoverBackgroundColors, idChart) {
  var ctx = document.getElementById(idChart);
  var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
      labels: etiquetas,
      datasets: [{
          data: datos,
          backgroundColor: backgroundColors,
          hoverBackgroundColor: hoverBackgroundColors,
          hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
      },
      options: {
      maintainAspectRatio: false,
      tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
      },
      legend: {
          display: false
      },
      cutoutPercentage: 80,
      },
  });
  }