<script setup>
import { ref, computed } from 'vue';
import { Icon } from '@iconify/vue';
import { usePage, router } from '@inertiajs/vue3'
import { read, writeFile, utils } from 'xlsx'
import { ElNotification } from 'element-plus';

const page = usePage()
const props = defineProps({show: Boolean})
const emit = defineEmits(['close'])

const namaFile = ref('')

const datas = ref([])
const loading = ref(false)

const onFilePicked = async(e) => {
    const file = e.target.files[0]
    namaFile.value = file.name
    loading.value = true
    const ab = await file.arrayBuffer()
    const wb = read(ab)
    const ws = wb.Sheets[wb.SheetNames[0]]
    datas.value = utils.sheet_to_json(ws)
    loading.value = false
}

const closeMe = () => {
    datas.value = []
    emit('close')
}

const unduhFormat = async() => {
    const fields = ['kk_id','nik','nama','jk','tempat_lahir','tanggal_lahir','agama','rt_id','pendidikan','pekerjaan','ayah','ibu'];
    let rows =[]
    let row = []
    for (let c=0; c < fields.length; c++) {
        row[fields[c]] = ''
    }

    rows.push(row)
    const wb = utils.book_new()
    const ws = utils.json_to_sheet(rows)
    utils.book_append_sheet(wb, ws, "warga")

    writeFile(wb, "Template Impor Warga.xlsx", { compression: true})

}

const kirim = async() => {
    loading.value = true
    await router.post(route('dashboard.warga.impor'), {datas: datas.value}, {
        onSuccess: page => {
            ElNotification({title: 'Info', message: page.props.flash.message, type: 'success'})
            router.reload({only: ['wargas']})
            closeMe()
        },
        onError: errs => {
            Object.keys(errs).forEach(k => {
                setTimeout(() => {
                    ElNotification({title: 'Error', message: errs[k], type:'error'})
                }, 500)
            })
        }, onFinish: () => {
            loading.value = false
        }
    })
}
</script>

<template>
    <el-card v-model="props.show" :show-close="false">
        <template #header>
            <div class="flex items-center justify-between">
                <h3>Formulir Impor Warga</h3>
                <div class="header-items flex items-center">
                    <p class="mr-2">{{ namaFile }}</p>
                    <input type="file" ref="fileWarga" accept=".xls,.xlsx,.ods,.csv" @change="onFilePicked" class="hidden">
                    <el-button-group>
                        <el-button type="success" size="small" @click="$refs.fileWarga.click()">Pilih File</el-button>
                        <el-button type="warning" size="small" @click="unduhFormat">Unduh Format</el-button>
                        <el-button type="primary" size="small" @click="kirim" :style="datas.length < 1 ? 'display:none;' : ''">Kirim</el-button>
                    </el-button-group>
                    <el-button type="danger" size="small" circle @click="closeMe" class="ml-2">
                        <Icon icon="mdi:close" />    
                    </el-button>
                </div>
            </div>
        </template>
        <div class="card-">
            <el-table :data="datas" v-loading="loading">
                <el-table-column label="No KK" prop="kk_id"></el-table-column>
                <el-table-column label="No NIK" prop="nik"></el-table-column>
                <el-table-column label="Nama" prop="nama"></el-table-column>
                <el-table-column label="JK" prop="jk"></el-table-column>
                <el-table-column label="Tempat Lahir" prop="tempat_lahir"></el-table-column>
                <el-table-column label="Tanggal Lahir" prop="tanggal_lahir"></el-table-column>
                <el-table-column label="Agama" prop="agama"></el-table-column>
                <el-table-column label="RT" prop="rt_id"></el-table-column>
                <el-table-column label="Pendidikan" prop="pendidikan"></el-table-column>
                <el-table-column label="Pekerjaan" prop="pekerjaan"></el-table-column>
                <el-table-column label="Nama Ayah" prop="ayah"></el-table-column>
                <el-table-column label="Nama Ibu" prop="ibu"></el-table-column>
            </el-table>
        </div>
    </el-card>
</template>