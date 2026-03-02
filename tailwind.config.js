/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },

      fontWeight: {
        regular: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
      },

      colors: {
        grey: {
          50:  '#F8F8F8',
          100: '#b8b8b8',
          200: '#959595',
          300: '#656565',
          400: '#474747',
          500: '#191919',
          600: '#171717',
          700: '#121212',
          800: '#0e0e0e',
          900: '#0b0b0b',
        }
      }

    },
  },
  plugins: [],
}