<script setup>
import { ref, computed, defineAsyncComponent } from "vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { lebar } from "@/helpers/layout";

import DashLayout from "@/Layouts/DashLayout.vue";
import { ElNotification } from "element-plus";

const page = usePage();
const FormLembaga = defineAsyncComponent(
    () => import("@/Components/Back/Lembaga/FormLembaga.vue"),
);
const MgmtMember = defineAsyncComponent(
    () => import("@/Components/Back/Lembaga/MgmtMember.vue"),
);
const FormDusun = defineAsyncComponent(
    () => import("@/Components/Back/Lembaga/FormDusun.vue"),
);
const FormRw = defineAsyncComponent(
    () => import("@/Components/Back/Lembaga/FormRw.vue"),
);
const FormRt = defineAsyncComponent(
    () => import("@/Components/Back/Lembaga/FormRt.vue"),
);
const formLembaga = ref(false);
const selectedLembaga = ref(null);
const loading = ref(false);

const mgmtMember = ref(false);

const aturMember = (item) => {
    selectedLembaga.value = item;
    mgmtMember.value = true;
};
const showFormLembaga = () => {
    formLembaga.value = true;
};
const closeFormLembaga = () => {
    formLembaga.value = false;
    mgmtMember.value = false;
    selectedLembaga.value = null;
};

const edit = (item) => {
    selectedLembaga.value = item;
    formLembaga.value = true;
};
const hapus = async (id) => {
    router.delete(route("dashboard.lembaga.destroy", { id: id }), {
        onStart: (start) => {
            loading.value = true;
        },
        onSuccess: (page) => {
            loading.value = false;
            ElNotification({
                title: "Info",
                message: page.props.flash.message,
                type: "success",
            });
        },
    });
};

const formDusun = ref(false);
const selectedDusun = ref({});
const addDusun = () => {
    formDusun.value = true;
};

const editDusun = (item) => {
    selectedDusun.value = item;
    formDusun.value = true;
};
const closeFormDusun = () => {
    formDusun.value = false;
    selectedDusun.value = {};
};

const hapusDusun = async (id) => {
    router.delete(route("dashboard.dusun.destroy", { id: id }), {
        onSuccess: (page) =>
            ElNotification({
                title: "Info",
                message: page.props.flash.message,
                type: "success",
            }),
        onerror: (errs) => console.log(errs),
    });
};

const formRw = ref(false);
const selectedRw = ref({});
const addRw = (dusun) => {
    // console.log(dusun)
    selectedDusun.value = dusun;
    formRw.value = true;
};
const editRw = (dusun, rw) => {
    console.log(dusun, rw);
    selectedDusun.value = dusun;
    selectedRw.value = rw;
    formRw.value = true;
};

const closeFormRw = () => {
    selectedDusun.value = {};
    selectedRw.value = {};
    formRw.value = false;
};

const formRt = ref(false);
const selectedRt = ref({});
const addRt = (rw) => {
    formRt.value = true;
    selectedRw.value = rw;
    selectedDusun.value = page.props.data.dusuns.filter((dusun) =>
        dusun.rws.map((itemRw) => itemRw.id).includes(rw.id),
    )[0];
};

const editRt = (rw, rt) => {
    selectedRw.value = rw;
    selectedDusun.value = page.props.data.dusuns.filter((dusun) =>
        dusun.rws.map((itemRw) => itemRw.id).includes(rw.id),
    )[0];
    selectedRt.value = rt;
    formRt.value = true;
};
const closeFormRt = () => {
    formRt.value = false;
    selectedDusun.value = {};
    selectedRw.value = {};
    selectedRt.value = {};
};

const data = computed(() => page.props.data);
</script>

