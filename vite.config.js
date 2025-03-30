import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'Modules/**/Resources/assets/js/app.js',
                'Modules/**/Resources/assets/css/app.css',
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
