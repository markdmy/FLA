//coded by Eunji

document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("additional-members-container");
  let templateAdded = false;

  function addMember() {
    const memberTemplate = document.querySelector(
      ".additional-member-template"
    );
    const clone = memberTemplate.cloneNode(true);

    const originalRemoveButton = clone.querySelector(".remove-member-button");
    if (templateAdded) {
      originalRemoveButton.style.display = "inline-block";
    } else {
      originalRemoveButton.style.display = "none";
    }

    clone.querySelectorAll("input").forEach(function (input) {
      input.value = "";
      const uniqueId = generateUniqueId();
      input.name += uniqueId;
      input.id += uniqueId;
    });

    const removeButton = clone.querySelector(".remove-member-button");
    removeButton.style.display = "inline-block";

    removeButton.addEventListener("click", function () {
      container.removeChild(clone);
      checkRemoveButtonVisibility();
    });

    container.appendChild(clone);
    checkRemoveButtonVisibility();
    templateAdded = true;
  }

  const addButton = document.querySelector(".add-member-button");

  let firstClick = true;
  addButton.addEventListener("click", function () {
    if (!templateAdded && !firstClick) {
      addMember();
    }
    firstClick = false;
  });

  container.addEventListener("click", function (event) {
    if (event.target && event.target.classList.contains("add-member-button")) {
      addMember();
    }
  });

  function checkRemoveButtonVisibility() {
    const removeButtons = container.querySelectorAll(".remove-member-button");
    if (removeButtons.length === 1) {
      removeButtons[0].style.display = "none";
    } else {
      removeButtons.forEach(function (button) {
        button.style.display = "inline-block";
      });
    }
  }

  function generateUniqueId() {
    return "_" + Math.random().toString(36).substr(2, 9);
  }

  const registrationForm = document.getElementById("registration-form");

  registrationForm.addEventListener("submit", function (e) {
    const confirmation = confirm("Are you sure you want to submit the form?");
    if (!confirmation) {
      e.preventDefault();
    } else {
      window.location.href = "registrationSuccess.php";
    }
  });

  const phoneInput = document.getElementById("phone");

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
