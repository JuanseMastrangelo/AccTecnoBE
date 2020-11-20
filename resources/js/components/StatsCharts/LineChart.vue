<script>
  import { Line } from 'vue-chartjs'

  export default {
    extends: Line,
    data () {
      return {
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
    methods: {
        drawChart: function (data, labels) {
            const chartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Ventas',
                        data: data,
                        // fill: false,
                        color: '#2554FF',
                        backgroundColor: this.hexToRgba('#2554FF', .2),
                        borderColor: '#2554FF',
                        borderWidth: 1.5,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderWidth: 1.5,
                        pointRadius: 4,
                        pointHoverBackgroundColor: '#2554FF',
                        pointHoverBorderColor: '#FFFFFF',
                        pointHoverRadius: 7,
                    }
                ]
            }
            this.renderChart(chartData, this.options);
        },
        hexToRgba: function (hex, alpha) {
          var r = parseInt(hex.slice(1, 3), 16),
              g = parseInt(hex.slice(3, 5), 16),
              b = parseInt(hex.slice(5, 7), 16);

          if (alpha) {
              return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
          } else {
              return "rgb(" + r + ", " + g + ", " + b + ")";
          }
        }
    }
  }
</script>