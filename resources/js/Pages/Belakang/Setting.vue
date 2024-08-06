<script setup>
import { ref, computed } from "vue";
import { router, usePage, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

import DashLayout from "@/Layouts/DashLayout.vue";

const page = usePage();
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
                </el-card>
            </div>
            <div class="col-span-2 md:col-span-3">
                <el-card>
                    <template #header>
                        <h3 class="text-lg">Data Pengunjung</h3>
                    </template>
                    <el-table
                        :data="page.props.data.visitors"
                        max-height="78vh"
                    >
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
