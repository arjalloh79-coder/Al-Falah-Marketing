/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.html'],
  theme: {
    extend: {
      colors: {
        canvas:   '#FAF8F5',
        stone:    '#F2EFE9',
        emerald:  { DEFAULT: '#14453D', deep: '#0F342E', soft: '#1C5B50' },
        brass:    { DEFAULT: '#C59B48', soft: '#D8BE86', light: '#E8D9B4' },
        charcoal: '#1C1E1D',
        slate:    '#5A605D',
      },
      fontFamily: {
        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
        sans:  ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
        arabic:['"Amiri"', 'serif'],
      },
      boxShadow: {
        soft: '0 1px 2px rgba(28,30,29,.04), 0 12px 32px -12px rgba(28,30,29,.14)',
        lift: '0 2px 4px rgba(28,30,29,.05), 0 24px 48px -20px rgba(20,69,61,.28)',
      },
      letterSpacing: { tightish: '-0.02em' },
    },
  },
  plugins: [],
};
