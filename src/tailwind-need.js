
tailwind.config = { darkMode: 'class',
// ...
content: [],
  theme: {
    extend: {
      colors: {
  'color-1': '#111827',
  'color-2': '#8BAAAD',
  'color-3': '#90323D',
  'color-4': '#FCF6B1',
  'color-5': '#F18F01AD',
},
      opacity: {
        54: ".24",
      },
      fontFamily: {
        'unbounded': ['"Unbounded"']
      }
    }
  }
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



