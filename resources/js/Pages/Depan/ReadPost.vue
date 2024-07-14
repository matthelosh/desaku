<script setup>
import {ref, computed, onMounted, onBeforeMount } from 'vue'
import {usePage, Head, Link} from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { onHeaderStuck } from '@/helpers/front'
import dayjs from 'dayjs'
import 'dayjs/locale/id'
dayjs.locale('id')
import axios from 'axios'

import Header from '@/Components/Front/Header.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import Footer from '@/Components/Front/Footer.vue'
const page = usePage()

const post = computed(() => page.props.post)
const others = computed(() => page.props.others)

const gb = ref(null)
// const rute = computed(() => route().params)
onBeforeMount(() => {
})
</script>

<template>
    <Head>
        <title>{{ page.props.post.title }}</title>
    </Head>
    <div class="page bg-sky-200">
        <el-affix @change="onHeaderStuck">
            <Header />
        </el-affix>
        
        <main class="bg-sky-100 py-0 md:py-8">
            <el-container>
                <el-row justify="center" class="w-full">
                    <el-col :span="16" :xs="24">
                        <el-row class="w-full">
                            <el-col class="bg-sky-200 h-10 p-2">
                                <!-- {{ rute }} -->
                                <el-breadcrumb class="h-full flex items-center text-white">
                                    <el-breadcrumb-item :to="{path: '/'}">
                                        <template #default>
                                            <Link class="flex" :href="route('front.home')">
                                                <Icon icon="mdi:home" class="text-md" />
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                    <el-breadcrumb-item :to="{path: post.category_id}">
                                        <template #default>
                                            <Link class="flex" :href="`/${post.category_id.toLowerCase()}`">
                                                {{ post.category_id }}
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                    <el-breadcrumb-item>
                                        <template #default>
                                            <span class="flex">
                                                {{ post.title }}
                                            </span>
                                        </template>
                                    </el-breadcrumb-item>
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        <div class="cover w-full md:h-[450px] overflow-hidden " >
                            <img :src="post.cover" alt="Cover" class="w-full object-contain object-cover object-top">
                             <!-- <img :src="gb" alt=""> -->
                        </div>
                    </el-col>
                    <el-col :span="10" :xs="24" class="bg-white">
                        <div class="post p-2 md:p-4">
                            <div class="meta flex gap-2 my-2">
                                <el-tag type="primary">
                                    <span class="flex items-center gap-1" >
                                        <Icon icon="mdi:account-circle" />
                                        {{ post.author?.name }}
                                    </span>
                                </el-tag>
                                <el-tag type="warning">
                                    <span class="flex items-center gap-1" >
                                        <Icon icon="mdi:calendar" />
                                        {{ dayjs(post.updated_at).format('ddd, DD MMMM YYYY H:m') }}
                                    </span>
                                </el-tag>
                            </div>
                            <h3 class="text-2xl font-bold tracking-wide font-serif text-sky-800 mt-6 mb-4">{{ post.title }}</h3>
                            <p class="text-lg" v-html="post.content"></p>
                        </div>
                    </el-col>
                    <el-col :span="6" :xs="24" class="bg-slate-100 p-2 md:p-4 side-container">
                        <el-affix :offset="80" target=".side-container">
                            <el-divider class="uppercase">
                                <span class="font-bold py-1">
                                    Berita Lainnya
                                </span>
                            </el-divider>
                            <div class="card grid grid-cols-8 bg-white h-[80px] mb-2" v-for="other in others" :key="other.id">
                                <div class="cover h-[80px] w-[80px] bg-sky-600 col-span-2 bg-orange-100">
                                    <el-image :src="other.cover" style="height:80px;" fit="cover" class="mix-blend-color-multiply"></el-image>
                                </div>
                                <div class="content col-span-6 py-1 pr-2" >
                                    <h3>
                                        <Link :href="`/berita/${other.slug}`" class="text-sky-800 hover:underline leading-3">
                                            {{ other.title }}
                                        </Link>
                                    </h3>
                                    <div class="flex gap-1">
                                        <el-tag>{{ other.category_id }}</el-tag>
                                        <el-tag type="warning">{{ dayjs(other.updated_at).format('DD/MM/YY H:m') }}</el-tag>
                                    </div>
                                </div>
                            </div>
                        </el-affix>
                    </el-col>
                </el-row>
            </el-container>
        </main>
        <Kontak />  
        <Footer />
    </div>
</template>