<script setup>
import { ref, computed, defineAsyncComponent } from 'vue'
import { Head, usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'

import DashLayout from '@/Layouts/DashLayout.vue'

const page = usePage()

const data = computed(() => page.props.data)
</script>

<template>
    <Head title="Data Kelembagaan" />
    <DashLayout>
        <el-container>
            <el-row :gutter="20" class="w-full">
                Halo
            </el-row>
        </el-container>
    </DashLayout>
</template>