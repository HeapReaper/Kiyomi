import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'Modules/Financials/resources/assets/js/app.js',
                'Modules/Financials/resources/assets/sass/app.scss',

                'Modules/Flights/resources/assets/js/app.js',
                'Modules/Flights/resources/assets/sass/app.scss',

                'Modules/Home/resources/assets/js/app.js',
                'Modules/Home/resources/assets/sass/app.scss',

                'Modules/Logging/resources/assets/js/app.js',
                'Modules/Logging/resources/assets/sass/app.scss',

                'Modules/Mail/resources/assets/js/app.js',
                'Modules/Mail/resources/assets/sass/app.scss',

                'Modules/Panel/resources/assets/js/app.js',
                'Modules/Panel/resources/assets/sass/app.scss',

                'Modules/Settings/resources/assets/js/app.js',
                'Modules/Settings/resources/assets/sass/app.scss',

                'Modules/Users/resources/assets/js/app.js',
                'Modules/Users/resources/assets/sass/app.scss',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~modules': '/Modules',
        },
    },
});
