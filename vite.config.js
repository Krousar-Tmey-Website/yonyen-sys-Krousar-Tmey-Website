import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/admin.css', 'resources/css/admin-news.css', 'resources/css/award.css', 'resources/js/app.js'],
```
<arg_key>task_progress</arg_key>
<arg_value>- [x] Investigate public awards page issue
- [x] Check .env configuration
- [x] Fix about.blade.php to show images and links
- [x] Verify the fix works
- [x] Improve styling and add detail view
- [x] Update about.blade.php with professional styling
- [x] Enhance admin awards page with professional styling
- [x] Create admin awards create page
- [x] Create admin awards edit page
- [x] Update AwardController to handle remove_image
- [x] Fix routes to include create and edit
- [x] Verify all features work
- [x] Create separate award.css file
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
