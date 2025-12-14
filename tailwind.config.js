import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                'neutral-primary-medium': '#fff',
                'primary': 'oklch(95.4% 0.038 75.164)',
                'brand': 'oklch(92.9% 0.013 255.508)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'heading': ['Bricolage Grotesque', 'sans-serif'],
            },
        },
    },

    plugins: [
        forms, 
        typography,
        require('flowbite/plugin'),
    ],
};
