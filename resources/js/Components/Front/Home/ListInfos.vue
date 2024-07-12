<script setup>
import { usePage, Link } from '@inertiajs/vue3'

const page = usePage()
</script>

<template>
    <div class="list-info mb-6">
        <ol>
            <template v-for="(info, i) in page.props.infos" :key="i">
                <li class="mb-4">
                    <Link :href="`/info/${info.slug}`" class="block bg-sky-500  text-white rounded font-bold flex gap-2 items-center  rounded-full hover:translate-x-2 transition-all duration-300 ease-in-out hover:shadow-md">
                        <img :src="info.cover" alt="Foto" class="h-10 w-10 rounded-full">
                        {{ info.title }}
                    </Link>
                </li>
            </template>
        </ol>
    </div>
</template>