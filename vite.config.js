import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'src/App/resources/css/app.css',
                'src/App/resources/css/auth.css',
                'src/App/resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
