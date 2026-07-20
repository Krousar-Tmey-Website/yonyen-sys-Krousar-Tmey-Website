import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/admin.css', 'resources/css/admin-news.css', 'resources/css/admin-history.css', 'resources/css/admin-donations.css', 'resources/js/app.js', 'resources/js/admin-donations.js', 'resources/js/admin-news-editor.js', 'resources/js/admin-news-form.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
