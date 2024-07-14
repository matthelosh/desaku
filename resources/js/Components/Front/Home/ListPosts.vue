<script setup>
import { usePage, Link } from '@inertiajs/vue3'
import { computed, ref, onMounted, onBeforeMount } from 'vue';
import { vElementVisibility } from '@vueuse/components'

import dayjs from 'dayjs';
import 'dayjs/locale/id'
dayjs.locale('id')

const page = usePage()
const posts = ref([])
onBeforeMount(() => {
    posts.value = page.props.posts

})
</script>

<template>
    <div class="list-post__container">
        <template v-for="(post, p) in posts" :key="p">
            <Transition name="pos"
             appear>
                <div class="post-card gap-0 grid grid-cols-12 border bg-white border-3 shadow-sm mb-4 relative" :class="(p === 0) ? 'bg-sky-400 overflow-hidden' : ''" >
                    <div class="cover sm:col-span-3 col-span-12 flex items-end relative  bg-sky-500 bg-opacity-30" :class="(p === 0) ? 'md:col-span-12 mix-blend-multiply object-cover h-full': 'md:col-span-3'">
                        <img :src="post.cover" alt="Cover" class="object-cover w-full h-full opacity-70 hover:opacity-100 transition-all ease-in-out duration-200 bg-blend-saturate">
                        <p class="absolute w-full bg-sky-600 bg-opacity-60 text-white text-center text-sm p-1 hidden md:block">{{ dayjs(post.created_at).format('DD MMM YYYY')}}</p>
                    </div>
                    <div class="post md:col-span-9 col-span-12 p-4" :class="(p === 0) ? 'md:col-span-12 absolute bottom-0 bg-sky-800 w-full bg-opacity-70 backdrop-blur' : 'md:col-span-3 md:relative absolute bottom-0 md:bg-transparent  w-full'">
                        <Link :href="`/berita/${post.slug}`" class="hidden md:block">
                            <h3 class="font-black text-sky-700 hover:underline tracking-wide mb-2 uppercase transition-all duration-300 linear" :class="(p === 0) ? 'text-4xl font-bold text-white font-mono tracking-wider hover:tracking-widest text-center' : ''">{{ post.title }}</h3>
                        </Link>
                        <div class="meta my-4 flex gap-1">
                            <el-tag type="primary">{{ post.type }}</el-tag>
                            <el-tag type="warning">{{ post.category_id }}</el-tag>
                        </div>
                        <p class="mb-2 hidden md:block" v-html="post.content.substring(0, 200)" v-if="(p !== 0)"></p>
                        <Link :href="`/berita/${post.slug}`" class="text-sky-600 hover:bg-sky-100 hover:font-semibold hover:text-sky-800 hover:underline mt-6 bg-white p-2 rounded">Selengkapnya ...</Link>
                        
                    </div>
                </div>
            </Transition>
        </template>
    </div>
</template>

<style scoped>
    .post-card {
        max-height: 250px;
    }

    .post-card:nth-child(1) {
        max-height: 500px;
    }
</style>