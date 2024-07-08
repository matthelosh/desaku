<script setup>
import { ref, computed } from 'vue'
import { Head, Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import menus from '@/datas/menu.json'

const showDrawer = ref(false)

const items = computed(() => menus)
</script>

<template>
    <el-header class="main-nav bg-sky-50" style="height: 80px; display:flex; align-items:center;">
        <div class="content h-14 flex items-center justify-between w-full">
            <Link href="/" class="title flex items-center gap-1 px-1">
                <img src="/img/tulungagung.png" alt="Logo" class="h-14" />
                <div class="title">
                    <h2 class="leading-4 text-xl font-bold tracking-wider">Desa Samar</h2>
                    <h3 class="leading-4">Kec. Pagerwojo</h3>
                </div>
            </Link>
            <nav class="navigasi flex items-center gap-2">
                <div class="large-nav md:flex items-center justify-end flex-wrap uppercase hidden">
                    <template v-for="(menu, m) in items" :key="m">
                        <Link v-if="menu.children.length < 1" :href="menu.url" class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline">{{ menu.label }}</Link>
                        <el-popover v-if="menu.children.length > 0" width="auto">
                            <template #reference>
                                <Link class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline flex items-start gap-1 justify-between" href="#">
                                    {{ menu.label }}
                                    <Icon icon="mdi:menu-down" class="text-lg" />
                                </Link>
                            </template>
                            <ol class="uppercase text-black">
                                <li v-for="(sub, s) in menu.children" :key="s" class="p-2 hover:bg-sky-100 hover:cursor-pointer">
                                    <Link :href="sub.url">{{ sub.label }}</Link>
                                </li>
                            </ol>
                        </el-popover>
                    </template>

                    <!-- <Link class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline" href="/">
                        Beranda
                    </Link>
                    <el-popover >
                        <template #reference>
                            <Link class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline flex items-start gap-1 justify-between" href="#">
                                Profil Desa
                                <Icon icon="mdi:menu-down" class="text-lg" />
                            </Link>
                        </template>
                        <ol class="uppercase text-black">
                            <li v-for="l of 4" :key="l" class="p-2 hover:bg-slate-100 hover:cursor-pointer">
                                <Link href="#">{{ l }}</Link>
                            </li>
                        </ol>
                    </el-popover>
                    <el-popover >
                        <template #reference>
                            <Link class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline flex items-start gap-1 justify-between" href="#">
                                Berita
                                <Icon icon="mdi:menu-down" class="text-lg" />
                            </Link>
                        </template>
                        <ol class="uppercase text-black">
                            <li v-for="l of 4" :key="l" class="p-2 hover:bg-slate-100 hover:cursor-pointer">
                                <Link href="#">{{ l }}</Link>
                            </li>
                        </ol>
                    </el-popover>
                    <el-popover>
                        <template #reference>
                            <Link class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline flex items-start gap-1 justify-between" href="#">
                                Produk Unggulan
                                <Icon icon="mdi:menu-down" class="text-lg" />
                            </Link>
                        </template>
                        <ol class="uppercase text-black">
                            <li class="p-2 hover:bg-slate-100 hover:cursor-pointer">
                                <Link href="#">Galeri Produk</Link>
                            </li>
                            <li class="p-2 hover:bg-slate-100 hover:cursor-pointer">
                                <Link href="#">Pemesanan</Link>
                            </li>
                        </ol>
                    </el-popover>
                    <el-popover>
                    <template #reference>
                            <Link class="px-4 py-2 mt-2 text-sm font-semibold hover:bg-sky-100 rounded hover:shadow-outline flex items-start gap-1 justify-between" href="#">
                                Potensi Wisata
                                <Icon icon="mdi:menu-down" class="text-lg" />
                            </Link>
                        </template>
                        <ol class="uppercase text-black">
                            <li class="p-2 hover:bg-slate-100">
                                <Link href="#">Wahana</Link>
                            </li>
                            <li class="p-2 hover:bg-slate-100">
                                <Link href="#">Paket Wisata</Link>
                            </li>
                        </ol>
                    </el-popover> -->
                </div>
                <Icon icon="mdi:menu" class="text-2xl hover:cursor-pointer" @click="showDrawer = !showDrawer" />
            </nav>
        </div>
    </el-header>
    <el-drawer v-model="showDrawer" :show-close="false" size="70%" style="width: 400px!important;">
        <template #header="{ close, titleId, titleClass }">
            <h4 :id="titleId" :class="titleClass">Menu</h4>
            <el-button type="danger" size="small" circle @click="close">
                <Icon icon="mdi:close" class="text-xl" />
            </el-button>
        </template>
        <div class="content">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio obcaecati maiores vero aut, accusamus possimus quae error iusto similique unde ab odit suscipit maxime facere dolorem perspiciatis quibusdam minus aperiam.</p>
        </div>
    </el-drawer>
</template>