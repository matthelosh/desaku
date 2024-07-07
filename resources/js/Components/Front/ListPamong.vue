<script setup>
import { ref, computed } from 'vue'


</script>

<template>
<el-carousel :interval="4000" type="card" height="230px" indicator-position="none">
    <el-carousel-item v-for="item in 6" :key="item" class="h-full relative">
        <img src="/img/pamong.jpg" alt="Foto Pamong">
        <h1 class="w-full absolute bottom-0 text-center p-2 bg-slate-400 text-white">Pamong {{ item }}</h1>
    </el-carousel-item>
</el-carousel>
</template>

<style scoped>
.el-carousel__item h3 {
  color: #475669;
  opacity: 0.75;
  line-height: 200px;
  margin: 0;
  text-align: center;
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}
</style>