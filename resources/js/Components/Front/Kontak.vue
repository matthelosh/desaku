<script setup>
import { Icon } from '@iconify/vue'
</script>

<template>
    <div class="footer bg-sky-600 text-white">
        <el-row :gutter="20">
            <el-col :span="8" :xs="24">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15804.490919813245!2d111.76801921893298!3d-7.986259872626185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7903ec623fbaa3%3A0x24bfb72822af55bf!2sSamar%2C%20Pagerwojo%2C%20Tulungagung%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1720257706658!5m2!1sen!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </el-col>
            <el-col :span="8" :xs="24" class="p-4">
                <h3 class="flex items-center text-xl font-bold uppercase mb-2">
                    <Icon icon="mdi:link-box-variant" class="text-2xl" />
                    Pranala Luar
                </h3>
                <ol>
                    <li>
                        <a href="https://tulungagung.go.id" target="_blank" class="flex items-center hover:underline hover:text-sky-100">
                            <Icon icon="mdi:chevron-double-right" />
                            Pemerintah Kabupaten Tulungagung
                        </a>
                    </li>
                    <li>
                        <a href="https://diskominfo.tulungagung.go.id" target="_blank" class="flex items-center hover:underline hover:text-sky-100">
                            <Icon icon="mdi:chevron-double-right" />
                            Diskominfo Tulungagung
                        </a>
                    </li>
                    <li>
                        <a href="https://tulungagung.kemenag.go.id" target="_blank" class="flex items-center hover:underline hover:text-sky-100">
                            <Icon icon="mdi:chevron-double-right" />
                            Kemenag Tulungagung
                        </a>
                    </li>
                </ol>
            </el-col>
            <el-col :span="8" :xs="24" class="p-4">
                <h3 class="flex items-center text-xl font-bold uppercase mb-2">
                    <Icon icon="mdi:contacts" class="text-2xl" />
                    Kontak Kami
                </h3>
                <address>
                    Sekretariat: Jalan Raya Samar, Desa Samar<br>
                    Kecamatan Pagerwojo <br>
                    Kabupaten Tulungagung.
                </address>
                <p class="flex items-center mt-4">
                    <Icon icon="mdi:phone-classic" class="mr-1" />
                    +62 1234-56789
                </p>
                <p class="flex items-center">
                    <Icon icon="mdi:email" class="mr-1" />
                    <a href="mailto:pemdes@bayang.desa.id" class="hover:underline">pemdes@bayang.desa.id</a>
                </p>
                <p class="flex items-center mt-4 gap-2">
                    <a href="#" target="_blank">
                        <Icon icon="mdi:youtube" class="text-2xl" />
                    </a>
                    <a href="#" target="_blank">
                        <Icon icon="mdi:facebook" class="text-2xl" />
                    </a>
                    <a href="#" target="_blank">
                        <Icon icon="mdi:instagram" class="text-2xl" />
                    </a>
                    <a href="#" target="_blank">
                        <Icon icon="mdi:twitter-box" class="text-2xl" />
                    </a>
                    <a href="#" target="_blank">
                        <Icon icon="mdi:whatsapp" class="text-2xl" />
                    </a>
                    <a href="#" target="_blank">
                        <Icon icon="mdi:telegram" class="text-2xl" />
                    </a>
                </p>
            </el-col>
        </el-row>
        <el-row>
            <el-col>

            </el-col>
        </el-row>
    </div>
</template>