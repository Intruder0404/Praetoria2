let mix = require('laravel-mix');

mix.js('src/main.ts', 'dist').setPublicPath('dist');

mix.webpackConfig({
    resolve: {
        extensions: ['.ts','.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        }
    }
});
