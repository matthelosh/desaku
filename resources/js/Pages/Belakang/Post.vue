<script setup>
import { ref, computed, defineAsyncComponent } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import dayjs from 'dayjs'
import 'dayjs/locale/id'

dayjs.locale('id')

import DashLayout from '@/Layouts/DashLayout.vue'
import { ElNotification } from 'element-plus'
// import 'element-plus/dist/s'
const WritePost = defineAsyncComponent(() => import('@/Components/Back/Post/WritePost.vue'))

const mode = ref('list')

const page = usePage()

// const posts = page.props.data.posts

const selectedPost = ref(null)

const editPost = (item) => {
    selectedPost.value = item
    mode.value = 'tulis'
} 
const closeForm = () => {
    mode.value = 'list'
    selectedPost.value = null
}

const hapus = async(id) => {
    router.delete(route('dashboard.post.destroy', {id: id}), {
        onSuccess: page => {
            ElNotification({title: 'Info', message: page.props.flash.message, type: 'success'})
            router.reload({only: ['data.posts']})
        }, onError: errs => {
            Object.keys(errs).forEach(k => {
                setTimeout(() => {
                    ElNotification({title: 'Error', message: errs[k], type: 'error'})
                }, 500)
            })
        }
    })
}
</script>

<template>
<Head title="Data Berita" />
<DashLayout>
    <div class="relative">
        <div class="toolbar w-full border border-sky-200 rounded p-2 bg-sky-100 mb-4 flex justify-between items-center">
            <h3 class=" text-sky-800 text-xl">Berita dan Informasi</h3>
            <div class="toolbar-items flex items-center gap-1">
                <el-button type="primary" class="flex items-center gap-1" @click="mode = 'tulis'">
                    <Icon icon="mdi:typewriter" />
                    Tulis Berita
                </el-button>
            </div>
        </div>
        <TransitionGroup name="pos" >
            <el-table :data="page.props.data.posts" height="85vh" v-if="mode === 'list'">
                <el-table-column label="Judul">
                    <template #default="scope">
                        <el-button type="primary" text @click="editPost(scope.row)">
                            {{ scope.row.title }}
                        </el-button>
                    </template>
                </el-table-column>
                <el-table-column label="Kategori" prop="category_id" width="150"></el-table-column>
                <el-table-column label="Penulis" width="200">
                    <template #default="scope">
                        {{ scope.row.author.name }}
                    </template>
                </el-table-column>
                <el-table-column label="Ditulis pada" width="200">
                    <template #default="scope">
                        {{ dayjs(scope.row.created_at).format('DD MMM YYYY H:m:s') }}
                    </template>
                </el-table-column>
                <el-table-column label="Diperbarui pada" width="200">
                    <template #default="scope">
                        {{ dayjs(scope.row.updated_at).format('DD MMM YYYY H:m:s') }}
                    </template>
                </el-table-column>
                <el-table-column label="Status" width="150">
                    <template #default="scope">
                        <!-- {{ scope.row.status }} -->
                        <el-select v-model="scope.row.status">
                            <el-option  v-for="status in ['draft', 'publish', 'taken_down']" :key="status" :value="status"></el-option>
                        </el-select>
                    </template>
                </el-table-column>
                <el-table-column label="Opsi" fixed="right" width="100" align="center">
                    <template #default="scope">
                        <span class="flex gap-1 justify-center">
                            <el-popconfirm title="Hapus?" @confirm="hapus(scope.row.id)">
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
            <WritePost :selectedPost="selectedPost" v-if="mode == 'tulis'" @close="closeForm" />
        </TransitionGroup>
    </div>
</DashLayout>
</template>

<style scoped>
.pos-enter-active {
    transition: all .5s ease-in-out
}
.pos-leave-active {
    transition: all .2s ease-in-out;
}

.pos-enter-from {
    opacity: 0;
    transform: translateX(-50px);
    position: absolute;
}
.pos-leave-to {
    opacity: 0;
    transform: translateX(20px);
    /* position: absolute; */
}
</style>