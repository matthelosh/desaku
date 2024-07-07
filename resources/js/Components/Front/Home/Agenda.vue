<script setup>
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import 'dayjs/locale/id'

dayjs.locale('id')
const page = usePage()

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
const agendas = computed(() => {
    return page.props.agendas.filter(agenda => {
        if (current.value !== null) {
            return new Date(agenda.mulai).getMonth() === new Date(current.value).getMonth()
        } else {
            return new Date(agenda.mulai).getMonth() === new Date().getMonth()
        }
    })
})

const onPageUpdated = (e) => {
    current.value = e[0].id
}
</script>

<template>
    <div class="list-agenda">
        <VCalendar expanded :attributes="attributes" locale="id" @did-move="onPageUpdated">
            <template #dayContent>

            </template>
        </VCalendar>
        <div class="mt-2">
            <el-table :data="agendas">
                <el-table-column label="Tanggal" >
                    <template #default="scope">
                        <span>{{ dayjs(scope.row.mulai).format('DD MMM YYYY') }}</span>
                    </template>
                </el-table-column>
                <el-table-column label="Kegiatan" prop="nama" width="300"></el-table-column>
            </el-table>
        </div>
    </div>
</template>