<script setup>
import { ref, computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const page = usePage();

const currentPage = ref(1);
const loading = ref(false);
const currentChange = (num) => {
    currentPage.value = num;
    loading.value = true;
    router.visit(page.props.users.path + "?page=" + num, {
        preserveState: true,
        onFinish: () => (loading.value = false),
    });
};

const prevPage = (num) => {};

const nextPage = (num) => {};
const selectedUser = ref({});
const formUser = ref(false);
const edit = (item) => {
    selectedUser.value = item;
    formUser.value = true;
};
const closeForm = () => {
    selectedUser.value = {};
    formUser.value = false;
};

const simpan = async () => {
    loading.value = true;
    router.post(route("dashboard.user.store"), selectedUser.value, {
        onSuccess: (page) => {
            loading.value = false;
            ElNotification({
                title: "Info",
                message: page.props.flash.message,
                type: "success",
            });
            closeForm();
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
            loading.value = false;
        },
    });
};

const hapus = async (id) => {
    loading.value = true;
    router.delete(route("dashboard.user.destroy", { id: id }), {
        onSuccess: (page) => {
            loading.value = false;
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
                }, 500);
            });

            loading.value = false;
        },
    });
};

const createUserRT = async () => {
    router.post(route("dashboard.user.rt.create"),
    null,
    {
        onStart: () => loading.value = true,
        onSuccess: () => {
            router.reload({ only: ['users']})
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
        onFinish: () => loading.value = false,
    })
}
</script>

<template>
    <el-card :loading="loading">
        <template #header>
            <div class="flex items-center justify-between">
                <h3 class="text-lg">Data Pengguna</h3>
                <div class="flex items-center justify-end gap-1">
                    <el-button type="primary"
                        size="small"
                        class="flex"
                        @click="createUserRT">
                        <Icon icon="mdi:users" />
                        Akun RT
                    </el-button>
                    <el-button
                        type="primary"
                        size="small"
                        class="flex"
                        @click="formUser = true"
                    >
                        <Icon icon="mdi:account-plus" />
                        Tambah Baru
                    </el-button>
                </div>
            </div>
        </template>
        <template #default>
            <el-table :data="page.props.users.data" v-loading="loading">
                <el-table-column label="#" type="index" />
                <el-table-column label="Username" prop="name" />
                <el-table-column label="Email" prop="email" />
                <el-table-column label="Role">
                    <template #default="scope">
                        {{ scope.row.roles.map((role) => role.name) }}
                    </template>
                </el-table-column>
                <el-table-column label="Profil">
                    <template #default="scope">
                        <div v-if="scope.row.warga">
                            {{ scope.row.warga.nama }}
                        </div>
                        <div v-else>No Profile</div>
                    </template>
                </el-table-column>
                <el-table-column label="Opsi">
                    <template #default="scope">
                        <div class="flex items-center">
                            <el-button
                                circle
                                type="warning"
                                size="small"
                                @click="edit(scope.row)"
                            >
                                <Icon icon="mdi:account-edit" />
                            </el-button>
                            <el-button circle type="primary" size="small">
                                <Icon icon="mdi:account-cog" />
                            </el-button>
                            <el-button circle type="success" size="small">
                                <Icon icon="mdi:account-lock" />
                            </el-button>
                            <el-popconfirm
                                @confirm="hapus(scope.row.id)"
                                title="Hapus User?"
                            >
                                <template #reference>
                                    <el-button
                                        circle
                                        type="danger"
                                        size="small"
                                    >
                                        <Icon icon="mdi:delete" />
                                    </el-button>
                                </template>
                            </el-popconfirm>
                        </div>
                    </template>
                </el-table-column>
            </el-table>
        </template>
        <template #footer>
            <div class="flex items-center justify-between p-2">
                <p>Total: {{ page.props.users.total }}</p>
                <el-pagination
                    layout="prev, pager, next"
                    :current-page="currentPage"
                    :total="page.props.users.total"
                    :page-count="page.props.users.last_page"
                    @current-change="currentChange"
                    @prev-click="prevPage"
                    @next-click="nextPage"
                    background
                ></el-pagination>
            </div>
        </template>
    </el-card>
    <el-dialog v-model="formUser" @close="closeForm">
        <template #header>
            <div class="header flex items-center justify-between">
                <h3 class="text-lg tracking-wide font-bold text-slate-500">
                    Form User
                </h3>
            </div>
        </template>
        <template #default>
            <el-form
                v-model="selectedUser"
                label-width="150"
                v-loading="loading"
            >
                <el-form-item label="Username">
                    <el-input
                        v-model="selectedUser.name"
                        placeholder="Username"
                    />
                </el-form-item>
                <el-form-item label="Email">
                    <el-input
                        v-model="selectedUser.email"
                        placeholder="Email"
                    />
                </el-form-item>
                <el-form-item label="Password">
                    <el-input
                        v-model="selectedUser.password"
                        placeholder="Password"
                    />
                </el-form-item>
                <el-form-item label="Role">
                    <el-select v-model="selectedUser.role" placeholder="Peran">
                        <el-option
                            v-for="(role, r) in page.props.roles"
                            :key="r"
                            :value="role.name"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item label="Warga">
                    <el-select
                        v-model="selectedUser.warga_id"
                        placeholder="Cari Warga"
                        filterable
                    >
                        <el-option
                            v-for="(warga, w) in page.props.wargas"
                            :key="w"
                            :value="warga.id"
                            :label="warga.nama"
                        ></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="">
                    <el-button type="primary" :loading="loading" @click="simpan"
                        >Simpan</el-button
                    >
                </el-form-item>
            </el-form>
        </template>
    </el-dialog>
</template>
