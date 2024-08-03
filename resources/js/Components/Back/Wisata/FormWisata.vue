<script setup>
import { ref, computed, onBeforeMount } from "vue";
import { usePage, router, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { jenis, skalas } from "@/datas/tipeusaha.json";
import { ElNotification } from "element-plus";

const page = usePage();

const businesses = computed(() => page.props.businesses);
const props = defineProps({ selectedWisata: Object });
const emit = defineEmits(["close"]);

const wisata = ref({});
const fileGambar = ref(null);

const simpan = async () => {
    // console.log(produk.value)
    let payload = { data: wisata.value };
    if (fileGambar.value !== null) {
        payload.foto = fileGambar.value;
    }
    await router.post(route("dashboard.wisata.store"), payload, {
        onSuccess: (page) => {
            ElNotification({
                title: "Info",
                message: page.props.flash.message,
                type: "success",
            });
            router.reload({ only: ["products"] });
            emit("close");
        },
        onError: (errs) => {
            Object.keys(errs).forEach((k) => {
                setTimeout(() => {
                    ElNotification({
                        title: "Error",
                        message: errs[k],
                        type: "error",
                    });
                }, 500);
            });
        },
    });
};
const kategoris = ref(["Agrowisata", "Edupark", "Hiburan", "Alam", "Lain"]);
const onFotoPicked = (e) => {
    const file = e.target.files[0];
    fileGambar.value = file;
    wisata.value.foto = URL.createObjectURL(file);
};

onBeforeMount(() => {
    wisata.value = props.selectedWisata ?? {};
});
</script>

<template>
    <el-card shadow="never">
        <template #header>
            <div class="toolbar flex items-center justify-between">
                <h3>
                    {{ props.selectedProduct?.id ? "Edit" : "Buat" }} Data
                    Wisata: {{ props.selectedWisata?.nama ?? "Baru" }}
                </h3>
                <div class="toolbar-item flex-items-center gap-1">
                    <el-button type="primary" @click="simpan">Simpan</el-button>
                    <el-button type="danger" @click="emit('close')"
                        >Tutup</el-button
                    >
                </div>
            </div>
        </template>
        <div class="card-body">
            <el-form
                v-model="wisata"
                label-width="200px"
                label-position="right"
            >
                <el-row :gutter="20">
                    <el-col :span="16">
                        <el-form-item width="200px" label="Nama">
                            <el-input
                                v-model="wisata.nama"
                                placeholder="Nama"
                                required
                            ></el-input>
                        </el-form-item>
                        <el-form-item width="200px" label="Lokasi">
                            <el-input
                                v-model="wisata.lokasi"
                                placeholder="Lokasi"
                                required
                            ></el-input>
                        </el-form-item>
                        <el-form-item width="200px" label="Kategori">
                            <el-select
                                v-model="wisata.kategori"
                                placeholder="Kategori"
                                required
                            >
                                <el-option
                                    v-for="cat in kategoris"
                                    :key="cat"
                                    :value="cat"
                                />
                            </el-select>
                        </el-form-item>
                        <el-form-item width="200px" label="Pengelola">
                            <el-input
                                v-model="wisata.pengelola"
                                placeholder="Pengelola"
                                required
                            ></el-input>
                        </el-form-item>
                        <el-form-item width="200px" label="Harga Tiket">
                            <el-input
                                type="number"
                                v-model="wisata.harga_tiket"
                                placeholder="Harga Tiket"
                                required
                            ></el-input>
                        </el-form-item>
                        <el-form-item width="200px" label="Buka Pukul">
                            <el-input
                                v-model="wisata.buka"
                                placeholder="Buka Pukul"
                                rows="8"
                                required
                            ></el-input>
                        </el-form-item>
                        <el-form-item width="200px" label="Tutup Pukul">
                            <el-input
                                v-model="wisata.tutup"
                                placeholder="Tutup Pukul"
                                rows="8"
                                required
                            ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">
                        <el-card>
                            <template #header>
                                <div class="flex items-center justify-between">
                                    <h1
                                        class="text-md font-bold text-slate-700 tracking-wide"
                                    >
                                        Gambar Produk
                                    </h1>
                                    <input
                                        type="file"
                                        ref="fileFoto"
                                        class="hidden"
                                        @change="onFotoPicked"
                                        accept=".jpg, .JPG, .jpeg, .JPEG, .png, .PNG"
                                    />
                                    <el-button
                                        size="small"
                                        type="primary"
                                        @click="$refs.fileFoto.click()"
                                        >Pilih Gambar</el-button
                                    >
                                </div>
                            </template>

                            <el-image
                                :src="wisata.foto"
                                style="width: 100%; height: 300px"
                            >
                                <template #error>
                                    <div
                                        class="image-slot flex items-center justify-center w-full h-full bg-slate-100 mx-auto rounded shadow"
                                    >
                                        <Icon
                                            icon="mdi:image-remove"
                                            class="text-8xl"
                                        />
                                    </div>
                                </template>
                            </el-image>
                        </el-card>
                    </el-col>
                </el-row>
            </el-form>
        </div>
    </el-card>
</template>
