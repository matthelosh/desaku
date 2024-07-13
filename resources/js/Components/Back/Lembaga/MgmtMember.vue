<script setup>
import {ref, computed, onBeforeMount } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import axios from 'axios'
import { ElNotification } from 'element-plus';

const page = usePage()
const props = defineProps({selectedLembaga: Object, show: Boolean})
const emit = defineEmits(['close'])


const members = ref([])
const searchNonMember = ref(null)
const nonMembers = ref([])
const selectedJabatan = ref('')
const selectedNonMembers = ref()

const handleNonMemberSelection = (val) => {
    selectedNonMembers.value = val
}

const filteredNonMembers = computed(() => {
    return !searchNonMember.value ? nonMembers.value : nonMembers.value.filter(warga => warga.nama.toLowerCase().includes(searchNonMember.value.toLowerCase()))
})

const getNonMember = async() => {
    // nonMembers.value = 'loading'
    axios.get(route('dashboard.warga', {
        _query: {lembagaId: props.selectedLembaga.id}
    })).then(res => {
        nonMembers.value = res.data.wargas
    }).catch(err => console.log(err))
}

const addMember = async(wargaId, jabatan) => {
    axios.post(route('dashboard.lembaga.member.attach', {id: props.selectedLembaga.id}), {data: {wargaId: wargaId, jabatan:jabatan}})
            .then(res => {
                ElNotification({ title: 'Info', message: res.data.message, type: 'success'})
                selectedJabatan.value = ''
                const index = nonMembers.value.findIndex(nm => nm.id === wargaId)
                nonMembers.value[index].pivot = {jabatan: jabatan}
                members.value.push(nonMembers.value[index])
                nonMembers.value.splice(index, 1)
                // getNonMember()
            })
}

const delMember = async(member) => {
    axios.post(route('dashboard.lembaga.member.detach', {id: props.selectedLembaga.id}), {data: {wargaId: member.id}})
    .then(res => {
                ElNotification({ title: 'Info', message: res.data.message, type: 'success'})
                const index = members.value.findIndex(m => m.id === member.id)

                nonMembers.value.unshift(member)
                members.value.splice(index, 1)
                // getNonMember()
            })
}

onBeforeMount(() => {
    getNonMember()
    members.value = props.selectedLembaga?.members
})

</script>

<template>
    <el-dialog fullscreen v-model="props.show" @close="emit('close')" style="padding:0!important;">
        <template #header>
            <h3>Anggota {{ props.selectedLembaga?.nama }} ({{ props.selectedLembaga.kode }})</h3>
        </template>
        <template #default>
            <el-container>
                <el-row class="w-full" :gutter="20">
                    <el-col :span="12">
                        <el-card shadow="never">
                            <template #header>
                                <h1>Data Anggota</h1>
                            </template>
                            <el-table :data="members" max-height="80vh">
                                <el-table-column label="#" type="index"></el-table-column>
                                <el-table-column label="Nama" prop="nama"></el-table-column>
                                <el-table-column label="Jabatan" prop="pivot.jabatan"></el-table-column>
                                <el-table-column label="Alamat" >
                                    <template #default="scope">
                                        <span>{{ scope.row.rt.nama }} / {{ scope.row.rt.rw.nama }}, Dusun {{ scope.row.rt.rw.dusun.nama }}</span>
                                    </template>
                                </el-table-column>
                                <el-table-column label="Opsi" width="150" fixed="right">
                                    <template #default="scope">
                                        <el-button type="danger" size="small" @click="delMember(scope.row)">
                                            <Icon icon="mdi:minus" />
                                        </el-button>
                                    </template>
                                </el-table-column>
                            </el-table>

                        </el-card>
                    </el-col>
                    <el-col :span="12">
                        <el-card shadow="never">
                            <template #header>
                                <div class="header flex items-center justify-between">
                                    <h1>Data Warga </h1>
                                    <div class="header-items flex items-center">
                                        <el-input v-model="searchNonMember" placeholder="Cari Warga" clearable>
                                            <template #suffix>
                                                <Icon icon="mdi:magnify" />
                                            </template>
                                        </el-input>
                                    </div>
                                </div>
                            </template>
                            <el-table :data="filteredNonMembers" max-height="80vh" v-loading="nonMembers.length < 1" @current-change="handleNonMemberSelection" highlight-current-row>
                                <el-table-column label="#" type="index"></el-table-column>
                                <el-table-column label="Nama" prop="nama" sortable></el-table-column>
                                <el-table-column label="Alamat" >
                                    <template #default="scope">
                                        <span>{{ scope.row.rt.nama }} / {{ scope.row.rt.rw.nama }}, Dusun {{ scope.row.rt.rw.dusun.nama }}</span>
                                    </template>
                                </el-table-column>
                                <el-table-column label="Opsi" width="150" fixed="right">
                                    <template #default="scope">
                                        <el-popover placement="left" width="250">
                                            <template #reference>
                                                <el-button circle type="primary" size="small">
                                                    <Icon icon="mdi:plus" />
                                                </el-button>
                                            </template>
                                            <div class="flex items-center gap-1">
                                                <el-input v-model="selectedJabatan" placeholder="Jabatan" size="small"></el-input>
                                                <el-button type="primary" size="small" @click="addMember(scope.row.id, selectedJabatan)">Tambah</el-button>
                                            </div>
                                        </el-popover>
                                    </template>
                                </el-table-column>
                            </el-table>
                            <!-- {{ nonMembers }} -->
                        </el-card>
                    </el-col>
                </el-row>
            </el-container>
        </template>
    </el-dialog>
</template>