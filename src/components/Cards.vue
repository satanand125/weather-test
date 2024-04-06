<template>
    <!-- Container for cards -->
    <div class="card">
        <div class="card-body">
            <div class="card-title m-0">{{ city }}</div>
            <div class="card-title-region">UAE</div>
            <div class="cloud-image">
                <img src="../assets/image/cloud-night.png" alt="" class="image-class">
            </div>
            <div class="temp d-flex justify-content-center">
                <span class="temp-class">{{temperature}}</span> <span class="degree-class">°</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "CardsView",
  props: {
    city: String,
    region: String,
    temperature: String
  },

};
</script>

<style>

.card {
    border-radius: 23px !important;
    background: #726497 !important;
    color: white !important;
    height: 38vh !important;
    width: 12vw !important;
}

.card-title {
    font-weight: 400 !important;
    font-size: 1.4em;
}

.card-title-region {
    font-weight: 200 !important;
    font-size: 15px;
}

.card-body {
    padding: 10% !important;
}

.cloud-image {
    display: flex;
    justify-content: center;
}

.image-class {
    width: auto;
    height: 15vh;
}

.temp-class {
    font-size: 2.6em;
    font-weight: bold;
    display: flex;
    color: #d3cddf;
    justify-content: center;
}

.degree-class {
    color: #8497c9;
    font-size: 3.5em;
    font-weight: 400;
    line-height: 54px;
}

</style>