<script setup>
import { ref, computed } from "vue";
import { Icon } from "@iconify/vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const items = computed(() => page.props.wisatas.data);

const defaultImage = (foto) => {
    return foto ?? "/img/wisata-1.jpg";
};
</script>

<template>
    <div class="grid grid-cols-1 gap-2">
        <div
            class="card bg-white hover:scale-105 ease-in-out duration-300 transition-all"
            v-for="(wisata, w) in items"
            :key="w"
        >
            <img
                :src="defaultImage(wisata.foto)"
                alt="Gambar Produk"
                class="w-full h-[200px] object-cover"
            />
            <div class="card-body p-2">
                <h3 class="text-sky-600 font-bold">{{ wisata.nama }}</h3>
                <p class="leading-4">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                </p>
            </div>
            <div
                class="card-footer border-t p-2 flex items-center justify-between"
            >
                <el-button type="success" size="small">
                    <Icon icon="mdi:ticket" class="text-lg mr-1" />
                    Tiket: Rp.
                    {{ wisata.harga_tiket.toLocaleString() }}
                </el-button>
            </div>
        </div>
    </div>
</template>
