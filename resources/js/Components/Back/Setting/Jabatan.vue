<script setup>
import { Icon } from "@iconify/vue";
import { router, usePage } from "@inertiajs/vue3";
import { ElMessage } from "element-plus";
import { ref } from "vue";

const page = usePage();
const showForm = ref(false);

const newJabatan = ref({});
const loading = ref(false);
const addjabatan = () => {
    showForm.value = true;
};

const editJabatan = (item) => {
    newJabatan.value = item;
    showForm.value = true;
};

const hapus = async (item) => {
    router.delete(route("jabatan.destroy", { id: item.id }), {
        onStart: () => (loading.value = true),
        onSuccess: () => {
            router.reload({ only: ["jabatans"] });
        },
        onFinish: () => (loading.value = false),
    });
};

const simpan = async () => {
    router.post(route("jabatan.store"), newJabatan.value, {
        onStart: () => (loading.value = true),
        onSuccess: () => {
            ElMessage({
                title: "Info",
                message: "Data Jabatan Disimpan",
                type: "success",
            });
            router.reload({ only: ["jabatans"] });
        },
        onFinish: () => (loading.value = false),
    });
};
</script>

<template>
    <div>
        <el-card>
            <template #header>
                <div class="flex items-center justify-between">
                    <h3>Data Jabatan</h3>
                    <div class="header-items flex items-center gap-2">
                        <el-button
                            :native-type="null"
                            type="primary"
                            size="small"
                            @click="addjabatan"
                        >
                            <Icon icon="mdi:account-plus" />
                            Tambah
                        </el-button>
                    </div>
                </div>
            </template>
            <template #default>
                <el-table :data="page.props.jabatans" max-height="300">
                    <el-table-column label="No" type="index"></el-table-column>
                    <el-table-column label="Nama" prop="nama"></el-table-column>
                    <el-table-column
                        label="Deskripsi"
                        prop="deskripsi"
                    ></el-table-column>
                    <el-table-column label="Opsi" width="100" fixed="right">
                        <template #default="{ row }">
                            <el-button-group>
                                <el-button
                                    :native-type="null"
                                    type="warning"
                                    size="small"
                                    @click="editJabatan(row)"
                                >
                                    <Icon icon="mdi:tag-edit" />
                                </el-button>
                                <el-button
                                    :native-type="null"
                                    type="danger"
                                    size="small"
                                    @click="hapus(row)"
                                >
                                    <Icon icon="mdi:delete" />
                                </el-button>
                            </el-button-group>
                        </template>
                    </el-table-column>
                </el-table>
            </template>
        </el-card>

        <el-dialog v-model="showForm" width="400px">
            <template #header>
                <h3>Form Jabatan</h3>
            </template>
            <template #default>
                <el-form v-model="newJabatan" label-position="top">
                    <el-form-item label="Nama Jabatan">
                        <el-input
                            v-model="newJabatan.nama"
                            placeholder="Isi Nama Jabatan"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="Deskripsi Jabatan">
                        <el-input
                            v-model="newJabatan.deskripsi"
                            type="textarea"
                            placeholder="Keterangan Jabatan"
                        ></el-input>
                    </el-form-item>
                    <div class="text-center">
                        <el-button
                            :loading="loading"
                            :native-type="null"
                            type="primary"
                            @click="simpan"
                        >
                            Simpan
                        </el-button>
                    </div>
                </el-form>
            </template>
        </el-dialog>
    </div>
</template>
