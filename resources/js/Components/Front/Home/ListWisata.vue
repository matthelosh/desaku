<script setup>
import { Icon } from '@iconify/vue';
</script>

<template>
    <div class="grid grid-cols-1 gap-2">
        <div class="card bg-white hover:scale-105 ease-in-out duration-300 transition-all" v-for="p in 4" :key="p">
            <img src="/img/wisata-1.jpg" alt="Gambar Produk" class="w-full h-[200px] object-cover">
            <div class="card-body p-2">
                <h3 class="text-sky-600 font-bold">Wisata #{{ p }}</h3>
                <p class="leading-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
            </div>
            <div class="card-footer border-t p-2 flex items-center justify-between">
                <el-button type="success" size="small">
                    <Icon icon="mdi:ticket" class="text-lg mr-1" />
                    Pesan Tiket
                </el-button>
                <div class="tag-price flex items-center gap-1">
                    <small>Rp. 12.000</small>
                </div>
            </div>
        </div>
    </div>
</template>