<script setup>
import { ref, computed } from 'vue'
import { router, usePage , Head } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'

const page = usePage()

</script>

<template>

    <div>
        <div class="visitor bg-white p-2 shadow rounded">
            <p>Hari ini: {{ page.props.visitor.today }}</p>
            <p>Semua: {{ page.props.visitor.total }}</p>
            <p>Online: {{ page.props.visitor.online }}</p>
        </div>
    </div>
</template>