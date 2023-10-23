document.addEventListener("DOMContentLoaded", function () {
  const navButtons = document.querySelectorAll(".event-nav-button");
  const formSections = document.querySelectorAll(".event-container");

  navButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      formSections.forEach((section) => {
        section.style.display = "none";
      });

      const formId = event.currentTarget.getAttribute("data-form");

      const correspondingForm = document.getElementById(formId);
      if (correspondingForm) {
        correspondingForm.style.display = "block";
      }
    });
  });

  let buttons = document.querySelectorAll(".event-nav-button");

  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      buttons.forEach(function (btn) {
        btn.classList.remove("clicked");
      });

      this.classList.add("clicked");
    });
  });

  //search partner button functionality
  document
    .getElementById("searchPartnerButton")
    .addEventListener("click", function () {
      const partnerSearchDiv = document.getElementById("partnerSearch");

      partnerSearchDiv.style.display = "block";
    });

  document
    .getElementById("searchPartnerIDButton")
    .addEventListener("click", function () {
      performSearchPartner();
    });

  document
    .getElementById("laundromat-name")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchPartner();
      }
    });

  function performSearchPartner() {
    const nameOfLaundromat = document.getElementById("laundromat-name").value;

    if (nameOfLaundromat.trim() === "") {
      alert("Please enter the name of laundromat registered.");
      return;
    }
    // Make an AJAX request to fetch the reference
    fetch("models/search_partner.php", {
      method: "POST",
      body: new URLSearchParams({
        "laundromat-name": nameOfLaundromat,
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
        console.log(data);

        if (data !== "Partner information not found") {
          const confirmation = confirm(
            "Is this partner's street address? \n" + data.streetAddress
          );

          if (confirmation) {
            document.getElementById("partnerIDResult").innerHTML =
              data.partnerID;

            document.getElementById("partnerIDResult").innerHTML +=
              "<br><span style='text-decoration: underline; cursor: pointer;'>Click to insert</span>";

            document
              .getElementById("partnerIDResult")
              .addEventListener("click", function () {
                // Get the input element and populate it with the clicked value
                const partnerReferenceInput =
                  document.getElementsByName("partner_id")[0];
                partnerReferenceInput.value = data.partnerID;

                // Close the popup
                document.getElementById("popup-search-partner").style.display =
                  "none";
              });
          } else {
            const laundromatName = document.getElementById("laundromat-name");
            laundromatName.value = "";
          }
        } else {
          document.getElementById("partnerIDResult").innerHTML = data;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  document
    .getElementById("searchPartnerButton")
    .addEventListener("click", function () {
      const partnerSearchDiv = document.getElementById("popup-search-partner");
      partnerSearchDiv.style.display = "flex";
    });

  document
    .getElementById("popup-search-partner")
    .addEventListener("click", function (event) {
      if (event.target === this) {
        document.getElementById("laundromat-name").value = "";
        document.getElementById("partnerIDResult").innerHTML = "";
        this.style.display = "none";
      }
    });

  //select element for adding participants
  const eventSelect = document.getElementById("event-for-participant");
  let selectedOption = null;

  // Event listener for when the select element is clicked for adding eventParticipants
  eventSelect.addEventListener("click", function () {
    // Make an AJAX request to fetch events data
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "models/fetch_events.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        const defaultOption = document.createElement("option");
        defaultOption.text = "Choose Laundromat/Event Date/Address";
        defaultOption.disabled = true;
        defaultOption.hidden = true;
        eventSelect.innerHTML = "";
        eventSelect.appendChild(defaultOption);

        data.forEach(function (event) {
          const option = document.createElement("option");
          option.text = `${event.nameOfLaundromat} / ${event.eventDate} / ${event.streetAddress}`;
          option.value = event.eventID;
          eventSelect.appendChild(option);
        });

        if (selectedOption) {
          eventSelect.value = selectedOption.value;
        }
      }
    };
    xhr.send();
  });

  // Add an event listener to update the select element's value when an option is selected
  eventSelect.addEventListener("change", function () {
    selectedOption = this.options[this.selectedIndex];
    this.value = selectedOption.value;
    const eventID = selectedOption.value; // Get the eventID from the selected option
    console.log(eventID); // Log the eventID
  });

  //search participant functionality
  document
    .getElementById("searchParticipantButton")
    .addEventListener("click", function () {
      const participantSearchDiv = document.getElementById("participantSearch");
      participantSearchDiv.style.display = "block";
    });

  document
    .getElementById("searchParticipantIDButton")
    .addEventListener("click", function () {
      performSearchParticipant();
    });

  document
    .getElementById("fname-eventParticipant")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchParticipant();
      }
    });

  document
    .getElementById("lname-eventParticipant")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchParticipant();
      }
    });

  document
    .getElementById("dob-eventParticipant")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchParticipant();
      }
    });

  function performSearchParticipant() {
    const fnameEventParticipant = document.getElementById(
      "fname-eventParticipant"
    ).value;
    const lnameEventParticipant = document.getElementById(
      "lname-eventParticipant"
    ).value;
    const dobEventParticipant = document.getElementById(
      "dob-eventParticipant"
    ).value;

    // Check if both first name and last name are provided before making the request
    if (
      fnameEventParticipant.trim() === "" ||
      lnameEventParticipant.trim() === "" ||
      dobEventParticipant.trim() === ""
    ) {
      alert("Please enter first, last name and date of birth.");
      return; // Do not proceed with the search if the inputs are empty.
    }

    // Make an AJAX request to fetch the reference
    fetch("models/search_participant.php", {
      method: "POST",
      body: new URLSearchParams({
        "fname-eventParticipant": fnameEventParticipant,
        "lname-eventParticipant": lnameEventParticipant,
        "dob-eventParticipant": dobEventParticipant,
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
        // data = data.replace(/"/g, "");
        data = JSON.parse(data);
        console.log(data);

        if (data !== "Participant information not found") {
          const confirmation = confirm(
            "Is this your street address? \n" + data.streetAddress
          );

          if (confirmation) {
            // Get the input element and populate it with the participantID

            document.getElementById("participantIDResult").innerHTML =
              data.participantID;

            document.getElementById("participantIDResult").innerHTML +=
              "<br><span style='text-decoration: underline; cursor: pointer;'>Click to insert</span>";

            document
              .getElementById("participantIDResult")
              .addEventListener("click", function () {
                // Get the input element and populate it with the clicked value
                const participantReferenceInput =
                  document.getElementsByName("participant_id")[0];
                participantReferenceInput.value = data.participantID;

                // Close the popup
                document.getElementById(
                  "popup-search-participant"
                ).style.display = "none";
              });
          } else {
            // Reset the input field values to empty or default values
            const fnameEventParticipant = document.getElementById(
              "fname-eventParticipant"
            );
            const lnameEventParticipant = document.getElementById(
              "lname-eventParticipant"
            );
            const dobEventParticipant = document.getElementById(
              "dob-eventParticipant"
            );

            fnameEventParticipant.value = "";
            lnameEventParticipant.value = "";
            dobEventParticipant.value = "";
          }
        } else {
          document.getElementById("participantIDResult").innerHTML = data;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  document
    .getElementById("searchParticipantButton")
    .addEventListener("click", function () {
      const participantSearchDiv = document.getElementById(
        "popup-search-participant"
      );
      participantSearchDiv.style.display = "flex";
    });

  document
    .getElementById("popup-search-participant")
    .addEventListener("click", function (event) {
      if (event.target === this) {
        // Clear the form inputs
        document.getElementById("fname-eventParticipant").value = "";
        document.getElementById("lname-eventParticipant").value = "";
        document.getElementById("dob-eventParticipant").value = "";
        this.style.display = "none";
      }
    });

  //select element for adding volunteer

  const eventSelectVolunteer = document.getElementById("event-for-volunteer");
  let selectedOptionVolunteer = null;

  // Event listener for when the select element is clicked for volunteers
  eventSelectVolunteer.addEventListener("click", function () {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "models/fetch_events.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        const defaultOption = document.createElement("option");
        defaultOption.text = "Choose Laundromat/Event Date/Address";
        defaultOption.disabled = true;
        defaultOption.hidden = true;
        eventSelectVolunteer.innerHTML = "";
        eventSelectVolunteer.appendChild(defaultOption);

        data.forEach(function (event) {
          const option = document.createElement("option");
          option.text = `${event.nameOfLaundromat} / ${event.eventDate} / ${event.streetAddress}`;
          option.value = event.eventID;
          eventSelectVolunteer.appendChild(option);
        });

        if (selectedOptionVolunteer) {
          eventSelectVolunteer.value = selectedOptionVolunteer.value;
        }
      }
    };
    xhr.send();
  });

  // Add an event listener to update the select element's value when an option is selected for volunteers
  eventSelectVolunteer.addEventListener("change", function () {
    selectedOptionVolunteer = this.options[this.selectedIndex];
    this.value = selectedOptionVolunteer.value;
    const eventID = selectedOptionVolunteer.value;
    console.log(eventID);
  });

  // Search volunteer button functionality
  // document
  //   .getElementById("searchVolunteerButton")
  //   .addEventListener("click", function () {
  //     const volunteerSearchDiv = document.getElementById("VolunteerSearch");
  //     volunteerSearchDiv.style.display = "block";
  //   });

  document
    .getElementById("searchVolunteerIDButton")
    .addEventListener("click", function () {
      performSearchVolunteer();
    });

  document
    .getElementById("fname-eventVolunteer")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchVolunteer();
      }
    });

  document
    .getElementById("lname-eventVolunteer")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchVolunteer();
      }
    });

  document
    .getElementById("dob-eventVolunteer")
    .addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        performSearchVolunteer();
      }
    });

  function performSearchVolunteer() {
    const fnameEventVolunteer = document.getElementById(
      "fname-eventVolunteer"
    ).value;
    const lnameEventVolunteer = document.getElementById(
      "lname-eventVolunteer"
    ).value;
    const dobEventVolunteer =
      document.getElementById("dob-eventVolunteer").value;

    if (
      fnameEventVolunteer.trim() === "" ||
      lnameEventVolunteer.trim() === "" ||
      dobEventVolunteer.trim() === ""
    ) {
      alert("Please enter first, last name and date of birth.");
      return;
    }

    // Make an AJAX request to fetch the reference
    fetch("models/search_volunteer.php", {
      method: "POST",
      body: new URLSearchParams({
        "fname-eventVolunteer": fnameEventVolunteer,
        "lname-eventVolunteer": lnameEventVolunteer,
        "dob-eventVolunteer": dobEventVolunteer,
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
        console.log(data);

        if (data !== "Volunteer information not found") {
          const confirmation = confirm(
            "Is this your street address? \n" + data.streetAddress
          );

          if (confirmation) {
            // Get the input element and populate it with the participantID

            document.getElementById("volunteerIDResult").innerHTML =
              data.volunteerID;

            document.getElementById("volunteerIDResult").innerHTML +=
              "<br><span style='text-decoration: underline; cursor: pointer;'>Click to insert</span>";

            document
              .getElementById("volunteerIDResult")
              .addEventListener("click", function () {
                const volunteerReferenceInput =
                  document.getElementsByName("volunteer_id")[0];
                volunteerReferenceInput.value = data.volunteerID;

                document.getElementById(
                  "popup-search-volunteer"
                ).style.display = "none";
              });
          } else {
            const fnameEventVolunteer = document.getElementById(
              "fname-eventVolunteer"
            );
            const lnameEventVolunteer = document.getElementById(
              "lname-eventVolunteer"
            );
            const dobEventVolunteer =
              document.getElementById("dob-eventVolunteer");

            fnameEventVolunteer.value = "";
            lnameEventVolunteer.value = "";
            dobEventVolunteer.value = "";
          }
        } else {
          document.getElementById("volunteerIDResult").innerHTML = data;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  document
    .getElementById("searchVolunteerButton")
    .addEventListener("click", function () {
      const volunteerSearchDiv = document.getElementById(
        "popup-search-volunteer"
      );
      volunteerSearchDiv.style.display = "flex";
    });

  document
    .getElementById("popup-search-volunteer")
    .addEventListener("click", function (event) {
      if (event.target === this) {
        document.getElementById("fname-eventVolunteer").value = "";
        document.getElementById("lname-eventVolunteer").value = "";
        document.getElementById("dob-eventVolunteer").value = "";
        document.getElementById("volunteerIDResult").innerHTML = "";
        this.style.display = "none";
      }
    });

  // creating log out button next to donate-button-container

  // Create the form element
  let logoutForm = document.createElement("form");
  logoutForm.action = "admin_logout.php";
  logoutForm.method = "post";
  logoutForm.className = "logout-form";

  // Create the button element
  let logoutButton = document.createElement("button");
  logoutButton.type = "submit";
  logoutButton.id = "adminLogout";
  logoutButton.className = "event-nav-button logout-button";
  logoutButton.innerHTML = "<span>Log Out</span>";

  // Append button to the form
  logoutForm.appendChild(logoutButton);

  // Get the target div
  let targetButton = document.querySelector(
    '.event-navigation button[data-form="add-volunteer"]'
  );

  // Insert the form to the left of the target div
  targetButton.insertAdjacentElement("afterend", logoutForm);
});
