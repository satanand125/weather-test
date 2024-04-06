<!-- Dashboard Container -->
<template>
  <div>
    <div class="row m-0">
      <Header />
    </div>
    <div class="row m-0 p-0">
      <div class="col-md-1 p-0">
        <Navbar />
      </div>
      <div class="col-md-11">
        <weather/>
      </div>
    </div>
  </div>
</template>

<script>
import Header from './Header.vue';
import Navbar from './Navbar.vue';
import Weather from './Weather.vue';

export default {
  name: 'DashboardView',
  components: {
    Navbar,
    Header,
    Weather
  }
}
</script>