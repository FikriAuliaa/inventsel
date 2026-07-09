import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/View/Component*.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                indigo: {
                    50: "#fff5f5",
                    100: "#ffe3e3",
                    200: "#ffc9c9",
                    300: "#ffa3a3",
                    400: "#ff6b6b",
                    500: "#ff3333",
                    600: "#E20613",
                    700: "#b8040e",
                    800: "#91020a",
                    950: "#1f0002",
                },
            },
        },
    },

    plugins: [forms],
};
