<!--coded by Eunji--->

<?php
include('db_conn.php');
include('familyMembers_model.php');
include('email_model.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
    
    if (isset($_FILES['p_identification']) && isset($_FILES['p_income_proof'])) {
        // Define the target directory
        $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    
        // Check if the target directory exists; if not, create it
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }
    
        // Get applicant's first name and last name
        $firstName = $_POST['p_first_name'];
        $lastName = $_POST['p_last_name'];
    
        // Create a subfolder for the applicant based on first name and last name
        $subfolder = $targetDirectory . $firstName . '_' . $lastName . '/';
    
        // Check if the subfolder exists; if not, create it
        if (!file_exists($subfolder)) {
            mkdir($subfolder, 0755, true);
        }
    
        // Process p_identification file
        $pIdentificationFile = $_FILES['p_identification'];
        $pIdentificationFileName = $firstName . '_' . $lastName . '_id_doc_' . $pIdentificationFile['name'];
        $pIdentificationFilePath = $subfolder . $pIdentificationFileName;
    
        if (move_uploaded_file($pIdentificationFile['tmp_name'], $pIdentificationFilePath)) {
            $id_file_path = $pIdentificationFilePath;
        } else {
            echo "Identification file upload failed.";
        }
    
        // Process p_income_proof file
        $pIncomeProofFile = $_FILES['p_income_proof'];
        $pIncomeProofFileName = $firstName . '_' . $lastName . '_income_doc_' . $pIncomeProofFile['name'];
        $pIncomeProofFilePath = $subfolder . $pIncomeProofFileName;
    
        if (move_uploaded_file($pIncomeProofFile['tmp_name'], $pIncomeProofFilePath)) {
            $income_proof_file_path = $pIncomeProofFilePath;
        } else {
            echo "Income proof file upload failed.";
        }
    } else {
        echo 'No file was uploaded.';
    }
    
    
    
    
    
    if(isset($_POST['p_first_name'])){
        $firstName = $_POST['p_first_name'];
    }
    
    if(isset($_POST['p_last_name'])){
        $lastName = $_POST['p_last_name'];
    }
    
    if(isset($_POST['p_birthDate'])){
        $dateOfBirth = $_POST['p_birthDate'];
    }
    
    if(isset($_POST['numberOfHousehold'])){
        $numberOfHousehold = $_POST['numberOfHousehold'];
    }
    
    if(isset($_POST['numberOfAdults'])){
        $numberOfAdults = $_POST['numberOfAdults'];
    }
    
    if(isset($_POST['children_under12'])){
        $NumberOfChildrenUnder12 = $_POST['children_under12'];
    }
    
    if(isset($_POST['children_over12'])){
        $NumberOfChildrenOver12 = $_POST['children_over12'];
    }
    
    if(isset($_POST['p_email'])){
        $email = $_POST['p_email'];
    }
    
    if(isset($_POST['p_address'])){
        $address = $_POST['p_address'];
    }
    
    if(isset($_POST['p_phoneNumber'])){
        $phone = $_POST['p_phoneNumber'];
    }
    
    if(isset($_POST['p_city'])){
        $city = $_POST['p_city'];
    }
    if(isset($_POST['province'])){
        $province = $_POST['province'];
    }
    
    if(isset($_POST['p_postalCode'])){
        $postalCode = $_POST['p_postalCode'];
    }

    
    //use $housing_situation variable
    if (isset($_POST['housing_situation'])) {
        $currentHousingSituation = $_POST['housing_situation'];
    }

    if ($_POST["housing_situation"] == "Other") {
        $housing_situation = $_POST["housing_situation_other"];
    } else {
        $housing_situation = $_POST["housing_situation"];
    }

    if(isset($_POST["additional_note"]){
        $additionalNote = $_POST["additional_note"];
    })

    //use $combinedFoundProgram
    $foundProgram = isset($_POST["found_program"]) ? $_POST["found_program"] : array();
    $foundProgramOther = isset($_POST["found_program_other"]) ? $_POST["found_program_other"] : "";
    $combinedFoundProgram = implode(", ", $foundProgram);
    if (!empty($foundProgramOther)) {
        $combinedFoundProgram .= ", " . $foundProgramOther;
    }

    $consent = isset($_POST["consent_box"]) ? 1 : 0;
    $formCreated = date('Y-m-d H:i:s');


    $participantInfo = add_participant($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12, $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $additionalNote, $formCreated, $consent, $id_file_path, $income_proof_file_path);

   

    if ($participantInfo) {
        $participantID = $participantInfo['participantID'];
        $participantEmail = $participantInfo['email'];
        if($participantID){
            //this is a code to see the posted data
            // var_dump($_POST);

            if (
                isset($_POST['first_name'], $_POST['last_name'], $_POST['birth_date'], $_POST['relationship'], $_POST['gender']) &&
                isset($_FILES['family_member_id_file']) &&
                (isset($_FILES['family_income_proof']) || isset($_POST['reason_for_no_income']))
            ) {
                $firstNames = $_POST['first_name'];
                $lastNames = $_POST['last_name'];
                $birthDates = $_POST['birth_date'];
                $relationships = $_POST['relationship'];
                $genders = $_POST['gender'];
                $familyMemberInfo = array();
                $idFiles = $_FILES['family_member_id_file'];
                $familyIncomeProofs = isset($_FILES['family_income_proof']) ? $_FILES['family_income_proof'] : null;
                $noIncomeExplanations = isset($_POST['reason_for_no_income']) ? $_POST['reason_for_no_income'] : null;
                
                $familySubfolder = $subfolder . 'family_members';
                
                if (!file_exists($familySubfolder)) {
                    mkdir($familySubfolder, 0755, true);
                }
                
                    
                for ($i = 0; $i < count($firstNames); $i++) {
                    $familyFirstName = $firstNames[$i];
                    $familyLastName = $lastNames[$i];
                    $familyDateOfBirth = $birthDates[$i];
                    $relationshipToParticipant = $relationships[$i];
                    $gender = $genders[$i];
                    $idFile = $idFiles['name'][$i];

                    // Move the ID file for this family member
                    $idFileName = $familyFirstName . '_' . $familyLastName . '_id_doc_' . $idFile;
                    $idFilePath = $familySubfolder . '/' . $idFileName;
                    move_uploaded_file($idFiles['tmp_name'][$i], $idFilePath);
                    
                    $incomeInfo = "";
                    // Handle the incomeProof file for this family member
                    if (isset($familyIncomeProofs) && !empty($familyIncomeProofs['name'][$i])) {
                        $incomeProofs = $familyIncomeProofs;
                        $incomeProofName = $familyFirstName . '_' . $familyLastName . '_income_doc_' . $incomeProofs['name'][$i];
                        $incomeProofPath = $familySubfolder . '/' . $incomeProofName;
                        
                        if (move_uploaded_file($incomeProofs['tmp_name'][$i], $incomeProofPath)) {
                            $incomeInfo = $incomeProofPath;
                        } else {
                            // Income proof file move failed
                        }
                    } elseif (isset($noIncomeExplanations) && !empty($noIncomeExplanations[$i])) {
                        // If "no" was selected, use the provided reason for no income
                        $noIncomeExplanation = $noIncomeExplanations[$i];
                        $incomeInfo = $noIncomeExplanation;
                    } else {
                        $incomeInfo = "UNDER 18 YEARS OLD";
                    }
                     // Add this family member to the database
                    add_family_member($participantID, $familyFirstName, $familyLastName, $familyDateOfBirth, $relationshipToParticipant, $gender, $idFilePath, $incomeInfo);
                    $familyMemberInfo[] = "First Name: $familyFirstName, Last Name: $familyLastName, Birth Date: $familyDateOfBirth, Relationship: $relationshipToParticipant, Gender: $gender, identification file path: $idFilePath, income information: $incomeInfo";
                    
                }
                
            }
            
            //executing a function email contact@freelaundryaccess.com about registration form being submitted.
            $redirectUrl = send_email_from_reg_form($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12, $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $formCreated, $id_file_path, $income_proof_file_path, $familyMemberInfo);

            if ($redirectUrl) {
                echo "<script>window.location.href='$redirectUrl';</script>";
                exit();
            }
        }
    }
}


