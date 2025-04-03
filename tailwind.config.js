/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/*.{html,js,php}",
    "./public/admin/*.{html,js,php}",
    "./public/user/*.{html,js,php}",
  ],

  theme: {
    extend: {
      screens: {
        "max-md": { max: "768px" },
      },
    },
  },
  plugins: [],
};

// module.exports = {
//   purge: ["./src/**/*.{html,js,jsx,ts,tsx}", "./public/index.html"], // Include all relevant paths
//   darkMode: false, // or 'media' or 'class'
//   theme: {
//     extend: {},
//   },
//   variants: {
//     extend: {},
//   },
//   plugins: [],
// };
