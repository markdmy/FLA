document.addEventListener("DOMContentLoaded", function () {
  // Get references to the input elements
  const numberOfHouseholdInput = document.getElementById("numberOfHousehold");
  const additionalMembersContainer = document.getElementById(
    "additional-members-container"
  );
  const templateContainer = document.querySelector(
    ".additional-member-template"
  );

  // Add an event listener to the numberOfHousehold input to react to changes
  numberOfHouseholdInput.addEventListener(
    "input",
    handleNumberOfHouseholdChange
  );
  const clonedTemplates = [];
  // Function to handle the change in numberOfHouseholdInput
  function handleNumberOfHouseholdChange() {
    const numberOfHouseholdValue = parseInt(numberOfHouseholdInput.value);

    // Clear any previously cloned containers
    additionalMembersContainer.innerHTML = "";

    if (numberOfHouseholdValue > 1) {
      // Show the additional members container
      additionalMembersContainer.style.display = "block";

      // Append additional cloned containers
      for (let i = 0; i < numberOfHouseholdValue - 1; i++) {
        const clonedTemplate = templateContainer.cloneNode(true);
        const label = document.createElement("label");
        label.textContent = `ADDITIONAL HOUSEHOLD MEMBER #${i + 1}`;
        clonedTemplate.prepend(label);

        // Add a unique identifier to the cloned template
        const uniqueId = generateUniqueId();
        const templateId = `clonedTemplate_${uniqueId}`;
        clonedTemplate.id = templateId;

        // Update IDs and names for input elements within the cloned template
        clonedTemplate
          .querySelectorAll('input[type="file"], textarea')
          .forEach((element) => {
            if (element.tagName === "INPUT" || element.tagName === "TEXTAREA") {
              const elementName = element.name;
              const uniqueElementId = `${elementName}_${uniqueId}`;
              element.id = uniqueElementId;
            }
          });

        clonedTemplate
          .querySelectorAll('input[type="file"]')
          .forEach((fileInput) => {
            validateFileInput(fileInput);
          });

        const radioInputs = clonedTemplate.querySelectorAll(
          'input[type="radio"]'
        );
        radioInputs.forEach((radioInput) => {
          const radioId = `${radioInput.id}${uniqueId}`;
          radioInput.id = radioId;

          const parentDiv = radioInput.closest(".income-phrase");
          if (parentDiv) {
            const parentDivId = `income_phrase${uniqueId}`;
            parentDiv.id = parentDivId;
          }
        });

        additionalMembersContainer.appendChild(clonedTemplate);

        // Check if the age input in this template should show the "family_income_proof" div
        const ageInput = clonedTemplate.querySelector('input[type="date"]');
        ageInput.addEventListener("change", function () {
          // Calculate age and show/hide "family_income_proof" based on the date value
          let birthDateValue = new Date(this.value);
          let currentDate = new Date();
          let age = currentDate.getFullYear() - birthDateValue.getFullYear();
          if (
            currentDate.getMonth() < birthDateValue.getMonth() ||
            (currentDate.getMonth() === birthDateValue.getMonth() &&
              currentDate.getDate() < birthDateValue.getDate())
          ) {
            age--;
          }

          console.log(age);

          const radioOptionYes = clonedTemplate.querySelector(
            `#${templateId} #income_proof_yes${uniqueId}`
          );
          const radioOptionNo = clonedTemplate.querySelector(
            `#${templateId} #income_proof_no${uniqueId}`
          );

          const proofFileInput = clonedTemplate.querySelector(
            `#${templateId} input[name="family_income_proof[]"]`
          );

          const textArea = clonedTemplate.querySelector(
            `#${templateId} textarea`
          );

          const familyIncomeUploadDiv =
            clonedTemplate.querySelector(".income-upload");

          const uniqueIncomeUploadId = `family_income_upload${uniqueId}`;
          familyIncomeUploadDiv.id = uniqueIncomeUploadId;

          const noIncomeExplanationDiv =
            clonedTemplate.querySelector(".reason-box");
          const uniqueNoIncomeId = `no_income_why${uniqueId}`;
          noIncomeExplanationDiv.id = uniqueNoIncomeId;

          const familyIncomeProofDiv = clonedTemplate.querySelector(
            `#${templateId} .income-indication#is_income_proof`
          );

          if (age >= 18) {
            familyIncomeProofDiv.style.display = "block";

            // Handle required attributes based on the user's choice
            radioOptionYes.addEventListener("change", function () {
              if (this.checked) {
                familyIncomeUploadDiv.style.display = "block";
                noIncomeExplanationDiv.style.display = "none";
                textArea.removeAttribute("required");
                proofFileInput.setAttribute("required", "required");
              }
            });

            radioOptionNo.addEventListener("change", function () {
              if (this.checked) {
                noIncomeExplanationDiv.style.display = "block";
                familyIncomeUploadDiv.style.display = "none";
                proofFileInput.removeAttribute("required");
                textArea.setAttribute("required", "required");
              }
            });
          } else {
            familyIncomeProofDiv.style.display = "none";

            radioOptionYes.removeAttribute("required");
            radioOptionNo.removeAttribute("required");
            proofFileInput.removeAttribute("required");
            textArea.removeAttribute("required");
          }
        });
      }
    } else {
      // Hide the additional members container
      additionalMembersContainer.style.display = "none";
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

  function handleIncomeProofOptionChange(uniqueId) {
    const familyIncomeUploadDiv = document.getElementById(
      `family_income_upload_${uniqueId}`
    );

    const noIncomeExplanationDiv = document.getElementById(
      `no_income_why_${uniqueId}`
    );

    // Check the value of the selected radio button
    const incomeProofOption = document.querySelector(
      `input[name="income_proof_option"]:checked`
    );

    if (familyIncomeUploadDiv && noIncomeExplanationDiv && incomeProofOption) {
      if (incomeProofOption.value === "yes") {
        // Show the "I have a proof of income" div and hide the "I do NOT have a proof of income" div
        familyIncomeUploadDiv.style.display = "block";
        noIncomeExplanationDiv.style.display = "none";
      } else if (incomeProofOption.value === "no") {
        // Show the "I do NOT have a proof of income" div and hide the "I have a proof of income" div
        familyIncomeUploadDiv.style.display = "none";
        noIncomeExplanationDiv.style.display = "block";
      }
    }
  }

  // Use event delegation to handle changes for dynamically created elements
  document.addEventListener("change", function (event) {
    if (event.target.matches('input[name^="income_proof_option"]')) {
      // Handle the change based on which radio button was clicked
      const uniqueId = event.target.id.split("_").pop();
      handleIncomeProofOptionChange(uniqueId);
    }
  });

  const pIdentificationInput = document.getElementById("p_identification");
  const pIncomeProofInput = document.getElementById("p_income_proof");

  // Validate p_identification input
  validateFileInput(pIdentificationInput);

  // Validate p_income_proof input
  validateFileInput(pIncomeProofInput);

  function validateFileInput(fileInput) {
    let allowedExtensions = [
      "jpg",
      "jpeg",
      "png",
      "pdf",
      "tiff",
      "doc",
      "docx",
    ];
    let maxFileSize = 10 * 1024 * 1024; // 10MB

    fileInput.addEventListener("change", function () {
      let fileName = fileInput.value;
      let fileExtension = fileName.split(".").pop().toLowerCase();

      if (allowedExtensions.indexOf(fileExtension) === -1) {
        alert(
          "Invalid file extension. Allowed extensions: " +
            allowedExtensions.join(", ")
        );
        fileInput.value = ""; // Clear the input field
        return;
      }

      if (fileInput.files[0].size > maxFileSize) {
        alert("File size exceeds the maximum limit.");
        fileInput.value = ""; // Clear the input field
        return;
      }
    });
  }
});
