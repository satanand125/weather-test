<template>
  <!-- Weather Reports and Statistics section -->
  <div class="row content">
    <!-- Weather Reports section -->
    <div class="row col-md-6">
      <h2 class="heading">Weather Reports</h2>
      <div v-for="(city, index) in cities" :key="index" class="col-md-4 mt-2">
        <Cards :city="city.value" :region="city.label" :temperature="city.temperature" />
      </div>
    </div>

    <!-- Statistics section -->
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-8">
          <h2 class="heading">Statistics</h2>
        </div>
        <div class="col-md-4">
          <!-- Dropdown to select city -->
          <select class="form-select" v-model="selectedCity" @change="handleSelectChange">
            <option
              v-for="option in cities"
              :key="option.value"
              :value="option.value"
            >{{ option.label }}</option>
          </select>
        </div>
      </div>

      <!-- Display weather charts for the selected city -->
      <div v-if="selectedCity">
        <div class="row" v-for="(chart, index) in charts" :key="index">
          <div class="heading-graph">{{ chart.title }} (Last 24 Hours)</div>
          <div v-if="chart.component">
            <component :is="chart.component" :chart="chart.data" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Cards from "./Cards.vue";
import HumidityChart from "./HumidityChart.vue";
import TemperatureChart from "./TemperatureChart.vue";
import WindChart from "./WindChart.vue";
import axios from "axios";

export default {
  name: "WeatherView",
  components: {
    Cards,
    TemperatureChart,
    WindChart,
    HumidityChart,
  },
  data() {
    return {
      selectedCity: "Dubai",
      cities: [],
      charts: []
    };
  },
  mounted() {
    this.fetchData(this.selectedCity);
    this.fetchWeatherData();

    // Automatically fetch weather data and charts data every 10 min
    setInterval(() => {
      this.fetchData(this.selectedCity);
    }, 600000);

    setInterval(() => {
      this.fetchWeatherData();
    }, 600000);
  },
  methods: {
    // Method to fetch weather data for all cities
    async fetchWeatherData() {
      await axios
        .get("http://localhost:8000/api/weatherBycity")
        .then(response => {
          const currentData = response.data.data;
          if (Array.isArray(currentData)) {
            this.cities = currentData.map(cityData => ({
              value: cityData.city,
              label: `${cityData.city}`,
              temperature: cityData.temperature
            }));
            if (this.cities.length > 0) {
              this.selectedCity = this.cities[0].value;
              this.fetchData(this.selectedCity);
            }
          }
        })
        .catch(error => {
          console.error("Error fetching weather data. An error occurred while retrieving weather data from the server:", error);
        });
    },

    // Method to fetch weather charts data for the selected city
    async fetchData(selectedCity) {
      await axios
        .get(`http://localhost:8000/api/weatherByHours/${selectedCity}`)
        .then(response => {
          const apiData = response.data.data;
          this.charts = [
            {
              title: "Temperature",
              component: "TemperatureChart",
              data: apiData.temp_data
            },
            {
              title: "Wind",
              component: "WindChart",
              data: apiData.wSpeed_data
            },
            {
              title: "Humidity",
              component: "HumidityChart",
              data: apiData.humidity_data
            }
          ];
        });
    },

    // Method to handle city selection change
    handleSelectChange() {
      this.fetchData(this.selectedCity);
    }
  }
};
</script>

<style scoped>
.content {
  padding-top: 1%;
}

.heading {
  color: #000;
  font-weight: 500;
  font-size: 20px;
}

.perc-value {
  align-content: center;
  justify-content: center !important;
  flex-wrap: wrap;
  display: flex;
}

.heading-graph {
  font-size: 18px;
  color: rgb(51, 51, 51);
  font-weight: bold;
  fill: rgb(51, 51, 51);
}
</style>
