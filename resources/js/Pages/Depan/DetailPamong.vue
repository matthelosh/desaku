<script setup>
import {ref, computed } from 'vue'
import {usePage, Head, Link} from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { onHeaderStuck } from '@/helpers/front'

import Header from '@/Components/Front/Header.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import Footer from '@/Components/Front/Footer.vue'
const page = usePage()

const pamong = computed(() => page.props.pamong)
</script>

<template>
    <Head>
        <title>{{ pamong.nama }}</title>
    </Head>
    <div class="page bg-sky-200">
        <el-affix @change="onHeaderStuck">
            <Header />
        </el-affix>
        
        <main class="bg-sky-100 py-8">
            <el-container>
                <el-row justify="center" class="w-full">
                    <el-col :span="16">
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
                                    <el-breadcrumb-item :to="{path: '/pamong'}">
                                        <template #default>
                                            <Link class="flex" :href="`/pamong`">
                                                Perangkat Desa
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                    <el-breadcrumb-item>
                                        <template #default>
                                            <span class="flex">
                                                {{ pamong.nama }}
                                            </span>
                                        </template>
                                    </el-breadcrumb-item>
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        
                    </el-col>
                    <el-col :span="16" class="bg-white">
                        <div class="card grid grid-cols-8">
                            <div class="foto col-span-3">
                                <img :src="pamong.foto" alt="Foto" class="w-full h-full object-cover object-bottom">
                            </div>
                            <div class="foto col-span-5 p-4">

                                <h3 class="text-2xl font-bold tracking-wide font-serif text-sky-800 mb-2">{{ pamong.nama }}</h3>
                                <p class="text-lg" v-html="pamong.alamat"></p>
                            </div>
                        </div>
                    </el-col>
                </el-row>
            </el-container>
        </main>
        <Kontak />  
        <Footer />
    </div>
</template>