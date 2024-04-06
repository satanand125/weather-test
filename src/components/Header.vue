<!-- Header Container -->
<template>
    <nav class="navbar navbar-lightbg-light">
        <div class="col-md-1 d-flex justify-content-center">
            <div class="img">
                <img height="40px" width="40px"  src="../assets/image/logo.png" alt="">
            </div>
        </div>
        <div class="col-md-11 d-flex justify-content-end align-items-center">
            <div class="profile-circle">
                <img src="../assets/image/icon-img.png" alt="" height="40px">
            </div>
        </div>
    </nav>
</template>

<script>
export default {
  name: "HeaderView",
};
</script>

<style>
.navbar {
    border-bottom: 1px solid #e4d8d8;
    height: 7% !important;
    display: flex;
    width: 100vw;
}

.profile-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #ccc;
  position: absolute;
  right: 2%;
}

.img {
    padding-right: 20%;
}
</style>