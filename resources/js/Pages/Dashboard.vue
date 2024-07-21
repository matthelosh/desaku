<script setup>
import DashLayout from '@/Layouts/DashLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Icon } from '@iconify/vue';

const page = usePage()
const lebar = computed(() => window.innerWidth <= 414 ? 'xs' : 'sm')
const data = computed(() => page.props.data)
</script>

<template>
    <Head title="Dashboard" />

    <DashLayout>
       <el-container>
            <el-row :gutter="lebar == 'xs' ? 0 : 20" class="w-full">
                <el-col :span="8" :xs="24">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-gradient-to-br from-red-500 to-red-400 hover:bg-gradient-to-bl h-[200px] group">
                        <template #default>
                            <div class="flex items-center justify-between relative" >
                                <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                    Kabar Desa
                                </h3>
                                <Icon icon="mdi:chart-box"  class="absolute right-0 text-white text-2xl hover:cursor-pointer hover:text-4xl transition-all duration-100 ease-in-out"/>
                            </div>
                            <h1 class="text-8xl text-center text-white relative">{{ data.posts.length }} <small class="text-2xl right-6 -ml-6">Kabar</small></h1>
                            <Icon icon="mdi:newspaper" class="text-8xl text-white opacity-60 group-hover:-translate-y-10 transition-all duration-300 ease-in-out group-hover:opacity-90 mix-blend-overlay" />
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8" :xs="24">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-gradient-to-br from-blue-500 to-blue-400 hover:bg-gradient-to-bl h-[200px] group">
                        <template #default>
                            <div class="flex items-center justify-between relative" >
                                <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                    Pengumuman
                                </h3>
                                <Icon icon="mdi:chart-box"  class="absolute right-0 text-white text-2xl hover:cursor-pointer hover:text-4xl transition-all duration-100 ease-in-out"/>
                            </div>
                            <h1 class="text-8xl text-center text-white relative">{{ data.infos.length }} <small class="text-2xl right-6 -ml-6">Info</small></h1>
                            <Icon icon="mdi:bullhorn-variant" class="text-8xl text-white opacity-60 group-hover:-translate-y-10 transition-all duration-300 ease-in-out group-hover:opacity-90 mix-blend-overlay" />
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8" :xs="24">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-gradient-to-br from-orange-500 to-orange-400 hover:bg-gradient-to-bl h-[200px] group">
                        <template #default>
                            <div class="flex items-center justify-between relative" >
                                <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                    Data Warga
                                </h3>
                                <Icon icon="mdi:chart-box"  class="absolute right-0 text-white text-2xl hover:cursor-pointer hover:text-4xl transition-all duration-100 ease-in-out"/>
                            </div>
                            <h1 class="text-8xl text-center text-white relative">{{ data.wargas.length }} <small class="text-2xl right-6 -ml-6">Jiwa</small></h1>
                            <Icon icon="mdi:human-greeting" class="text-8xl text-white opacity-60 group-hover:-translate-y-10 transition-all duration-300 ease-in-out group-hover:opacity-90 mix-blend-overlay" />
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8" :xs="24">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-gradient-to-br from-violet-500 to-violet-400 hover:bg-gradient-to-bl h-[200px] group">
                        <template #default>
                            <div class="flex items-center justify-between relative" >
                                <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                    Potensi Wisata
                                </h3>
                                <Icon icon="mdi:chart-box"  class="absolute right-0 text-white text-2xl hover:cursor-pointer hover:text-4xl transition-all duration-100 ease-in-out"/>
                            </div>
                            <h1 class="text-8xl text-center text-white relative">{{ data.wisatas.length }} <small class="text-2xl right-6 -ml-6">Tujuan</small></h1>
                            <Icon icon="mdi:beach" class="text-8xl text-white opacity-60 group-hover:-translate-y-10 transition-all duration-300 ease-in-out group-hover:opacity-90 mix-blend-overlay" />
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8" :xs="24">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-gradient-to-br from-indigo-500 to-indigo-400 hover:bg-gradient-to-bl transition-all duration-300 ease h-[200px] group">
                        <template #default>
                            <div class="flex items-center justify-between relative" >
                                <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                    Potensi Usaha
                                </h3>
                                <Icon icon="mdi:chart-box"  class="absolute right-0 text-white text-2xl hover:cursor-pointer hover:text-4xl transition-all duration-100 ease-in-out"/>
                            </div>
                            <h1 class="text-8xl text-center text-white relative">{{ data.businesses.length }} <small class="text-2xl right-6 -ml-6">Perusahaan</small></h1>
                            <Icon icon="mdi:store" class="text-8xl text-white opacity-60 group-hover:-translate-y-10 transition-all duration-300 ease-in-out group-hover:opacity-90 mix-blend-overlay" />
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8" :xs="24">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-gradient-to-br from-sky-500 to-sky-400 hover:bg-gradient-to-bl transition-all duration-300 ease-in h-[200px] group">
                        <template #default>
                            <div class="flex items-center justify-between relative">
                                <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                    Produk Unggulan
                                </h3>
                                <Icon icon="mdi:chart-box"  class="absolute right-0 text-white text-2xl hover:cursor-pointer hover:text-4xl transition-all duration-100 ease-in-out"/>
                            </div>
                            <h1 class="text-8xl text-center text-white relative">{{ data.produks.length }} <small class="text-2xl right-6 -ml-6">Produk</small></h1>
                            <Icon icon="mdi:sale" class="text-8xl text-white opacity-60 group-hover:-translate-y-10 transition-all duration-300 ease-in-out group-hover:opacity-90 mix-blend-overlay" />
                        </template>
                    </el-card>
                </el-col>
            </el-row>
       </el-container>
    </DashLayout>
</template>
