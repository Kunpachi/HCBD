// import defaultTheme from 'tailwindcss/defaultTheme';

// /** @type {import('tailwindcss').Config} */
// export default {
//     content: [
//         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/**/*.blade.php',
//         './resources/**/*.js',
//         './resources/**/*.vue',
//     ],
//     theme: {
//         extend: {
//             fontFamily: {
//                 sans: ['Figtree', ...defaultTheme.fontFamily.sans],
//             },
//         },
//     },
//     plugins: [],
// };

// tailwind.config.js

import defaultTheme from 'tailwindcss/defaultTheme';

// /** @type {import('tailwindcss').Config} */
// export default {
//     // Tambahkan prefix 'tw-' agar tidak bentrok dengan class Vuexy/Bootstrap
//     // Contoh: 'text-center' (Vuexy) vs 'tw-text-center' (Tailwind)
//     prefix: 'tw-',
    
//     // Ini adalah bagian '@source' yang Anda salah tempatkan di app.css
//     content: [
//         './resources/vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/views/**/*.blade.php', // Pastikan ini mengarah ke semua file Blade Anda
//         './resources/js/**/*.js',         // Dan file JS Anda
//     ],

//     theme: {
//         extend: {
//             // Ini adalah bagian '@theme' yang Anda salah tempatkan di app.css
//             fontFamily: {
//                 sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
//             },
//         },
//     },

//     plugins: [],
// };

const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  // Hindari tabrakan dengan class Bootstrap/Vuexy
  prefix: 'tw-',

  // Nonaktifkan preflight supaya tidak bentrok reset Bootstrap/Vuexy
  corePlugins: {
    preflight: false,
  },

  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './storage/framework/views/*.php',
    './resources/vendor/**/*.html',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
      },
      // Tambahkan warna/spacing kustom bila perlu
    },
  },

  plugins: [],
}