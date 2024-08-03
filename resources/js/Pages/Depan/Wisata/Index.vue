<script setup>
import { ref, computed } from "vue";
import { usePage, Head, Link, router } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { onHeaderStuck } from "@/helpers/front";
import Header from "@/Components/Front/Header.vue";
import Kontak from "@/Components/Front/Kontak.vue";
import Footer from "@/Components/Front/Footer.vue";
import dayjs from "dayjs";
import "dayjs/locale/id";

dayjs.locale("id");

const page = usePage();

const filter = ref(null);
const wisatas = computed(() => {
    return filter.value === null
        ? page.props.wisatas.slice(0, 10)
        : page.props.wisatas.filter((wisata) =>
              wisata.nama.toLowerCase().includes(filter.value.toLowerCase()),
          );
});
</script>

<template>
    <Head>
        <title>Potensi Wisata Desa Samar Tulungagung</title>
        <meta
            name="description"
            content="Daftar Potensi Wisata Desa Samar Kecamatan Pagerwojo Kabupaten Tulungagung"
        />
    </Head>
    <div class="page bg-sky-100">
        <el-affix @change="onHeaderStuck">
            <Header />
        </el-affix>

        <main class="bg-sky-50 py-8">
            <el-container>
                <el-row justify="center" class="w-full">
                    <el-col :span="16" :xs="24">
                        <el-row class="w-full">
                            <el-col class="bg-sky-100 h-10 p-2">
                                <el-breadcrumb
                                    class="h-full flex items-center text-white"
                                >
                                    <el-breadcrumb-item :to="{ path: '/' }">
                                        <template #default>
                                            <Link
                                                class="flex"
                                                :href="route('front.home')"
                                            >
                                                <Icon
                                                    icon="mdi:home"
                                                    class="text-md"
                                                />
                                            </Link>
                                        </template>
                                    </el-breadcrumb-item>
                                    <el-breadcrumb-item
                                        :to="{ path: '/wisata' }"
                                    >
                                        <template #default>
                                            Daftar Wisata
                                            <!--     <Lin -->
                                            <!--         class="flex" -->
                                            <!--         :href="`${posts[0]?.category_id.toLowerCase()}`" -->
                                            <!--     > -->
                                            <!--         {{ posts[0]?.category_id }} -->
                                            <!--     </Link> -->
                                        </template>
                                    </el-breadcrumb-item>
                                </el-breadcrumb>
                            </el-col>
                        </el-row>
                        <div class="cover w-full h-[350px] relative">
                            <img
                                src="/img/wisata-1.jpg"
                                alt="Cover"
                                class="h-full w-full saturate-100 contrast-50 object-bottom object-cover"
                            />
                            <div
                                class="overlay absolute top-0 right-0 bottom-0 left-0 bg-orange-100 flex items-center justify-center bg-opacity-50 mix-blend-overlay"
                            >
                                <div class="text-center bg-white p-4">
                                    <h1
                                        class="text-4xl font-bold uppercase tracking-wide font-serif"
                                    >
                                        Potensi Wisata Desa Samar
                                    </h1>
                                    <span class="text-xl"
                                        >Kecamatan Pagerwojo</span
                                    >
                                </div>
                            </div>
                        </div>
                    </el-col>
                    <el-col :span="16" :xs="24" class="px-4 md:px-0">
                        <el-input
                            placeholder="Cari Produk"
                            class="mt-4"
                            v-model="filter"
                            clearable
                        >
                            <template #suffix>
                                <Icon icon="mdi:magnify" />
                            </template>
                        </el-input>
                        <div class="posts grid md:grid-cols-2 gap-4 py-4">
                            <div
                                v-for="(wisata, w) in wisatas"
                                :key="w"
                                class="post bg-slate-200 grid grid-cols-2"
                            >
                                <div class="cover h-full">
                                    <img
                                        :src="wisata.foto"
                                        alt="Cover"
                                        class="w-full object-cover object-bottom"
                                    />
                                </div>
                                <div class="content p-2 bg-white shadow">
                                    <Link
                                        :href="
                                            route('front.wisata.detail', {
                                                id: wisata.id,
                                            })
                                        "
                                    >
                                        <h3
                                            class="text-md md:text-xl leading-4 font-bold uppercase text-sky-700"
                                        >
                                            {{ wisata.nama }}
                                        </h3>
                                    </Link>
                                    <div
                                        class="meta flex gap-1 items-center mt-4"
                                    >
                                        <el-tag type="warning">
                                            {{
                                                dayjs(wisata.updated_at).format(
                                                    "DD/M/YY H:m",
                                                )
                                            }}
                                        </el-tag>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-col>
                </el-row>
            </el-container>
        </main>
        <Kontak />
        <Footer />
    </div>
</template>
