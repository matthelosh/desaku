<script setup>
import {ref, computed } from 'vue'
import {usePage, Head, Link} from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { onHeaderStuck } from '@/helpers/front'

import Header from '@/Components/Front/Header.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import Footer from '@/Components/Front/Footer.vue'
const page = usePage()

const post = computed(() => page.props.post)
</script>

<template>
    <Head>
        <title>{{ page.props.post.title }}</title>
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
                                    <el-breadcrumb-item :to="{path: '/berita'}">
                                        <template #default>
                                            <Link class="flex" :href="`/berita`">
                                                Berita
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
                        <div class="cover w-full h-[350px] overflow-hidden">
                            <img :src="post.cover" alt="Cover" class="w-full saturate-100 contrast-50">
                        </div>
                    </el-col>
                    <el-col :span="10" class="bg-white">
                        <div class="post p-4">
                            <h3 class="text-2xl font-bold tracking-wide font-serif text-sky-800 mb-2">{{ post.title }}</h3>
                            <p class="text-lg" v-html="post.content"></p>
                        </div>
                    </el-col>
                    <el-col :span="6" class="bg-slate-100"></el-col>
                </el-row>
            </el-container>
        </main>
        <Kontak />  
        <Footer />
    </div>
</template>