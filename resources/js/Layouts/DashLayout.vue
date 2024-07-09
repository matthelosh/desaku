<script setup>
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3'

import SideMenu from '@/Layouts/SideMenu.vue'

</script>

<template>
    <div class="common-layout">
        <el-container>
            <el-aside class="bg-slate-200 h-screen hidden md:block">
                <SideMenu />
            </el-aside>
            <el-container>
                    <el-header class="bg-sky-600 flex items-center justify-between p-0">
                        <h3 class="text-white uppercase font-bold">Manajemen Informasi Desa Samar</h3>
                        <div class="header-items flex items-center gap-4">
                            <Link href="/" class="flex items-center text-white">
                                <Icon icon="mdi:home-export-outline" />
                                Beranda
                            </Link>
                            <el-popover title="Mau Keluar?">
                                <template #reference>
                                    <Icon icon="mdi:exit-to-app" class="text-xl hover:cursor-pointer hover:text-red-300 text-red-100" />
                                </template>
                                <div>
                                    <Link href="/logout" as="button" method="POST">Keluar</Link>
                                </div>
                            </el-popover>
                        </div>
                    </el-header>
                <el-main class="bg-sky-50 max-h-[94.5vh]" >
                    <Transition name="pindah" appear>
                        <slot />
                    </Transition>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<style scoped>
.pindah-enter-active,
.pindah-leave-active {
    transition: all .5s ease-in-out;
}

.pindah-enter-from,
.pindah-leave-to {
    opacity: 0;
    transform: translateY(20px);
}
</style>