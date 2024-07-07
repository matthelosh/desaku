<script setup>
import { Icon } from '@iconify/vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage()

const products = page.props.products
</script>

<template>
    <!-- {{ page.props.products }} -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="card bg-white hover:scale-105 ease-in-out duration-300 transition-all hover:shadow" v-for="(product, p) in products" :key="p">
            <img :src="product.foto" alt="Gambar Produk" class="w-full h-[200px] object-cover">
            <div class="card-body p-2">
                <h3 class="text-sky-600 font-bold">{{ product.nama }}</h3>
                <p class="leading-4" v-html="product.deskripsi.substring(0,200)"></p>
            </div>
            <div class="card-footer border-t p-2 flex items-center justify-between">
                <el-button type="success" size="small">Pesan</el-button>
                <div class="tag-price flex items-center gap-1">
                    <small>{{ product.harga }}</small>
                    <Icon icon="mdi:tag-outline" class="text-sky-500" />
                </div>
            </div>
        </div>
    </div>
</template>