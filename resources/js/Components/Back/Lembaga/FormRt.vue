<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import axios from 'axios'
import { Icon } from '@iconify/vue';
import { ElNotification } from 'element-plus';

const page = usePage()
const props = defineProps({selectedRw: Object, selectedRt: Object, selectedDusun: Object, show: Boolean })
const emit = defineEmits(['close'])

const loading = ref(false)
const rt =ref({})
const wargas = ref([])

const simpan = async() => {
    loading.value = true
    router.post(route('dashboard.rt.store'), {data: rt.value}, {
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

const rws = computed(() => {
    return props.selectedDusun.rws
})
const getWarga = async() => {
    // nonMembers.value = 'loading'
    axios.get(route('dashboard.warga', {
        _query: {lembagaId: 'rt'}
    })).then(res => {
        wargas.value = res.data.wargas
    }).catch(err => console.log(err))
}

onBeforeMount(() => {
    getWarga()
    rt.value = props.selectedRt.id ? props.selectedRt : { rw_id: props.selectedRw.id }
})
</script>

<template>
<el-dialog v-model="props.show" :show-close="false" >
    <template #header>
        <div class="toolbar flex items-center justify-between">
            <h3>Formulir RW {{ rt.nama }} Dusun {{ props.selectedDusun?.nama }}</h3>
            <el-button circle type="danger" @click="emit('close')"><Icon icon="mdi:close" /></el-button>
        </div>
    </template>
    <template #default>
        <div>
            <el-form v-model="rt" direction="vertical" label-width="150" v-loading="loading">
                <el-form-item label="Nama RW" >
                    <el-input v-model="rt.nama" placeholder="Isi Nama RW"></el-input>
                </el-form-item>
                <el-form-item label="Ketua Rt" >
                    <el-select v-model="rt.ketua_id" placeholder="Ketua RT" filterable clearable>
                        <el-option v-for="(warga, w) in wargas" :key="warga.nik" :value="warga.id" :label="warga.nama"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="RW" >
                    <el-select v-model="rt.rw_id" placeholder="RW" filterable clearable>
                        <el-option v-for="(rw, r) in rws" :key="rw.id" :value="rw.id" :label="rw.nama"></el-option>
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