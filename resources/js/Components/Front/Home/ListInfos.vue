<script setup>
import { usePage, Link } from '@inertiajs/vue3'

const page = usePage()
</script>

<template>
    <div class="list-info mb-6">
        <ol>
            <template v-for="(info, i) in page.props.infos" :key="i">
                <li class="mb-2">
                    <Link :href="`/berita/${info.slug}`" class="block bg-sky-500 p-2 text-white rounded font-bold">{{ info.title }}</Link>
                </li>
            </template>
        </ol>
    </div>
</template>