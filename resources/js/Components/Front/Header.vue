<script setup>
import { ref, computed } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import menus from "@/datas/menu.json";

const showDrawer = ref(false);

const items = computed(() => menus);
const goto = (item) => {};
</script>

<template>
    <el-header
        class="main-nav bg-sky-100"
        style="height: 80px; display: flex; align-items: center"
    >
        <div class="content h-14 flex items-center justify-between w-full">
            <Link href="/" class="title flex items-center gap-1 px-1">
                <img src="/img/tulungagung.png" alt="Logo" class="h-14" />
                <div class="title">
                    <h2 class="leading-4 text-xl font-bold tracking-wider">
                        Desa Samar
                    </h2>
                    <h3 class="leading-4">Kec. Pagerwojo</h3>
                </div>
            </Link>
            <nav class="navigasi flex items-center gap-2">
                <div
                    class="large-nav md:flex items-center justify-end flex-wrap uppercase hidden"
                >
                    <template v-for="(menu, m) in items" :key="m">
                        <Link
                            v-if="menu.children?.length < 1"
                            :href="
                                route(menu.url, {
                                    category_id: menu.params.category_id,
                                })
                            "
                            class="px-4 text-sky-900 py-2 text-sm font-semibold rounded hover:shadow-outline"
                            >{{ menu.label }}</Link
                        >
                        <el-popover
                            v-if="menu.children?.length > 0"
                            width="auto"
                        >
                            <template #reference>
                                <Link
                                    class="px-4 py-2 text-sm text-sky-900 font-semibold rounded hover:shadow-outline flex items-start gap-1 justify-between"
                                    href="#"
                                >
                                    {{ menu.label }}
                                    <Icon
                                        icon="mdi:menu-down"
                                        class="text-lg"
                                    />
                                </Link>
                            </template>
                            <ol class="uppercase">
                                <li
                                    v-for="(sub, s) in menu.children"
                                    :key="s"
                                    class="p-2 hover:bg-sky-100 hover:cursor-pointer"
                                >
                                    <Link
                                        :href="route(sub.url, sub.params)"
                                        class="text-sky-800 hover:text-sky-900"
                                        >{{ sub.label }}</Link
                                    >
                                </li>
                            </ol>
                        </el-popover>
                    </template>
                </div>
                <Icon
                    icon="mdi:menu"
                    class="text-2xl hover:cursor-pointer md:hidden"
                    @click="showDrawer = !showDrawer"
                />
            </nav>
        </div>
    </el-header>
    <el-drawer
        v-model="showDrawer"
        :show-close="false"
        size="70%"
        style="width: 400px !important"
    >
        <template #header="{ close, titleId, titleClass }">
            <h4 :id="titleId" :class="titleClass">Menu</h4>
            <el-button type="danger" size="small" circle @click="close">
                <Icon icon="mdi:close" class="text-xl" />
            </el-button>
        </template>
        <div class="content">
            <template v-for="(menu, m) in items" :key="m">
                <ol>
                    <li v-if="menu.children?.length > 0">
                        <Link
                            href="#"
                            class="px-4 text-sky-900 py-2 text-sm font-semibold rounded hover:shadow-outline"
                            >{{ menu.label }}</Link
                        >
                        <ol class="pl-6">
                            <li v-for="(child, c) in menu.children" :key="c">
                                <Link
                                    :href="route(child.url)"
                                    class="px-4 text-sky-900 py-2 text-sm font-semibold rounded hover:shadow-outline"
                                    >{{ child.label }}</Link
                                >
                            </li>
                        </ol>
                    </li>
                    <li v-if="menu.children?.length < 1">
                        <Link
                            :href="route(menu.url)"
                            class="px-4 text-sky-900 py-2 text-sm font-semibold rounded hover:shadow-outline"
                            >{{ menu.label }}</Link
                        >
                    </li>
                </ol>
            </template>
        </div>
    </el-drawer>
</template>

<style>
header.stuck {
    background-color: rgb(8, 36, 66) !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.8) !important;
    color: white !important;
}

.stuck a {
    color: white !important;
}
</style>
