<template>
  <div id="chart-container-temperature" class="chart-container-temperature"></div>
</template>

<script>
import Highcharts from "highcharts";

export default {
  props: {
    chart: {
      type: Array,
      required: true
    }
  },
  mounted() {
    this.renderChart();
  },
  watch: {
    chart: {
      handler() {
        this.renderChart();
      },
      deep: true
    }
  },
  methods: {
    renderChart() {
      const filteredData = this.chart.filter(item => item.temperature !== null);
      Highcharts.chart("chart-container-temperature", {
        credits: {
          enabled: false
        },
        title: {
          text: "",
          align: "left"
        },
        yAxis: {
          title: {
            text: ""
          }
        },
        xAxis: {
          type: "datetime",
          labels: {
            formatter: function() {
              return Highcharts.dateFormat("%Y-%m-%d %H:%M:%S", this.value);
            }
          }
        },
        legend: {
          layout: "vertical",
          align: "right",
          verticalAlign: "middle"
        },
        plotOptions: {
          series: {
            label: {
              connectorAllowed: false
            },
            pointStart: 0,
            marker: {
              radius: 1
            }
          }
        },
        series: [
          {
            name: "Temperature",
            data: filteredData.map(item => ({
              x: new Date(item.end_time).getTime(),
              y: parseFloat(item.temperature)
            }))
          }
        ],
        responsive: {
          rules: [
            {
              condition: {
                maxWidth: 500
              },
              chartOptions: {
                legend: {
                  enabled: false,
                }
              }
            }
          ]
        }
      });
    }
  }
};
</script>

<style scoped>
.chart-container-temperature {
  height: 23vh;
}
</style>
