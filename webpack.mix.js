let mix = require('laravel-mix');
const path = require('path');

mix.js('src/main.ts', 'dist').setPublicPath('dist');

mix.webpackConfig({
    resolve: {
        extensions: ['.ts','.js', '.vue'],
        alias: {
            '@': path.resolve(__dirname + '/resources')
        }
    }
});
