<script setup>
import {ref, computed } from 'vue'
import {usePage, Head, Link} from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { onHeaderStuck } from '@/helpers/front'
import dayjs from 'dayjs'
import 'dayjs/locale/id'

dayjs.locale('id')

import Header from '@/Components/Front/Header.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import Footer from '@/Components/Front/Footer.vue'
const page = usePage()

const posts = computed(() => page.props.posts)

</script>

<template>
    <Head>
        <title>Profil Desa</title>
    </Head>
    <div class="page bg-sky-200">
        <el-affix @change="onHeaderStuck">
            <Header />
        </el-affix>
        
        <main class="py-6">
            <el-container>
                <el-row justify="center" class="w-full">
                    <el-col :span="16" :xs="24">
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
                                    <el-breadcrumb-item :to="{path: '/profil'}">
                                        <template #default>
                                            Profil
                                        </template>
                                    </el-breadcrumb-item>
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        <el-row  class="w-full">
                            <el-col>
                                <div class="grid md:grid-cols-3 gap-4 px-4 md:px-0">
                                    <div v-for="(post, p) in posts" :key="p"  class="card bg-white col-span-1 rounded-md overflow-hidden shadow">
                                        <div class="card-header p-4">
                                            <h3 class="font-bold text-2xl">
                                                <Link :href="`/profil/${post.category_id}`">
                                                    {{ post.title }}
                                                </Link>
                                            </h3>
                                            <div class="meta w-full my-2 flex gap-2">
                                                <el-tag type="primary">{{ post.category_id }}</el-tag>
                                                <el-tag type="danger">{{ dayjs(post.updated_at).locale('id').format('DD MMM YYYY H:m:s') }}</el-tag>
                                            </div>
                                            <p v-html="post.content.substring(0, 200)" class="text-justify font-lg"></p>
                                        </div>
                                    </div>
                                </div>
                            </el-col>
                        </el-row>
                    </el-col>
                </el-row>
            </el-container>
        </main>
        <Kontak />
        <Footer />
    </div>
</template>