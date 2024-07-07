<script setup>

</script>

<template>
    <el-footer class="bg-sky-700 h-auto flex items-center text-white justify-center md:justify-between">
            <div>
                &copy; {{ new Date().getFullYear() }} Pemerintah Desa Samar
            </div>
            <div class="hidden md:block">
                <p>Dipersembahkan oleh:</p>
                <p>Program pengabdian masyarakat Universitas Negeri Malang (UM)</p>
            </div>
    </el-footer>
    <el-backtop :right="50" :bottom="20" />
</template>