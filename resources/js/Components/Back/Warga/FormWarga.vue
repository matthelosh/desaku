<script setup>
import {ref, computed, onBeforeMount} from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import axios from 'axios';
import pendidikan from '@/datas/pendidikan.json'
import pekerjaans from '@/datas/pekerjaans.json'

const mode = ref('tambah')
const page = usePage()
const props = defineProps({selectedWarga: Object})
const emit = defineEmits(['close'])

const warga = ref({})
const loading = ref(false)
const foto = ref(null)
const rts = ref([])
const getData = () => {
    axios.get(route('dashboard.warga.alamat'))
        .then(res => {
            rts.value = page.props.auth.role == 'rt' ? res.data.rts.filter(rt => rt.nama == page.props.auth.user.name) : res.data.rts
        })
}

const onFotoPicked = (e) => {
    const file = e.target.files[0]
    foto.value = file
    warga.value.foto = URL.createObjectURL(file)
}

const onRtPicked = (e) => {
    const index = rts.value.findIndex(rt => rt.id == e)
    console.log(rts.value[index])
    warga.value.rt_id = e
    warga.value.rw = rts.value[index].rw.nama
    warga.value.dusun = rts.value[index].dusun.nama
}

const simpan = async() => {
    let payload = {
        data: warga.value
    }

    if (foto.value !== null) payload.fileFoto = foto.value
    loading.value = true
    router.post(route('dashboard.warga.store'), payload, {
        onSuccess: page => {
            loading.value = false
            emit('close')
        },
        onError: errs => console.log(errs)
    })
}

onBeforeMount(async () => {
    await getData()
    mode.value = props.selectedWarga ? 'edit' : 'tambah'
    warga.value = props.selectedWarga ?? {}
    warga.value.rw = props.selectedWarga ? props.selectedWarga.rw.nama : ''
    warga.value.dusun = props.selectedWarga ? props.selectedWarga.dusun.nama : ''
})
</script>

<template>
    <el-card v-loading="loading">
        <template #header>
            <div class="flex justify-between items-center">
                <h3>Formulir Tambah Warga</h3>

                <div class="toolbar-items flex items-center gap-1">
                    <el-button type="primary" @click="simpan">Simpan</el-button>
                    <el-button type="danger" @click="emit('close')">
                        Batal
                    </el-button>
                </div>
            </div>
        </template>
        <template #default>
            <el-container>
                <el-row class="w-full" :gutter="20">
                    <el-col :span="16">
                        <div class="border rounded bg-slate-100 p-2">
                            <el-form v-model="warga" label-width="200" >
                                <el-form-item label="NIK" >
                                    <el-input v-model="warga.nik" placeholder="Masukkan Nomor KTP"></el-input>
                                </el-form-item>
                                <el-form-item label="No KK" >
                                    <el-input v-model="warga.kk_id" placeholder="Masukkan Nomor Kartu Keluarga"></el-input>
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
                                        <el-form-item label="RT" >
                                            <el-select v-model="warga.rt_id" placeholder="Pilih RT" filterable @change="onRtPicked">
                                                <el-option v-for="rt in rts" :key="rt.id" :value="rt.id" :label="rt.nama+'- RW '+rt.rw_id"></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="RW" >
                                            {{ warga.rw ?? '' }}
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="Dusun" >
                                            {{ warga.dusun ?? '' }}
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="Pendidikan" >
                                            <el-select v-model="warga.pendidikan" placeholder="Pilih Pendidikan" filterable>
                                                <el-option v-for="pend in pendidikan" :value="pend" :key="pend" ></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="Pekerjaan" >
                                            <el-select v-model="warga.pekerjaan" placeholder="Pilih Pekerjaan" filterable>
                                                <el-option v-for="pekerjaan in pekerjaans" :key="pekerjaan" :value="pekerjaan"></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="Nama Ayah (Opsional)" >
                                            <el-input v-model="warga.ayah" placeholder="Masukkan Nama Ayah"></el-input>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="Nama Ibu (Opsional)"  >
                                            <el-input v-model="warga.ibu" placeholder="Masukkan Nama Ibu"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                            </el-form>
                        </div>
                    </el-col>
                    <el-col :span="8">
                        <el-card shadow="hover">
                            <template #header>
                                <div class="flex items-center justify-between">
                                <h1 class="text-md font-bold text-slate-700 tracking-wide">Pas Foto</h1>
                                <input type="file" ref="fileFoto" class="hidden" @change="onFotoPicked" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .PNG" />
                                <el-button size="small" type="primary" @click="$refs.fileFoto.click()">Ambil Foto</el-button>
                            </div>
                            </template>
                            <div class="flex justify-center">
                                <el-image :src="warga.foto" style="width: 300px;height: 300px;" fit="cover">
                                    <template #error>
                                        <div class="flex justify-center items-center w-full">
                                            <Icon icon="mdi:account-box" style="font-size:14em; color: #abcfff;" class=" text-slate-100" />
                                        </div>
                                    </template>
                                </el-image>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>
            </el-container>
        </template>
    </el-card>
</template>
