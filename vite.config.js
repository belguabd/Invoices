import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    react(),
    laravel({
      input: [
        // Ensure these paths are correct and relative to your project's root directory
        'resources/js/app.jsx',  // Example path to a JSX file
        'resources/js/app.js',   // Example path to a JavaScript file
        'resources/css/app.css', // Example path to a CSS file
      ],
      refresh: true,
    }),
  ],
});
