<script setup>
import DashLayout from '@/Layouts/DashLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()

const data = computed(() => page.props.data)
</script>

<template>
    <Head title="Dashboard" />

    <DashLayout>
       <el-container>
            <el-row :gutter="20" class="w-full">
                <el-col :span="8">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-red-500 h-[200px]">
                        <template #default>
                            <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                Berita Desa
                            </h3>
                            <h1 class="text-8xl text-center text-white relative">{{ data.posts.length }} <small class="text-2xl right-6 -ml-6">Kabar</small></h1>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-blue-500 h-[200px]">
                        <template #default>
                            <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                Pengumuman
                            </h3>
                            <h1 class="text-8xl text-center text-white relative">{{ data.infos.length }} <small class="text-2xl right-6 -ml-6">Info</small></h1>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-orange-500 h-[200px]">
                        <template #default>
                            <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                Warga Desa
                            </h3>
                            <h1 class="text-8xl text-center text-white relative">{{ data.wargas.length }} <small class="text-2xl right-6 -ml-6">Jiwa</small></h1>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-violet-500 h-[200px]">
                        <template #default>
                            <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                Potensi Wisata
                            </h3>
                            <h1 class="text-8xl text-center text-white relative">{{ data.wisatas.length }} <small class="text-2xl right-6 -ml-6">Tujuan</small></h1>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-indigo-500 h-[200px]">
                        <template #default>
                            <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                Data Potensi Usaha
                            </h3>
                            <h1 class="text-8xl text-center text-white relative">{{ data.businesses.length }} <small class="text-2xl right-6 -ml-6">Perusahaan</small></h1>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card class="card border border-sky-500 rounded-md mb-4 " body-class="bg-sky-500 h-[200px]">
                        <template #default>
                            <h3 class="font-bold text-xl uppercase tracking-wide text-sky-50">
                                Produk Unggulan
                            </h3>
                            <h1 class="text-8xl text-center text-white relative">{{ data.produks.length }} <small class="text-2xl right-6 -ml-6">Produk</small></h1>
                        </template>
                    </el-card>
                </el-col>
            </el-row>
       </el-container>
    </DashLayout>
</template>
