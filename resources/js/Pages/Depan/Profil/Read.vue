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

const post = computed(() => page.props.post)

</script>

<template>
    <Head>
        <title>{{ post ? title : '404' }}</title>
    </Head>
    <div class="page bg-sky-200">
        <el-affix @change="onHeaderStuck">
            <Header />
        </el-affix>
        
        <main class="py-6">
            <el-container>
                <el-row justify="center" class="w-full">
                    <el-col :span="16" :xs="24" class="bg-slate-200">
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
                                            <Link class="flex" :href="`/profil`">
                                                Profil
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                    <el-breadcrumb-item>
                                        <template #default>
                                            <span class="flex">
                                                {{ post?.title }}
                                            </span>
                                        </template>
                                    </el-breadcrumb-item>
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        <el-row  class="w-full">
                            <el-col class="bg-white">
                                <div class="card rounded-md overflow-hidden shadow">
                                    <div class="card-header p-4">
                                        <h3 class="font-bold text-2xl">{{ post?.title }}</h3>
                                        <div class="meta w-full my-2 flex gap-2">
                                            <el-tag type="primary">{{ post?.category_id }}</el-tag>
                                            <el-tag type="danger">{{ dayjs(post?.updated_at).locale('id').format('DD MMM YYYY H:mm:s') }}</el-tag>
                                        </div>
                                        <p v-html="post?.content" class="text-justify font-lg"></p>
                                        <el-alert type="error" v-if="!post" size="large" style="margin: 30px auto;" :show-icon="true">
                                            <h3 class="text-xl">Belum ada tulisan</h3>
                                        </el-alert>
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