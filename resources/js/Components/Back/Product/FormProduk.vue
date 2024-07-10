<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import {jenis, skalas} from '@/datas/tipeusaha.json'
import { ElNotification } from 'element-plus';

const page = usePage()

const businesses = computed(() => page.props.businesses)
const props = defineProps({selectedProduct: Object})
const emit = defineEmits(['close'])

const produk = ref({})
const fileGambar = ref(null)

const simpan = async() => {
    // console.log(produk.value)
    let payload = {data: produk.value}
    if (fileGambar.value !== null ) {
        payload.foto = fileGambar.value
    }
    await router.post(route('dashboard.produk.store'), payload, {
        onSuccess: page => {
            ElNotification({ title: 'Info', message: page.props.flash.message, type: 'success'})
            router.reload({only: ['products']})
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


const onFotoPicked = (e) => {
    const file = e.target.files[0]
    fileGambar.value = file
    produk.value.foto = URL.createObjectURL(file)
}

onBeforeMount(() => {
    produk.value = props.selectedProduct ?? {}
})
</script>

<template>
<el-card shadow="never">
    <template #header>
        <div class="toolbar flex items-center justify-between">
            <h3>{{ props.selectedProduct?.id ? 'Edit' : 'Buat' }} Data Produk: {{ props.selectedProduct?.nama ?? 'Baru' }}</h3>
            <div class="toolbar-item flex-items-center gap-1">
                <el-button type="primary" @click="simpan">Simpan</el-button>
                <el-button type="danger" @click="emit('close')">Tutup</el-button>
            </div>
        </div>
    </template>
    <div class="card-body ">
        <el-form v-model="produk" label-width="200px" label-position="right">
            <el-row :gutter="20">
                <el-col :span="16">
                    <el-form-item width="200px" label="Kode SKU">
                        <el-input v-model="produk.sku" placeholder="SKU / Kode" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Nama Produk">
                        <el-input v-model="produk.nama" placeholder="Nama Produk" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Produsen">
                        <el-select v-model="produk.business_id" placeholder="Pilih Produsen" required filterable>
                            <el-option v-for="prod in businesses" :key="prod.id" :value="prod.id" :label="prod.nama"  />
                        </el-select>
                    </el-form-item>
                    <el-form-item width="200px" label="Jenis Produk">
                        <el-input v-model="produk.jenis" placeholder="Jenis Produk" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Berat Produk">
                        <el-input v-model="produk.berat" placeholder="Berat Produk" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Satuan Produk">
                        <el-input v-model="produk.satuan" placeholder="Satuan Produk" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Link Marketplace (Shoppe, Tokped, dll)">
                        <el-input v-model="produk.link" placeholder="Link Marketplace" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Harga Produk">
                        <el-input type="number" v-model="produk.harga" placeholder="Harga Produk" required ></el-input>
                    </el-form-item>
                    <el-form-item width="200px" label="Deskripsi Produk">
                        <el-input type="textarea" v-model="produk.deskripsi" placeholder="Deskripsi Produk" rows="8" required ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-card>
                        <template #header>
                            <div class="flex items-center justify-between">
                                <h1 class="text-md font-bold text-slate-700 tracking-wide">Gambar Produk</h1>
                                <input type="file" ref="fileFoto" class="hidden" @change="onFotoPicked" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .PNG" />
                                <el-button size="small" type="primary" @click="$refs.fileFoto.click()">Pilih Gambar</el-button>
                            </div>
                        </template>

                        <el-image :src="produk.foto" style="width: 100%;height: 300px;">
                            <template #error>
                                <div class="image-slot flex items-center justify-center w-full h-full bg-slate-100 mx-auto rounded shadow">
                                    <Icon icon="mdi:image-remove" class="text-8xl" />
                                </div>
                            </template>
                        </el-image>
                    </el-card>
                </el-col>
            </el-row>
            
        </el-form>

    </div>
</el-card>
</template>