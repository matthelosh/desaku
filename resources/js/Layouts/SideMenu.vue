<script setup>
import { Icon } from "@iconify/vue";
import { Link, usePage } from "@inertiajs/vue3";
import menus from "@/datas/dashmenu.json";
import { computed } from "vue";

const page = usePage();

const rute = computed(() => route().current());
</script>

<template>
    <div>
        <div class="menu bg-white">
            <div class="avatar relative bg-sky-400 py-4">
                <img
                    src="/img/pamong.jpg"
                    alt="Pamong"
                    class="rounded-full w-[60%] mx-auto object-cover"
                />
                <h1
                    class="absolute w-full p-2 bg-sky-600 text-white uppercase bottom-0 bg-opacity-50 font-bold text-lg backdrop-blur-md text-center"
                >
                    <Link :href="route('profile.edit')">
                        {{ page.props.auth.user.name }} || {{ page.props.auth.role }}
                    </Link>
                </h1>
            </div>
            <ol>
                <el-divider>MENU</el-divider>
                <li v-for="(menu, m) in menus" :key="m">
                    <Link
                        v-if="menu.roles.includes(page.props.auth.role)"
                        :href="route(menu.url)"
                        :class="{ active: rute === menu.url }"
                        class="flex gap-1 items-center py-4 px-2 hover:text-sky-800 transition-all duration-200 ease-in-out hover:bg-sky-100 text-slate-900"
                    >
                        <Icon :icon="`mdi:${menu.icon}`" />
                        {{ menu.label }}
                    </Link>
                </li>
                <el-divider v-if="page.props.auth.role == 'admin' || page.props.auth.role == 'ops'">
                    <div class="flex items-center gap-2">
                        <Icon icon="mdi:tools" />
                        SETTING
                    </div>
                </el-divider>
                <li v-if="page.props.auth.role == 'admin' || page.props.auth.role == 'ops'">
                    <Link
                        :href="route('dashboard.setting')"
                        :class="{ active: rute === 'dashboard.setting' }"
                        class="flex gap-1 items-center py-4 px-2 hover:text-sky-800 transition-all duration-200 ease-in-out hover:bg-sky-100 text-sky-800"
                    >
                        <Icon icon="mdi:cog" />
                        Pengaturan
                    </Link>
                </li>
            </ol>
        </div>
    </div>
</template>

<style scoped>
.active {
    color: rgb(30, 41, 58) !important;
    /* text-transform: uppercase; */
    background-color: rgb(192, 224, 255);
    font-weight: 900;
}
</style>
