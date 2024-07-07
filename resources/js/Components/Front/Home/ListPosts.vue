<script setup>
import { usePage, Link } from '@inertiajs/vue3'

import dayjs from 'dayjs';
import 'dayjs/locale/id'
import { computed, ref, onMounted, onBeforeMount } from 'vue';
dayjs.locale('id')

const page = usePage()

const posts = ref([])
onBeforeMount(() => {
    posts.value = page.props.posts
})
</script>

<template>
    <div>
        <template v-for="(post, p) in posts" :key="p">
            <Transition name="pos" appear>
                <div class="post-card gap-0 grid grid-cols-12 border bg-white border-3 shadow-sm mb-4">
                    <div class="cover sm:col-span-3 col-span-12  bg-cover bg-center h-40 flex items-end relative" >
                        <img :src="post.cover" alt="Cover" class="object-cover w-full h-full opacity-70 hover:opacity-100 transition-all ease-in-out duration-200 bg-blend-overlay after:block after:absolute after:w-full after:h-full after:bg-violet-400 after:content-['Halo']">
                        <p class="absolute w-full bg-sky-600 bg-opacity-60 text-white text-center text-sm p-1">{{ dayjs(post.created_at).format('DD MMM YYYY')}}</p>
                    </div>
                    <div class="post sm:col-span-9 col-span-12 p-2">
                        <Link :href="`/berita/${post.slug}`">
                            <h3 class="font-black text-sky-700 hover:underline tracking-wide mb-2 uppercase">{{ post.title }}</h3>
                        </Link>
                        <p class="mb-2">{{ post.content.substring(0, 200) }}</p>
                        <Link href="#" class="text-sky-600 hover:underline mt-6">Selengkapnya ...</Link>
                        
                    </div>
                </div>
            </Transition>
        </template>
    </div>
</template>

<style scoped>
    .pos-enter-active {
        opacity: 0;
        transform: translateX(-20px);
    }
</style>