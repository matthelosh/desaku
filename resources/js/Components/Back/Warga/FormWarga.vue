<script setup>
import {ref, computed, onBeforeMount} from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import axios from 'axios';

const page = usePage()
const props = defineProps({selectedWarga: Object})
const emit = defineEmits(['close'])

const warga = ref({})
const alamat = ref({})
const getData = async() => {
    axios.get(route('dashboard.warga.alamat'))
        .then(res => alamat.value = res.data.alamat)
}

const rws = computed(() => {
    return !warga.value.dusun_id ? alamat.value.rws :  alamat.value.rws.filter(rw => rw.dusun_id == warga.value.dusun_id)
})
const rts = computed(() => {
    return !warga.value.rw_id ? alamat.value.rts :  alamat.value.rts.filter(rt => rt.rw_id == warga.value.rw_id)
})

onBeforeMount(() => {
    warga.value = props.selectedWarga ?? {}

    getData()
})
</script>

<template>
    <el-card>
        <template #header>
            <div class="flex justify-between items-center">
                <h3>Formulir Tambah Warga</h3>

                <div class="toolbar-items flex items-center gap-2">
                    <el-button circle type="danger" @click="emit('close')">
                        <Icon icon="mdi:close" />
                    </el-button>
                </div>
            </div>
        </template>
        <template #default>
            <el-container>
                <el-row class="w-full" :gutter="20">
                    <el-col :span="16">
                        <div class="border rounded bg-slate-100 p-2">
                            <el-form v-model="warga" label-width="200">
                                <el-form-item label="NIK" >
                                    <el-input v-model="warga.nik" placeholder="Masukkan Nomor KTP"></el-input>
                                </el-form-item>
                                <el-form-item label="No KK" >
                                    <el-input v-model="warga.no_kk" placeholder="Masukkan Nomor Kartu Keluarga"></el-input>
                                </el-form-item>
                                <el-form-item label="Nama Lengkap" >
                                    <el-input v-model="warga.nama" placeholder="Masukkan Nama Lengkap"></el-input>
                                </el-form-item>
                                <el-form-item label="Jenis Kelamin" >
                                    <el-select v-model="warga.jk" placeholder="Pilih Jenis Kelamin">
                                        <el-option v-for="jk in ['Laki-laki', 'Perempuan']" :value="jk"></el-option>
                                    </el-select>
                                </el-form-item>
                                <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="Tempat Lahir" >
                                            <el-input v-model="warga.tempat_lahir" placeholder="Masukkan Tempat Lahir"></el-input>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="Tanggal Lahir" >
                                            <el-input type="date" v-model="warga.tanggal_lahir" placeholder="Masukkan Tanggal Lahir"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="Agama" >
                                            <el-select v-model="warga.agama" placeholder="Pilih Agama">
                                                <el-option v-for="agama in ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghuchu']" :value="agama"></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="Dusun" >
                                            <el-select v-model="warga.dusun_id" placeholder="Pilih Dusun">
                                                <el-option v-for="dusun in alamat.dusuns" :key="dusun.id" :value="dusun.id" :label="dusun.nama"></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="RW" >
                                            <el-select v-model="warga.rw_id" placeholder="Pilih RW" filterable>
                                                <el-option v-for="rw in rws" :value="rw.id" :key="rw.id" :label="rw.nama"></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="RT" >
                                            <el-select v-model="warga.rt_id" placeholder="Pilih RT" filterable>
                                                <el-option v-for="rt in rts" :key="rt.id" :value="rt.id" :label="rt.nama"></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                            </el-form>
                        </div>
                    </el-col>
                    <el-col :span="8"></el-col>
                </el-row>
            </el-container>
        </template>
    </el-card>
</template>