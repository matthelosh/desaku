<script setup>
import { ref, computed, defineAsyncComponent } from "vue";
import { usePage, router, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

import DashLayout from "@/Layouts/DashLayout.vue";
import { ElNotification } from "element-plus";

const page = usePage();
const mode = ref("list");
const FormWisata = defineAsyncComponent(
    () => import("@/Components/Back/Wisata/FormWisata.vue"),
);
const wisatas = computed(() => page.props.wisatas);
const selectedWisata = ref(null);

const formWisata = ref(false);
const openForm = () => {
    formWisata.value = true;
    mode.value = "tulis";
};
const edit = (item) => {
    formWisata.value = true;
    selectedWisata.value = item;
    mode.value = "tulis";
};
const closeForm = () => {
    mode.value = "list";
    formWisata.value = false;
    selectedWisata.value = {};
};
const hapus = async (item) => {
    router.delete(route("dashboard.wisata.destroy", { id: item.id }), {
        onSuccess: (page) => {
            ElNotification({
                title: "Info",
                message: page.props.flash.message,
                type: "success",
            });
            router.reload({ only: ["wisatas"] });
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
</script>

<template>
    <Head title="Data Wisata" />
    <DashLayout>
        <div class="relative">
            <div
                class="toolbar w-full border border-sky-200 rounded p-2 bg-sky-100 mb-4 flex justify-between items-center"
            >
                <h3 class="text-sky-800 text-xl flex gap-1 items-center">
                    <Icon icon="mdi:store-cog-outline" class="text-2xl" />
                    Data Potensi Wisata Desa Samar
                </h3>
                <div class="toolbar-items flex items-center gap-1">
                    <el-button
                        type="primary"
                        class="flex items-center gap-1"
                        @click="openForm"
                    >
                        <Icon icon="mdi:store-plus" />
                        Entri Baru
                    </el-button>
                </div>
            </div>
            <TransitionGroup name="pos">
                <el-table
                    :data="wisatas"
                    max-height="85vh"
                    v-if="mode === 'list'"
                    style="width: 100%"
                >
                    <el-table-column label="#" type="index" />
                    <el-table-column label="Foto">
                        <template #default="scope">
                            <el-image
                                :src="scope.row.foto"
                                style="height: 100px"
                            >
                                <template #error>
                                    <img src="/img/balai.jpg" />
                                </template>
                            </el-image>
                        </template>
                    </el-table-column>
                    <el-table-column label="Nama">
                        <template #default="scope">
                            <el-button
                                type="primary"
                                link
                                @click="edit(scope.row)"
                                >{{ scope.row.nama }}</el-button
                            >
                        </template>
                    </el-table-column>
                    <el-table-column
                        label="Lokasi"
                        prop="lokasi"
                    ></el-table-column>
                    <el-table-column
                        label="Harga Tiket"
                        prop="harga_tiket"
                    ></el-table-column>
                    <el-table-column label="Opsi" :fixed="'right'" width="90">
                        <template #default="scope">
                            <span>
                                <el-button
                                    circle
                                    type="primary"
                                    size="small"
                                    @click="edit(scope.row)"
                                >
                                    <Icon icon="mdi:store-edit" />
                                </el-button>
                                <el-popconfirm
                                    placement="left"
                                    title="Yakin hapus?"
                                    @confirm="hapus(scope.row)"
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
                <FormWisata
                    v-if="mode == 'tulis'"
                    :selectedWisata="selectedWisata"
                    @close="closeForm"
                />
            </TransitionGroup>
        </div>
    </DashLayout>
</template>
