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
</script>

<template>
    <el-card>
        <template #header>
            <div class="flex items-center justify-between">
                <h3 class="text-lg">Data Pengguna</h3>
                <el-button type="primary" size="small" class="flex">
                    <Icon icon="mdi:account-plus" />
                    Tambah Baru
                </el-button>
            </div>
        </template>
        <template #default>
            <el-table :data="page.props.users.data">
                <el-table-column label="#" type="index" />
                <el-table-column label="Username" prop="name" />
                <el-table-column label="Email" prop="email" />
                <el-table-column label="Profil">
                    <template #default="scope">
                        <div v-if="scope.row.warga"></div>
                        <div v-else>No Profile</div>
                    </template>
                </el-table-column>
                <el-table-column label="Opsi">
                    <template #default="scope">
                        <div class="flex items-center">
                            <el-button circle type="warning" size="small">
                                <Icon icon="mdi:account-edit" />
                            </el-button>
                            <el-button circle type="primary" size="small">
                                <Icon icon="mdi:account-cog" />
                            </el-button>
                            <el-button circle type="success" size="small">
                                <Icon icon="mdi:account-lock" />
                            </el-button>

                            <el-button circle type="danger" size="small">
                                <Icon icon="mdi:delete" />
                            </el-button>
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
</template>
