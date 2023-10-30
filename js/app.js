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

  //by eunji. Adding automatic phoneinput formats in all forms
  const phoneInputs = document.querySelectorAll("input[type=tel]");

  phoneInputs.forEach((phoneInput) => {
    phoneInput.addEventListener("input", function (e) {
      const inputValue = e.target.value.replace(/\D/g, "");

      if (inputValue.length >= 1) {
        let formattedValue = "";
        if (inputValue.length > 0) {
          formattedValue += inputValue.substring(0, 3);
        }
        if (inputValue.length >= 4) {
          formattedValue += "-" + inputValue.substring(3, 6);
        }
        if (inputValue.length >= 7) {
          formattedValue += "-" + inputValue.substring(6, 10);
        }
        e.target.value = formattedValue;
      }
    });
  });

  const passwordInput = document.getElementById("password");
  const toggleButton3 = document.getElementById("toggle_password3");

  function togglePasswordVisibility(
    input,
    toggleButton3,
    eyeClosedSrc,
    eyeOpenSrc
  ) {
    if (input.type === "password") {
      input.type = "text";
      toggleButton3.firstElementChild.src = eyeClosedSrc; // Change the src of the first child (the img)
    } else {
      input.type = "password";
      toggleButton3.firstElementChild.src = eyeOpenSrc; // Change the src of the first child (the img)
    }
  }

  // Add click event listeners to toggle buttons
  toggleButton3.addEventListener("click", () => {
    togglePasswordVisibility(
      passwordInput,
      toggleButton3,
      "assets/images/eye-slash-solid.svg",
      "assets/images/eye-solid.svg"
    );
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
