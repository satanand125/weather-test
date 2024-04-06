<template>
<!-- Container for Wind Chart -->
  <div id="chart-container-wind"></div>
</template>

<script>
import Highcharts from "highcharts";
import HCMore from "highcharts/highcharts-more";
HCMore(Highcharts);

export default {
  props: {
    chart: {
      type: Array,
      required: true
    }
  },
  mounted() {
    this.renderChart();  // method for rendering chart
  },
  methods: {
    renderChart() {
      // rendering chart
      const windSpeedData = this.chart.filter(item => item.wind_speed !== null);

      const data = windSpeedData.map(item => parseFloat(item.wind_speed));
      const timeLabels = windSpeedData.map(item => item.start_time);

      Highcharts.chart("chart-container-wind", {
        // method for rendering high chart
        credits: {
          enabled: false,
        },
        title: {
          align: "left",
          text: "",
        },
        xAxis: {
          type: "category",
          categories: timeLabels,
          alignTicks: false,
        },
        yAxis: {
          title: { text: null },
          labels: {
            enabled: false,
          },
        },
        legend: {
          enabled: false,
        },
        series: [
          {
            name: "Wind",
            type: "line",
            data: data,
            marker: {
              enabled: false
            },
            color: 'rgba(255, 0, 0, 0.5)'
          }
        ],
      });
    }
  }
};
</script>

<style>
#chart-container-wind {
  height: 23vh;
}
</style>
