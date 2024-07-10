<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import {jenis, skalas} from '@/datas/tipeusaha.json'
import { ElNotification } from 'element-plus';

const page = usePage()

const props = defineProps({selectedBusiness: Object})
const emit = defineEmits(['close'])

const business = ref({})
const fileLogo = ref(null)

const simpan = async() => {
    // console.log(business.value)
    await router.post(route('dashboard.bisnis.store'), {data: business.value}, {
        onSuccess: page => {
            ElNotification({ title: 'Info', message: page.props.flash.message, type: 'success'})
            router.reload({only: ['business']})
            emit('close')
        }, onError: errs => {
            Object.keys(errs).forEach(k => {
                setTimeout(() => {
                    ElNotification({ title: 'Error', message: errs[k], type: 'error'})
                }, 500)
            })
        }
    })
}

onBeforeMount(() => {
    business.value = props.selectedBusiness ?? {}
})
</script>

<template>
<el-card shadow="never">
    <template #header>
        <div class="toolbar flex items-center justify-between">
            <h3>{{ props.selectedBusiness?.id ? 'Edit' : 'Buat' }} Data Usaha: {{ props.selectedBusiness?.nama ?? 'Baru' }}</h3>
            <div class="toolbar-item flex-items-center gap-1">
                <el-button type="primary" @click="simpan">Simpan</el-button>
                <el-button type="danger" @click="emit('close')">Tutup</el-button>
            </div>
        </div>
    </template>
    <div class="card-body ">
        <el-form v-model="business" label-width="200px" label-position="right">
            <el-row>
                <el-col :span="12">
                    <el-form-item width="200px" label="Nama Usaha">
                        <el-input v-model="business.nama" placeholder="Nama Usaha" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Jenis Usaha">
                        <el-select v-model="business.jenis" placeholder="Jenis Usaha" required >
                            <el-option v-for="j in jenis" :key="j" :value="j"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item width="200px" label="Kategori Usaha">
                        <el-select v-model="business.skala" placeholder="Kategori Usaha" required >
                            <el-option v-for="skala in skalas" :key="skala" :value="skala"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item width="200px" label="Nama Pemilik">
                        <el-input v-model="business.pemilik" placeholder="Nama Pemilik" required ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item width="200px" label="Toko Online">
                        <el-input v-model="business.online_store" placeholder="Online Store" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Alamat Usaha">
                        <el-input type="textarea" v-model="business.alamat" placeholder="Alamat Usaha" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="No. Kontak">
                        <el-input v-model="business.kontak" placeholder="No. Kontak" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Ketarangan">
                        <el-input type="textarea" v-model="business.deskripsi" placeholder="Keterangan Usaha" required ></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            
        </el-form>

    </div>
</el-card>
</template>