<template>
    <Head title="Data Kelembagaan" />
    <DashLayout>
        <el-container>
            <el-row
                :gutter="lebar() === 'xs' ? 0 : 20"
                class="w-full"
                justify="space-between"
            >
                <el-col :span="12" :xs="24">
                    <el-card>
                        <template #header>
                            <div
                                class="toolbar flex justify-between items-center"
                            >
                                <h3 class="font-bold uppercase">
                                    Lembaga Masyarakat & Pemerintahan Desa
                                </h3>
                                <el-button
                                    type="primary"
                                    size="small"
                                    circle
                                    @click="showFormLembaga"
                                >
                                    <Icon
                                        icon="mdi-plus"
                                        class="text-lg hover:rotate-90 transision-all duration-200"
                                    />
                                </el-button>
                            </div>
                        </template>
                        <template #default>
                            <el-table
                                :data="data.lembagas"
                                max-height="82vh"
                                v-loading="loading"
                            >
                                <el-table-column
                                    label="#"
                                    type="index"
                                    width="60"
                                ></el-table-column>
                                <el-table-column
                                    label="Kode"
                                    prop="kode"
                                    width="100"
                                ></el-table-column>
                                <el-table-column
                                    label="Nama"
                                    prop="nama"
                                ></el-table-column>

                                <el-table-column
                                    label="Opsi"
                                    width="150"
                                    fixed="right"
                                >
                                    <template #default="scope">
                                        <div class="flex items-center gap-1">
                                            <el-button
                                                circle
                                                type="primary"
                                                size="small"
                                                @click="aturMember(scope.row)"
                                            >
                                                <Icon
                                                    icon="mdi:human-capacity-increase"
                                                />
                                            </el-button>
                                            <el-button
                                                circle
                                                type="warning"
                                                size="small"
                                                @click="edit(scope.row)"
                                            >
                                                <Icon icon="mdi:edit" />
                                            </el-button>
                                            <el-popconfirm
                                                :title="`Hapus lembaga ${scope.row.nama}?`"
                                                @confirm="hapus(scope.row.id)"
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
                                <el-table-column
                                    label="Detail"
                                    type="expand"
                                    width="200"
                                >
                                    <template #default="props">
                                        <div class="pl-4 py-4">
                                            <h3 class="font-bold">Anggota</h3>
                                            <el-table
                                                :data="props.row.members"
                                                :border="true"
                                            >
                                                <el-table-column
                                                    label="#"
                                                    type="index"
                                                    width="50"
                                                ></el-table-column>
                                                <el-table-column
                                                    label="Nama"
                                                    prop="nama"
                                                ></el-table-column>
                                                <el-table-column
                                                    label="Jabatan"
                                                    prop="pivot.jabatan"
                                                    width="160"
                                                ></el-table-column>
                                                <el-table-column label="Alamat">
                                                    <template #default="scope">
                                                        {{ scope.row.rt.nama }}
                                                        {{
                                                            scope.row.rt.rw.nama
                                                        }}
                                                        {{
                                                            scope.row.rt.rw
                                                                .dusun.nama
                                                        }}
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                        </div>
                                    </template>
                                </el-table-column>
                            </el-table>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="12" :xs="24">
                    <el-card class="mt-4 md:mt-0">
                        <template #header>
                            <div
                                class="toolbar flex justify-between items-center"
                            >
                                <h3 class="font-bold uppercase">
                                    Lembaga Teritorial
                                </h3>

                                <el-button
                                    size="small"
                                    type="primary"
                                    @click="addDusun"
                                    class="flex items-center gap-1"
                                >
                                    <icon icon="mdi:plus" class="text-lg" />
                                    Tambah Dusun
                                </el-button>
                            </div>
                        </template>
                        <el-table :data="data.dusuns" max-height="82vh">
                            <el-table-column
                                label="#"
                                type="index"
                                width="60"
                            ></el-table-column>
                            <el-table-column label="Dusun" width="250">
                                <template #default="scope">
                                    <el-button
                                        text
                                        type="primary"
                                        @click="editDusun(scope.row)"
                                        >{{ scope.row.nama }}</el-button
                                    >
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="Kasun"
                                prop="kasun.nama"
                            ></el-table-column>
                            <el-table-column label="Jml RW">
                                <template #default="scope">
                                    {{ scope.row.rws.length }}
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="Detail"
                                type="expand"
                                width="200"
                            >
                                <template #default="props">
                                    <div class="pl-4 py-4">
                                        <div
                                            class="flex items-center justify-between px-1 py-2"
                                        >
                                            <h3 class="font-bold">Data RW</h3>
                                            <el-button
                                                size="small"
                                                type="primary"
                                                @click="addRw(props.row)"
                                                class="mr-4 flex items-center gap-1"
                                            >
                                                <icon
                                                    icon="mdi:plus"
                                                    class="text-lg"
                                                />
                                                Tambah RW
                                            </el-button>
                                        </div>
                                        <el-table
                                            :data="props.row.rws"
                                            :border="true"
                                        >
                                            <el-table-column
                                                label="#"
                                                type="index"
                                                width="60"
                                            ></el-table-column>
                                            <el-table-column
                                                label="RW"
                                                width="100"
                                            >
                                                <template #default="scope">
                                                    <el-button
                                                        text
                                                        type="primary"
                                                        @click="
                                                            editRw(
                                                                props.row,
                                                                scope.row,
                                                            )
                                                        "
                                                        >{{
                                                            scope.row.nama
                                                        }}</el-button
                                                    >
                                                </template>
                                            </el-table-column>
                                            <el-table-column label="Ketua">
                                                <template #default="scope">
                                                    {{ scope.row.ketua?.nama }}
                                                </template>
                                            </el-table-column>
                                            <el-table-column label="Jml RT">
                                                <template #default="scope">
                                                    {{ scope.row.rts.length }}
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                label="Detail"
                                                type="expand"
                                                width="200"
                                            >
                                                <template #default="props">
                                                    <div class="ml-4 my-4">
                                                        <div
                                                            class="flex items-center justify-between py-2"
                                                        >
                                                            <h3
                                                                class="font-bold"
                                                            >
                                                                Data RT
                                                            </h3>
                                                            <el-button
                                                                size="small"
                                                                type="primary"
                                                                @click="
                                                                    addRt(
                                                                        props.row,
                                                                    )
                                                                "
                                                                class="mr-6 flex items-center gap-1"
                                                            >
                                                                <icon
                                                                    icon="mdi:plus"
                                                                    class="text-lg"
                                                                />
                                                                Tambah RT
                                                            </el-button>
                                                        </div>
                                                        <el-table
                                                            :data="
                                                                props.row.rts
                                                            "
                                                        >
                                                            <el-table-column
                                                                label="#"
                                                                type="index"
                                                                width="60"
                                                            ></el-table-column>
                                                            <el-table-column
                                                                label="RT"
                                                                width="100"
                                                            >
                                                                <template
                                                                    #default="scope"
                                                                >
                                                                    <el-button
                                                                        text
                                                                        type="primary"
                                                                        @click="
                                                                            editRt(
                                                                                props.row,
                                                                                scope.row,
                                                                            )
                                                                        "
                                                                        >{{
                                                                            scope
                                                                                .row
                                                                                .nama
                                                                        }}</el-button
                                                                    >
                                                                </template>
                                                            </el-table-column>
                                                            <el-table-column
                                                                label="Ketua"
                                                                prop="ketua.nama"
                                                            ></el-table-column>
                                                            <el-table-column
                                                                label="Jml Warga"
                                                            >
                                                                <template
                                                                    #default="scope"
                                                                >
                                                                    {{
                                                                        scope
                                                                            .row
                                                                            .wargas
                                                                            .length
                                                                    }}
                                                                </template>
                                                            </el-table-column>
                                                        </el-table>
                                                    </div>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                    </div>
                                </template>
                            </el-table-column>
                            <el-table-column
                                label="Opsi"
                                fixed="right"
                                width="80"
                            >
                                <template #default="scope">
                                    <el-popconfirm
                                        :title="`Hapus Dusun ${scope.row.nama}?`"
                                        @confirm="hapusDusun(scope.row.id)"
                                    >
                                        <template #reference>
                                            <el-button
                                                type="danger"
                                                circle
                                                size="small"
                                            >
                                                <Icon icon="mdi:close" />
                                            </el-button>
                                        </template>
                                    </el-popconfirm>
                                </template>
                            </el-table-column>
                        </el-table>
                    </el-card>
                </el-col>
            </el-row>
        </el-container>
    </DashLayout>
    <FormLembaga
        v-if="formLembaga"
        :show="formLembaga"
        :selectedLembaga="selectedLembaga"
        @close="closeFormLembaga"
    />
    <MgmtMember
        v-if="mgmtMember"
        :show="mgmtMember"
        :selectedLembaga="selectedLembaga"
        @close="closeFormLembaga"
    />
    <FormDusun
        v-if="formDusun"
        :show="formDusun"
        :selectedDusun="selectedDusun"
        @close="closeFormDusun"
    />
    <FormRw
        v-if="formRw"
        :show="formRw"
        :selectedRw="selectedRw"
        :selectedDusun="selectedDusun"
        @close="closeFormRw"
    />
    <FormRt
        v-if="formRt"
        :show="formRt"
        :selectedRt="selectedRt"
        :selectedRw="selectedRw"
        :selectedDusun="selectedDusun"
        @close="closeFormRt"
    />
</template>

