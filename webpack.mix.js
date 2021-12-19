const mix = require("laravel-mix");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
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

// mix.webpackConfig({
//   plugins: [new MiniCssExtractPlugin({ filename: "resources/css/app.css" })],
//   module: {
//     rules: [
//       {
//         test: /\.css(\?|$)/,
//         use: [MiniCssExtractPlugin.loader, "css-loader"],
//         include: [/node_modules/],
//       },
//     ],
//   },
// });

mix
  .js("resources/js/app.js", "public/js")
  .vue()
  .sass("resources/sass/app.scss", "public/css")
 