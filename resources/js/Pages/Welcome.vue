<script setup>
import { ref, computed } from 'vue'
import { Head, Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';

import Header from '@/Components/Front/Header.vue'
import Hero from '@/Components/Front/Home/Hero.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import ListPosts from '@/Components/Front/Home/ListPosts.vue'
import ListInfos from '@/Components/Front/Home/ListInfos.vue'
import Agenda from '@/Components/Front/Home/Agenda.vue'
import CarouselPamong from '@/Components/Front/Home/ListPamong.vue'
import ListProducts from '@/Components/Front/Home/ListProducts.vue'
import ListWisata from '@/Components/Front/Home/ListWisata.vue'
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});



const onHeaderStuck = (e) => {
    const header = document.querySelector('.main-nav')
    if (e) {
        header.style.height = '60px'
        header.style.transition = 'all .35s ease-in-out'
    } else {
        header.style.height = '80px'
        header.style.transition = 'all .35s ease-in-out'
    }
}
</script>

<template>
    <Head>
        <title>Sugeng Rawuh</title>
        <meta name="description" content="Website resmi Pemerintah Desa Samar Kecamatan Pagerwojo Kabupaten Tulungagung" />
    </Head>
    <div class="common-layout h-min-screen w-screen bg-slate-100">
        <el-container>
            <div class="info w-full h-8 bg-sky-600">

            </div>
            <el-affix @change="onHeaderStuck" :offset="0">
                <Header />
            </el-affix>
            <Hero />
            <el-main>
                <el-container>
                    <el-row  justify="center" class="w-full">
                        <el-col :span="10" :xs="24" class="px-0 md:px-6">
                            <el-divider content-position="left">
                                <template #default>
                                    <Link href="/berita" class="flex items-center gap-1 text-sky-600 text-lg">
                                        <Icon icon="mdi:newspaper" />
                                        Berita Terkini
                                    </Link>
                                </template>
                            </el-divider>
                            <ListPosts />
                        </el-col>
                        <el-col :span="6" :xs="24" class="side px-0 md:px-6">
                                <!-- Pengumuman -->
                                <el-divider content-position="center">
                                    <template #default>
                                        <span class="flex items-center gap-1 text-sky-600 text-lg">
                                            <Icon icon="mdi:bell-badge" />
                                            Pengumuman
                                        </span>
                                    </template>
                                </el-divider>
                                <!-- List Pengumuman -->
                                 <ListInfos />
                                <!-- Agenda -->
                                 <div class="my-1">&nbsp;</div>
                                <el-divider content-position="center" class="mt-6">
                                    <template #default>
                                        <span class="flex items-center gap-1 text-sky-600 text-lg">
                                            <Icon icon="mdi:calendar" />
                                            Agenda Desa
                                        </span>
                                    </template>
                                </el-divider>
                                <!-- List Agenda -->
                                 <Agenda />
                                 <!-- Pamong -->
                                 <div class="my-2">&nbsp;</div>
                                <el-divider content-position="center" class="mt-6">
                                    <template #default>
                                        <Link href="/pamong">
                                            <span class="flex items-center gap-1 text-sky-600 text-lg">
                                                <Icon icon="mdi:account-tie" />
                                                Aparatur <span class="hidden md:block">Desa</span>
                                            </span>
                                        </Link>
                                    </template>
                                </el-divider>
                                <!-- List Pamong -->
                                 <div class="list-info">
                                    <CarouselPamong />
                                 </div>
                                 
                        </el-col>
                    </el-row>
                </el-container>
                <el-container>
                    <el-row class="bg-sky-100 w-full py-4 min-h-screen" justify="center">
                        <el-col :span="6" :xs="24" class="side px-0 md:px-6">
                            <el-divider content-position="center" class="mt-6">
                                <template #default>
                                    <span class="flex items-center gap-1 text-sky-600 text-lg">
                                        <Icon icon="mdi:ticket" />
                                        <span class="hidden md:block">Potensi</span> Wisata
                                    </span>
                                </template>
                            </el-divider>
                            <ListWisata />
                        </el-col>
                        <el-col :span="10" :xs="24" class="main px-0 md:px-6 my-4 md:my-0">
                            <el-divider content-position="center" class="mt-6">
                                <template #default>
                                    <span class="flex items-center gap-1 text-sky-600 text-lg">
                                        <Icon icon="mdi:shopping" />
                                        Produk <span class="hidden md:block">Unggulan</span>
                                    </span>
                                </template>
                            </el-divider>
                            <ListProducts />
                        </el-col>
                    </el-row>
                </el-container>
            </el-main>
            <Kontak />
            <el-footer class="bg-sky-700 h-auto flex items-center text-white justify-center md:justify-between">
                    <div>
                        &copy; {{ new Date().getFullYear() }} Pemerintah Desa Samar
                    </div>
                    <div class="hidden md:block">
                        <p>Dipersembahkan oleh:</p>
                        <p>Program pengabdian masyarakat Universitas Negeri Malang (UM)</p>
                    </div>
            </el-footer>
        </el-container>
        
        <el-backtop :right="50" :bottom="20" />
    </div>
</template>

<style>


</style>
