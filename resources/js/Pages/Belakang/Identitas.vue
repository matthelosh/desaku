<script setup>
import { ref, computed } from "vue";
import { usePage, router, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { lebar } from "@/helpers/layout";

import DashLayout from "@/Layouts/DashLayout.vue";

const page = usePage();

const mode = ref("show");

const identitas = ref({});

const data = computed(() => page.props.identitas);

const edit = () => {
    mode.value = "edit";
    identitas.value = data.value;
};

const closeEdit = () => {
    mode.value = "show";
    identitas.value = "show";
};
</script>

<template>
    <Head title="Identitas Desa" />
    <DashLayout>
        <div
            class="md:w-[60%] mx-auto bg-white rounded border md:mt-8 hover:shadow-lg relative group"
        >
            <h1 class="text-xl text-center font-bold uppercase my-6">
                <span v-if="mode == 'edit'">Edit </span>Identitas Desa
            </h1>
            <Icon
                icon="mdi:building"
                class="hidden group-hover:block absolute right-2 top-2 hover:cursor-pointer text-sky-600 hover:text-sky-700"
                @click="edit"
                v-if="mode == 'show'"
            />
            <Icon
                icon="mdi:close"
                class="hidden group-hover:block absolute right-2 top-2 hover:cursor-pointer text-sky-600 hover:text-sky-700"
                @click="closeEdit"
                v-if="mode == 'edit'"
            />

            <el-descriptions
                :column="lebar() == 'xs' ? 1 : 4"
                border
                v-if="mode == 'show'"
                class="transition-all duration-300 ease-in"
            >
                <el-descriptions-item label="Nama Desa">{{
                    data.nama
                }}</el-descriptions-item>
                <el-descriptions-item label="Kode PUM">{{
                    data.kode_pum
                }}</el-descriptions-item>
                <el-descriptions-item label="Status">{{
                    data.status
                }}</el-descriptions-item>
                <el-descriptions-item label="Kode Pos">{{
                    data.kode_pos
                }}</el-descriptions-item>
                <el-descriptions-item label="Kecamatan">{{
                    data.kecamatan
                }}</el-descriptions-item>
                <el-descriptions-item label="Kabupaten">{{
                    data.kabupaten
                }}</el-descriptions-item>
                <el-descriptions-item label="Provinsi">{{
                    data.provinsi
                }}</el-descriptions-item>
                <el-descriptions-item label="No. Kontak">{{
                    data.telp
                }}</el-descriptions-item>
                <el-descriptions-item label="Email">{{
                    data.email
                }}</el-descriptions-item>
                <el-descriptions-item label="Website">{{
                    data.website
                }}</el-descriptions-item>
            </el-descriptions>

            <div
                v-if="mode == 'edit'"
                class="transition-all duration-300 ease-out px-4 pb-4"
            >
                {{ identitas }}

                <el-form
                    v-model="identitas"
                    label-width="200"
                    label-position="left"
                >
                    <el-form-item label="Kode PUM">
                        <el-input
                            v-model="identitas.kode_pum"
                            placeholder="Kode PUM"
                        />
                    </el-form-item>
                    <el-form-item label="Nama Desa">
                        <el-input
                            v-model="identitas.nama"
                            placeholder="Nama Desa"
                        />
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </DashLayout>
</template>
