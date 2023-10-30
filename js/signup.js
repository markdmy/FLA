document.addEventListener("DOMContentLoaded", function () {
  //Search volunteer button functionality
  document
    .getElementById("searchVolunteerReference")
    .addEventListener("click", function () {
      const volunteerSearchDiv = document.getElementById(
        "volunteerEmailSearch"
      );
      volunteerSearchDiv.style.display = "block";
    });

  document
    .getElementById("searchVolunteerEmailButton")
    .addEventListener("click", function () {
      performSearchVolunteer();
    });

  document
    .getElementById("fname-searchVolunteer")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchVolunteer();
      }
    });

  document
    .getElementById("lname-searchVolunteer")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchVolunteer();
      }
    });

  function performSearchVolunteer() {
    const fnameEventVolunteer = document.getElementById(
      "fname-searchVolunteer"
    ).value;
    const lnameEventVolunteer = document.getElementById(
      "lname-searchVolunteer"
    ).value;

    if (
      fnameEventVolunteer.trim() === "" ||
      lnameEventVolunteer.trim() === ""
    ) {
      alert("Please enter first, last name.");
      return;
    }

    // Make an AJAX request to fetch the reference
    fetch("models/search_volunteer.php", {
      method: "POST",
      body: new URLSearchParams({
        "fname-eventVolunteer": fnameEventVolunteer,
        "lname-eventVolunteer": lnameEventVolunteer,
      }),
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((data) => {
        data = JSON.parse(data);
        const popupResultVolunteer = document.getElementById(
          "popup_volunteer_email_result"
        );
        if (data !== "No volunteers found with the given names.") {
          // Clear the previous results
          const tbody = document.querySelector("#volunteerQueryResult tbody");
          tbody.innerHTML = "";

          data.forEach((volunteer) => {
            const row = document.createElement("tr");
            row.classList.add("clickable-row");
            row.innerHTML = `
              <td>${volunteer.firstName}</td>
              <td>${volunteer.lastName}</td>
              <td>${volunteer.email}</td>
              <td>${volunteer.dateOfBirth}</td>
              <td>${volunteer.streetAddress}</td>
              
            `;
            tbody.appendChild(row);

            // Add a click event to each row to handle the selection
            row.addEventListener("click", () => {
              // Get the input element and populate it with the participantID
              const volunteerID = volunteer.volunteerID;
              const volunteerEmail = volunteer.email;
              // Close the popup
              popupResultVolunteer.style.display = "none";

              document.getElementById("volunteerEmailResult").innerHTML =
                volunteerEmail;
              document.getElementById("volunteerEmailResult").innerHTML +=
                "<br><span style='text-decoration: underline; cursor: pointer;'>Click to insert</span>";
              document
                .getElementById("volunteerEmailResult")
                .addEventListener("click", function () {
                  // Get the input element and populate it with the clicked value
                  const volunteerEmailReferenceInput =
                    document.getElementsByName("signup_email")[0];
                  volunteerEmailReferenceInput.value = volunteerEmail;
                  volunteerEmailReferenceInput.removeAttribute("disabled");
                  volunteerEmailReferenceInput.setAttribute(
                    "required",
                    "required"
                  );

                  const volunteerReferenceInput =
                    document.getElementsByName("volunteer_number")[0];
                  volunteerReferenceInput.value = volunteerID;
                  volunteerReferenceInput.removeAttribute("disabled");
                  volunteerReferenceInput.setAttribute("required", "required");

                  // Close the popup
                  document.getElementById(
                    "popup-search-volunteer-email"
                  ).style.display = "none";
                });
            });
          });
          popupResultVolunteer.style.display = "flex";
        } else {
          document.getElementById("volunteerEmailResult").innerHTML = data;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  document
    .getElementById("searchVolunteerReference")
    .addEventListener("click", function () {
      const volunteerSearchDiv = document.getElementById(
        "popup-search-volunteer-email"
      );
      volunteerSearchDiv.style.display = "flex";
    });

  document
    .getElementById("popup-search-volunteer-email")
    .addEventListener("click", function (event) {
      if (event.target === this) {
        document.getElementById("fname-searchVolunteer").value = "";
        document.getElementById("lname-searchVolunteer").value = "";
        document.getElementById("volunteerEmailResult").innerHTML = "";
        this.style.display = "none";
      }
    });

  const passwordInput = document.getElementById("password_input");
  const confirmInput = document.getElementById("confirm_password_input");
  const toggleButton1 = document.getElementById("toggle_password1");
  const toggleButton2 = document.getElementById("toggle_password2");
  const toggleButton3 = document.getElementById("toggle_password3");

  const pwNotMatched = document.getElementById("pw_not_matched");

  // Function to toggle password visibility and update the eye icon
  function togglePasswordVisibility(
    input,
    toggleButton,
    eyeClosedSrc,
    eyeOpenSrc
  ) {
    if (input.type === "password") {
      input.type = "text";
      toggleButton.firstElementChild.src = eyeClosedSrc; // Change the src of the first child (the img)
    } else {
      input.type = "password";
      toggleButton.firstElementChild.src = eyeOpenSrc; // Change the src of the first child (the img)
    }
  }

  // Add click event listeners to toggle buttons
  toggleButton1.addEventListener("click", () => {
    togglePasswordVisibility(
      passwordInput,
      toggleButton1,
      "assets/images/eye-slash-solid.svg",
      "assets/images/eye-solid.svg"
    );
  });

  toggleButton2.addEventListener("click", () => {
    togglePasswordVisibility(
      confirmInput,
      toggleButton2,
      "assets/images/eye-slash-solid.svg",
      "assets/images/eye-solid.svg"
    );
  });

  toggleButton3.addEventListener("click", () => {
    togglePasswordVisibility(
      confirmInput,
      toggleButton2,
      "assets/images/eye-slash-solid.svg",
      "assets/images/eye-solid.svg"
    );
  });

  // Function to validate passwords
  function validatePasswords() {
    const password = passwordInput.value;
    const confirmPassword = confirmInput.value;

    if (password !== confirmPassword) {
      document.getElementById("pw_not_matched").textContent =
        "Passwords do not match";
      document.getElementById("pw_length_error").textContent = ""; // Clear any length error message
      return false; // Return false if passwords don't match
    } else {
      // Check if the password is between 8 and 12 characters
      if (password.length < 8 || password.length > 12) {
        // Display a message if the password length is not within the required range
        document.getElementById("pw_length_error").textContent =
          "Password must be between 8 and 12 characters.";
        document.getElementById("pw_not_matched").textContent = ""; // Clear "Passwords do not match" message
        return false; // Return false if length is incorrect
      } else {
        document.getElementById("pw_not_matched").textContent =
          "Passwords Matched.";
        document.getElementById("pw_length_error").textContent = ""; // Clear any length error message
        return true; // Return true if both conditions are met
      }
    }
  }

  confirmInput.addEventListener("input", validatePasswords);

  document
    .getElementById("add-volun-form")
    .addEventListener("submit", function (event) {
      const volunteerNumberInput = document.getElementById("volunteer_number");
      const signupEmailInput = document.getElementById("signup_email");

      if (
        volunteerNumberInput.value.trim() === "" ||
        signupEmailInput.value.trim() === ""
      ) {
        alert("Please insert Reference number and email.");
        event.preventDefault(); // Prevent form submission
      } else if (!validatePasswords()) {
        alert("Passwords DO NOT match or don't meet the length requirement.");
        event.preventDefault(); // Prevent form submission
      } else {
        if (
          !confirm(
            "Are you sure you want to submit the form? Please make sure you confirm email and password"
          )
        ) {
          event.preventDefault();
        }
      }
    });

  const strengthText = document.getElementById("strength-text");
  const lengthText = document.getElementById("length-text");

  passwordInput.addEventListener("input", () => {
    const password = passwordInput.value;
    const length = password.length;

    lengthText.textContent = `${length} characters`;

    if (length >= 8 && length <= 12) {
      lengthText.style.color = "green";

      if (isStrongPassword(password)) {
        strengthText.textContent = "Strong";
        strengthText.style.color = "green";
      } else {
        strengthText.textContent = "Moderate";
        strengthText.style.color = "orange";
      }
    } else {
      lengthText.style.color = "red";
      strengthText.textContent = "Weak";
    }
  });

  function isStrongPassword(password) {
    // Check if the password meets the minimum length requirement
    if (password.length < 8) {
      return false;
    }

    // Check for uppercase letters
    if (!/[A-Z]/.test(password)) {
      return false;
    }

    // Check for lowercase letters
    if (!/[a-z]/.test(password)) {
      return false;
    }

    // Check for numbers
    if (!/[0-9]/.test(password)) {
      return false;
    }

    // Check for special characters
    if (!/[@#$%^&+=]/.test(password)) {
      return false;
    }

    // If all checks pass, the password is strong
    return true;
  }
});
