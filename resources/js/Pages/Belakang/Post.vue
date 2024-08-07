<script setup>
import { ref, computed, defineAsyncComponent } from "vue";
import { usePage, router, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import dayjs from "dayjs";
import "dayjs/locale/id";

dayjs.locale("id");

import DashLayout from "@/Layouts/DashLayout.vue";
import { ElNotification } from "element-plus";
// import 'element-plus/dist/s'
const WritePost = defineAsyncComponent(
    () => import("@/Components/Back/Post/WritePost.vue"),
);

const mode = ref("list");

const page = usePage();
const loading = ref(false);

// const posts = page.props.data.posts

const selectedPost = ref(null);

const editPost = (item) => {
    selectedPost.value = item;
    mode.value = "tulis";
};
const closeForm = () => {
    mode.value = "list";
    selectedPost.value = null;
};

const hapus = async (id) => {
    router.delete(route("dashboard.post.destroy", { id: id }), {
        onSuccess: (page) => {
            ElNotification({
                title: "Info",
                message: page.props.flash.message,
                type: "success",
            });
            router.reload({ only: ["data.posts"] });
        },
        onError: (errs) => {
            Object.keys(errs).forEach((k) => {
                setTimeout(() => {
                    ElNotification({
                        title: "Error",
                        message: errs[k],
                        type: "error",
                    });
                }, 500);
            });
        },
    });
};

const currentPage = ref(1);
const currentChange = (num) => {
    loading.value = true;
    currentPage.value = num;
    router.visit(page.props.posts.path + "?page=" + num, {
        preserveState: true,
        onFinish: () => (loading.value = false),
    });
};
</script>

<template>
    <Head title="Data Berita" />
    <DashLayout>
        <el-card class="relative" v-loading="loading">
            <div
                class="toolbar w-full border border-sky-200 rounded p-2 bg-sky-100 mb-4 flex justify-between items-center"
            >
                <h3 class="text-sky-800 text-xl">Berita dan Informasi</h3>
                <div class="toolbar-items flex items-center gap-1">
                    <el-button
                        type="primary"
                        class="flex items-center gap-1"
                        @click="mode = 'tulis'"
                    >
                        <Icon icon="mdi:typewriter" />
                        Tulis Berita
                    </el-button>
                </div>
            </div>
            <TransitionGroup name="pos">
                <div v-if="mode === 'list'">
                    <el-table :data="page.props.posts.data" max-height="85vh">
                        <el-table-column label="#" type="index" />
                        <el-table-column label="Judul">
                            <template #default="scope">
                                <el-button
                                    type="primary"
                                    text
                                    @click="editPost(scope.row)"
                                >
                                    {{ scope.row.title }}
                                </el-button>
                            </template>
                        </el-table-column>
                        <el-table-column
                            label="Kategori"
                            prop="category_id"
                            width="150"
                        ></el-table-column>
                        <el-table-column label="Penulis" width="200">
                            <template #default="scope">
                                {{ scope.row.author.name }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Ditulis pada" width="200">
                            <template #default="scope">
                                {{
                                    dayjs(scope.row.created_at).format(
                                        "DD MMM YYYY H:m:s",
                                    )
                                }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Diperbarui pada" width="200">
                            <template #default="scope">
                                {{
                                    dayjs(scope.row.updated_at).format(
                                        "DD MMM YYYY H:m:s",
                                    )
                                }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Status" width="150">
                            <template #default="scope">
                                <!-- {{ scope.row.status }} -->
                                <el-select v-model="scope.row.status">
                                    <el-option
                                        v-for="status in [
                                            'draft',
                                            'publish',
                                            'taken_down',
                                        ]"
                                        :key="status"
                                        :value="status"
                                    ></el-option>
                                </el-select>
                            </template>
                        </el-table-column>
                        <el-table-column
                            label="Opsi"
                            fixed="right"
                            width="100"
                            align="center"
                        >
                            <template #default="scope">
                                <span class="flex gap-1 justify-center">
                                    <el-popconfirm
                                        title="Hapus?"
                                        @confirm="hapus(scope.row.id)"
                                    >
                                        <template #reference>
                                            <el-button
                                                circle
                                                type="danger"
                                                size="small"
                                            >
                                                <Icon icon="mdi:close" />
                                            </el-button>
                                        </template>
                                    </el-popconfirm>
                                </span>
                            </template>
                        </el-table-column>
                    </el-table>
                    <div class="w-full flex items-center justify-between p-2">
                        <p>Total: {{ page.props.posts.total }}</p>
                        <el-pagination
                            :total="page.props.posts.total"
                            background
                            layout="prev, pager, next"
                            v-model:current-page="currentPage"
                            :page-count="page.props.posts.last_page"
                            @current-change="currentChange"
                        />
                    </div>
                </div>
                <WritePost
                    :selectedPost="selectedPost"
                    v-if="mode == 'tulis'"
                    @close="closeForm"
                />
            </TransitionGroup>
        </el-card>
    </DashLayout>
</template>

<style>
.pos-enter-active {
    transition: all 0.5s ease-in-out;
}
.pos-leave-active {
    transition: all 0.2s ease-in-out;
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
