<template>
  <div id="chart-container-humidity"></div>
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
      const filteredData = this.chart.filter(item => item.humidity !== null);

      const chartData = filteredData.map(item => ({
        name: item.start_time,
        y: parseFloat(item.humidity)
      }));

      Highcharts.chart("chart-container-humidity", {
        credits: {
          enabled: false,
        },
        chart: {
          type: "column",
        },
        title: {
          align: "left",
          text: "",
        },
        accessibility: {
          announceNewData: {
            enabled: true,
          },
        },
        xAxis: {
          type: "category",
        },
        yAxis: {
          title: {
            text: "",
          },
          labels: {
            enabled: false,
          },
        },
        legend: {
          enabled: false,
        },
        plotOptions: {
          series: {
            borderWidth: 0,
          },
          column: {
            groupPadding: 0.1,
            pointPadding: 0,
          },
        },
        tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
        },
        series: [
          {
            name: "Humidity",
            color: "#7947f7",
            data: chartData,
          },
        ],
        drilldown: {
          breadcrumbs: {
            position: {
              align: "right",
            },
          },
        },
      });
    }
  }
};
</script>

<style>
#chart-container-humidity {
  height: 23vh;
}
</style>
