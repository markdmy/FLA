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
  if (window.location.pathname.endsWith("registration.php")) {
    const addButton = document.querySelector(".add-member-button");

    if (addButton) {
      let firstClick = true;
      addButton.addEventListener("click", function () {
        if (!templateAdded && !firstClick) {
          addMember();
        }
        firstClick = false;
      });
    }
  }

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
      window.location.href = "submitSuccess.php";
    }
  });
});
