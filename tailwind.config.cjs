/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'navbar' : '#000814',
        'bgblue' : '#000E24',
        'yellowactive' : '#FFD60A'
      }
    },
  },
  plugins: [],
}