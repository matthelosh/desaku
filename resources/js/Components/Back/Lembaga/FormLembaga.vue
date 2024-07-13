<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue';
import { lebar } from '@/helpers/layout';
import { ElLoading, ElMessageBox } from 'element-plus';

const props = defineProps({ selectedLembaga: Object, show: Boolean })
const emit = defineEmits(['close', 'loading', 'start', 'finish'])

const lembaga = ref({
    kode: 'KPKD', nama: 'Komisi Pemilihan Kepala Desa', tipe: 'Masyarakat', deskripsi: 'Hanya Contoh'
})
const options = ref({
        lock: true,
        text: 'Mohon tunggu..',
        background: 'rgba(0,0,0,0.7)'
    })
const simpan = async() => {
    const loading = ElLoading.service(options.value)
    await router.post(route('dashboard.lembaga.store'), {data: lembaga.value}, {
        onSuccess: page => {
            loading.close()

            ElMessageBox.alert('<div class="flex items-center justify-center "><h1 class="animate-bounce">Selesai</h1></div>', 'Info', {dangerouslyUseHTMLString: true})
            emit('close')
        }, 
        onError: errs => {
            loading.close()
            ElMessageBox.alert('<div class="flex items-center justify-center"><h1 class="animate-bounce font-xl text-red-500">Maaf ada kesahalan..</h1></div>', 'Error', {dangerouslyUseHTMLString: true})
        }
    })
}

onBeforeMount(() => {
    lembaga.value = props.selectedLembaga !== null ? props.selectedLembaga : {}
})
</script>

<template>
    <el-dialog v-model="props.show" :fullscreen="lebar() == 'xs'"  :show-close="false" @close="emit('close')" style="padding:0!important;">
        <template #header style="margin:0!important;padding:0!important;">
            <div class="flex w-full items-center justify-between">
                <h3>Formulir Lembaga</h3>

                <el-button @click="emit('close')" circle type="danger">
                    <Icon icon="mdi:close" />
                </el-button>
            </div>
        </template>
        <!-- {{ props.selectedLembaga }} -->
        <el-form v-model="lembaga" label-position="top">
            <el-row :gutter="20">
                <el-col :span="4">
                    <el-form-item label="Kode">
                        <el-input v-model="lembaga.kode" placeholder="Kode Lembaga"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="14">
                    <el-form-item label="Nama">
                        <el-input v-model="lembaga.nama" placeholder="Masukkan Nama Lembaga"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item label="Tipe">
                        <el-select v-model="lembaga.tipe">
                            <el-option v-for="tipe in ['Pemerintah', 'Masyarakat', 'Teritorial']" :key="tipe" :value="tipe"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20">
                <el-col>
                    <el-form-item label="Keterangan">
                        <el-input type="textarea" v-model="lembaga.deskripsi" placeholder="Keterangan"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row justify="center">
                <el-button type="primary" @click="simpan">Simpan</el-button>
            </el-row>
        </el-form>
    </el-dialog>
</template>

<style scoped>
.el-dialog header .el-dialog__header {
    margin: 0!important;
    padding: 0!important;
}
</style>