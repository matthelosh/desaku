<script setup>
import { ref, computed } from 'vue'
import {usePage, Head, Link, router} from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { onHeaderStuck } from '@/helpers/front'
import Header from '@/Components/Front/Header.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import Footer from '@/Components/Front/Footer.vue'
const page = usePage()

const filter = ref('')

const showDetail = (item) => {
    router.get(route('front.pamong.detail', {nik: item.nik}))
}

</script>

<template>
    <Head>
        <title>Perangkat Desa Samar Tulungagung</title>
        <meta name="description" content="Daftar Perangkat Desa Samar Kecamatan Pagerwojo Kabupaten Tulungagung" />
    </Head>
    <div class="page bg-sky-200">
        <el-affix @change="onHeaderStuck">
            <Header />
        </el-affix>
        
        <main class="bg-sky-100 py-8">
            <el-container>
                <el-row justify="center" class="w-full">
                    <el-col :span="16" :xs=24>
                        <el-row class="w-full">
                            <el-col class="bg-sky-200 h-10 p-2">
                                <el-breadcrumb class="h-full flex items-center text-white">
                                    <el-breadcrumb-item :to="{path: '/'}">
                                        <template #default>
                                            <Link class="flex" :href="route('front.home')">
                                                <Icon icon="mdi:home" class="text-md" />
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                    <el-breadcrumb-item :to="{path: '/berita'}">
                                        <template #default>
                                            <Link class="flex" :href="`/berita`">
                                                Perangkat Desa
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        <div class="cover w-full h-[350px] relative">
                            <img src="/img/balai.jpg" alt="Cover" class="h-full w-full saturate-100 contrast-50  object-cover" />
                            <div class="overlay absolute top-0 right-0 bottom-0 left-0 bg-orange-100 flex items-center justify-center bg-opacity-50 mix-blend-overlay">
                                <div class="text-center  p-4">
                                    <h1 class="text-4xl font-bold uppercase tracking-wide font-serif">Perangkat Desa Samar</h1>
                                    <span class="text-xl">Kecamatan Pagerwojo</span>
                                </div>
                            </div>
                        </div>
                    </el-col>
                </el-row>
            </el-container>
            <el-row justify="center" class="w-full">
                <el-col :span="16" :xs="24" class="bg-white p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div v-for="pamong in page.props.pamongs" :key="pamong.id" class="card grid grid-cols-8 border-3 border-black rounded-lg overflow-hidden shadow bg-gradient-to-r from-blue-800 to-indigo-800 h-[200px] md:h-[250px] shadow hover:shadow-lg transition-all hover:scale-105 hover:cursor-pointer ease-in-out duration-300" @click="showDetail(pamong)">
                            <div class="foto col-span-3">
                                <img :src="pamong.foto" alt="Foto Pamong" class="object-cover object-center h-full w-full">
                            </div>
                            <div class="detail col-span-5 py-2 px-3 text-yellow-400">
                                <h2 class="mb-2 text-xl md:text-2xl font-black tracking-wider">{{ pamong.nama }}</h2>
                                <table class="text-xs md:text-sm">
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>Kepala Desa</td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>{{ pamong.nip ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top">Alamat</td>
                                        <td class="align-top">:</td>
                                        <td>{{ pamong.alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top">No. HP</td>
                                        <td class="align-top">:</td>
                                        <td>{{ pamong.hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top">Email</td>
                                        <td class="align-top">:</td>
                                        <td>{{ pamong.email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </el-col>
            </el-row>
        </main>
        <Kontak />  
        <Footer />
    </div>
</template>