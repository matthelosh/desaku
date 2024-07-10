<script setup>
import { ref, computed, defineAsyncComponent } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'

import DashLayout from '@/Layouts/DashLayout.vue'
import { ElNotification } from 'element-plus';

const page = usePage()
const mode = ref('list')
const FormBisnis = defineAsyncComponent(() => import('@/Components/Back/Bisnis/FormBisnis.vue'))
const businesses = computed(() => page.props.businesses)
const products = computed(() => page.props.products)
const selectedBusiness = ref(null)

const formBisnis = ref(false)
const openForm = () => {formBisnis.value = true; mode.value = 'tulis'}
const edit = (item) => {formBisnis.value = true; selectedBusiness.value = item; mode.value = 'tulis'}
const closeForm = () => { 
    mode.value = 'list'
    formBisnis.value = false
    selectedBusiness.value = {}
}
const hapus = async(item) => {
    router.delete(route('dashboard.bisnis.destroy', {id: item.id}), {
        onSuccess: page => {
            ElNotification({title: 'Info', message: page.props.flash.message, type: 'success'})
            router.reload({only: ['businesses']})
        }, onError: errs => {
            Object.keys(errs).forEach(k => {
                setTimeout(() => {
                    ElNotification({ title: 'Error', message: errs[k], type: 'error'})
                }, 500)
            })
        }
    })
}
</script>

<template>
<Head title="Data Usaha" />
<DashLayout>
    <div class="relative">
        <div class="toolbar w-full border border-sky-200 rounded p-2 bg-sky-100 mb-4 flex justify-between items-center">
            <h3 class=" text-sky-800 text-xl flex gap-1 items-center">
                <Icon icon="mdi:store-cog-outline" class="text-2xl" />
                Data Produk UMKM Desa Samar
            </h3>
            <div class="toolbar-items flex items-center gap-1">
                <el-button type="primary" class="flex items-center gap-1" @click="openForm">
                    <Icon icon="mdi:store-plus" />
                    Entri Baru
                </el-button>
            </div>
        </div>
        <TransitionGroup name="pos" >
            <el-table :data="products" height="85vh" v-if="mode === 'list'" style="width: 100%;">
                <el-table-column label="SKU" prop="sku" width="200" :fixed="true"></el-table-column>
                <el-table-column label="Nama" prop="nama" width="200" :fixed="true"></el-table-column>
                <el-table-column label="Gambar" width="100">
                    <template #default="scope">
                        <el-image :src="scope.row.foto"></el-image>
                    </template>
                </el-table-column>
                <el-table-column label="Jenis" prop="jenis" width="150"></el-table-column>
                <el-table-column label="Produsen"  width="200">
                    <template #default="scope">
                        <span>{{ scope.row.produsen.nama }}</span>
                    </template>
                </el-table-column>
                <el-table-column label="Dimensi" prop="dimensi" width="150"></el-table-column>
                <el-table-column label="Satuan" prop="satuan" width="250"></el-table-column>
                <el-table-column label="Harga (Rp)" prop="harga" width="250"></el-table-column>
                <el-table-column label="Pemesanan" prop="produsen.kontak" width="200"></el-table-column>
                <el-table-column label="Toko Online" prop="produsen.online_store" width="200"></el-table-column>
                <el-table-column label="Keterangan" prop="deskripsi" width="500"></el-table-column>
                <el-table-column label="Opsi" :fixed="'right'" width="90">
                    <template #default="scope">
                        <span class="flex gap-1">
                            <el-button circle type="primary" size="small" @click="edit(scope.row)">
                                <Icon icon="mdi:store-edit" />
                            </el-button>
                            <el-popconfirm placement="left" title="Yakin hapus?" @confirm="hapus(scope.row)">
                                <template #reference>
                                    <el-button circle type="danger" size="small">
                                        <Icon icon="mdi:close" />
                                    </el-button>
                                </template>
                            </el-popconfirm>
                            
                        </span>
                    </template>
                </el-table-column>
            </el-table>
            <FormBisnis v-if="mode == 'tulis'" :selectedBusiness="selectedBusiness" @close="closeForm" />
        </TransitionGroup>
    </div>
</DashLayout>
</template>