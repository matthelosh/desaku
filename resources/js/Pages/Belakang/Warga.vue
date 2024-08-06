<script setup>
import { ref, computed, defineAsyncComponent, onMounted } from "vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import DashLayout from "@/Layouts/DashLayout.vue";
import { lebar } from "@/helpers/layout.js";
const FormWarga = defineAsyncComponent(
    () => import("@/Components/Back/Warga/FormWarga.vue"),
);
const ImporWarga = defineAsyncComponent(
    () => import("@/Components/Back/Warga/ImportWarga.vue"),
);
const mode = ref("list");
const selectedWarga = ref(null);
const page = usePage();
const wargas = computed(() => page.props.wargas);
const search = ref("");
const datas = computed(() => {
    return page.props.wargas.data.filter((warga) =>
        warga.nama.toLowerCase().includes(search.value.toLowerCase()),
    );
});
const cari = async () => {
    progressIndicator.value = true;
    router.visit(
        route("dashboard.warga", {
            _query: {
                q: search.value,
            },
        }),
        {
            preserveState: true,
            onFinish: () => (progressIndicator.value = false),
        },
    );
};
const currentPage = ref(1);

const progressIndicator = ref(false);

const tambah = () => {
    mode.value = "tambah";
};

const edit = (item) => {
    selectedWarga.value = item;
    mode.value = "tambah";
};

const hapus = async (id) => {
    router.delete(route("dashboard.warga.destroy", { id: id }), {
        onStart: (visit) => {
            progressIndicator.value = true;
        },
        onProgress: (progress) => console.log(progress),
        onSuccess: (page) => {
            progressIndicator.value = false;
            router.reload({ only: ["wargas"] });
        },
        onError: (errs) => console.log(errs),
    });
};

const closeForm = () => {
    // alert('halo')
    selectedWarga.value = null;
    mode.value = "list";
};
const impor = () => {
    mode.value = "impor";
};
const imporWarga = ref(false);
const closeImpor = () => {
    mode.value = "list";
};

const pageChanged = (currentPage, pageSize) => {
    console.log(currentPage, pageSize);
};

const currentChange = (pageNumber) => {
    // console.log(pageNumber);
    currentPage.value = pageNumber;
    progressIndicator.value = true;
    router.visit(wargas.value.path + "?page=" + pageNumber, {
        preserveState: true,
        onFinish: () => (progressIndicator.value = false),
    });
};

const prevPage = (pageNumber) => {
    //console.log(pageNumber);
    // currentPage.value -= 1;
};
const nextPage = (pageNumber) => {
    //    console.log(pageNumber);
    // currentPage.value += 1;
};
</script>

<template>
    <Head title="Data Warga" />
    <DashLayout>
        <el-container>
            <el-row :gutter="lebar() == 'xs' ? 0 : 20" class="w-full">
                <el-col :span="24">
                    <Transition name="warga">
                        <el-card v-if="mode == 'list'" width="100%">
                            <template #header>
                                <div class="flex justify-between items-center">
                                    <h3>Data Warga</h3>

                                    <div
                                        class="toolbar-items flex items-center gap-2"
                                    >
                                        <el-input
                                            placeholder="Cari Warga"
                                            v-model="search"
                                            clearable
                                            @change="cari"
                                        >
                                            <template #suffix>
                                                <Icon icon="mdi:magnify" />
                                            </template>
                                        </el-input>
                                        <el-button
                                            type="primary"
                                            @click="tambah"
                                            >Tambah Baru</el-button
                                        >
                                        <el-button type="success" @click="impor"
                                            >Impor</el-button
                                        >
                                    </div>
                                </div>
                            </template>
                            <template #default>
                                <el-table
                                    :data="wargas.data"
                                    max-height="75vh"
                                    v-loading="progressIndicator"
                                    element-loading-text="`Tunggu sebentar`"
                                >
                                    <el-table-column
                                        label="#"
                                        type="index"
                                        width="80"
                                    ></el-table-column>
                                    <el-table-column
                                        label="NIK"
                                        prop="nik"
                                        width="150"
                                    ></el-table-column>
                                    <el-table-column
                                        label="Nama"
                                        prop="nama"
                                        sortable
                                    ></el-table-column>
                                    <el-table-column
                                        label="Jenis Kelamin"
                                        prop="jk"
                                        width="150"
                                    ></el-table-column>
                                    <el-table-column
                                        label="RT"
                                        prop="rt.nama"
                                        sortable
                                        width="80"
                                    ></el-table-column>
                                    <el-table-column
                                        label="RW"
                                        prop="rw.nama"
                                        sortable
                                        width="80"
                                    ></el-table-column>
                                    <el-table-column
                                        label="Dusun"
                                        prop="dusun.nama"
                                        width="150"
                                    ></el-table-column>
                                    <el-table-column
                                        label="Opsi"
                                        fixed="right"
                                        width="150"
                                    >
                                        <template #default="scope">
                                            <div
                                                class="flex items-center gap-1"
                                            >
                                                <el-button
                                                    circle
                                                    type="warning"
                                                    size="small"
                                                    @click="edit(scope.row)"
                                                >
                                                    <Icon icon="mdi:edit" />
                                                </el-button>
                                                <el-popconfirm
                                                    title="Hapus Data?"
                                                    @confirm="
                                                        hapus(scope.row.id)
                                                    "
                                                >
                                                    <template #reference>
                                                        <el-button
                                                            circle
                                                            type="danger"
                                                            size="small"
                                                        >
                                                            <Icon
                                                                icon="mdi:close"
                                                            />
                                                        </el-button>
                                                    </template>
                                                </el-popconfirm>
                                            </div>
                                        </template>
                                    </el-table-column>
                                </el-table>
                            </template>
                            <template #footer>
                                <div
                                    class="flex items-center p-2 justify-between w-full"
                                >
                                    <p>
                                        Jumlah Warga: {{ wargas.total }} | Page:
                                        {{ currentPage }}
                                    </p>
                                    <el-pagination
                                        layout="prev, pager, next"
                                        :current-page="currentPage"
                                        :total="wargas.total"
                                        :page-count="wargas.last_page"
                                        @current-change="currentChange"
                                        @prev-click="prevPage"
                                        @next-click="nextPage"
                                        background
                                    ></el-pagination>
                                </div>
                            </template>
                        </el-card>
                    </Transition>
                    <Transition name="warga">
                        <FormWarga
                            v-if="mode == 'tambah'"
                            :selectedWarga="selectedWarga"
                            @close="closeForm"
                        />
                    </Transition>
                    <Transition name="warga">
                        <ImporWarga
                            v-if="mode == 'impor'"
                            @close="closeImpor"
                            :show="mode == 'impor'"
                        />
                    </Transition>
                </el-col>
            </el-row>
        </el-container>
    </DashLayout>
</template>

<style scoped>
.warga-enter-active {
    transition: all 0.3s ease-in-out;
}
.warga-leave-active {
    transition: all 0.2s ease-in-out;
}

.warga-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.warga-leave-to {
    opacity: 0;
    transform: translateX(50px);
}
</style>
