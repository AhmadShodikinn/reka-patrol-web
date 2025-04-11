import './assets/main.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h, inject } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import ThemeProvider from './Components/Layout/ThemeProvider.vue';
import SidebarProvider from './Components/Layout/SidebarProvider.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        );
        page.then((module) => {
            const pageComponent = module.default;
            const layout = pageComponent.layout || ThemeProvider;
            pageComponent.layout = (props: any) => {
                const page = h(layout, { ...props }, () => {
                    if (layout === ThemeProvider) {
                        return h(SidebarProvider, {}, () => h(pageComponent, props));
                    } else {
                        return h(pageComponent, props);
                    }
                });
                return page;
            };
        });
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
