import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //CSS
                'resources/css/app.css',
                'resources/css/index.property.css',
                'resources/css/base.admin.css',
                //JS
                'resources/js/app.js',
                'resources/js/base.js'

            ],
            refresh: true,
        }),
    ],
});
