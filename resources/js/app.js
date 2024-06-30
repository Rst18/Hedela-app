import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },



    });
   

    // Echo.channel('presence-channel').listen('Hello',(event)=>{
    //    console.log(event);
    // })


    // window.Echo.join('presence-channel')
    // .here((users)=>{
    //     console.log({users},'conctd')
    // })
    // .joining((user)=>{
    //     console.log({user}, 'joined')
    // })
    // .leaving((user)=>{
    //     console.log({user}, 'leaved')
    // })

    // Echo.channel('dispatch-channel').listen('DispatchEvent',(event)=>{
    //    console.log(event);
    // })