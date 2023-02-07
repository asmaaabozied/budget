import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'storage/vite.hot',
            buildDirectory: 'build-main',
            input: [
                'resources/assets/sass/app.scss',
                'resources/assets/js/app.js',
            ],
            refresh: true,
        }),
        // vue({
        //     template: {
        //         transformAssetUrls: {
        //             base: null,
        //             includeAbsolute: false,
        //         },
        //     },
        // }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': '/resources/assets/js'
        }
    },
    server: {
        host: '0.0.0.0'
    },
    build: {
        manifest: 'main_manifest.json',
    }
})
