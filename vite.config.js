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

                'resources/css/add/blog_style.css',

                'resources/js/add/payment.js',
                'resources/js/add/previsions/lunar.js',
                'resources/js/add/previsions/numerology.js',
                'resources/js/add/tarot/tarot.js',
                
                'resources/js/add/universe/draws.js',
                'resources/js/add/universe/blog.js',
                'resources/js/add/universe/tarot/tarot.js',
                'resources/js/add/universe/tarot/tarot.css',
                'resources/js/add/universe/numerology/numerology.js',
                'resources/js/add/universe/numerology/numerology.css',
            ],
            refresh: true,
        }),
    ],
});
