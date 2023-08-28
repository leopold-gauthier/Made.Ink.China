document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector(".menu-toggle");
    const menuList = document.querySelector(".menu-list");
    const body = document.querySelector("body");

    menuToggle.addEventListener("click", function() {
        if (window.getComputedStyle(menuList).opacity === '1') {
            // Code à exécuter si l'opacité est égale à 1
            menuList.classList.remove("show");
            body.classList.remove("no-scroll");
          } else {
            // Code à exécuter si l'opacité n'est pas égale à 1
            body.classList.add("no-scroll");
            menuList.classList.add("show");
        }
      window.scrollTo(0, 0);

    });
  });