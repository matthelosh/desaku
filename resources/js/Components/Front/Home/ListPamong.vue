<script setup>
import { ref, computed } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'

const page = usePage()

</script>

<template>
<el-carousel :interval="4000" type="card" height="230px" indicator-position="none">
    <el-carousel-item v-for="(pamong, p) in page.props.pamongs" :key="p" class="h-full relative">
        <img src="/img/pamong.jpg" alt="Foto Pamong">
        <Link :href="`/pamong/detail/${pamong.nik}`">
          <h1 class="w-full leading-4 absolute bottom-0 text-center p-2 bg-slate-400 text-white">
            <span class="underline">{{ pamong.gelar_depan ?? '' }} {{ pamong.nama }}, {{ pamong.gelar_belakang ?? '' }} </span><br>
            <small class="uppercase">Jabatan</small>
          </h1>
        </Link>
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