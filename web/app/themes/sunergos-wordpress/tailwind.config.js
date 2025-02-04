/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    colors: {
      mediterraneanblue: '#26619C',
      twilightblue: '#123456',
      seashell: '#F5F5F5',
      lavender: '#89619E',
      darklavender: '#664875',
      bluecharcoal: '#858AB5',
      honeyorange: '#F5A623',
      white: '#fff',
      transparent: 'transparent',
      current: 'currentColor',
    },
    extend: {
      container: {
        center: true,
        padding: '2rem',
        screens : {
          sm: '640px', // Small devices
          md: '768px', // Medium devices
          lg: '1024px', // Large devices
          xl: '1264px', // Extra-large devices
          '2xl': '1264px', // 2XL devices
        }
      },
      fontFamily: {
        sans: 'sans-serif',
        serif: '"Cochin", serif',
      },
    },
  },
  plugins: [],
};

export default config;