function add_participant($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12,
    $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $additionalNote, $formCreated, $consent, $id_file_path, $income_proof_file_path)
{
    global $db;
    try {
        $query = "INSERT INTO participants (firstName, lastName, dateOfBirth, numberOfHousehold, numberOfAdults, NumberOfChildrenUnder12,
        NumberOfChildrenOver12, email, streetAddress, phone, city, province, postalCode, currentHousingSituation, howDidYouFindProgram, additionalNote, formCreated, consent, id_file_path, income_proof_file_path) 
        VALUES ('$firstName', '$lastName', '$dateOfBirth',  '$numberOfHousehold', '$numberOfAdults', '$NumberOfChildrenUnder12',
        '$NumberOfChildrenOver12', '$email', '$address',  '$phone', '$city', '$province', '$postalCode', '$housing_situation', '$combinedFoundProgram', '$additionalNote', '$formCreated', '$consent', '$id_file_path', '$income_proof_file_path')";

        $result = $db->query($query);

        if ($result) {
            // Retrieve the auto-generated participantID
            $participantID = $db->lastInsertId();

            return array("participantID" => $participantID, "email" => $email);
        } else {
            throw new Exception("Error inserting participant: " . $db->errorInfo()[2]);
        }
    } catch (Exception $e) {
        // Handle the exception (e.g., log the error, display a user-friendly message)
        echo "An error occurred: " . $e->getMessage();
        return false; // Indicate that the insertion failed
    }
}





?>