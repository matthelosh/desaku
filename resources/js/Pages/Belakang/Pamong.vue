<script setup>
import { ref, computed, onBeforeMount } from "vue";
import { usePage, router, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import dayjs from "dayjs";
import "dayjs/locale/id";

dayjs.locale("id");

import DashLayout from "@/Layouts/DashLayout.vue";
import axios from "axios";
import { ElNotification } from "element-plus";
const mode = ref("list");
const page = usePage();
const loading = ref(false);
const pamongs = page.props.data.pamongs;
const pamong = ref({});
const selectedWarga = ref({});
const showDetail = ref(false);

const data = ref({
    jabatans: [],
    wargas: [],
});
const getWarga = async () => {
    axios
        .post(route("dashboard.warga.index"))
        .then((res) => (data.value = res.data.datas));
};

const onPejabatPicked = async (nik) => {
    let pam = await data.value.wargas.filter((warga) => warga.nik === nik)[0];
    selectedWarga.value = pam;
    showDetail.value = true;
};

const simpan = async () => {
    loading.value = true;
    router.post(
        route("dashboard.pamong.store"),
        { data: pamong.value },
        {
            onSuccess: (page) => {
                ElNotification({
                    title: "Info",
                    message: page.props.flash.message,
                    type: "success",
                });
            },
            onError: (errs) => {
                Object.keys(errs).forEach((k) => {
                    setTimeout(() => {
                        ElNotification({
                            title: "Error",
                            message: errs[k],
                            type: "error",
                        });
                    });
                });
            },
        },
    );
};

const editPamong = (item) => {
    // alert('edit')
    pamong.value = item;
    selectedWarga.value = item.warga;
    mode.value = "form";
    showDetail.value = true;
};

onBeforeMount(() => {
    getWarga();
});
</script>

<template>
    <Head title="Data Berita" />
    <DashLayout>
        <div>
            <Transition name="pamong">
                <div v-if="mode == 'list'">
                    <div
                        class="toolbar w-full border border-sky-200 rounded p-2 bg-sky-100 mb-4 flex justify-between items-center"
                    >
                        <h3 class="text-sky-800 text-xl">
                            Manajemen Aparatur Desa
                        </h3>
                        <div class="toolbar-items flex items-center gap-1">
                            <el-button
                                type="primary"
                                class="flex items-center gap-1"
                                @click="mode = 'form'"
                            >
                                <Icon icon="mdi:account-tie" />
                                Entri Baru
                            </el-button>
                        </div>
                    </div>
                    <!-- {{ pamongs }} -->
                    <el-table :data="pamongs" height="85vh">
                        <el-table-column
                            label="NIK"
                            prop="nik"
                            width="200"
                        ></el-table-column>
                        <el-table-column label="Foto" width="120">
                            <template #default="scope">
                                <el-image
                                    :src="scope.row.warga?.foto"
                                    alt="Foto"
                                    style="
                                        width: 70px;
                                        height: 70px;
                                        border-radius: 50%;
                                    "
                                    fit="cover"
                                    :lazy="true"
                                />
                            </template>
                        </el-table-column>
                        <el-table-column label="Nama" width="250">
                            <template #default="scope">
                                <el-button
                                    plain
                                    type="primary"
                                    @click="editPamong(scope.row)"
                                >
                                    {{ scope.row.warga?.nama }}
                                </el-button>
                            </template>
                        </el-table-column>
                        <el-table-column label="Jenis Kelamin" width="100">
                            <template #default="scope">
                                {{ scope.row.warga?.jk }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Tempat, Tgl Lahir" width="250">
                            <template #default="scope">
                                {{ scope.row.warga?.tempat_lahir }},
                                {{
                                    dayjs(
                                        scope.row.warga?.tanggal_lahir,
                                    ).format("DD MMM YYYY")
                                }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Jabatan" width="200">
                            <template #default="scope">
                                {{ scope.row.jabatan?.nama }}
                            </template>
                        </el-table-column>
                        <el-table-column label="Alamat">
                            <template #default="scope">
                                {{ scope.row.warga?.rt?.nama }}/{{
                                    scope.row.warga?.rt?.rw?.nama
                                }}
                                Dusun {{ scope.row.warga?.rt?.rw?.dusun?.nama }}
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
                                    <el-button
                                        circle
                                        type="danger"
                                        size="small"
                                    >
                                        <Icon icon="mdi:close" />
                                    </el-button>
                                </span>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </Transition>
            <Transition name="pamong">
                <div v-if="mode == 'form'">
                    <el-card
                        class="w-full md:w-[60%] mx-auto"
                        v-loading="loading"
                    >
                        <template #header>
                            <div class="flex items-center justify-between">
                                <h3>Formulir Perangkat Desa</h3>

                                <div
                                    class="card-toolbar flex items-center gap-1"
                                >
                                    <el-button
                                        type="primary"
                                        size="small"
                                        @click="simpan"
                                    >
                                        Simpan
                                    </el-button>
                                    <el-button
                                        type="danger"
                                        circle
                                        size="small"
                                        @click="mode = 'list'"
                                    >
                                        <Icon icon="mdi:close" />
                                    </el-button>
                                </div>
                            </div>
                        </template>
                        <template #default>
                            <el-form v-model="pamong" v-loading="loading">
                                <el-row :gutter="20">
                                    <el-col :span="8">
                                        <el-form-item label="Pejabat">
                                            <el-select
                                                filterable
                                                placeholder="Pilih Pejabat"
                                                v-model="pamong.nik"
                                                @change="onPejabatPicked"
                                            >
                                                <el-option
                                                    v-for="(
                                                        warga, w
                                                    ) in data.wargas"
                                                    :key="w"
                                                    :value="warga.nik"
                                                    :label="warga.nama"
                                                ></el-option>
                                            </el-select>
                                        </el-form-item>
                                        <el-form-item label="Jabatan">
                                            <el-select
                                                filterable
                                                placeholder="Pilih Jabatan"
                                                v-model="pamong.jabatan_id"
                                            >
                                                <el-option
                                                    v-for="(
                                                        jabatan, j
                                                    ) in data.jabatans"
                                                    :key="j"
                                                    :value="jabatan.id"
                                                    :label="jabatan.nama"
                                                ></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>

                                    <el-col :span="16">
                                        <el-card
                                            class="mb-4"
                                            shadow="never"
                                            v-if="showDetail"
                                        >
                                            <h3 class="mb-2 font-bold">
                                                Detail Pejabat:
                                            </h3>
                                            <el-row>
                                                <el-col>
                                                    <el-image
                                                        :src="
                                                            selectedWarga.foto
                                                        "
                                                    ></el-image>
                                                </el-col>
                                                <el-col>
                                                    <el-descriptions
                                                        :border="true"
                                                        :column="2"
                                                    >
                                                        <el-descriptions-item
                                                            label="Nama"
                                                            >{{
                                                                selectedWarga.nama
                                                            }}</el-descriptions-item
                                                        >
                                                        <el-descriptions-item
                                                            label="Jenis Kelamin"
                                                            >{{
                                                                selectedWarga.jk
                                                            }}</el-descriptions-item
                                                        >
                                                        <el-descriptions-item
                                                            label="Agama"
                                                            >{{
                                                                selectedWarga.agama
                                                            }}</el-descriptions-item
                                                        >
                                                        <el-descriptions-item
                                                            label="Tempat, Tanggal Lahir"
                                                            >{{
                                                                selectedWarga.tempat_lahir
                                                            }},
                                                            {{
                                                                dayjs(
                                                                    selectedWarga.tanggal_lahir,
                                                                ).format(
                                                                    "DD-MM-YYYY",
                                                                )
                                                            }}</el-descriptions-item
                                                        >
                                                    </el-descriptions>
                                                </el-col>
                                            </el-row>
                                        </el-card>
                                    </el-col>
                                </el-row>
                            </el-form>
                        </template>
                    </el-card>
                </div>
            </Transition>
        </div>
    </DashLayout>
</template>

<style scoped>
.pamong-enter-active {
    transition: all 0.3s ease-in-out;
}
.pamong-leave-active {
    transition: all 0.2s ease-in-out;
}

.pamong-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.pamong-leave-to {
    opacity: 0;
    transform: translateX(50px);
}
</style>

