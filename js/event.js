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

  function performSearchParticipant() {
    const fnameEventParticipant = document.getElementById(
      "fname-eventParticipant"
    ).value;
    const lnameEventParticipant = document.getElementById(
      "lname-eventParticipant"
    ).value;

    // Check if both first name and last name are provided before making the request
    if (
      fnameEventParticipant.trim() === "" ||
      lnameEventParticipant.trim() === ""
    ) {
      alert("Please enter first, last name.");
      return;
    }

    // Make an AJAX request to fetch the reference
    fetch("models/search_participant.php", {
      method: "POST",
      body: new URLSearchParams({
        "fname-eventParticipant": fnameEventParticipant,
        "lname-eventParticipant": lnameEventParticipant,
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
        const popupResultParticipant = document.getElementById(
          "popup_participant_search_result"
        );

        if (data !== "No participants found with the given names.") {
          // Clear the previous results
          const tbody = document.querySelector(
            "#participantSearchResult tbody"
          );
          tbody.innerHTML = "";

          data.forEach((participant) => {
            const row = document.createElement("tr");
            row.classList.add("clickable-row");
            row.innerHTML = `
              <td>${participant.firstName}</td>
              <td>${participant.lastName}</td>
              <td>${participant.dateOfBirth}</td>
              <td>${participant.streetAddress}</td>
            `;
            tbody.appendChild(row);

            // Add a click event to each row to handle the selection
            row.addEventListener("click", () => {
              // Get the input element and populate it with the participantID
              const participantID = participant.participantID;
              // Close the popup
              popupResultParticipant.style.display = "none";

              document.getElementById("participantIDResult").innerHTML =
                participantID;
              document.getElementById("participantIDResult").innerHTML +=
                "<br><span style='text-decoration: underline; cursor: pointer;'>Click to insert</span>";
              document
                .getElementById("participantIDResult")
                .addEventListener("click", function () {
                  // Get the input element and populate it with the clicked value
                  const participantReferenceInput =
                    document.getElementsByName("participant_id")[0];
                  participantReferenceInput.value = participantID;

                  // Close the popup
                  document.getElementById(
                    "popup-search-participant"
                  ).style.display = "none";
                });
            });
          });

          //Show the popup with display: flex
          popupResultParticipant.style.display = "flex";
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
        document.getElementById("participantIDResult").innerHTML = "";
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

  //Search volunteer button functionality
  document
    .getElementById("searchVolunteerButton")
    .addEventListener("click", function () {
      const volunteerSearchDiv = document.getElementById("volunteerSearch");
      volunteerSearchDiv.style.display = "block";
    });

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

  function performSearchVolunteer() {
    const fnameEventVolunteer = document.getElementById(
      "fname-eventVolunteer"
    ).value;
    const lnameEventVolunteer = document.getElementById(
      "lname-eventVolunteer"
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
          "popup_volunteer_search_result"
        );
        if (data !== "No volunteers found with the given names.") {
          // Clear the previous results
          const tbody = document.querySelector("#volunteerSearchResult tbody");
          tbody.innerHTML = "";

          data.forEach((volunteer) => {
            const row = document.createElement("tr");
            row.classList.add("clickable-row");
            row.innerHTML = `
              <td>${volunteer.firstName}</td>
              <td>${volunteer.lastName}</td>
              <td>${volunteer.dateOfBirth}</td>
              <td>${volunteer.streetAddress}</td>
            `;
            tbody.appendChild(row);

            // Add a click event to each row to handle the selection
            row.addEventListener("click", () => {
              // Get the input element and populate it with the participantID
              const volunteerID = volunteer.volunteerID;
              // Close the popup
              popupResultVolunteer.style.display = "none";

              document.getElementById("volunteerIDResult").innerHTML =
                volunteerID;
              document.getElementById("volunteerIDResult").innerHTML +=
                "<br><span style='text-decoration: underline; cursor: pointer;'>Click to insert</span>";
              document
                .getElementById("volunteerIDResult")
                .addEventListener("click", function () {
                  // Get the input element and populate it with the clicked value
                  const volunteerReferenceInput =
                    document.getElementsByName("volunteer_id")[0];
                  volunteerReferenceInput.value = volunteerID;

                  // Close the popup
                  document.getElementById(
                    "popup-search-volunteer"
                  ).style.display = "none";
                });
            });
          });
          popupResultVolunteer.style.display = "flex";
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
    '.event-navigation button[data-form="event_record_retrieval"]'
  );

  // Insert the form to the left of the target div
  targetButton.insertAdjacentElement("afterend", logoutForm);

  //Select element for Event Records

  //select element for adding volunteer

  const eventSelectForRecord = document.getElementById("event-for-record");
  let selectedOptionEventRecord = null;

  // Event listener for when the select element is clicked for volunteers
  eventSelectForRecord.addEventListener("click", function () {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "models/fetch_events.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        const defaultOption = document.createElement("option");
        defaultOption.text = "Choose Laundromat/Event Date/Address";
        defaultOption.disabled = true;
        defaultOption.hidden = true;
        eventSelectForRecord.innerHTML = "";
        eventSelectForRecord.appendChild(defaultOption);

        data.forEach(function (event) {
          const option = document.createElement("option");
          option.text = `${event.nameOfLaundromat} / ${event.eventDate} / ${event.streetAddress}`;
          option.value = event.eventID;
          eventSelectForRecord.appendChild(option);
        });

        if (selectedOptionEventRecord) {
          eventSelectForRecord.value = selectedOptionEventRecord.value;
        }
      }
    };
    xhr.send();
  });

  // Add an event listener to update the select element's value when an option is selected for volunteers
  eventSelectForRecord.addEventListener("change", function () {
    selectedOptionEventRecord = this.options[this.selectedIndex];
    this.value = selectedOptionEventRecord.value;
    const eventID = selectedOptionEventRecord.value;
    console.log(eventID);
  });
});
