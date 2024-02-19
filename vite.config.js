import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import vuetify, { transformAssetUrls } from 'vite-plugin-vuetify'
import {fileURLToPath, URL} from "url";

export default defineConfig({
    plugins: [
        vue({
            template: { transformAssetUrls }
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/main.ts'],
            refresh: true,
        }),
        vuetify({
            autoImport: true,
        }),
    ],
    define: { 'process.env': {} },
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url))
        },
        extensions: [
            '.ts',
            '.js',
            '.json',
            '.jsx',
            '.mjs',
            '.ts',
            '.tsx',
            '.vue',
        ],
    },
});
