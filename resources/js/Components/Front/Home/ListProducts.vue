<script setup>
import { Icon } from '@iconify/vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage()

const products = page.props.products
</script>

<template>
    <!-- {{ page.props.products }} -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="card bg-white relative h-[250px] hover:scale-105 ease-in-out duration-300 transition-all hover:shadow" v-for="(product, p) in products" :key="p">
            <img :src="product.foto" alt="Gambar Produk" class="w-full h-[250px] object-cover object-bottom mix-blend-multiply">
            <div class="card-overlay absolute p-2 bottom-0 bg-gradient-to-t from-black to-[#ffffff34] h-full flex items-end">
                <div class="h-[50%]">
                    <h3 class="text-white uppercase font-bold">{{ product.nama }}</h3>
                    <p class="leading-4 text-white" v-html="product.deskripsi.substring(0,100)"></p>
                    <div class="card-footer text-white border-t p-2 flex items-center justify-between">
                        <el-button type="success" size="small">Pesan</el-button>
                        <div class="tag-price flex items-center gap-1">
                            <small>{{ product.harga }}</small>
                            <Icon icon="mdi:tag-outline" class="text-sky-500" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>