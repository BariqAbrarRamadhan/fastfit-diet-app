import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    theme: {
        extend: {
            colors: {
                orange: {
                    50: '#FFF3E0',
                    100: '#FFE0B2',
                    500: '#FF9800',
                    600: '#F57C00',
                },
                purple: {
                    100: '#F3E5F5',
                    500: '#9C27B0',
                },
                green: {
                    100: '#E8F5E9',
                    500: '#4CAF50',
                    800: '#2E7D32',
                },
                red: {
                    100: '#FFEBEE',
                    500: '#F44336',
                    600: '#D32F2F',
                    800: '#B71C1C',
                },
            },
        },
    },
});
