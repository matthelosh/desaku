<script setup>
import { ref, computed } from "vue";
import { router, usePage, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

import DashLayout from "@/Layouts/DashLayout.vue";

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
    <Head title="Pengaturan" />
    <DashLayout>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-3">
            <div class="col-span-1 md:col-span-3">
                <el-card>
                    <template #header>
                        <h3 class="text-lg">Data Pengguna</h3>
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
                                        <el-button
                                            circle
                                            type="warning"
                                            size="small"
                                        >
                                            <Icon icon="mdi:account-edit" />
                                        </el-button>
                                        <el-button
                                            circle
                                            type="primary"
                                            size="small"
                                        >
                                            <Icon icon="mdi:account-cog" />
                                        </el-button>
                                        <el-button
                                            circle
                                            type="success"
                                            size="small"
                                        >
                                            <Icon icon="mdi:account-lock" />
                                        </el-button>

                                        <el-button
                                            circle
                                            type="danger"
                                            size="small"
                                        >
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
            </div>
            <div class="col-span-2 md:col-span-3">
                <el-card>
                    <template #header>
                        <h3 class="text-lg">Data Pengunjung</h3>
                    </template>
                    <el-table :data="page.props.visitors" max-height="78vh">
                        <el-table-column
                            label="Alamat IP"
                            prop="ip_address"
                        ></el-table-column>
                        <el-table-column
                            label="Laman"
                            prop="visited_uri"
                        ></el-table-column>
                        <el-table-column
                            label="Agen"
                            prop="user_agent"
                        ></el-table-column>
                        <el-table-column
                            label="Negara"
                            prop="country"
                        ></el-table-column>
                    </el-table>
                </el-card>
            </div>
            <!-- <div class="col-span-1"> -->
            <!--     <el-card> -->
            <!--         <h3>Data Pengunjung</h3> -->
            <!--     </el-card> -->
            <!-- </div> -->
            <!-- <div class="col-span-1"> -->
            <!--     <el-card> -->
            <!--         <h3>Data Pengunjung</h3> -->
            <!--     </el-card> -->
            <!-- </div> -->
        </div>
    </DashLayout>
</template>
