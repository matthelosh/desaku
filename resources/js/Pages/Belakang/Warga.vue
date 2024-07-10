<script setup>
import { ref, computed, defineAsyncComponent } from 'vue'
import { Head, usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'

import DashLayout from '@/Layouts/DashLayout.vue'

const FormWarga = defineAsyncComponent(() => import('@/Components/Back/Warga/FormWarga.vue'))
const mode = ref('list')
const selectedWarga = ref(null)

const page = usePage()
const search = ref('')
const datas = computed(() => {
    return page.props.wargas.filter(warga => warga.nama.toLowerCase().includes(search.value.toLowerCase()))
})

const tambah = () => {
    mode.value = 'tambah'
}

const closeForm = () => {
    mode.value = 'list'
    selectedWarga.value = null
}
</script>

<template>
    <Head title="Data Warga" />
    <DashLayout>
        <el-container>
            <el-row :gutter="20" class="w-full">
                <el-col :span="24">
                    <TransitionGroup name="warga">
                        <el-card v-if="mode == 'list'" width="100%">
                            <template #header>
                                <div class="flex justify-between items-center">
                                    <h3>Data Warga</h3>

                                    <div class="toolbar-items flex items-center gap-2">
                                        <el-input placeholder="Cari Warga" v-model="search">
                                            <template #suffix>
                                                <Icon icon="mdi:magnify" />
                                            </template>
                                        </el-input>
                                        <el-button type="primary" @click="tambah">Tambah Baru</el-button>
                                    </div>
                                </div>
                            </template>
                            <template #default>
                                <el-table :data="datas" height="80vh">
                                    <el-table-column label="#" type="index" width="80"></el-table-column>
                                    <el-table-column label="NIK" prop="nik" width="150"></el-table-column>
                                    <el-table-column label="Nama" prop="nama" sortable></el-table-column>
                                    <el-table-column label="Jenis Kelamin" prop="jk" width="150"></el-table-column>
                                    <el-table-column label="RT" prop="rt.nama" sortable width="80"></el-table-column>
                                    <el-table-column label="RW" prop="rw.nama" sortable width="80"></el-table-column>
                                    <el-table-column label="Dusun" prop="dusun.nama" width="150"></el-table-column>
                                </el-table>
                            </template>
                        </el-card>
                        <FormWarga v-if="mode == 'tambah'" :selectedWarga="selectedWarga" @close="closeForm" />
                    </TransitionGroup>
                </el-col>
            </el-row>
        </el-container>
    </DashLayout>
</template>

<style scoped>
.warga-enter-active {
    transition: all .5s ease-in-out;
}
.warga-leave-active {
    transition: all .2s ease-in-out;
}

.warga-enter-from {
    opacity: 0;
    transform: translateX(-20px);
}
.warga-leave-to {
    opacity: 0;
    transform: translateX(20px);
}
</style>