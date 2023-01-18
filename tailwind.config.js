const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
delete colors['lightBlue'];
delete colors['warmGray'];
delete colors['trueGray'];
delete colors['coolGray'];
delete colors['blueGray'];

module.exports = {
    content: [
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
      "./index.html",
      './resources/**/*.{vue,js,ts,jsx,tsx}',
      './node_modules/litepie-datepicker/**/*.js',
      "./resources/**/*.blade.php",
    ],
    theme: {
      colors: {
        ...colors,
        primary: {
          lightest: '#bed4ed',
          lighter: '#1d68a7',
          light: '#214b76',
          DEFAULT: '#10253a',
        },
        transparent: {
          DEFAULT: 'transparent',
        }
      },
      extend: {
        background: {
          transparent: 'rbga(0,0,0,0)',
        },
        borderWidth: {
          '1': '1px'
        },
        maxHeight: {
          '290' : '290px'
        },
        shadow: {
          DEFAULT: 'filter: drop-shadow(0 25px 25px rgb(0 0 0 / 0.15))'
        }
      },
    },
    variants: {
      extend: {},
    },

    plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
      require('@tailwindcss/line-clamp'),
      require('@tailwindcss/aspect-ratio'),
    ],
};
