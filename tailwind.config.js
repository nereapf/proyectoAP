import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                azulFondo: "#e8f0ff",
                azulBoton: "#78a7ff",
                azulOscuro: "#003399",
                azulBordes: "#c3d6f9",
                azulMenuSeleccionado: "#ccdcf7",
                amarilloEstrellas: "#eab308",
                grisEstrellas: "#e2e8f0"
            }
        },
    },

    plugins: [forms, require("daisyui")],
};
