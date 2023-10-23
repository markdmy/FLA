<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Register for Free Laundry Access - Sign up for free laundry access" />
    <meta name="keywords" content="registration, sign up, Free Laundry Access">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Registration Form</title>
    <link rel="icon" href="assets/images/apple-touch-icon-120x120.png" />
</head>

<body>
    <?php 
    include('components/header.php')?>

    <section class="container">
        <form action="models/participant_model.php" method="POST" class="form" id="registration-form"
            enctype="multipart/form-data">
            <h2>Registration Form</h2>
            <div class="form-content">
                <div class="column">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter first name" required name="p_first_name" />
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter last name" required name="p_last_name" />
                    </div>
                </div>

                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email address" required name="p_email" />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="p_phone" name="p_phoneNumber" placeholder="Format: 123-456-7890"
                            class="form-input">
                    </div>
                    <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" name="p_birthDate" placeholder="Enter birth date" id="p_birthDate"
                            required />
                    </div>
                </div>
                <div class="column">
                    <div class="file-upload" id="id_upload">
                        <label>Upload Your ID</label>
                        <br>
                        <p class="file-upload-phrase">(A form of ID issued by the government such as driver's license,
                            PR
                            card, passport.) </p>
                        <input type="file" required name="p_identification" id="p_identification" />
                    </div>
                    <!-- <div class="file-upload" id="p_income_upload" style="display: none;"> -->
                    <div class="file-upload" id="p_income_upload">
                        <label>Upload Proof of Income</label>
                        <br>
                        <p class="file-upload-phrase">(Proof of income needed for age 18 and over.) </p>
                        <input type="file" required name="p_income_proof" id="p_income_proof" />
                    </div>
                </div>



                <div class="input-box address">
                    <label>Address</label>
                    <input type="text" placeholder="Enter street address" required name="p_address" />

                    <div class="column">

                        <input type="text" placeholder="Enter your city" required name="p_city" />
                        <div class="select-box">
                            <select name="province">
                                <option hidden>Province</option>
                                <option>Alberta</option>
                                <option>British Columbia</option>
                                <option>Manitoba</option>
                                <option>New Brunswick</option>
                                <option>Newfoundland</option>
                                <option>Labrador</option>
                                <option>Nova Scotia</option>
                                <option>Ontario</option>
                                <option>PEI</option>
                                <option>Quebec</option>
                                <option>Saskatchewan</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" pattern="[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d" placeholder="Enter postal code" required
                        name="p_postalCode" />



                </div>

                <div class="input-box">
                    <label>Total number of individuals in your household using this program:</label>
                    <input type="number" placeholder="Enter total number" name="numberOfHousehold" min="1"
                        id="numberOfHousehold" />
                </div>

                <div class="column">
                    <div class="input-box number-of-adults">
                        <label>Number of Adults (18 yrs and older):</label>
                        <input type="number" placeholder="Enter number" name="numberOfAdults" id="numberOfAdults"
                            min="0" />
                    </div>
                    <div class="input-box children-under12">
                        <label>Number of Children (Under 12 yrs old):</label>
                        <input type="number" placeholder="Enter number" name="children_under12" min="0"
                            id="numberUnder12" />
                    </div>
                    <div class="input-box children-over12">
                        <label>Number of Children (Over 12 yrs old):</label>
                        <input type="number" placeholder="Enter number" name="children_over12" min="0"
                            id="numberOver12" />
                    </div>
                </div>

                <div class="input-box" id="additional-members-container">
                    <label>ADDITIONAL HOUSEHOLD MEMBER</label>
                    <div class="additional-member-template" data-original="true">
                        <div class="column">
                            <input type="text" placeholder="First Name" required name="first_name[]" />
                            <input type="text" placeholder="Last Name" required name="last_name[]" />
                        </div>
                        <div class="column">
                            <div class="input-box">
                                <label>Birth Date</label>
                                <input type="date" placeholder="Date of Birth" name="birth_date[]" required />
                            </div>
                            <div class="file-upload">
                                <label>Upload ID</label>
                                <p class="file-upload-phrase">(Over 18 years old: A form of ID issued by the government
                                    such
                                    as
                                    driver's license, PR card, passport. <br>Under 18 years old: A birth certificate.)
                                </p>
                                <input type="file" name="family_member_id_file[]" required>

                            </div>

                        </div>




                        <div class="income-indication" id="is_income_proof" style="display: none;">
                            <div class="column">
                                <div class="file-upload" id="income_true">
                                    <div class="income-phrase">
                                        <input type="radio" name="income_proof_option[]" id="income_proof_yes"
                                            value="yes" required />
                                        <label for="income_proof_yes" class="radio-label">I have a proof of
                                            income</label>
                                    </div>
                                    <div class="income-upload" id="family_income_upload" style="display: none;">
                                        <label>Please Upload Proof of Income</label>
                                        <br>
                                        <input type="file" name="family_income_proof[]" required />
                                    </div>
                                </div>
                                <div class="file-upload" id="income_false">
                                    <div class="income-phrase">
                                        <input type="radio" name="income_proof_option[]" id="income_proof_no" value="no"
                                            required />
                                        <label for="income_proof_no" class="radio-label">I don't have a source of
                                            income</label>
                                    </div>
                                    <div class="reason-box" id="no_income_why" style="display: none;">
                                        <label for="message" class="form-label">Please explain the reason for no
                                            income.</label>
                                        <textarea name="reason_for_no_income[]" rows="2" required
                                            class="form-textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <input type="text" placeholder="Relationship To Applicant" name="relationship[]" required />
                            <input type="text" placeholder="Gender (Optional)" name="gender[]" />
                        </div>

                    </div>
                </div>


                <div class="housing-box">
                    <label>CURRENT HOUSING SITUATION(OPTIONAL)</label>

                    <div class="housing-option">
                        <div class="housing">
                            <input type="radio" id="rental" name="housing_situation" value="Rental">
                            <label for="rental">Rental</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="social_housing" name="housing_situation" value="Social Housing">
                            <label for="social_housing">Social Housing (Group home/ Youth home)</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="emergency_shelter" name="housing_situation"
                                value="Emergency Shelter">
                            <label for="emergency_shelter">Emergency Shelter</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="family_friends" name="housing_situation"
                                value="With Family/Friends">
                            <label for="family_friends">With Family/Friends</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="unhoused" name="housing_situation" value="Unhoused">
                            <label for="unhoused">Unhoused</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="other" name="housing_situation" value="Other">
                            <label for="other">Other (Please Specify)</label>
                            <input type="text" id="other_specify" class="other-housing-situation"
                                name="housing_situation_other" placeholder="Specify">
                        </div>
                    </div>
                </div>



                <div class="program-box housing-box">
                    <label>HOW DID YOU FIND OUR PROGRAM (Please select all applicable)</label>
                    <div class="program-option">


                        <div class="program">
                            <input type="checkbox" id="immigration" name="found_program[]"
                                value="Immigration/ Newcomer Services">
                            <label for="immigration">Immigration/ Newcomer Services</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="client_family_friend" name="found_program[]"
                                value="Client/Family/Friend">
                            <label for="client_family_friend">Client/Family/Friend</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="employment_insurance" name="found_program[]"
                                value="Employment Insurance">
                            <label for="employment_insurance">Employment Insurance</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="media_news_outreach" name="found_program[]"
                                value="Media/News/Outreach">
                            <label for="media_news_outreach">Media/News/Outreach</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="unions" name="found_program[]" value="Unions">
                            <label for="unions">Unions</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="social_agency" name="found_program[]" value="Social Agency">
                            <label for="social_agency">Social Agency</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="wsib" name="found_program[]" value="WSIB">
                            <label for="wsib">WSIB</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="none" name="found_program[]" value="None">
                            <label for="none">None</label><br>
                        </div>


                        <div class="program other-specify">
                            <input type="text" id="other_specify" class="other-source" name="found_program_other"
                                placeholder="Other (Please Specify)">
                        </div>
                    </div>
                </div>


                <div class="privacy">
                    <h3>Privacy Notice and Consent</h3>
                    <div class="privacy-body">
                        <p>At Free Laundry Access, we collect and use your personal information to manage our programs,
                            assess your eligibility for support, understand the needs of those we serve and improve our
                            services. On an as-needed basis, we also share your personal information with other agencies
                            to
                            provide more complete support, eliminate duplication of efforts or fulfill our commitments
                            to
                            those who fund our programs. We obey strict standards of confidentiality when collecting,
                            using
                            and sharing or disclosing your personal information. Tell us if you would like to receive a
                            copy
                            of our Privacy Policy.</p>
                        <br>
                        <ul class="privacy-right">
                            <li>You have the right to receive a copy of the information about you that is stored in the
                                Free
                                Laundry Access Client Management System and/or the Free Laundry Access Intake software.
                            </li>
                            <li>You have the right to correct mistakes in information about you.</li>
                        </ul>
                        <br>
                        <p>Our resources and ability to serve your community depend in part on the information provided
                            by
                            our participants.</p> <br>
                        <p>I have read and understood the information above and by signing this document I agree that
                            Free
                            Laundry Access Inc. may collect, use and disclose my personal information for the purposes
                            mentioned above. I also agree that my personal information may be entered into the Free
                            Laundry
                            Access Client Management System and/or the Free Laundry Access Intake software.</p> <br>
                        <p>In applying for assistance from Free Laundry Access Inc. on behalf of myself and/or my
                            household, and sharing information about myself and/or my family members, I confirm that I
                            am
                            sharing this information with the knowledge and permission of all household members age 18
                            and
                            over (AB, SK, MB, ON, PE, QC) or age 19 and over (BC, NT, NU, YT, NB, NL, NS).</p> <br>
                        <p>I attest all information provided in the registration form is true to the best of my
                            knowledge.
                            I understand the program services are only available to me on event dates, times and
                            locations
                            announced. Outside of these event dates the program services will not be available to me.
                        </p> <br>
                        <p>I understand I may be denied access to the program if the information provided herein is
                            false,
                            and/or if on the event date I am not sober/coherent or under the influence of any substance
                            and/or use aggressive/abusive language and/or aggressive action(s) towards staff and/or
                            volunteers of Free Laundry Access Inc. and/or any individual(s) in or around the laundromat
                            were
                            the program services are being provided.</p>
                    </div>
                    <label for="consent-checkbox" class="center-checkbox-label">
                        <input type="checkbox" id="consent-checkbox" required name="consent_box">
                        <span class="checkbox-text">I consent to the privacy notice</span>
                    </label>
                </div>

            </div>
            <button type="submit" id="registrationSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>
    </section>



    <?php
include('components/footer.php'); ?>



    <script src="js/app.js"></script>
    <script src="js/form.js"></script>
</body>

</html>