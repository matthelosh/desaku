<script setup>
import { ref, computed, defineAsyncComponent } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { Doc, Text, History, Paragraph, Dropcursor, FontFamily, Bold, Underline, Italic, Strike, Heading, Link, Color, BulletList, OrderedList, TextAlign, LineHeight, Indent, Blockquote, Image, Table, Iframe, HorizontalRule, Fullscreen, Print, SelectAll } from 'element-tiptap-vue3-fixed'
import DashLayout from '@/Layouts/DashLayout.vue'
import { ElNotification } from 'element-plus';
const AllAgenda = defineAsyncComponent(() => import('@/Components/Back/Agenda/AllAgenda.vue'))
const extensions = [
    Doc, Text, History, Dropcursor,
    Paragraph.configure({buble: true}), Heading.configure({buble: true}),FontFamily, Color.configure({buble: true}), Underline.configure({buble: true}), Bold.configure({buble: true}), Italic.configure({buble: true}),  TextAlign.configure({buble: true}),Indent, Blockquote, LineHeight, Link.configure({buble: true}), Strike.configure({buble: true}), BulletList, OrderedList,
    Image.configure({
        defaultWidth: 400,
        draggable: true,
        uploadRequest: async(file) => {
            let fd = new FormData()
            fd.append("image", file)
            return new Promise(async(resolve, reject) => {
                await axios.post(route('dashboard.post.image.upload'), fd).then(res => {
                    resolve(res.data.url)
                })
            })
        }
    }),
    Table, Iframe, HorizontalRule, Print, SelectAll, Fullscreen
]
const page = usePage()
const mode = ref('list')

const newAgenda = ref({
})

const editAgenda = (item) => {
    newAgenda.value = item
    
}

const simpan = async() => {
    // console.log(newAgenda.value)
    router.post(route('dashboard.agenda.store'), {data: newAgenda.value}, {
        onSuccess: page => {
            ElNotification({ title: 'Info', message: page.props.flash.message, type: 'success'})
            router.reload({only: ['agendas']})
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
    <Head title="Agenda Kegiatan" />
    <DashLayout>
        <el-row class="w-full" :gutter="20">
            <el-col :span="16">
                <el-card>
                    <AllAgenda @edit="editAgenda" />
                </el-card>
            </el-col>
            <el-col :span="8">
                <el-affix :offset="80">
                    <el-card>
                        
                        <el-divider>Tambah Agenda</el-divider>
                        <el-form v-model="newAgenda" label-position="top" ref="formAgenda">
                            <el-form-item label="Nama" >
                                <el-input v-model="newAgenda.nama" 
                            placeholder="Masukkan Nama Kegiatan" />
                            </el-form-item>
                            <el-form-item label="Waktu Mulai" >
                                <el-input type="date" v-model="newAgenda.mulai" 
                            placeholder="Waktu Kegiatan" />
                            </el-form-item>
                            <el-form-item label="Waktu Selesai" >
                                <el-input type="date" v-model="newAgenda.selesai" 
                            placeholder="Waktu Kegiatan" />
                            </el-form-item>
                            <el-form-item label="Lokasi" >
                                <el-input v-model="newAgenda.lokasi" 
                            placeholder="Masukkan Lokasi Kegiatan" />
                            </el-form-item>
                            <el-form-item label="Pelaksana" >
                                <el-input v-model="newAgenda.pelaksana" 
                            placeholder="Masukkan Pelaksana Kegiatan" />
                            </el-form-item>
                            <el-form-item label="Deskripsi" >
                                <el-input type="textarea" v-model="newAgenda.deskripsi" placeholder="Keterangan" />
                            </el-form-item>
                            <div class="flex justify-center gap-1 items-center">
                                <el-button type="warning" size="small" @click="newAgenda = {}">Reset</el-button>
                                <el-button type="primary" size="large" @click="simpan">Simpan</el-button>
                            </div>
                        </el-form>
                    </el-card>
                </el-affix>
            </el-col>
        </el-row>
    </DashLayout>
</template>