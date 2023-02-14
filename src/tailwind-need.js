
tailwind.config = { darkMode: 'class',
// ...
content: [],
  theme: {
    extend: {
      colors: {
  'color-1': '#000F08',
  'color-2': '#1C3738',
  'color-3': '#4D4847',
  'color-4': '#F4FFF8',
  'color-5': '#8BAAAD',
},
      opacity: {
        54: ".24",
      },
      fontFamily: {
        Unbounded: ['"Unbounded"'],
      },
    },
  },
};


// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (
  localStorage.getItem("color-theme") === "dark" ||
  (!("color-theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  document.documentElement.classList.add("dark");
} else {
  document.documentElement.classList.remove("dark");
}



