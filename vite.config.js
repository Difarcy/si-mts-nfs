import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/website.css',
                'resources/js/website.js',
                'resources/css/admin.css',
                'resources/js/admin.js',
                'resources/js/auth.js'
            ],
            refresh: [
                'resources/views/**',
                'routes/**',
                'app/**',
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: [
                '**/node_modules/**',
                '**/vendor/**',
                '**/storage/**',
                '**/bootstrap/cache/**',
                '**/public/build/**',
                '**/public/hot',
                '**/.git/**',
                '**/database/**',
                '**/tests/**',
                '**/.env*',
                '**/composer.json',
                '**/composer.lock',
                '**/package-lock.json',
            ],
            usePolling: false,
            interval: 100,
        },
        hmr: {
            host: 'localhost',
        },
    },
    optimizeDeps: {
        include: ['alpinejs'],
    },
});
