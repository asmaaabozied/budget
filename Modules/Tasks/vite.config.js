const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import { splitVendorChunkPlugin } from 'vite'
import path from 'path'
import VueI18nPlugin from "@intlify/unplugin-vue-i18n/vite";
import prismjs from 'vite-plugin-prismjs';

export default defineConfig({
    build: {
        outDir: '../../public/modules/tasks/build',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'modules/tasks/build',
            input: [
                __dirname + '/Resources/assets/js/app.js'
            ],
            refresh: true,

        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VueI18nPlugin({
            include: path.resolve(__dirname, '/Resources/assets/js/libs//locales/**'),
        }),
        splitVendorChunkPlugin(),
        prismjs({
            languages: ['json'],
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~': path.resolve(__dirname, 'node_modules'),
            '@': '/Resources/assets/js',
        }
    },
    optimizeDeps: {
        include: ['sortablejs'],
    },
    server: {
        host: '0.0.0.0'
    },
})

