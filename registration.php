<!DOCTYPE html>
<html lang="en">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JDKE8RQXYH"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-JDKE8RQXYH');
    </script>
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
    include('components/header.php') ?>

    <section class="container">
        <form action="models/participant_model.php" method="POST" class="form" id="registration-form" enctype="multipart/form-data">
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
                        <input type="tel" id="p_phone" name="p_phoneNumber" placeholder="Format: 123-456-7890" class="form-input">
                    </div>
                    <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" name="p_birthDate" placeholder="Enter birth date" id="p_birthDate" required />
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
                        <p class="file-upload-phrase">File format: jpg, jpeg, png, pdf, tiff, doc, docx</p>
                    </div>
                    <!-- <div class="file-upload" id="p_income_upload" style="display: none;"> -->
                    <div class="file-upload" id="p_income_upload">
                        <label>Upload Proof of Income</label>
                        <br>
                        <p class="file-upload-phrase">(Proof of income needed for age 18 and over.) </p>
                        <input type="file" required name="p_income_proof" id="p_income_proof" />
                        <p class="file-upload-phrase">File format: jpg, jpeg, png, pdf, tiff, doc, docx</p>
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
                    <input type="text" pattern="[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d" placeholder="Enter postal code" required name="p_postalCode" />



                </div>

                <div class="input-box">
                    <label>Total number of individuals in your household using this program:</label>
                    <input type="number" placeholder="Enter total number" name="numberOfHousehold" min="1" id="numberOfHousehold" />
                </div>

                <div class="column">
                    <div class="input-box number-of-adults">
                        <label>Number of Adults (18 yrs and older):</label>
                        <input type="number" placeholder="Enter number" name="numberOfAdults" id="numberOfAdults" min="0" />
                    </div>
                    <div class="input-box children-under12">
                        <label>Number of Children (Under 12 yrs old):</label>
                        <input type="number" placeholder="Enter number" name="children_under12" min="0" id="numberUnder12" />
                    </div>
                    <div class="input-box children-over12">
                        <label>Number of Children (Over 12 yrs old):</label>
                        <input type="number" placeholder="Enter number" name="children_over12" min="0" id="numberOver12" />
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
                                <p class="file-upload-phrase">File format: jpg, jpeg, png, pdf, tiff, doc, docx</p>

                            </div>

                        </div>




                        <div class="income-indication" id="is_income_proof" style="display: none;">
                            <div class="column">
                                <div class="file-upload" id="income_true">
                                    <div class="income-phrase">
                                        <input type="radio" name="income_proof_option[]" id="income_proof_yes" value="yes" required />
                                        <label for="income_proof_yes" class="radio-label">I have a proof of
                                            income</label>
                                    </div>
                                    <div class="income-upload" id="family_income_upload" style="display: none;">
                                        <label>Please Upload Proof of Income</label>
                                        <br>
                                        <input type="file" name="family_income_proof[]" required />
                                        <p class="file-upload-phrase">File format: jpg, jpeg, png, pdf, tiff, doc, docx
                                        </p>
                                    </div>
                                </div>
                                <div class="file-upload" id="income_false">
                                    <div class="income-phrase">
                                        <input type="radio" name="income_proof_option[]" id="income_proof_no" value="no" required />
                                        <label for="income_proof_no" class="radio-label">I don't have a source of
                                            income</label>
                                    </div>
                                    <div class="reason-box" id="no_income_why" style="display: none;">
                                        <label for="message" class="form-label">Please explain the reason for no
                                            income.</label>
                                        <textarea name="reason_for_no_income[]" rows="2" required class="form-textarea"></textarea>
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
                            <input type="radio" id="emergency_shelter" name="housing_situation" value="Emergency Shelter">
                            <label for="emergency_shelter">Emergency Shelter</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="family_friends" name="housing_situation" value="With Family/Friends">
                            <label for="family_friends">With Family/Friends</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="unhoused" name="housing_situation" value="Unhoused">
                            <label for="unhoused">Unhoused</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="other" name="housing_situation" value="Other">
                            <label for="other">Other (Please Specify)</label>
                            <input type="text" id="other_specify" class="other-housing-situation" name="housing_situation_other" placeholder="Specify">
                        </div>
                    </div>
                </div>



                <div class="program-box housing-box">
                    <label>HOW DID YOU FIND OUR PROGRAM (Please select all applicable)</label>
                    <div class="program-option">


                        <div class="program">
                            <input type="checkbox" id="immigration" name="found_program[]" value="Immigration/ Newcomer Services">
                            <label for="immigration">Immigration/ Newcomer Services</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="client_family_friend" name="found_program[]" value="Client/Family/Friend">
                            <label for="client_family_friend">Client/Family/Friend</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="employment_insurance" name="found_program[]" value="Employment Insurance">
                            <label for="employment_insurance">Employment Insurance</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="media_news_outreach" name="found_program[]" value="Media/News/Outreach">
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
                            <input type="text" id="other_specify" class="other-source" name="found_program_other" placeholder="Other (Please Specify)">
                        </div>
                    </div>
                </div>

                <div class="menu" id="apply">
                    <div class="menu-title" id="apply">
                        Terms, Conditions, and Restrictions
                        <span class="icon">+</span>
                    </div>
                    <div class="menu-content">
                        <div class="privacy-body">
                            <h3>Section 1: Eligibility Requirements</h3>
                            <br>
                            <p>The Free Laundry Access Program (the "Program") is designed to provide support and assistance to individuals and families experiencing poverty and/or housing insecurity. To be eligible for participation in the Program, individuals or families must meet the following eligibility requirements:
                                <br><br>
                                1.1 Residency:

                                Participants must be residents of [City/Community/Region] and provide valid proof of residency, such as a government-issued identification card or utility bill with their current address.
                                <br><br>
                                1.2 Income Status:

                                Participants must demonstrate that they are currently experiencing poverty and/or housing insecurity, as defined by the Market Basket Measure (MBM) for individuals or families within their region. The MBM is a widely recognized measure used to assess the cost of a basic standard of living in different areas, and eligibility will be determined based on meeting or falling below the established MBM threshold for the respective region.
                                <br><br>
                                1.3 Documentation:

                                Applicants must provide relevant documentation supporting their income status and housing situation, which may include but is not limited to:
                                <br><br>
                                a. Proof of income (pay stubs, social assistance statements, etc.)

                                b. Proof of housing situation (lease agreements, utility bills, etc.)

                                c. Any additional documents requested by Free Laundry Access Inc. to verify eligibility.
                                <br><br>
                                1.4 Self-Declaration:

                                In cases where official documentation is not readily available or does not accurately reflect the individual or family's current situation, a self-declaration of poverty and/or housing insecurity may be accepted, subject to verification by Free Laundry Access Incorporated.
                                <br><br>
                                1.5 Privacy and Confidentiality:

                                All information provided by applicants to establish eligibility will be treated with the utmost privacy and confidentiality, in accordance with applicable privacy laws and Free Laundry Access' privacy policy.
                                <br><br>
                                1.6 Verification Process:

                                Free Laundry Access Inc. reserves the right to verify the accuracy and authenticity of the information provided by applicants to determine eligibility for the service. Applicants may be requested to attend an interview or provide additional supporting documents during the verification process.
                                <br><br>
                                1.7 Decision:

                                The final decision regarding eligibility for the Free Laundry Access Service rests with Free Laundry Access Incorporated. If an applicant's eligibility status changes during their participation in the Program, they must inform Free Laundry Access Inc. immediately.
                                <br><br>
                                1.8 Non-Discrimination:

                                Free Laundry Access Inc. does not discriminate on the basis of race, ethnicity, gender, sexual orientation, religion, or any other protected characteristic in determining eligibility for the service.
                                <br><br>
                                1.9 Changes to Eligibility Criteria:

                                Free Laundry Access Inc. reserves the right to modify the eligibility criteria for the Free Laundry Access service as needed, subject to applicable laws and regulations. Any changes to the criteria will be communicated to participants in a timely and transparent manner.

                                By participating in the service, applicants agree to abide by the eligibility requirements outlined in this section and any other terms and conditions set forth by Free Laundry Access Incorporated.
                            </p><br><br>
                            <h3>Section 2: Use of the Program</h3>
                            <br>
                            <p>
                                2.1 Individual and Family Use Only:

                                The Free Laundry Access service is intended solely for the personal use of eligible individuals and their immediate family members residing at the same address. Participants are strictly prohibited from using the program to launder clothes for unrelated individuals or providing compensation to others for doing their laundry.
                                <br><br>
                                2.2 Limit on Compensated Loads:

                                Participants in the service may have a maximum number of loads of laundry compensated for within a specified timeframe. The determination of this limit will be based on the estimated number of loads that a reasonable person or family would need to launder their essential clothing items during the designated period.
                                <br><br>
                                2.3 Fair Usage Policy:

                                Free Laundry Access Inc. reserves the right to implement a Fair Usage Policy to ensure equitable distribution of program benefits among all eligible participants. The Fair Usage Policy may include reasonable restrictions on the frequency of use or the number of loads compensated to prevent misuse and ensure the program's sustainability.
                                <br><br>
                                2.4 Program Amendments:

                                Free Laundry Access Inc. retains the right to amend the terms and conditions of the Program, including the restrictions on usage and load limits, as necessary to maintain the program's effectiveness and align with its objectives. Any changes to the program will be communicated to participants through appropriate channels.
                                <br><br>
                                2.5 Compliance and Monitoring:

                                Participants are expected to comply with the rules and regulations of the Program. Free Laundry Access Inc. may conduct periodic monitoring to ensure adherence to these guidelines and take appropriate action if misuse or violation is identified.
                                <br><br>
                                2.6 Non-Transferability:

                                Participation in the Free Laundry Access Program and any associated benefits are non-transferable and cannot be assigned, sold, or shared with others.
                                <br><br>
                                2.7 Program Integrity:

                                Free Laundry Access Inc. is committed to maintaining the integrity of the Program and ensuring it remains accessible to those in genuine need. Participants found to be in violation of the terms and conditions outlined in this section may be subject to suspension or termination from the Program.
                                <br><br>
                                2.8 Reservation of Rights:

                                Free Laundry Access Inc. reserves the right to make the final decision on the eligibility of loads for compensation and to address any issues arising from the use of the Program at its sole discretion.

                                By utilizing the Free Laundry Access Program, participants acknowledge their understanding and acceptance of the conditions outlined in this section and agree to abide by the Program's guidelines as set forth by Free Laundry Access Incorporated.
                            </p><br><br>
                            <h3>Section 3: Code of Conduct and Safety</h3>
                            <br><p>
                            3.1 Sober and Non-Aggressive Behaviour:

                            All individuals participating in the Free Laundry Access Program are required to maintain a sober and non-aggressive demeanor while attending our events or using facilities hosting our events. Participants must not be under the influence of any substance that impairs their judgment or behaviour. Aggressive behaviour, harassment, or any conduct that causes others to feel unsafe, including other program users, volunteers, or staff, will not be tolerated.
                            <br><br>
                            3.2 Refusal of Service:

                            Free Laundry Access Inc. reserves the right to refuse service to any individual who demonstrates behaviour that violates the code of conduct outlined in this section. Refusal of service may occur immediately if the person is under the influence of substances or engaging in aggressive behaviour.
                            <br><br>
                            3.3 Accompanied Individuals with Disabilities:

                            Participants who require access to the Free Laundry Access Program and have a physical or intellectual disability must be accompanied by a caregiver or individual who can personally assist them throughout their participation. Free Laundry Access Inc. and its staff are not qualified caregivers and cannot perform the functions necessary to support individuals with disabilities adequately.
                            <br><br>
                            3.4 Reasonable Accommodation:

                            Free Laundry Access Inc. is committed to providing reasonable accommodation to individuals with disabilities, to the extent required by applicable laws and regulations. Accommodation requests should be communicated in advance, allowing us to make appropriate arrangements.
                            <br><br>
                            3.5 Non-Discrimination:

                            Free Laundry Access Inc. does not discriminate against individuals with disabilities and ensures equal access to the Program, provided the necessary support is provided by the individual or their caregiver as outlined in this section.
                            <br><br>
                            3.6 Right to Modify:

                            Free Laundry Access Inc. reserves the right to modify the Code of Conduct and Safety guidelines as needed to ensure the safety and well-being of all participants and maintain a positive and inclusive environment.

                            By participating in the Free Laundry Access Program, individuals agree to abide by the Code of Conduct and Safety guidelines detailed in this section and acknowledge that any violation of these guidelines may result in refusal of service.
                            </p><br><br>
                            <h3>Section 4: Waiver and Additional Verification</h3>
                            <br><p>
                            4.1 Waiver of Service Provision:
                            Free Laundry Access Inc. reserves the right to refuse access to the Free Laundry Access Program for any reason that requires additional time or research to determine an individual's eligibility. While we strive to provide a timely and efficient process for eligibility verification, certain cases may require further investigation or verification of documents.
                            <br><br>
                            4.2 Additional Verification Requirements:

                            In situations where eligibility for the Program cannot be immediately determined based on the information provided, Free Laundry Access Inc. may request additional documentation or conduct further verification to assess an individual's eligibility.
                            <br><br>
                            4.3 Timeframe for Verification:

                            The timeframe for completing additional research or verification may vary depending on the complexity of the case and the availability of required information. Free Laundry Access Inc. will make reasonable efforts to complete the verification process promptly.
                            <br><br>
                            4.4 No Guarantee of Eligibility:

                            Providing additional time for verification or requesting further documentation does not guarantee automatic eligibility for the Free Laundry Access Program. The final decision regarding eligibility remains with Free Laundry Access Incorporated.
                            <br><br>
                            4.5 Privacy and Confidentiality:

                            All information provided for additional verification will be treated with strict privacy and confidentiality, following applicable privacy laws and Free Laundry Access Inc.'s privacy policy.
                            <br><br>
                            4.6 Right to Refuse Access:

                            If an individual fails to provide the requested additional verification or if the information provided is deemed insufficient or inaccurate, Free Laundry Access Inc. reserves the right to refuse access to the Free Laundry Access Program.
                            <br><br>
                            4.7 Non-Discrimination:

                            Free Laundry Access Inc. does not discriminate against individuals seeking access to the Program. Additional verification requirements will be applied consistently and impartially to all applicants.
                            <br><br>
                            4.8 Amendment of Terms:

                            Free Laundry Access Inc. may amend the Waiver and Additional Verification section as necessary to ensure the efficient and effective operation of the Program while maintaining compliance with applicable laws and regulations.

                            By seeking access to the Free Laundry Access Program, individuals acknowledge their understanding of the Waiver and Additional Verification section and agree to cooperate with Free Laundry Access Inc. in providing any necessary information for eligibility determination.
                            </p><br><br>
                            <h3>Section 5: Acceptance</h3>
                            <br><p>
                            By signing below, I hereby acknowledge that I have read, understood, and accept the terms, conditions, and restrictions outlined in this document for participation in the Free Laundry Access Program provided by Free Laundry Access Incorporated. I agree to abide by the eligibility requirements, code of conduct, safety guidelines, waiver, and any additional verification processes as set forth by Free Laundry Access Incorporated. I understand that failure to comply with these guidelines may result in refusal of service. I further acknowledge that my participation in the Program is subject to the sole discretion of Free Laundry Access Incorporated.
                            </p>
                        </div>
                    </div>
                    <div class="menu" id="apply">
                        <div class="menu-title" id="apply">
                            Privacy Notice and Consent
                            <span class="icon">+</span>
                        </div>
                        <div class="menu-content">
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
                        </div>

                        <div class="privacy">

                            <label for="consent-checkbox" class="center-checkbox-label">
                                <input type="checkbox" id="consent-checkbox" required name="consent_box">
                                <span class="checkbox-text">I consent to the Terms, Conditions, and Restrictions, and Privacy Notice</span>
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