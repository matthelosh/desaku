import './bootstrap';
import '../css/app.css';

import { createApp, h, ref } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import VCalendar from 'v-calendar';
import 'v-calendar/style.css';
import ElementTiptapPlugin from 'element-tiptap-vue3-fixed';
import 'element-plus/dist/index.css'
import 'element-tiptap-vue3-fixed/lib/style.css'
// import { InertiaProgress } from '@inertiajs/progress';
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// InertiaProgress.init();


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {

        const app = createApp({ render: () => h(App, props) })
        app
            // .component(ProgressIndicator)
            .use(plugin)
            .use(ZiggyVue)
            .use(VCalendar, {})
            .use(ElementTiptapPlugin);

        app.mount(el);

    },
});

