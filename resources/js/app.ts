import './assets/main.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import ThemeProvider from './Components/Layout/ThemeProvider.vue';
import SidebarProvider from './Components/Layout/SidebarProvider.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        return resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        );
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => {
                const layout = props.initialPage.props.layout || ThemeProvider;
                return h(layout, {...props}, () => {
                    if (layout === ThemeProvider) {
                        return h(SidebarProvider, {}, () => h(App, props));
                    } else {
                        return h(App, props);
                    }
                });
            },
        });

        app.use(plugin).use(ZiggyVue).mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
