// program.html collapsible menus

document.addEventListener("DOMContentLoaded", function () {
  const menuTitles = document.querySelectorAll(".menu-title");

  function toggleMenu(content, title) {
    if (content.style.display === "block") {
      content.style.display = "none";
      title.querySelector(".icon").textContent = "+";
    } else {
      content.style.display = "block";
      title.querySelector(".icon").textContent = "-";
    }
  }

  menuTitles.forEach((title) => {
    title.addEventListener("click", () => {
      const content = title.nextElementSibling;
      toggleMenu(content, title);
    });
  });

  if (window.location.hash) {
    const hash = window.location.hash.substring(1);
    const menu = document.getElementById(hash);

    if (menu) {
      const content = menu.querySelector(".menu-content");
      const title = menu.querySelector(".menu-title");
      toggleMenu(content, title);
    }
  }
});

// navigation bar mobile

document.addEventListener("DOMContentLoaded", function () {
  const hamburgerIcon = document.querySelector(".hamburger-icon");
  const navMobile = document.querySelector(".navMobile");

  hamburgerIcon.addEventListener("click", function (event) {
    event.stopPropagation();
    navMobile.classList.toggle("visible");

    if (navMobile.classList.contains("visible")) {
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = "auto";
    }
  });

  document.addEventListener("click", function (event) {
    if (
      !navMobile.contains(event.target) &&
      !hamburgerIcon.contains(event.target)
    ) {
      navMobile.classList.remove("visible");
      document.body.style.overflow = "auto";
    }
  });
});

// homepage image slideshow

let slideIndex = 0;
showSlides();

function showSlides() {
  let slides = document.getElementsByClassName("slide");

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex++;

  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  slides[slideIndex - 1].style.display = "block";

  setTimeout(showSlides, 3500);
}