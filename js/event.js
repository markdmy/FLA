document.addEventListener("DOMContentLoaded", function () {
  const navButtons = document.querySelectorAll(".event-nav-button");
  const formSections = document.querySelectorAll(".container");

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

  // Create a default option element
  const defaultOption = document.createElement("option");
  defaultOption.text = "Choose Laundromat/Event Date/Address";
  defaultOption.disabled = true;
  defaultOption.selected = true;

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
                partnerReferenceInput.removeAttribute("disabled");
                partnerReferenceInput.setAttribute("required", "required");

                // Close the popupparticipant_id
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
                  participantReferenceInput.removeAttribute("disabled");
                  participantReferenceInput.setAttribute(
                    "required",
                    "required"
                  );
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
                  volunteerReferenceInput.removeAttribute("disabled");
                  volunteerReferenceInput.setAttribute("required", "required");

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

  const eventSelectForRecord = document.getElementById("event-for-record");
  let selectedOptionEventRecord = null;
  const eventTableContainer = document.getElementById("event_record_result");
  // Add the default option to the select element
  eventSelectForRecord.appendChild(defaultOption);

  // Event listener for when the select element is clicked for volunteers
  eventSelectForRecord.addEventListener("click", function () {
    //eventTableContainer.style.display = "block";
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "models/fetch_events.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);

        // Clear all options except the default option
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
    const eventID = selectedOptionEventRecord.value;
    eventTableContainer.style.display = "block";
    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      `models/fetch_event_participants.php?eventID=${eventID}`,
      true
    );
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          const data = JSON.parse(xhr.responseText);

          const tableBody = document.querySelector(
            "#event_record_result .participant-table"
          );

          const calculateTotalRow = document.querySelector(".calculate-total");
          const landromatInfo = document.querySelector(".laundromat-info");
          // Hide the table heading and the calculate total row

          tableBody.innerHTML = "";

          const laundromatName = document.getElementById(
            "record_laundromat_name"
          );
          const laundromatAddress = document.getElementById(
            "record_laundromat_address"
          );
          const laundromatEventDate = document.getElementById(
            "record_laundromat_eventdate"
          );

          if (data.length > 0) {
            calculateTotalRow.style.display = "table-row";
            landromatInfo.style.display = "block";
            laundromatName.innerHTML = data[0].partnerName;
            laundromatAddress.innerHTML =
              data[0].partnerStreetAddress +
              ", " +
              data[0].partnerCity +
              ", " +
              data[0].partnerProvince +
              " " +
              data[0].partnerPostalCode;
            laundromatEventDate.innerHTML = data[0].eventDate;

            populateEventParticipantsTable(data);
          } else {
            calculateTotalRow.style.display = "none";
            landromatInfo.style.display = "none";
            const noParticipantsRow = document.createElement("tr");
            const noParticipantsCell = document.createElement("td");
            noParticipantsCell.textContent =
              "No participants registered in selected event found";
            noParticipantsCell.colSpan = 5;
            noParticipantsRow.appendChild(noParticipantsCell);
            tableBody.appendChild(noParticipantsRow);
          }
        } catch (error) {
          // Handle invalid JSON or other errors
          console.error(error);
        }
      }
    };
    xhr.send();
  });

  function populateEventParticipantsTable(participantsData) {
    const tableBody = document.querySelector(
      "#event_record_result .participant-table"
    );
    const participantRows = document.querySelectorAll(
      ".participant-table .participant-row"
    );

    // Initialize totals
    let totalWash = 0;
    let totalDry = 0;
    let totalProduct = 0;
    let totalCost = 0;

    // Remove existing participant rows
    participantRows.forEach((row, index) => {
      row.remove();
    });

    participantsData.forEach(function (participant) {
      const row = document.createElement("tr");
      row.className = "participant-row";

      const nameCell = document.createElement("td");
      nameCell.textContent = `${participant.firstName} ${participant.lastName}`;
      row.appendChild(nameCell);

      const costOfWashCell = document.createElement("td");
      costOfWashCell.textContent = "$" + participant.costOfWash;
      row.appendChild(costOfWashCell);
      totalWash += parseFloat(participant.costOfWash);

      const costOfDryCell = document.createElement("td");
      costOfDryCell.textContent = "$" + participant.costOfDry;
      row.appendChild(costOfDryCell);
      totalDry += parseFloat(participant.costOfDry);

      const productCostCell = document.createElement("td");
      productCostCell.textContent = "$" + participant.productCost;
      row.appendChild(productCostCell);
      totalProduct += parseFloat(participant.productCost);

      const totalCostCell = document.createElement("td");
      totalCostCell.textContent = "$" + participant.totalCost;
      row.appendChild(totalCostCell);
      totalCost += parseFloat(participant.totalCost);

      tableBody.appendChild(row);
    });

    const totalWashCell = document.getElementById("total-wash-cost");
    const totalDryCell = document.getElementById("total-dry-cost");
    const totalProductCell = document.getElementById("total-product-cost");
    const totalTotalCell = document.getElementById("total-total-cost");

    totalWashCell.textContent = "$" + totalWash.toFixed(2);
    totalDryCell.textContent = "$" + totalDry.toFixed(2);
    totalProductCell.textContent = "$" + totalProduct.toFixed(2);
    totalTotalCell.textContent = "$" + totalCost.toFixed(2);
  }

  const defaultOptionCity = document.createElement("option");
  defaultOptionCity.text = "Choose a city";
  defaultOptionCity.disabled = true;
  defaultOptionCity.selected = true;

  // displaying cities of volunteers in select
  const citySelect = document.getElementById("volunteers_city");
  let selectedOptionCity = null;
  const citySearchResultBox = document.getElementById(
    "volunteer_record_result"
  );

  // Event listener for when the select element is clicked for choosing a city
  citySelect.addEventListener("click", function () {
    // Make an AJAX request to fetch cities data
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "models/fetch_cities.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        citySelect.innerHTML = "";
        citySelect.appendChild(defaultOptionCity); // Add your default option here

        data.forEach(function (entry) {
          // Access properties like city, province, and postalcode
          const option = document.createElement("option");
          option.text = entry.city;
          option.value = entry.city;
          citySelect.appendChild(option);
        });

        if (selectedOptionCity) {
          citySelect.value = selectedOptionCity.value;
        }
      }
    };
    xhr.send();
  });

  citySelect.addEventListener("change", function () {
    selectedOption = this.options[this.selectedIndex];
    this.value = selectedOption.value;
    const cityName = selectedOption.value; // Get the eventID from the selected option

    citySearchResultBox.style.display = "block";
    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      `models/fetch_volunteer_by_city.php?city=${cityName}`,
      true
    );
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          const responseText = xhr.responseText;
          if (responseText) {
            const data = JSON.parse(responseText);
            populateVolunteerTable(data);
          } else {
            // Handle the case where the response is empty
            console.log("Response is empty.");
          }
        } catch (error) {
          // Handle invalid JSON or other errors
          console.error(error);
        }
      }
    };
    xhr.send();
  });

  const tableBody = document.querySelector(
    "#volunteer_record_result .volunteer-table"
  );
  const volunteerRow = document.querySelector(".volunteer-row");

  // Function to populate the volunteer table
  function populateVolunteerTable(data) {
    // Clear the existing rows
    tableBody.innerHTML = "";

    // Loop through the data and create a new row for each volunteer
    data.forEach(function (volunteer) {
      // Clone the template row
      const newRow = volunteerRow.cloneNode(true);
      newRow.id = ""; // Clear the ID attribute
      newRow.style.display = ""; // Make the row visible

      // Update the cells with volunteer data
      newRow.querySelector(
        "td:first-child"
      ).textContent = `${volunteer.firstName} ${volunteer.lastName}`;
      newRow.querySelector("td:nth-child(2)").textContent =
        volunteer.dateOfBirth;
      newRow.querySelector("td:nth-child(3)").textContent = volunteer.email;
      newRow.querySelector("td:nth-child(4)").textContent = volunteer.phone;
      newRow.querySelector("td:nth-child(5)").textContent =
        volunteer.streetAddress;
      newRow.querySelector("td:nth-child(6)").textContent = volunteer.city;
      newRow.querySelector("td:nth-child(7)").textContent = volunteer.province;
      newRow.querySelector("td:nth-child(8)").textContent =
        volunteer.postalcode;

      // Append the new row to the table
      tableBody.appendChild(newRow);
    });
  }

  //populating partners records
  const bringPartnersButton = document.getElementById("bring_partners");
  let isShowing = false;
  const partnerTable = document.getElementById("partner_record_result");

  // Add a click event listener to the "Click to display partners" button
  bringPartnersButton.addEventListener("click", function () {
    isShowing = !isShowing;

    if (isShowing) {
      bringPartnersButton.textContent = "Close";
      partnerTable.style.display = "block";

      // Make an AJAX request to fetch events data
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "models/fetch_partners.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const data = JSON.parse(xhr.responseText);

          const tableBody = document.querySelector(".partner-table");
          tableBody.innerHTML = "";

          // Assuming 'data' is an array of partner data
          data.forEach(function (partner) {
            const row = document.createElement("tr");

            // Name column (concatenating firstName and lastName)
            const nameCell = document.createElement("td");
            nameCell.textContent = partner.firstName + " " + partner.lastName;
            row.appendChild(nameCell);

            // Name of Laundromat
            const laundromatCell = document.createElement("td");
            laundromatCell.textContent = partner.nameOfLaundromat;
            row.appendChild(laundromatCell);

            // Email
            const emailCell = document.createElement("td");
            emailCell.textContent = partner.email;
            row.appendChild(emailCell);

            // Phone
            const phoneCell = document.createElement("td");
            phoneCell.textContent = partner.phone;
            row.appendChild(phoneCell);

            // Street Address
            const streetAddressCell = document.createElement("td");
            streetAddressCell.textContent = partner.streetAddress;
            row.appendChild(streetAddressCell);

            // City
            const cityCell = document.createElement("td");
            cityCell.textContent = partner.city;
            row.appendChild(cityCell);

            // Province
            const provinceCell = document.createElement("td");
            provinceCell.textContent = partner.province;
            row.appendChild(provinceCell);

            // Postal Code
            const postalCodeCell = document.createElement("td");
            postalCodeCell.textContent = partner.postalcode;
            row.appendChild(postalCodeCell);

            // # of washers
            const washersCell = document.createElement("td");
            washersCell.textContent = partner.numberOfWashers;
            row.appendChild(washersCell);

            // # of dryers
            const dryersCell = document.createElement("td");
            dryersCell.textContent = partner.numberOfDryers;
            row.appendChild(dryersCell);

            // Has Attendant
            const attendantCell = document.createElement("td");
            attendantCell.textContent = partner.hasAttendant;
            row.appendChild(attendantCell);

            // Add the row to the table body
            tableBody.appendChild(row);
          });
        }
      };
      xhr.send();
    } else {
      bringPartnersButton.textContent = "Click to display partners";
      partnerTable.style.display = "none";
    }
  });

  document
    .getElementById("download-vol-rec-button")
    .addEventListener("click", function (e) {
      e.preventDefault();
      let table = document.getElementById("volunteer_record_table");

      // Create a CSV string
      let csv = [];
      let headerRow = table.querySelector("thead tr");
      let headerCols = headerRow.querySelectorAll("th");
      let header = Array.from(headerCols, (th) => th.textContent);
      csv.push(header.join(","));

      let rows = table.querySelectorAll("tbody tr");
      for (let i = 0; i < rows.length; i++) {
        let row = [];
        let cols = rows[i].querySelectorAll("td");
        for (let j = 0; j < cols.length; j++) {
          row.push(cols[j].textContent);
        }
        csv.push(row.join(","));
      }

      let csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");

      let encodedUri = encodeURI(csvContent);
      let link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "table_data_volunteer.csv");
      document.body.appendChild(link);

      link.click();
    });

  document
    .getElementById("download-partner-button")
    .addEventListener("click", function (e) {
      e.preventDefault();
      // Get the table element
      let table = document.getElementById("partner_record_table");

      let csv = [];

      let headerRow = table.querySelector("thead tr");
      let headerCols = headerRow.querySelectorAll("th");
      let header = Array.from(headerCols, (th) => th.textContent);
      csv.push(header.join(","));

      let dataRows = table.querySelectorAll("tbody tr");
      for (let i = 0; i < dataRows.length; i++) {
        let row = [];
        let cols = dataRows[i].querySelectorAll("td");
        for (let j = 0; j < cols.length; j++) {
          let cellText = cols[j].textContent;
          row.push(cellText);
        }
        csv.push(row.join(","));
      }

      let csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");

      // Create a download link
      let encodedUri = encodeURI(csvContent);
      let link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "partner_table_data.csv");
      document.body.appendChild(link);

      link.click();
    });

  document
    .getElementById("download-event-button")
    .addEventListener("click", function (e) {
      e.preventDefault();
      let laundromatName = document.getElementById(
        "record_laundromat_name"
      ).textContent;
      let laundromatAddress = document.getElementById(
        "record_laundromat_address"
      ).textContent;
      let eventDate = document.getElementById(
        "record_laundromat_eventdate"
      ).textContent;

      let tables = document.querySelectorAll(".event-record-table");

      let csv = [];

      csv.push(`Laundromat Name: ${laundromatName}`);
      csv.push(`Address: ${laundromatAddress}`);
      csv.push(`Event Date: ${eventDate}`);

      tables.forEach((table) => {
        let rows = table.querySelectorAll("tr");
        rows.forEach((row) => {
          let cols = row.querySelectorAll("td, th");
          let rowArray = Array.from(cols, (col) => col.textContent);
          csv.push(rowArray.join(","));
        });
      });

      let csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");

      let encodedUri = encodeURI(csvContent);
      let link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "event_table_data.csv");
      document.body.appendChild(link);

      link.click();
    });
});
