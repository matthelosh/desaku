<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import axios from 'axios'
import { Icon } from '@iconify/vue';
import { ElNotification } from 'element-plus';

const page = usePage()
const props = defineProps({selectedDusun: Object, show: Boolean })
const emit = defineEmits(['close'])

const loading = ref(false)
const dusun =ref({})
const wargas = ref([])

const simpan = async() => {
    loading.value = true
    router.post(route('dashboard.dusun.store'), {data: dusun.value}, {
        onSuccess: page => {
            ElNotification({title: 'Info', message: page.props.flash.message , type: 'success'})
            router.reload({only: ['data.dusuns']})
            loading.value = false
            emit('close')
        },
        onError: errs => {
            loading.value = false
            Object.keys(errs).forEach(k => {
                setTimeout(() => {
                    ElNotification({title: 'Error', message: errs[k] , type: 'error'})
                }, 500)
            })
        }
    })
}

const getWarga = async() => {
    // nonMembers.value = 'loading'
    axios.get(route('dashboard.warga', {
        _query: {lembagaId: 'dusun'}
    })).then(res => {
        wargas.value = res.data.wargas
    }).catch(err => console.log(err))
}

onBeforeMount(() => {
    getWarga()
    dusun.value = props.selectedDusun ?? {deskripsi: 'Dusun ...' }
})
</script>

<template>
<el-dialog v-model="props.show" :show-close="false" >
    <template #header>
        <div class="toolbar flex items-center justify-between">
            <h3>Formulir Dusun {{ dusun.nama }}</h3>
            <el-button circle type="danger" @click="emit('close')"><Icon icon="mdi:close" /></el-button>
        </div>
    </template>
    <template #default>
        <div>
            <el-form v-model="dusun" direction="vertical" label-width="150" v-loading="loading">
                <el-form-item label="Nama Dusun" >
                    <el-input v-model="dusun.nama" placeholder="Isi Nama Dusun"></el-input>
                </el-form-item>
                <el-form-item label="Kepala Dusun Dusun" >
                    <el-select v-model="dusun.ketua_id" placeholder="Kepala Dusun" filterable clearable>
                        <el-option v-for="(warga, w) in wargas" :key="warga.nik" :value="warga.id" :label="warga.nama"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Keterangan" >
                    <el-input type="textarea" v-model="dusun.deskripsi" placeholder="Isi Keterangan"></el-input>
                </el-form-item>
                <el-form-item label=" " >
                    <el-button type="primary" @click="simpan">Simpan</el-button>
                </el-form-item>
            </el-form>
        </div>
    </template>
</el-dialog>
</template>

<style>
.el-dialog__header {
    padding: 0!important;
    margin: 0!important;
}
</style>