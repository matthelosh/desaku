<script setup>

</script>

<template>
    <div class="hero bg-[url('/img/bg.png')] bg-green-300 bg-blend-multiply w-full h-[20vh] md:h-[60vh] bg-no-repeat bg-cover relative">
        <div class="hero-content w-full h-full bg-violet-400 bg-blend-color bg-opacity-0 flex items-center justify-center">
            <div>
                <h3 class="text-white text-xl uppercase text-center">
                    <small>Selamat Datang</small>
                    <br>
                    <span class="font-black tracking-widest">Samar Bisa!</span>
                </h3>
            </div>
        </div>
    </div>
</template>

<style>
.hero {
    animation: zoom-in-zoom-out 30s ease infinite!important;
    backdrop-filter: blur(100px);
}
@keyframes zoom-in-zoom-out {
    0% {
        background-size: 120%;
    }

    50% {
        background-size: 100%;
        background-position: center center;
        background-color: #a8f9d6aa;
        /* background: none; */
    }

    100% {
        background-size: 120%;
    }
}
</style>