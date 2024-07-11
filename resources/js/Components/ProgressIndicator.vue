<script setup>
import { ref } from 'vue'
import { Icon } from '@iconify/vue';
const loading = ref(false)
const percentage = ref(10)
const status = ref('idle')
const message = ref('Tunggu sebentar ..')

const start = (progress) => {
    loading.value = true
    percentage.value = progress
    status.value = 'progress'
}

const set = (progress) => {
    percentage.value += progress
}

const finish = (progress) => {
    percentage.value = progress
    status.value = 'finish'
    loading.value = false
}


defineExpose({
    message, start, set, finish
})
</script>

<template>
    <div class="overlay fixed top-0 right-0 bottom-0 left-0 bg-slate-700 bg-opacity-30 backdrop-blur z-40 flex items-center justify-center" v-if="loading" >
        <div>
        <Icon icon="mdi:loading" class="animate-spin text-8xl text-white mx-auto" v-if="status == 'progress'" />
        <Icon icon="mdi:check-circle-outline" class="animate-bounce text-8xl text-green-500 mx-auto" v-if="status == 'finish' " />
        <h3 class="text-center text-white text-2xl">{{ message }} {{ percentage }}%</h3>
    </div>
    </div>
</template>