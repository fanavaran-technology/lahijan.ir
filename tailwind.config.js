const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/app/**/*.blade.php",
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '0rem',
                lg: '2rem',
                xl: '3rem',
                '2xl': '4rem',
            },
        },
        extend: {
            fontFamily: {
                'vazir': ["vazirmatn"],
                'shabnam': ["shabnam"]
            },
            // backgroundImage: {
            //     'hero-pattern': "url('/img/hero-pattern.svg')",
            //     'footer-texture': "url('/img/footer-texture.png')",
            // }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
