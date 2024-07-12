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
                <el-col :span="12">
                        <el-card>
                            <template #header>
                                <div class="toolbar flex jutify-between items-center">
                                    <h3 class="font-bold uppercase">Lembaga Masyarakat & Pemerintahan Desa</h3>
                                </div>
                            </template>
                            <template #default>
                                <el-table :data="data.lembagas" max-height="82vh">
                                    <el-table-column label="#" type="index" width="60"></el-table-column>
                                    <el-table-column label="Kode" prop="kode" width="100"></el-table-column>
                                    <el-table-column label="Nama" prop="nama"></el-table-column>
                                    
                                    <el-table-column label="Opsi" width="150" fixed="right">
                                        <template #default="scope" >
                                            <div class="flex items-center gap-1">
                                                <el-button circle type="primary" size="small">
                                                    <Icon icon="mdi:human-capacity-increase" />
                                                </el-button>
                                                <el-button circle type="warning" size="small">
                                                    <Icon icon="mdi:edit" />
                                                </el-button>
                                                <el-button circle type="danger" size="small">
                                                    <Icon icon="mdi:close" />
                                                </el-button>
                                            </div>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Detail" type="expand" width="200">
                                        <template #default="props">
                                            <div class="pl-4 py-4">
                                                <h3 class="font-bold">Anggota</h3>
                                                <el-table :data="props.row.members" :border="true">
                                                    <el-table-column label="#" type="index" width="50"></el-table-column>
                                                    <el-table-column label="Nama" prop="nama" width="160"></el-table-column>
                                                    <el-table-column label="Jabatan" prop="pivot.jabatan" width="160"></el-table-column>
                                                    <el-table-column label="Alamat">
                                                        <template #default="scope">
                                                            {{ scope.row.rt.nama }} {{ scope.row.rt.rw.nama }} {{ scope.row.rt.rw.dusun.nama }}
                                                        </template>
                                                    </el-table-column>
                                                    <el-table-column label="Opsi" width="100">
                                                        <template #default="scope">
                                                            <el-button type="danger" circle size="small">
                                                                <Icon icon="mdi:account-remove" />
                                                            </el-button>
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
                <el-col :span="12">
                        <el-card>
                            <template #header>
                                <div class="toolbar flex jutify-between items-center">
                                    <h3 class="font-bold uppercase">Lembaga Teritorial</h3>
                                </div>
                            </template>
                                <el-table :data="data.dusuns" max-height="82vh">
                                    <el-table-column label="#" type="index" width="60"></el-table-column>
                                    <el-table-column label="Dusun" prop="nama" width="250"></el-table-column>
                                    <el-table-column label="Kasun" prop="kasun" ></el-table-column>
                                    <el-table-column label="Jml RW" >
                                        <template #default="scope">
                                            {{ scope.row.rws.length }}
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Detail" type="expand" width="200">
                                        <template #default="props">
                                            <div class="pl-4 py-4">
                                                <h3 class="font-bold">Data RW</h3>
                                                <el-table :data="props.row.rws" :border="true">
                                                    <el-table-column label="#" type="index" width="60"></el-table-column>
                                                    <el-table-column label="RW" prop="nama" width="100"></el-table-column>
                                                    <el-table-column label="Ketua" prop="ketua" ></el-table-column>
                                                    <el-table-column label="Jml RT" >
                                                        <template #default="scope">
                                                            {{ scope.row.rts.length }}
                                                        </template>
                                                    </el-table-column>
                                                    <el-table-column label="Detail" type="expand" width="200">
                                                        <template #default="props">
                                                            <div class="ml-4 my-4">
                                                                <h3 class="font-bold">Data RT</h3>
                                                                <el-table :data="props.row.rts">
                                                                    <el-table-column label="#" type="index" width="60"></el-table-column>
                                                                    <el-table-column label="RT" prop="nama" width="100"></el-table-column>
                                                                    <el-table-column label="Ketua" prop="ketua" ></el-table-column>
                                                                    <el-table-column label="Jml Warga" >
                                                                        <template #default="scope">
                                                                            {{ scope.row.wargas.length }}
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
                                </el-table>
                            
                        </el-card>
                </el-col>
            </el-row>
        </el-container>
    </DashLayout>
</template>