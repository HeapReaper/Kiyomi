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
                'Modules/Financials/resources/assets/css/app.css',

                'Modules/Flights/resources/assets/js/app.js',
                'Modules/Flights/resources/assets/css/app.css',

                'Modules/Home/resources/assets/js/app.js',
                'Modules/Home/resources/assets/css/app.css',

                'Modules/Logging/resources/assets/js/app.js',
                'Modules/Logging/resources/assets/css/app.css',

                'Modules/Mail/resources/assets/js/app.js',
                'Modules/Mail/resources/assets/css/app.css',

                'Modules/Panel/resources/assets/js/app.js',
                'Modules/Panel/resources/assets/css/app.css',

                'Modules/Settings/resources/assets/js/app.js',
                'Modules/Settings/resources/assets/css/app.css',

                'Modules/Users/resources/assets/js/app.js',
                'Modules/Users/resources/assets/css/app.css',
            ],
            server: {
                origin: 'http://127.0.0.1:5173',
                watch: {
                    usePolling: true,
                },
                hmr: {
                    host: 'localhost',
                    protocol: 'ws',
                },
            },
            refresh: [
                'routes/web.php',
                'resources/views/**/*.blade.php',
                'Modules/**/resources/views/**/*.blade.php',
            ],
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
