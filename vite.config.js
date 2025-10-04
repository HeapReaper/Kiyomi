
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import collectModuleAssetsPaths from './vite-module-loader.js';
 
async function getConfig() {
    const paths = [
        'resources/css/app.css',
        'resources/js/app.js',
    ];
    const inputPaths = await collectModuleAssetsPaths(paths, 'Modules');
    refreshPaths.push(
        'Modules/**/app/Livewire/**',
        'Modules/**/app/View/Components/**',
        'Modules/**/lang/**',
        'Modules/**/resources/lang/**',
        'Modules/**/resources/views/**',
        'Modules/**/routes/**'
    );
 
    return defineConfig({
        plugins: [
            laravel({
                input: inputPaths,
                refresh: refreshPaths,
            })
        ]
    });
}
 
export default getConfig();