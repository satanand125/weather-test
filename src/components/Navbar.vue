<template>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" id="sidebar">
                <li>
                    <a>
                        <span class="icon">
                            <img src="../assets/icons-svg/home-225.svg" alt="">
                        </span>
                    </a>
                </li>
                <li class="last-item">
                    <a>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#202020" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
                            </svg>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
  name: "NavBar",
};
</script>

<style>
.row {
  margin-left: 0px;
  margin-right: 0px;
}

#sidebar {
    display: grid;
    grid-template-columns: 1fr;
    grid-auto-rows: minmax(100px, auto);
}

#sidebar-wrapper {
  background: #fff;
  position: fixed;
  height: 100vh;
  width: 95px;
  border-right: 1px solid #e4d8d8;
}

.last-item {
    position: absolute;
    bottom: 12%;
}

.sidebar-nav {
  list-style: none;
  margin: 0;
  padding: 0;
}

.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}

.icon {
  float: right;
  padding-right: 60px;
}
</style>
