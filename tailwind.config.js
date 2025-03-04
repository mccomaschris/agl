const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
		content: [
			"./resources/**/*.blade.php",
			"./resources/**/**/*.blade.php",
			"./resources/**/**/**/*.blade.php",
			"./resources/**/*.js",
			'./vendor/livewire/flux-pro/stubs/**/*.blade.php',
			'./vendor/livewire/flux/stubs/**/*.blade.php',
		],
    theme: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
        },
        extend: {
            colors: {
              grey: {
                100: '#f8f9f8',
                200: '#ebeeec',
                300: '#dde1de',
                400: '#ced4d0',
                500: '#bdc5c0',
                600: '#95a39a',
                700: '#7c8d82',
                800: '#5b7163',
                900: '#121514',
              },
              green: {
                100: '#e6f6e3',
                200: '#caedc4',
                300: '#abe2a1',
                400: '#86d578',
                500: '#00B140',
                600: '#18a000',
                700: '#158c00',
                800: '#117400',
                900: '#0c5300',
              },
              'green-bright': '#08cd4f',
              'black-grey': '#121514',
              'yellow': '#ECC94B',

              red: {
                100: "#fff5f5",
                500: "#f56565",
                900: "#742a2a"
              },
            }
          }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        },
    },
};
