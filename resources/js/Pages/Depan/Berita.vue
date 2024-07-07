<script setup>
import {ref, computed } from 'vue'
import {usePage, Head, Link} from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { onHeaderStuck } from '@/helpers/front'
import Header from '@/Components/Front/Header.vue'
import Kontak from '@/Components/Front/Kontak.vue'
import Footer from '@/Components/Front/Footer.vue'
const page = usePage()

const filter = ref('')
const posts = computed(() => {
    return !filter ? page.props.posts : page.props.posts.filter(post => post.content.toLowerCase().includes(filter.value.toLowerCase()))
})

</script>

<template>
    <Head>
        <title>Kabar Desa Samar Tulungagung</title>
        <meta name="description" content="Hasil Pencarian dalam KAtegori Berita Desa Samar Kecamatan Pagerwojo Kabupaten Tulungagung" />
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
                            <el-col class="bg-sky-100 h-10 p-2">
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
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        <div class="cover w-full h-[350px] relative">
                            <img src="/img/kantor.jpg" alt="Cover" class="h-full w-full saturate-100 contrast-50 object-bottom object-cover">
                            <div class="overlay absolute top-0 right-0 bottom-0 left-0 bg-orange-100 flex items-center justify-center bg-opacity-50 mix-blend-overlay">
                                <div class="text-center bg-white p-4">
                                    <h1 class="text-4xl font-bold uppercase tracking-wide font-serif">Kabar Desa Samar</h1>
                                    <span class="text-xl">Kecamatan Pagerwojo</span>
                                </div>
                            </div>
                        </div>
                    </el-col>
                    <el-col :span="16" :xs="20">
                        <el-input placeholder="Cari Berita" class="mt-4" v-model="filter" clearable>
                            <template #suffix>
                                <Icon icon="mdi:magnify" />
                            </template>
                        </el-input>
                        <div class="posts grid md:grid-cols-2 gap-4 py-4">
                            <div v-for="(post, p) in posts" :key="p" class="post bg-slate-200 grid grid-cols-2">
                                <div class="cover h-full">
                                    <img :src="post.cover" alt="Cover" class="w-full object-cover object-bottom">
                                </div>
                                <div class="content p-2 bg-white shadow">
                                    <Link :href="`/berita/${post.slug}`">
                                        <h3 class="text-xl font-bold text-slate-700">{{ post.title }}</h3>
                                    </Link>
                                    <p class="hidden md:block mt-4" v-html="post.content.substring(0, 200)"></p>
                                </div>
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