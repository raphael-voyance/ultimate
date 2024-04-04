import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typographie from '@tailwindcss/typography';
import aspectratio from '@tailwindcss/aspect-ratio';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        "./resources/**/**/*.blade.php",
        "./resources/**/**/*.js",
        "./app/View/Components/**/**/*.php",
        "./app/Livewire/**/**/*.php",

        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",

        './vendor/usernotnull/tall-toasts/config/**/*.php',
        './vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                writer: ["Zeyada", "cursive"],
                serif: ["Marcellus", ...defaultTheme.fontFamily.serif],
            },
        },
    },

    corePlugins: {
        aspectRatio: false,
    },

    plugins: [forms, typographie, aspectratio, require("daisyui")],

    daisyui: {
        themes: [
            {
            base_theme: {
                "primary": "#c670e0",
                "secondary": "#498fc1",
                "secondary-accent": "#3b76a0",
                "accent": "#e8915f",
                "neutral": "#1b1528",
                "base-100": "#27283f",
                "info": "#85abe5",
                "success": "#116953",
                "warning": "#fdd463",
                "error": "#ea5f4d",
                },
            },
            "dark",
        ],
      },
};
