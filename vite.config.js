import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';

const modulePath = path.resolve(__dirname, 'Modules');
const modules = fs.existsSync(modulePath)
    ? fs.readdirSync(modulePath).filter(dir => fs.statSync(path.join(modulePath, dir)).isDirectory())
    : [];

const moduleAssets = modules.flatMap(module => [
    `Modules/${module}/resources/assets/js/app.js`,
    `Modules/${module}/resources/assets/css/app.css`,
    'resources/js/app.js',
    'resources/js/turbo.js',
]);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/turbo.js',
                ...moduleAssets,
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
