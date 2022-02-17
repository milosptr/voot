const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.html',
        './resources/**/*.js',
    ],

    theme: {
      colors: {
        ...colors,
        primary: {
          lighter: '#1d68a7',
          light: '#214b76',
          DEFAULT: '#10253a',
        },
        yellow: {
          DEFAULT: '#FFDA00',
        }
      },
      extend: {
        borderWidth: {
          '1': '1px'
        }
      },
    },
    variants: {
      extend: {},
    },

    plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/aspect-ratio'),
    ],
};
