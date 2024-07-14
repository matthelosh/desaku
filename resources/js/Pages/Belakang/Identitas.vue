<script setup>
import { ref, computed } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { lebar } from '@/helpers/layout'

import DashLayout from '@/Layouts/DashLayout.vue'

const page = usePage()

const identitas = ref({})

const data = computed(() => page.props.identitas)
</script>

<template>
<Head title="Identitas Desa" />
<DashLayout>
    <div class="md:w-[60%] mx-auto bg-white rounded border md:mt-8 hover:shadow-lg">
        <h1 class="text-xl text-center font-bold uppercase my-6">Identitas Desa</h1>

        <el-descriptions
            :column="lebar() == 'xs' ? 1 : 4"
            border
        >
            <el-descriptions-item label="Nama Desa">{{ data.nama }}</el-descriptions-item>
            <el-descriptions-item label="Kode PUM">{{ data.kode_pum }}</el-descriptions-item>
            <el-descriptions-item label="Status">{{ data.status }}</el-descriptions-item>
            <el-descriptions-item label="Kode Pos">{{ data.kode_pos }}</el-descriptions-item>
            <el-descriptions-item label="Kecamatan">{{ data.kecamatan }}</el-descriptions-item>
            <el-descriptions-item label="Kabupaten">{{ data.kabupaten }}</el-descriptions-item>
            <el-descriptions-item label="Provinsi">{{ data.provinsi }}</el-descriptions-item>
            <el-descriptions-item label="No. Kontak">{{ data.telp }}</el-descriptions-item>
            <el-descriptions-item label="Email">{{ data.email }}</el-descriptions-item>
            <el-descriptions-item label="Website">{{ data.website }}</el-descriptions-item>
        </el-descriptions>
    </div>
</DashLayout>
</template>