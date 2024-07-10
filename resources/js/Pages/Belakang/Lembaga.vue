<script setup>
import { ref, computed, defineAsyncComponent } from 'vue'
import { Head, usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'

import DashLayout from '@/Layouts/DashLayout.vue'

const page = usePage()

const data = computed(() => page.props.data)
</script>

<template>
    <Head title="Data Kelembagaan" />
    <DashLayout>
        <el-container>
            <el-row :gutter="20" class="w-full">
                <el-col :span="8">
                    <el-card width="100%">
                        <template #header>
                            <div class="flex justify-between items-center">
                                <h3>Dusun</h3>
                            </div>
                        </template>
                        <template #default>
                            <el-table :data="data.dusuns" height="300px">
                                <el-table-column label="#" type="index"></el-table-column>
                                <el-table-column label="Nama" prop="nama"></el-table-column>
                                <el-table-column label="Nama Kasun" prop="kasun"></el-table-column>
                                <el-table-column label="Jml RW" >
                                    <template #default="scope">
                                        {{ scope.row.rws.length }}
                                    </template>
                                </el-table-column>
                            </el-table>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card width="100%">
                        <template #header>
                            <div class="flex justify-between items-center">
                                <h3>Rukun Warga (RW)</h3>
                            </div>
                        </template>
                        <template #default>
                            <el-table :data="data.rws" height="300px">
                                <el-table-column label="#" type="index"></el-table-column>
                                <el-table-column label="Nama" prop="nama"></el-table-column>
                                <el-table-column label="Nama Kasun" prop="ketua"></el-table-column>
                                <el-table-column label="Jml RT" >
                                    <template #default="scope">
                                        {{ scope.row.rts.length }}
                                    </template>
                                </el-table-column>
                            </el-table>
                        </template>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card width="100%" >
                        <template #header>
                            <div class="flex justify-between items-center">
                                <h3>Rukun Tetangga (RT)</h3>
                            </div>
                        </template>
                        <template #default>
                            <el-table :data="data.rts" height="80vh">
                                <el-table-column label="#" type="index"></el-table-column>
                                <el-table-column label="Nama" prop="nama"></el-table-column>
                                <el-table-column label="Nama Kasun" prop="ketua"></el-table-column>
                                <el-table-column label="Jml Warga" >
                                    <template #default="scope">
                                        {{ scope.row.wargas.length }}
                                    </template>
                                </el-table-column>
                            </el-table>
                        </template>
                    </el-card>
                </el-col>
            </el-row>
        </el-container>
    </DashLayout>
</template>