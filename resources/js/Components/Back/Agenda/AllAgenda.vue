<script setup>
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import 'dayjs/locale/id'
import { Icon } from '@iconify/vue';

dayjs.locale('id')
const page = usePage()
const emit = defineEmits(['edit'])

const editAgenda = (item) => {
    emit('edit', item)
}

const attributes = computed(() => {
    let data = []
    page.props.agendas.forEach(agenda => {
        data.push({
            highlight: 'red',
            dates: [agenda.mulai],
            popover: {
                label: agenda.nama
            }
        })
    })
    return data
})
const current = ref(null)
// const agendas = computed(() => {
//     return page.props.agendas.filter(agenda => {
//         if (current.value !== null) {
//             return new Date(agenda.mulai).getMonth() === new Date(current.value).getMonth()
//         } else {
//             return new Date(agenda.mulai).getMonth() === new Date().getMonth()
//         }
//     })
// })

const yearNow = computed(() => {
    const date = new Date()
    return date.getFullYear()
})

const onPageUpdated = (e) => {
    current.value = e[0].id
}

const hapus = async(id) => {
    router.delete(route('dashboard.agenda.destroy', {id: id}), {
        onSuccess: page => {
            ElNotification({title: 'Info', message: page.props.flash.message, type: 'success'})
        }
    })
}
</script>

<template>
    <div class="list-agenda">
        <VCalendar expanded :attributes="attributes" locale="id" @did-move="onPageUpdated" :columns="4" :rows="3" :min-date="new Date(yearNow+'-01-01-')" :max-date="new Date(yearNow+'-12-31')" >
            <template #dayContent>

            </template>
        </VCalendar>
        <div class="mt-2">
            <el-table :data="page.props.agendas" height="500">
                <el-table-column label="Mulai" width="150">
                    <template #default="scope">
                        <span>{{ dayjs(scope.row.mulai).format('DD MMM YYYY') }}</span>
                    </template>
                </el-table-column>
                <el-table-column label="Selesai"  width="150">
                    <template #default="scope">
                        <span>{{ dayjs(scope.row.selesai).format('DD MMM YYYY') }}</span>
                    </template>
                </el-table-column>
                <el-table-column label="Kegiatan" prop="nama" width="300"></el-table-column>
                <el-table-column label="Lokasi" prop="lokasi" ></el-table-column>
                <el-table-column label="Pelaksana" prop="pelaksana" width="200"></el-table-column>
                <el-table-column label="Opsi" fixed="right" prop="pelaksana" width="150">
                    <template #default="scope">
                        <span class="flex items-center gap-1">
                            <el-button type="warning" size="small" circle @click="editAgenda(scope.row)">
                                <Icon icon="mdi:edit" />
                            </el-button>
                            <el-button type="danger" size="small" circle @click="hapus(scope.row.id)">
                                <Icon icon="mdi:close" />
                            </el-button>
                        </span>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>