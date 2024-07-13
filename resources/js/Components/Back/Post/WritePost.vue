<script setup>
import { ref, computed, onBeforeMount } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import axios from 'axios'
import { Doc, Text, History, Paragraph, Dropcursor, FontFamily, Bold, Underline, Italic, Strike, Heading, Link, Color, BulletList, OrderedList, TextAlign, LineHeight, Indent, Blockquote, Image, Table, Iframe, HorizontalRule, Fullscreen, Print, SelectAll } from 'element-tiptap-vue3-fixed'
import { ElNotification } from 'element-plus'
import 'element-plus/theme-chalk/display.css'

const page = usePage()
const props = defineProps({ selectedPost: Object})
const emit = defineEmits(['close'])

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


const pos = ref({
    title: '',
    content: 'Isi Tulisan',
    category_id: 'Berita',
    type: 'post'
})

const categories = ref([])
const getCategories = async() => {
    axios.post(route('dashboard.post.category.index'))
            .then(res => categories.value = res.data.categories)
            .catch(err => console.log(err.response))
}

const simpan = async() => {
    let payload = {data: pos.value}
    if (fileCover.value !== null) {
        payload.fileCover = fileCover.value
    }

    await router.post(route('dashboard.post.store'), payload, {
        onSuccess: page => {
            ElNotification({title: 'Info', message: page.props.flash.message, type: 'success'})
        }
    })
}
const fileCover = ref(null)
const onCoverPicked = (e) => {
    const file = e.target.files[0]
    pos.value.cover = URL.createObjectURL(file)
    fileCover.value = file
}

const togglePostProp = () => {
    const postContent = document.querySelector('.post-content')
    const postProp = document.querySelector('.post-prop')

    postContent.classList.toggle('hidden-sm-and-down')
    postProp.classList.toggle('hidden-sm-and-down')
}

onBeforeMount(() => {
    getCategories()
    if (props.selectedPost !== null) {
        pos.value = props.selectedPost
    }
})
</script>

<template>
<div>
    <el-row :gutter="20" class="w-full">
        <el-col :span="20" :xs="24" class="post-content">
            <el-input v-model="pos.title" placeholder="Masukkan Judul Tulisan" size="large" class="mb-4"></el-input>
            <element-tiptap v-model:content="pos.content" :extensions="extensions" />
        </el-col>
        <el-button type="primary"  class="fixed -right-6 md:hidden" @click="togglePostProp">
            <Icon icon="mdi:menu-open" class="text-lg" />
        </el-button>
        <el-col :span="4" :xs="24" class="hidden-sm-and-down post-prop">
            <el-card shadow="hover">
                <span class="flex gap-2 justify-center">
                    <el-button type="primary" block @click="simpan">Simpan Tulisan</el-button>
                    <el-button type="danger" block @click="emit('close')">Tutup</el-button>
                </span>
                <el-divider>Sampul</el-divider>
                <input type="file" ref="imageCover" @change="onCoverPicked" accept=".jpg, .JPG, .JPG, .jpeg, .png, .PNG, .png, .bmp, .BMP" class="hidden">
                <el-button size="small" type="info" @click="$refs.imageCover.click()">Ganti</el-button>
                <el-image :src="pos.cover" class="w-full h-[150px]" @click="$refs.imageCover.click()">
                    <template #error>
                    <div class="image-slot" @click="$refs.imageCover.click()">
                        <Icon icon="mdi:image-remove" />
                    </div>
                    </template>
                </el-image>
                <el-divider>Kategori</el-divider>
                <el-select v-model="pos.category_id" placeholder="Pilih Kategori">
                    <el-option v-for="category in categories" :key="category.id" :value="category.nama"></el-option>
                </el-select>
                <el-divider>Tipe</el-divider>
                <el-select v-model="pos.type" placeholder="Pilih Tipe">
                    <el-option v-for="type in ['post', 'page']" :key="type" :value="type"></el-option>
                </el-select>
            </el-card>
        </el-col>
    </el-row>
</div>

</template>

<style scoped>
.image-slot {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    background: var(--el-fill-color-light);
    color: var(--el-text-color-secondary);
    font-size: 30px;
}
</style>