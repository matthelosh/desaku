<script setup>
import { ref, computed } from 'vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import dayjs from 'dayjs'
import 'dayjs/locale/id'

dayjs.locale('id')

import DashLayout from '@/Layouts/DashLayout.vue'

const page = usePage()

const pamongs = page.props.data.pamongs
</script>

<template>
<Head title="Data Berita" />
<DashLayout>
    <div>
        <div class="toolbar w-full border border-sky-200 rounded p-2 bg-sky-100 mb-4 flex justify-between items-center">
            <h3 class=" text-sky-800 text-xl">Manajemen Aparatur Desa</h3>
            <div class="toolbar-items flex items-center gap-1">
                <el-button type="primary" class="flex items-center gap-1">
                    <Icon icon="mdi:account-tie" />
                    Entri Baru
                </el-button>
            </div>
        </div>
        <!-- {{ pamongs }} -->
        <el-table :data="pamongs" height="85vh">
            <el-table-column label="NIK" prop="nik" width="200"></el-table-column>
            <el-table-column label="Foto" width="200">
                <template #default="scope">
                    <el-image :src="scope.row.foto" alt="Foto" style="width: 70px; height: 70px; border-radius: 50%;" fit="cover" :lazy="true" />
                </template>
            </el-table-column>
            <el-table-column label="Nama" width="200">
                <template #default="scope">
                    {{ scope.row.nama }}
                </template>
            </el-table-column>
            <el-table-column label="Jenis Kelamin" width="150">
                <template #default="scope">
                   {{ scope.row.jk }}
                </template>
            </el-table-column>
            <el-table-column label="Tempat, Tgl Lahir" width="250">
                <template #default="scope">
                   {{ scope.row.tempat_lahir }}, {{ dayjs(scope.row.tanggal_lahir).format('DD MMM YYYY') }}
                </template>
            </el-table-column>
            <el-table-column label="Jabatan" >
                <template #default="scope">
                   {{ scope.row.jabatan.nama }}
                </template>
            </el-table-column>
            <el-table-column label="Alamat" >
                <template #default="scope">
                   {{ scope.row.alamat }}
                </template>
            </el-table-column>
            <el-table-column label="Opsi" fixed="right" width="100" align="center">
                <template #default="scope">
                    <span class="flex gap-1 justify-center">
                        <el-button circle type="danger" size="small">
                            <Icon icon="mdi:close" />
                        </el-button>
                    </span>
                </template>
            </el-table-column>
        </el-table>
    </div>
</DashLayout>
</template>