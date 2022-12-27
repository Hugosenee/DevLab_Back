/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./src/**/*.{vue,js,ts,jsx,tsx,php}",
  ],
  theme: {
    extend: {
      colors: {
        'navbar' : '#000814',
        'bgble' : '#000E24',
        'yellowactive' : '#FFD60A'
      }
    },
  },
  plugins: [],
}