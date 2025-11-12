// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });

// import { defineConfig } from 'vite'
// import laravel from 'laravel-vite-plugin'
// import tailwindcss from '@tailwindcss/vite'

// export default defineConfig({
//   plugins: [
//     laravel({
//       input: [
//         'resources/css/app.css',   // tetap ada untuk Tailwind / custom CSS
//         'resources/js/app.js'      // entry utama untuk Vuexy
//       ],
//       refresh: true,
//     }),
//     tailwindcss(),
//   ],

//   // biar font, gambar, dan ikon Vuexy bisa di-load
//   assetsInclude: [
//     '*/.png',
//     '*/.jpg',
//     '*/.jpeg',
//     '*/.svg',
//     '*/.webp',
//     '*/.woff',
//     '*/.woff2',
//     '*/.ttf',
//     '*/.eot'
//   ],
// })
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: [
        'resources/views/**/*.blade.php',
        'resources/js/**/*.js',
        'resources/js/**/*.vue',
        'resources/css/**/*.css',
      ],
    }),
  ],
  resolve: {
    alias: {
      '@': '/resources/js',
    },
  },
})