<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import axios from 'axios'
import { Icon } from '@iconify/vue';
import { ElNotification } from 'element-plus';

const page = usePage()
const props = defineProps({selectedRw: Object, selectedDusun: Object, show: Boolean })
const emit = defineEmits(['close'])

const loading = ref(false)
const rw =ref({})
const wargas = ref([])

const simpan = async() => {
    loading.value = true
    router.post(route('dashboard.rw.store'), {data: rw.value}, {
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

const dusuns = computed(() => {
    return page.props.data.dusuns
})
const getWarga = async() => {
    // nonMembers.value = 'loading'
    axios.get(route('dashboard.warga', {
        _query: {lembagaId: 'rw'}
    })).then(res => {
        wargas.value = res.data.wargas
    }).catch(err => console.log(err))
}

onBeforeMount(() => {
    getWarga()
    rw.value = props.selectedRw.id ? props.selectedRw : { dusun_id: props.selectedDusun.id }
})
</script>

<template>
<el-dialog v-model="props.show" :show-close="false" >
    <template #header>
        <div class="toolbar flex items-center justify-between">
            <h3>Formulir RW {{ rw.nama }} Dusun {{ props.selectedDusun?.nama }}</h3>
            <el-button circle type="danger" @click="emit('close')"><Icon icon="mdi:close" /></el-button>
        </div>
    </template>
    <template #default>
        <div>
            <el-form v-model="rw" direction="vertical" label-width="150" v-loading="loading">
                <el-form-item label="Nama RW" >
                    <el-input v-model="rw.nama" placeholder="Isi Nama RW"></el-input>
                </el-form-item>
                <el-form-item label="Ketua Rw" >
                    <el-select v-model="rw.ketua_id" placeholder="Ketua RW" filterable clearable>
                        <el-option v-for="(warga, w) in wargas" :key="warga.nik" :value="warga.id" :label="warga.nama"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Dusun" >
                    <el-select v-model="rw.dusun_id" placeholder="Dusun" filterable clearable>
                        <el-option v-for="(dusun, d) in dusuns" :key="dusun.id" :value="dusun.id" :label="dusun.nama"></el-option>
                    </el-select>
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