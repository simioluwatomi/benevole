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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/index.scss', 'public/css')
    .copyDirectory('node_modules/boomerang-ui-kit/assets/images', 'public/images')
    .copy(['node_modules/boomerang-ui-kit/assets/css/theme.css'], 'public/css/boomerang.css')
    .extract()
    .browserSync('benevole.test')
    .disableNotifications()
    .version();

// remove console.log statements from production builds
if (mix.inProduction()) {
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true
                }
            }
        }
    });
}
