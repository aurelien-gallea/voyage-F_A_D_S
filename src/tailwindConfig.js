
      tailwind.config = {
        theme: {
          extend: {
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
    
    