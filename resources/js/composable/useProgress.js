
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import NProgress from 'nprogress'

export function useProgress() {
    const isLoading = ref(false)

    Inertia.on('start', () => {
        isLoading.value = true;
        NProgress.start();
    })

    // Inertia.on('finish', () => {
    //     isLoading.value = false;
    //     NProgress.done();
    // })

    return {
        isLoading
    };
}

