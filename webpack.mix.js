const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .options({ processCssUrls: false })

mix.js('resources/js/editor-admin.js', 'public/js')
    .copy('node_modules/tinymce/skins', 'public/js/wysiwyg/skins')
    .copy('resources/js/vi_VN.js', 'public/js');

if (mix.inProduction()) {
    mix.version();
}
