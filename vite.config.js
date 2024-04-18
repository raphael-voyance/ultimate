import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/css/add/numerology_tree.css',

                'resources/css/add/messaging.css',

                'resources/js/add/sticky_nav_messaging.js',

                'resources/js/add/hero_home.js',
                'resources/css/add/hero_home.css',

                'resources/js/add/payment.js',
            ],
            refresh: true,
        }),
    ],
});
