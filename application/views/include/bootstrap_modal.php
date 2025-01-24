<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js"></script>
<?php 
if(in_array(BOOTSTRAP_MODALS['new_emp_form'], $bootstrap_modals)) { ?>
<!------ add new designation_modal -->
<div class="modal fade" id="designation_modal" role="dialog">
    <div class="modal-dialog" role="document" style="margin-right: 900px;">
        <div class="modal-content" style="width: 1200px;text-align:center;">
            <div class="modal-header btnclr" >
                <a href="#" class="close" data-dismiss="modal">&times;</a>
                <h4 class="modal-title"><?= ('Form instructions') ?></h4>
            </div>
            <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
                <form id="add_designation" method="post">
                <div class="panel-body">
                <input type ="hidden" name="csrf_test_name" id="" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="form-group row">
                    <section class="content content_instuc" id="instuc_p1">
                    <!-- form instructions -->
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                        <div class="panel-body">
                            <div class="instuc_text row">
                                <div class="col-md-6">
                                <h3>General Instruction</h3>
                                <p>Section references are to the Internal Revenue Code.</p>
                                <div class="para-text">
                                <h4>Future Developments</h4>
                                <p>For the latest information about developments related to
                                Form W-4, such as legislation enacted after it was published,
                                go to www.irs.gov/FormW4</p>
                                <h4>Purpose of Form</h4>
                                <p>Complete Form W-4 so that your employer can withhold the
                                correct federal income tax from your pay. If too little is
                                withheld, you will generally owe tax when you file your tax
                                return and may owe a penalty. If too much is withheld, you
                                will generally be due a refund. Complete a new Form W-4
                                when changes to your personal or financial situation would
                                change the entries on the form. For more information on
                                withholding and when you must furnish a new Form W-4,
                                see Pub. 505, Tax Withholding and Estimated Tax. </p>
                                <p><strong>Exemption from withholding. </strong>You may claim exemption
                                from withholding for 2022 if you meet both of the following
                                conditions: you had no federal income tax liability in 2021
                                and you expect to have no federal income tax liability in
                                2022. You had no federal income tax liability in 2021 if (1)
                                your total tax on line 24 on your 2021 Form 1040 or 1040-SR
                                is zero (or less than the sum of lines 27a, 28, 29, and 30), or
                                (2) you were not required to file a return because your
                                income was below the filing threshold for your correct filing
                                status. If you claim exemption, you will have no income tax
                                withheld from your paycheck and may owe taxes and
                                penalties when you file your 2022 tax return. To claim
                                exemption from withholding, certify that you meet both of
                                the conditions above by writing “Exempt” on Form W-4 in
                                the space below Step 4(c). Then, complete Steps 1(a), 1(b),
                                and 5. Do not complete any other steps. You will need to
                                submit a new Form W-4 by February 15, 2023.</p>
                                <p></strong>Your privacy.</strong> If you prefer to limit information provided in
                                Steps 2 through 4, use the online estimator, which will also
                                increase accuracy.</p>
                                <p>As an alternative to the estimator: if you have concerns
                                with Step 2(c), you may choose Step 2(b); if you have
                                concerns with Step 4(a), you may enter an additional amount
                                you want withheld per pay period in Step 4(c). If this is the
                                only job in your household, you may instead check the box
                                in Step 2(c), which will increase your withholding and
                                significantly reduce your paycheck (often by thousands of
                                dollars over the year).</p>
                                <p><strong>When to use the estimator.</strong> Consider using the estimator at
                                www.irs.gov/W4App if you:</p>
                                <ol>
                                <li> Expect to work only part of the year;</li>
                                <li>Have dividend or capital gain income, or are subject to
                                additional taxes, such as Additional Medicare Tax;</li>
                                <li> Have self-employment income (see below); or</li>
                                <li>Prefer the most accurate withholding for multiple job
                                situations</li>
                                </ol>
                                <p><strong>Self-employment. </strong>Generally, you will owe both income and
                                self-employment taxes on any self-employment income you
                                receive separate from the wages you receive as an
                                employee. If you want to pay these taxes through
                                withholding from your wages, use the estimator at
                                www.irs.gov/W4App to figure the amount to have withheld.</p>
                                <p><strong>Nonresident alien.</strong> If you’re a nonresident alien, see Notice
                                1392, Supplemental Form W-4 Instructions for Nonresident
                                Aliens, before completing this form.</p>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <h3>Specific Instructions</h3>
                                <div class="para-text">
                                <p><strong>Step 1(c). </strong>Check your anticipated filing status. This will
                                determine the standard deduction and tax rates used to
                                compute your withholding.</p>
                                <p></strong>Step 2.</strong> Use this step if you (1) have more than one job at the
                                same time, or (2) are married filing jointly and you and your
                                spouse both work.</p>
                                <p>Option <b>(a)</b> most accurately calculates the additional tax
                                you need to have withheld, while option <b>(b)</b> does so with a
                                little less accuracy. </p>
                                <p>If you (and your spouse) have a total of only two jobs, you
                                may instead check the box in option (c). The box must also
                                be checked on the Form W-4 for the other job. If the box is
                                checked, the standard deduction and tax brackets will be
                                cut in half for each job to calculate withholding. This option
                                is roughly accurate for jobs with similar pay; otherwise, more
                                tax than necessary may be withheld, and this extra amount
                                will be larger the greater the difference in pay is between the
                                two jobs</p>
                                <img src="" alt="">
                                <p><strong>Multiple jobs.</strong> Complete Steps 3 through 4(b) on only
                                one Form W-4. Withholding will be most accurate if
                                you do this on the Form W-4 for the highest paying job.</p>
                                <p><strong>Step 3.</strong> This step provides instructions for determining the
                                amount of the child tax credit and the credit for other
                                dependents that you may be able to claim when you file your
                                tax return. To qualify for the child tax credit, the child must
                                be under age 17 as of December 31, must be your
                                dependent who generally lives with you for more than half
                                the year, and must have the required social security number.
                                You may be able to claim a credit for other dependents for
                                whom a child tax credit can’t be claimed, such as an older
                                child or a qualifying relative. For additional eligibility
                                requirements for these credits, see Pub. 501, Dependents,
                                Standard Deduction, and Filing Information. You can also
                                include other tax credits for which you are eligible in this
                                step, such as the foreign tax credit and the education tax
                                credits. To do so, add an estimate of the amount for the year
                                to your credits for dependents and enter the total amount in
                                Step 3. Including these credits will increase your paycheck
                                and reduce the amount of any refund you may receive when
                                you file your tax return.</p>
                                <strong>Step 4 (optional).</strong>
                                <p><strong>Step 4(a).</strong> Enter in this step the total of your other
                                estimated income for the year, if any. You shouldn’t include
                                income from any jobs or self-employment. If you complete
                                Step 4(a), you likely won’t have to make estimated tax
                                payments for that income. If you prefer to pay estimated tax
                                rather than having tax on other income withheld from your
                                paycheck, see Form 1040-ES, Estimated Tax for Individuals.</p>
                                <p></strong>Step 4(b). </strong>Enter in this step the amount from the
                                Deductions Worksheet, line 5, if you expect to claim
                                deductions other than the basic standard deduction on your
                                2022 tax return and want to reduce your withholding to
                                account for these deductions. This includes both itemized
                                deductions and other deductions such as for student loan
                                interest and IRAs</p>
                                <p><strong>Step 4(c). </strong>Enter in this step any additional tax you want
                                withheld from your pay each pay period, including any
                                amounts from the Multiple Jobs Worksheet, line 4. Entering
                                an amount here will reduce your paycheck and will either
                                increase your refund or reduce any amount of tax that you
                                owe</p>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </section>
                                <section class="content content_instuc" id="instuc_p2">
                                <!-- form instructions -->
                                <div class="row">
                                <div class="col-sm-12">
                                <div class="panel panel-bd lobidrag">
                                <!-- <div class="panel-heading">
                                <div class="panel-title">
                                    <h4>Form instructions</h4>
                                </div>
                                </div> -->
                                <div class="panel-body">
                                <h4 class="instuc_title">Step 2(b)—Multiple Jobs Worksheet<span> (Keep for your records.)</span></h4>
                                <div class="instru-text">
                                <p>If you choose the option in Step 2(b) on Form W-4, complete this worksheet (which calculates the total extra tax for all jobs) on only ONE
                                Form W-4. Withholding will be most accurate if you complete the worksheet and enter the result on the Form W-4 for the highest paying job</p>
                                <p><strong>Note: </strong>If more than one job has annual wages of more than $120,000 or there are more than three jobs, see Pub. 505 for additional
                                tables; or, you can use the online withholding estimator at www.irs.gov/W4App.</p>
                                <div class="wagesList">
                                <ol>
                                <div class="w_price2">
                                <li>Two jobs. If you have two jobs or you’re married filing jointly and you and your spouse each have one
                                job, find the amount from the appropriate table on page 4. Using the “Higher Paying Job” row and the
                                “Lower Paying Job” column, find the value at the intersection of the two household salaries and enter
                                that value on line 1. Then, skip to line 3 . . . . . . . . . . . . . . . . . . . . .</li>
                                <form>
                                <label for="price">1</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <li>Three jobs. If you and/or your spouse have three jobs at the same time, complete lines 2a, 2b, and
                                2c below. Otherwise, skip to line 3.</li>
                                <br>
                                <ol type="a">
                                <div class="w_price2">
                                <li>Find the amount from the appropriate table on page 4 using the annual wages from the highest
                                paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
                                in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries
                                and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">2a</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <div class="w_price2">
                                <li>Find the amount from the appropriate table on page 4 using the annual wages from the highest
                                paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
                                in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries
                                and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">2b</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <div class="w_price2">
                                <li>Find the amount from the appropriate table on page 4 using the annual wages from the highest
                                paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
                                in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries
                                and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">2c</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                </ol>
                                <div class="w_price2">
                                <li>Find the amount from the appropriate table on page 4 using the annual wages from the highest
                                paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
                                in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries
                                and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">3</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <div class="w_price2">
                                <li>Find the amount from the appropriate table on page 4 using the annual wages from the highest
                                paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
                                in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries
                                and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">4</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                </ol>
                                </div>
                                </div>
                                </div>
                                <div class="panel-body">
                                <h4 class="instuc_title">Step 4(b)—Deductions Worksheet<span> (Keep for your records.)</span></h4>
                                <div class="instru-text">
                                <div class="wagesList">
                                <ol>
                                <div class="w_price2">
                                <li>Enter an estimate of your 2022 itemized deductions (from Schedule A (Form 1040)). Such deductions
                                may include qualifying home mortgage interest, charitable contributions, state and local taxes (up to
                                $10,000), and medical expenses in excess of 7.5% of your income . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">1</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <div class="w_price2">
                                <li>If line 1 is greater than line 2, subtract line 2 from line 1 and enter the result here. If line 2 is greater
                                than line 1, enter “-0-” . . . . . . . . . . . . . . . . . . . . . . . . . . </li>
                                <form>
                                <label for="price">2</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <div class="w_price2">
                                <li>Enter an estimate of your student loan interest, deductible IRA contributions, and certain other
                                adjustments (from Part II of Schedule 1 (Form 1040)). See Pub. 505 for more information . . . . </li>
                                <form>
                                <label for="price">3</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                <div class="w_price2">
                                <li>Add lines 3 and 4. Enter the result here and in Step 4(b) of Form W-4 . . . . . . . . . . .</li>
                                <form>
                                <label for="price">4</label>
                                <input type="text" id="wages_price" name="price" placeholder="$">
                                </form>
                                </div>
                                <br>
                                </ol>
                                </div>
                                </div>
                                <div class="instruc_bottom2">
                                <div class="col-md-6">
                                <p><strong>Privacy Act and Paperwork Reduction Act Notice.</strong> We ask for the information
                                on this form to carry out the Internal Revenue laws of the United States. Internal
                                Revenue Code sections 3402(f)(2) and 6109 and their regulations require you to
                                provide this information; your employer uses it to determine your federal income
                                tax withholding. Failure to provide a properly completed form will result in your
                                being treated as a single person with no other entries on the form; providing
                                fraudulent information may subject you to penalties. Routine uses of this
                                information include giving it to the Department of Justice for civil and criminal
                                litigation; to cities, states, the District of Columbia, and U.S. commonwealths and
                                possessions for use in administering their tax laws; and to the Department of
                                Health and Human Services for use in the National Directory of New Hires. We
                                may also disclose this information to other countries under a tax treaty, to federal
                                and state agencies to enforce federal nontax criminal laws, or to federal law
                                enforcement and intelligence agencies to combat terrorism.</p>
                                </div>
                                <div class="col-md-6">
                                <p>You are not required to provide the information requested on a form that is
                                subject to the Paperwork Reduction Act unless the form displays a valid OMB
                                control number. Books or records relating to a form or its instructions must be
                                retained as long as their contents may become material in the administration of
                                any Internal Revenue law. Generally, tax returns and return information are
                                confidential, as required by Code section 6103.</p>
                                <p>The average time and expenses required to complete and file this form will vary
                                depending on individual circumstances. For estimated averages, see the
                                instructions for your income tax return.</p>
                                <p>If you have suggestions for making this form simpler, we would be happy to hear
                                from you. See the instructions for your income tax return.</p>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                    </section>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php } if(in_array(BOOTSTRAP_MODALS['bank_info_modal'], $bootstrap_modals)) { ?>
<div class="modal fade" id="add_bank_info">
   <div class="modal-dialog">
      <div class="modal-content" style="text-align:center;" >
         <div class="modal-header btnclr" >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo display ('ADD BANK ') ?></h4>
         </div>
         <div class="container"></div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_bank"  method="post" style="text-align: left !important;">
               <div class="panel-body">
               <div class="form-group row">
                     <label for="bank_name" class="col-sm-4 col-form-label"><?php echo display('bank_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control clearinputValue" name="bank_name" id="bank_name" required="" placeholder="<?php echo display('bank_name') ?>" tabindex="1"/>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_GET['id']; ?>">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="ac_name" class="col-sm-4 col-form-label"><?php echo display('ac_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control clearinputValue" name="ac_name" id="ac_name" required="" placeholder="<?php echo display('ac_name') ?>" tabindex="2"/>
                     </div>
                  </div>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="ac_no" class="col-sm-4 col-form-label"><?php echo display('ac_no') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="number" class="form-control clearinputValue" name="ac_no" id="ac_no" required="" placeholder="<?php echo display('ac_no') ?>" tabindex="3"/>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="branch" class="col-sm-4 col-form-label"><?php echo display('branch') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control clearinputValue" name="branch" id="branch" required placeholder="<?php echo display('branch') ?>" tabindex="4"/>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="shipping_line" class="col-sm-4 col-form-label"><?php echo display('Country') ?>
                     <i class="text-danger"></i>
                     </label>
                     <div class="col-sm-6">
                        <select name="country" id="country" class="selectpicker countrypicker form-control">
                         <option value="">Select Country</option>
                           <?php foreach($country_data as $value) { ?>
                              <option value="<?= $value['name']; ?>" <?= $value['name'] === 'UNITED STATES' ? 'selected' : ''; ?>> <?= $value['name']; ?> 
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="previous_balance" class="col-sm-4 col-form-label"><?php echo display('Currency') ?></label>
                     <div class="col-sm-6">
                        <select  class="form-control" id="currency" name="currency1" class="form-control"  style="width: 100%;" required=""  style="max-width: -webkit-fill-available;">
                           <option>Select currency</option>
                           <option value="AFN">AFN - Afghan Afghani</option>
                           <option value="ALL">ALL - Albanian Lek</option>
                           <option value="DZD">DZD - Algerian Dinar</option>
                           <option value="AOA">AOA - Angolan Kwanza</option>
                           <option value="ARS">ARS - Argentine Peso</option>
                           <option value="AMD">AMD - Armenian Dram</option>
                           <option value="AWG">AWG - Aruban Florin</option>
                           <option value="AUD">AUD - Australian Dollar</option>
                           <option value="AZN">AZN - Azerbaijani Manat</option>
                           <option value="BSD">BSD - Bahamian Dollar</option>
                           <option value="BHD">BHD - Bahraini Dinar</option>
                           <option value="BDT">BDT - Bangladeshi Taka</option>
                           <option value="BBD">BBD - Barbadian Dollar</option>
                           <option value="BYR">BYR - Belarusian Ruble</option>
                           <option value="BEF">BEF - Belgian Franc</option>
                           <option value="BZD">BZD - Belize Dollar</option>
                           <option value="BMD">BMD - Bermudan Dollar</option>
                           <option value="BTN">BTN - Bhutanese Ngultrum</option>
                           <option value="BTC">BTC - Bitcoin</option>
                           <option value="BOB">BOB - Bolivian Boliviano</option>
                           <option value="BAM">BAM - Bosnia-Herzegovina Convertible Mark</option>
                           <option value="BWP">BWP - Botswanan Pula</option>
                           <option value="BRL">BRL - Brazilian Real</option>
                           <option value="GBP">GBP - British Pound Sterling</option>
                           <option value="BND">BND - Brunei Dollar</option>
                           <option value="BGN">BGN - Bulgarian Lev</option>
                           <option value="BIF">BIF - Burundian Franc</option>
                           <option value="KHR">KHR - Cambodian Riel</option>
                           <option value="CAD">CAD - Canadian Dollar</option>
                           <option value="CVE">CVE - Cape Verdean Escudo</option>
                           <option value="KYD">KYD - Cayman Islands Dollar</option>
                           <option value="XOF">XOF - CFA Franc BCEAO</option>
                           <option value="XAF">XAF - CFA Franc BEAC</option>
                           <option value="XPF">XPF - CFP Franc</option>
                           <option value="CLP">CLP - Chilean Peso</option>
                           <option value="CNY">CNY - Chinese Yuan</option>
                           <option value="COP">COP - Colombian Peso</option>
                           <option value="KMF">KMF - Comorian Franc</option>
                           <option value="CDF">CDF - Congolese Franc</option>
                           <option value="CRC">CRC - Costa Rican ColÃ³n</option>
                           <option value="HRK">HRK - Croatian Kuna</option>
                           <option value="CUC">CUC - Cuban Convertible Peso</option>
                           <option value="CZK">CZK - Czech Republic Koruna</option>
                           <option value="DKK">DKK - Danish Krone</option>
                           <option value="DJF">DJF - Djiboutian Franc</option>
                           <option value="DOP">DOP - Dominican Peso</option>
                           <option value="XCD">XCD - East Caribbean Dollar</option>
                           <option value="EGP">EGP - Egyptian Pound</option>
                           <option value="ERN">ERN - Eritrean Nakfa</option>
                           <option value="EEK">EEK - Estonian Kroon</option>
                           <option value="ETB">ETB - Ethiopian Birr</option>
                           <option value="EUR">EUR - Euro</option>
                           <option value="FKP">FKP - Falkland Islands Pound</option>
                           <option value="FJD">FJD - Fijian Dollar</option>
                           <option value="GMD">GMD - Gambian Dalasi</option>
                           <option value="GEL">GEL - Georgian Lari</option>
                           <option value="DEM">DEM - German Mark</option>
                           <option value="GHS">GHS - Ghanaian Cedi</option>
                           <option value="GIP">GIP - Gibraltar Pound</option>
                           <option value="GRD">GRD - Greek Drachma</option>
                           <option value="GTQ">GTQ - Guatemalan Quetzal</option>
                           <option value="GNF">GNF - Guinean Franc</option>
                           <option value="GYD">GYD - Guyanaese Dollar</option>
                           <option value="HTG">HTG - Haitian Gourde</option>
                           <option value="HNL">HNL - Honduran Lempira</option>
                           <option value="HKD">HKD - Hong Kong Dollar</option>
                           <option value="HUF">HUF - Hungarian Forint</option>
                           <option value="ISK">ISK - Icelandic KrÃ³na</option>
                           <option value="INR">INR - Indian Rupee</option>
                           <option value="IDR">IDR - Indonesian Rupiah</option>
                           <option value="IRR">IRR - Iranian Rial</option>
                           <option value="IQD">IQD - Iraqi Dinar</option>
                           <option value="ILS">ILS - Israeli New Sheqel</option>
                           <option value="ITL">ITL - Italian Lira</option>
                           <option value="JMD">JMD - Jamaican Dollar</option>
                           <option value="JPY">JPY - Japanese Yen</option>
                           <option value="JOD">JOD - Jordanian Dinar</option>
                           <option value="KZT">KZT - Kazakhstani Tenge</option>
                           <option value="KES">KES - Kenyan Shilling</option>
                           <option value="KWD">KWD - Kuwaiti Dinar</option>
                           <option value="KGS">KGS - Kyrgystani Som</option>
                           <option value="LAK">LAK - Laotian Kip</option>
                           <option value="LVL">LVL - Latvian Lats</option>
                           <option value="LBP">LBP - Lebanese Pound</option>
                           <option value="LSL">LSL - Lesotho Loti</option>
                           <option value="LRD">LRD - Liberian Dollar</option>
                           <option value="LYD">LYD - Libyan Dinar</option>
                           <option value="LTL">LTL - Lithuanian Litas</option>
                           <option value="MOP">MOP - Macanese Pataca</option>
                           <option value="MKD">MKD - Macedonian Denar</option>
                           <option value="MGA">MGA - Malagasy Ariary</option>
                           <option value="MWK">MWK - Malawian Kwacha</option>
                           <option value="MYR">MYR - Malaysian Ringgit</option>
                           <option value="MVR">MVR - Maldivian Rufiyaa</option>
                           <option value="MRO">MRO - Mauritanian Ouguiya</option>
                           <option value="MUR">MUR - Mauritian Rupee</option>
                           <option value="MXN">MXN - Mexican Peso</option>
                           <option value="MDL">MDL - Moldovan Leu</option>
                           <option value="MNT">MNT - Mongolian Tugrik</option>
                           <option value="MAD">MAD - Moroccan Dirham</option>
                           <option value="MZM">MZM - Mozambican Metical</option>
                           <option value="MMK">MMK - Myanmar Kyat</option>
                           <option value="NAD">NAD - Namibian Dollar</option>
                           <option value="NPR">NPR - Nepalese Rupee</option>
                           <option value="ANG">ANG - Netherlands Antillean Guilder</option>
                           <option value="TWD">TWD - New Taiwan Dollar</option>
                           <option value="NZD">NZD - New Zealand Dollar</option>
                           <option value="NIO">NIO - Nicaraguan CÃ³rdoba</option>
                           <option value="NGN">NGN - Nigerian Naira</option>
                           <option value="KPW">KPW - North Korean Won</option>
                           <option value="NOK">NOK - Norwegian Krone</option>
                           <option value="OMR">OMR - Omani Rial</option>
                           <option value="PKR">PKR - Pakistani Rupee</option>
                           <option value="PAB">PAB - Panamanian Balboa</option>
                           <option value="PGK">PGK - Papua New Guinean Kina</option>
                           <option value="PYG">PYG - Paraguayan Guarani</option>
                           <option value="PEN">PEN - Peruvian Nuevo Sol</option>
                           <option value="PHP">PHP - Philippine Peso</option>
                           <option value="PLN">PLN - Polish Zloty</option>
                           <option value="QAR">QAR - Qatari Rial</option>
                           <option value="RON">RON - Romanian Leu</option>
                           <option value="RUB">RUB - Russian Ruble</option>
                           <option value="RWF">RWF - Rwandan Franc</option>
                           <option value="SVC">SVC - Salvadoran ColÃ³n</option>
                           <option value="WST">WST - Samoan Tala</option>
                           <option value="SAR">SAR - Saudi Riyal</option>
                           <option value="RSD">RSD - Serbian Dinar</option>
                           <option value="SCR">SCR - Seychellois Rupee</option>
                           <option value="SLL">SLL - Sierra Leonean Leone</option>
                           <option value="SGD">SGD - Singapore Dollar</option>
                           <option value="SKK">SKK - Slovak Koruna</option>
                           <option value="SBD">SBD - Solomon Islands Dollar</option>
                           <option value="SOS">SOS - Somali Shilling</option>
                           <option value="ZAR">ZAR - South African Rand</option>
                           <option value="KRW">KRW - South Korean Won</option>
                           <option value="XDR">XDR - Special Drawing Rights</option>
                           <option value="LKR">LKR - Sri Lankan Rupee</option>
                           <option value="SHP">SHP - St. Helena Pound</option>
                           <option value="SDG">SDG - Sudanese Pound</option>
                           <option value="SRD">SRD - Surinamese Dollar</option>
                           <option value="SZL">SZL - Swazi Lilangeni</option>
                           <option value="SEK">SEK - Swedish Krona</option>
                           <option value="CHF">CHF - Swiss Franc</option>
                           <option value="SYP">SYP - Syrian Pound</option>
                           <option value="STD">STD - São Tomé and Príncipe Dobra</option>
                           <option value="TJS">TJS - Tajikistani Somoni</option>
                           <option value="TZS">TZS - Tanzanian Shilling</option>
                           <option value="THB">THB - Thai Baht</option>
                           <option value="TOP">TOP - Tongan pa'anga</option>
                           <option value="TTD">TTD - Trinidad & Tobago Dollar</option>
                           <option value="TND">TND - Tunisian Dinar</option>
                           <option value="TRY">TRY - Turkish Lira</option>
                           <option value="TMT">TMT - Turkmenistani Manat</option>
                           <option value="UGX">UGX - Ugandan Shilling</option>
                           <option value="UAH">UAH - Ukrainian Hryvnia</option>
                           <option value="AED">AED - United Arab Emirates Dirham</option>
                           <option value="UYU">UYU - Uruguayan Peso</option>
                           <option selected value="USD">USD - US Dollar</option>
                           <option value="UZS">UZS - Uzbekistan Som</option>
                           <option value="VUV">VUV - Vanuatu Vatu</option>
                           <option value="VEF">VEF - Venezuelan BolÃ­var</option>
                           <option value="VND">VND - Vietnamese Dong</option>
                           <option value="YER">YER - Yemeni Rial</option>
                           <option value="ZMK">ZMK - Zambian Kwacha</option>
                        </select>
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <div class="row">
         <div class="col-sm-8">
         </div>
         <div class="col-sm-4">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?php echo display('Close') ?></a>
         <input type="submit" id="addBank"    class="btn btnclr" name="addBank" value="<?php echo display('save') ?>"/>
         </div>
         </div>
        </div>
         </form>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['designation_modal'], $bootstrap_modals)) { ?>
<!------ add new designation_modal -->  
<div class="modal fade" id="designation_modal" role="dialog">
   <div class="modal-dialog" role="document">
      <!-- <div class="modal-dialog" role="document"> -->
      <div class="modal-content">
         <div class="modal-header btnclr"  style="text-align:center;" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title"><?php echo ('Add New Designation ') ?></h4>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_designation" method="post">
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="customer_name" class="col-sm-3 col-form-label" style="width: auto;"><?php echo ('New Designation') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input class="form-control clearDesignation" name ="designation" id="designation" type="text" required="" tabindex="1">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"   data-dismiss="modal"><?php echo display('Close') ?> </a>
         <input type="submit" class="btn btnclr"   value=<?php echo display('Submit') ?>>
         </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>

<?php if(in_array(BOOTSTRAP_MODALS['payroll_type_modal'], $bootstrap_modals)) { ?>
    <!------ add new payroll Type -->
<div class="modal fade" id="proll_type" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr"  style="text-align:center;" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title">Add Payroll Type</h4>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_payroll_type" method="post">
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="customer_name" class="col-sm-3 col-form-label" style="width: auto;">New Payroll Type <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input class="form-control" name ="new_payroll_type" id="new_payroll_type" type="text" placeholder="New Payroll Type"  required="" tabindex="1">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?php echo display('Close') ?> </a>
         <input type="submit" class="btn btnclr"  value=<?php echo display('Submit') ?>>
         </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } if(in_array(BOOTSTRAP_MODALS['emp_type_modal'], $bootstrap_modals)) { ?>
<!------ add new Payment Type -->  
<div class="modal fade" id="employees_type" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr"  style="text-align:center;" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title">Add Employee Type</h4>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_employee_type" method="post">
               <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="customer_name" class="col-sm-3 col-form-label" style="width: auto;">New Employee Type <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input class="form-control" name ="employee_type" id="emps_type" type="text" placeholder="New Employee Type"  required="" tabindex="1">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?php echo display('Close') ?> </a>
         <input type="submit" class="btn btnclr"  value=<?php echo display('Submit') ?>>
         </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } if(in_array(BOOTSTRAP_MODALS['pay_type_modal'], $bootstrap_modals)) { ?>
    <!------ add new Payment Type -->  
<div class="modal fade" id="payment_type" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr"  style="text-align:center;">
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title"><?php echo display('Add New Payment Type') ?></h4>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_pay_type" method="post">
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="customer_name" class="col-sm-3 col-form-label" style="width: auto;"><?php echo display('New Payment Type') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input class="form-control" name ="new_payment_type" id="new_payment_type" type="text" placeholder="New Payment Type"  required="" tabindex="1">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?php echo display('Close') ?> </a>
         <input type="submit" class="btn btnclr "  value=<?php echo display('Submit') ?>>
         </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
}
if(in_array(BOOTSTRAP_MODALS['add_states'],$bootstrap_modals)){ ?>
<!-- Add States -->
<div class="modal fade modal-success" id="add_states" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New State</h3>
         </div>
         <div class="modal-body">
            <form method="post" id="addState" style="text-align: left !important;">
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
               <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">State Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="state_name" id="" type="text" placeholder="State Name"  required="" tabindex="1">
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"  value="Submit">
         </div>
        </form>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['add_state_tax'],$bootstrap_modals)){ ?>
 <!-- Add New State Tax  -->
<div class="modal fade modal-success" id="add_state_tax" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New State Tax</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form method="post" id="addstatetax" style="text-align: left !important;">
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">State Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <select class="form-control" name="selected_state" required>
                        <option value="" selected disabled><?php echo display('select_one') ?></option>
                        <?php  foreach($states_list as $state){ ?>
                        <option value="<?php  echo $state['state']; ?>"><?php  echo $state['state']; ?></option>
                        <?php  }  ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">Tax Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="state_tax_name" id="" type="text" placeholder="State Tax Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"   value="Submit">
         </div>
         </form>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['add_state_tax'],$bootstrap_modals)){ ?>
<!-- Add New City -->
<div class="modal fade modal-success" id="add_city_info" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New City</h3>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form method="post" id="cityTax" style="text-align: left !important;"> 
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
               <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">City Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="city_name" id="" type="text" placeholder="City Name"  required="" tabindex="1">
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"  value="Submit">
         </div>
         </form>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['add_city_tax'],$bootstrap_modals)){ ?>
<!-- Add New City Tax -->
<div class="modal fade modal-success" id="add_city_tax" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr">
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New City Tax</h3>
         </div>
         <div class="modal-body">
            <form id="addCityTax" method="post" style="text-align: left !important;">
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">City Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <select class="form-control" name="selected_city" required>
                        <option value="" selected disabled><?php echo display('select_one') ?></option>
                        <?php  foreach($city_list as $city){ ?>
                        <option value="<?php  echo $city['state']; ?>"><?php  echo $city['state']; ?></option>
                        <?php  }  ?>
                     </select>
                  </div>
               </div> 
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">City Tax Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="city_tax_name" id="" type="text" placeholder="City Tax Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"   value="Submit">
         </div>
         </form>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['add_county_info'],$bootstrap_modals)){ ?>
<!-- Add County -->
<div class="modal fade modal-success" id="add_county_info" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New County</h3>
         </div>   
         <div class="modal-body">
            <form id="addCounty" method="post" style="text-align: left !important;">
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">County Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="county" id="" type="text" placeholder="County Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"  value="Submit">
         </div>
         </form>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['add_county_tax'],$bootstrap_modals)){ ?>
<!-- Add New County Tax -->
<div class="modal fade modal-success" id="add_county_tax" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align:center;">
         <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Add New County Tax</h3>
         </div>
         <div class="modal-body">
            <form id="addCountyTax" method="post" style="text-align: left !important;">
            <div class="panel-body">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">County Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <select class="form-control" name="selected_county" required>
                        <option value="" selected disabled><?php echo display('select_one') ?></option>
                        <?php  foreach($county_list as $county){ ?>
                        <option value="<?php  echo $county['state']; ?>"><?php  echo $county['state']; ?></option>
                        <?php  }  ?>
                     </select>
                  </div>
               </div> 
               <div class="form-group row">
                  <label for="customer_name" class="col-sm-3 col-form-label">County Tax Name<i class="text-danger">*</i></label>
                  <div class="col-sm-6">
                     <input class="form-control" name ="county_tax_name" id="" type="text" placeholder="County Tax Name"  required="" tabindex="1">
                     <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                     <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
            <input type="submit" class="btnclr btn btn-success"   value="Submit">
         </div>
         </form>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['daily_break'],$bootstrap_modals)){ ?>
<div class="modal fade" id="dailybreak_add" role="dialog">
<div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top: 190px;text-align:center;">
        <div class="modal-header btnclr"  >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title">Add New Daily Break</h4>
        </div>
        <div class="modal-body">
            <form id="insert_daily_break" method="post" style="text-align: left !important;">
                <div class="panel-body">
                    <input type ="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="form-group row">
                        <label for="customer_name" class="col-sm-3 col-form-label" style="width: auto;">Daily Break<i class="text-danger">*</i></label>
                        <div class="col-sm-6">
                            <input type="text" class="decimal form-control dBreaks" name ="dbreak" id="dbreak" placeholder="Integer and decimal only" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btnclr "   data-dismiss="modal"><?php echo display('Close') ?> </a>
                <input type="submit" class="btn btnclr "  value=<?php echo display('Submit') ?>>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php } ?>

<?php if(in_array(BOOTSTRAP_MODALS['generatedownload'],$bootstrap_modals)){ ?>
<!-- All Form Download Modal -->
<div class="modal fade modal-success" id="generatedownload" role="dialog" style="margin-top: 300px;">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr">
         </div>
         <div class="modal-body">
            <div class="skeleton-loader"></div>
            <h3 class="text-center mb-2">Your PDF is almost ready, please wait a moment</h3>
         </div>
      </div>
   </div>
</div>
<?php } if(in_array(BOOTSTRAP_MODALS['allForms'],$bootstrap_modals)){ ?>
<div class="modal fade modal-success" id="allForms" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="text-align:center;">
        <div class="modal-header btnclr" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title">Forms</h3>
        </div>
         <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <select class="btnclr btn" id="timesheetSelect">
                      <option value="">W2 Form - Select Employee</option>
                    <?php
                        $addedIds = [];
                        foreach ($timesheet_data_emp as $time) {
                            if (!empty($time['id']) && !empty($time['first_name']) && !empty($time['last_name']) && !isset($addedIds[$time['id']])) {
                                echo '<option style="color:white;" value="' . htmlspecialchars($time['id']) . '?id=' . htmlspecialchars($company_id) . '">'
                                    . htmlspecialchars($time['first_name']) . '<br>' . htmlspecialchars($time['last_name'])
                                    . '</option>';
                                $addedIds[$time['id']] = true; 
                            }
                        }
                    ?>

                    </select>
                </div>
                <div class="col-md-4">
                    <a class="btnclr btn" href="<?php echo base_url('chrm/formw3Form?id='.$_GET['id']) ?>">W3 Form</a>
                </div>
                <div class="col-md-4">
                    <a class="btnclr btn" href="<?php echo base_url('chrm/form940Form?id='.$_GET['id']) ?>">Form 940</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <select class="btnclr btn" id="form941">
                      <option style="color:white;" selected>Form 941 - Select a Quarter</option>
                      <option style="color:white;" value="Q1?id=<?= $_GET['id'] ?>">Q1</option>
                      <option style="color:white;" value="Q2?id=<?= $_GET['id'] ?>">Q2</option>
                      <option style="color:white;" value="Q3?id=<?= $_GET['id'] ?>">Q3</option>
                      <option style="color:white;" value="Q4?id=<?= $_GET['id'] ?>">Q4</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <a class="btnclr btn" href="<?php echo base_url('chrm/form944Form?id=' . $_GET['id']); ?>">Form 944</a>
                </div>
                <div class="col-md-4">
                    <select class="btnclr btn" id="timesheetSelect3">
                        <option>NJ927 Form</option>
                        <option style="color:white;"  value="Q1?id=<?= $_GET['id'] ?>">Q1</option>
                        <option style="color:white;"  value="Q2?id=<?= $_GET['id'] ?>">Q2</option>
                        <option style="color:white;"  value="Q3?id=<?= $_GET['id'] ?>">Q3</option>
                        <option style="color:white;"  value="Q4?id=<?= $_GET['id'] ?>">Q4</option>
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <select class="btnclr btn" id="UC_2a_form">
                        <option style="color:white;" selected>UC-2A Form - Select a Quarter</option>
                        <option style="color:white;" value="Q1?id=<?= $_GET['id'] ?>">Q1</option>
                        <option style="color:white;" value="Q2?id=<?= $_GET['id'] ?>">Q2</option>
                        <option style="color:white;" value="Q3?id=<?= $_GET['id'] ?>">Q3</option>
                        <option style="color:white;" value="Q4?id=<?= $_GET['id'] ?>">Q4</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <a class="btnclr btn" href="<?php echo base_url('chrm/wr30_form?id=' . $_GET['id']); ?>">WR30 Form</a>
                </div>
                <div class="col-md-4">
                    <select class="btnclr btn" id="timesheetSelecttwo">
                        <option>F1099-NEC-Select Employee</option>
                        <?php
                            $addedIds = [];
                            foreach ($merged_data_salespartner as $sales) {
                                if (!in_array($sales['id'], $addedIds)) {
                                    echo '<option style="color:white;" value="' . htmlspecialchars($sales['id']) . '?id=' . htmlspecialchars($company_id) . '">' . 
                                         htmlspecialchars($sales['first_name']) . ' ' . 
                                         htmlspecialchars($sales['middle_name']) . ' ' . 
                                         htmlspecialchars($sales['last_name']) . 
                                         '</option>';
                                    $addedIds[] = $sales['id'];
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btnclr btn btn-danger" data-dismiss="modal">Close</a>
         </div>
         <?php echo form_close() ?>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['reminders'], $bootstrap_modals)) { ?>

<!------ Add Reminders -->  
<div class="modal fade" id="reminders" role="dialog">
   <div class="modal-dialog" role="document" style="width: 800px !important;">
      <!-- <div class="modal-dialog" role="document"> -->
    <form id="notificationForm" method="post" style="text-align: left !important;">

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="admin_id" value="<?php echo $_GET['admin_id']; ?>">

        <div class="modal-content">
            <div class="modal-header btnclr"  style="text-align:center;" >
                <a href="#" class="close" data-dismiss="modal">&times;</a>
                <h4 class="modal-title">Setup Reminder</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="tableAlerts">
                   <thead style="text-align:center;">
                        <tr>
                            <th>Period</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Source</th>
                        </tr>
                   </thead>
                   <tbody>
                        <tr>
                            <td>
                                <select class="when form-control" name="title" id="period" onchange="selectPeriodDate()" style="width: -webkit-fill-available;">
                                    <option value="">Select Period</option>
                                    <option value="Quater 1">Quater 1</option>
                                    <option value="Quater 2">Quater 2</option>
                                    <option value="Quater 3">Quater 3</option>
                                    <option value="Quater 4">Quater 4</option>
                                    <option value="Year">Year</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" width="20%" name="due_dates" id="due_dates" class="form-control" readonly placeholder="Due Date">
                            </td>
                            <td>
                                <select class="when form-control" name="select_date" style="width: -webkit-fill-available;">
                                    <option value=""><?php echo display('Select Preferred Date') ?></option>
                                    <option value="On Date">On Date</option>
                                    <option value="1 Day Before">1 Day Before</option>
                                    <option value="3 Days Before">3 Days Before</option>
                                    <option value="1 Week Before">1 Week Before</option>
                                </select>
                            </td>
                            <td>
                                <select class="where form-control select_source" name="select_source" onchange="selectSource(this)" style="width: -webkit-fill-available;">
                                    <option value="">Select Preferred Source</option>
                                    <option value="EMAIL">EMAIL</option>
                                    <option value="WAGERS">WAGERS</option>
                                    <option value="CALENDER">CALENDER</option>
                                </select>
                                <br>
                                <select class="form-control select_email" name="select_email" style="width: -webkit-fill-available; display: none;">
                                    <option value="">Select Email</option>
                                    <?php foreach ($email as $value) { ?>
                                    <option value="<?php echo $value['email']; ?>"><?php echo $value['email']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                   </tbody>
                </table>
             </div>
             <div class="modal-footer">
                <a href="#" class="btn btnclr" data-dismiss="modal"><?php echo display('Close') ?> </a>
                <button type="submit" class="btn btnclr disableButton">Submit</button>
             </div>
            </div>
        </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['calanderreminders'], $bootstrap_modals)) { ?>

<!-- Calander Reminder Modal -->
<div class="modal fade" id="calanderreminders" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr">
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title"><?php echo 'Add Reminder' ?></h4>
         </div>
         <div class="modal-body">
            <form id="calanderaddreminder" method="post">
               <div class="panel-body">
                    <div class="row">
                       <div class="col-md-12">
                         <label>Title <span class="text-danger">*</span></label>
                         <input type="text" name="title" id="title" class="form-control" placeholder="Enter your Title">
                         
                         <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>">
                         <input type="hidden" name="admin_id" value="<?php echo $_GET['admin_id']; ?>">
                         <br>
                       </div>
                       <div class="col-md-12">
                         <label>Description</label>
                         <input type="text" name="description" id="description" class="form-control" placeholder="Enter your Description">
                         <br>
                       </div>
                       <div class="col-md-12">
                         <label>Schedule From <span class="text-danger">*</span></label>
                         <input type="date" name="start" id="start" class="form-control">
                         <br>
                       </div>
                       <div class="col-md-12">
                         <label>Schedule To <span class="text-danger">*</span></label>
                         <input type="date" name="end" id="end" class="form-control">
                         <br>
                       </div>
                       <div class="col-md-12">
                         <button type="submit" class="btn btnclr btn-md">Save</button>
                       </div>
                    </div>
               </div>
            </form>
      </div>
   </div>
</div>

<?php } if(in_array(BOOTSTRAP_MODALS['notifications'], $bootstrap_modals)) { ?>

<!-- Show Reminder Modal -->
<div class="modal fade" id="notifications" role="dialog">
   <div class="modal-dialog" role="document" style="width: 800px !important;">
      <!-- <div class="modal-dialog" role="document"> -->
    <form method="post" style="text-align: left !important;">
        <div class="modal-content">
            <div class="modal-header btnclr"  style="text-align:center;" >
                <a href="#" class="close closeUpdate" data-dismiss="modal">&times;</a>
                <h4 class="modal-title">Notification</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="tableNotificationAlerts">
                   <thead style="text-align:center;">
                        <tr>
                            <th>Period</th>
                            <th>Tax Due Date</th>
                            <th>Schedule Date</th>
                        </tr>
                   </thead>
                   <tbody>
                   </tbody>
                </table>
             </div>
             <div class="modal-footer">
                <a href="#" class="btn btnclr closeUpdate" data-dismiss="modal"><?php echo display('Close') ?> </a>
             </div>
            </div>
        </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<?php } ?>

<script>

var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
   // Payroll Insert Data
     $('#add_payroll_type').submit(function(e){
       e.preventDefault();
         var data = {
           data : $("#add_payroll_type").serialize()
         };
         data[csrfName] = csrfHash;
         $.ajax({
             type:'POST',
             data: $("#add_payroll_type").serialize(),
            dataType:"json",
             url:'<?php echo base_url();?>Cinvoice/add_paymentroll_type',
             success: function(data2, statut) {
          var $select = $('select#payroll_type');
               $select.empty();
               console.log(data);
                 for(var i = 0; i < data2.length; i++) {
                    console.log(data2);
           var option = $('<option/>').attr('value', data2[i].proll_type).text(data2[i].proll_type);
           $select.append(option); 
       }
         $('#new_payroll_type').val('');
         $("#bodyModal1").html("Payroll Added Successfully");
         $('#proll_type').modal('hide');
         $('#payroll_type').show();
          $('#myModal1').modal('show');
         window.setTimeout(function(){
           $('#proll_type').modal('hide');
          $('#myModal1').modal('hide');
       }, 2000);
        }
         });
     });


// Add Payment Type   
$("#add_pay_type").validate({
    rules: {
        new_payment_type: "required",
    },
    messages: {
        new_payment_type: "New Payment is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>chrm/add_payment_type", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(data1) {
                var $select = $('select#paytype');
                $select.empty(); 

                for(var i = 0; i < data1.length; i++) {
                    var option = $('<option/>').attr('value', data1[i].payment_type).text(data1[i].payment_type);
                    $select.append(option); 
                }

                $select.val(data1[data1.length - 1].payment_type);

                toastr.success('Payment Type has been saved successfully.', "Success", { 
                   closeButton: false,
                   timeOut: 1000
                });
                $('#payment_type').modal('hide');
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});
     
     
// Insert Employeee Type
$("#add_employee_type").validate({
    rules: {
        employee_type: "required",
    },
    messages: {
        employee_type: "New Employee Type is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>chrm/add_employee_type", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(data1) {
                var $select = $('select#emp_type');
                $select.empty(); 

                for(var i = 0; i < data1.length; i++) {
                    var option = $('<option/>').attr('value', data1[i].employee_type).text(data1[i].employee_type);
                    $select.append(option); 
                }

                $select.val(data1[data1.length - 1].employee_type);

                toastr.success('Employee Type has been saved successfully.', "Success", { 
                   closeButton: false,
                   timeOut: 1000
                });
                $('#employees_type').modal('hide');
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});


   // End Employee Type
   $(function() {  
      $("#instuc_p2").hide();
      $(".emply_form").hide();
      
      $(".next_pg").click(function(){  
         $("#instuc_p2").show();
         $("#instuc_p1").hide();
      });  

      $(".emply_form_btn").click(function(){
         $(".emply_form").show();
         $("#instuc_p2").hide();
         $("#instuc_p1").hide();
      })
   });  

   // Payroll Insert Data
$('#add_payroll_type').submit(function(e){
   e.preventDefault();
     var data = {
       data : $("#add_payroll_type").serialize()
     };
     data[csrfName] = csrfHash;
 
     $.ajax({
         type:'POST',
         data: $("#add_payroll_type").serialize(), 
        dataType:"json",
         url:'<?php echo base_url();?>Cinvoice/add_paymentroll_type',
         success: function(data2, statut) {
    
      var $select = $('select#payrolltype');
  
           $select.empty();
           console.log(data);
             for(var i = 0; i < data2.length; i++) {
                console.log(data2);
       var option = $('<option/>').attr('value', data2[i].payroll_type).text(data2[i].payroll_type);
       $select.append(option); 
   }
     $('#new_payroll_type').val('');
     $("#bodyModal1").html("Payroll Added Successfully");
     $('#payroll_type').modal('hide');
     
     $('#payrolltype').show();
      $('#myModal1').modal('show');
     window.setTimeout(function(){
       $('#payroll_type').modal('hide');
      $('#myModal1').modal('hide');
  
   }, 2000);
   
    }
     });
 });   
   
// End Payroll Type
   
// Add Designation    
$("#add_designation").validate({
    rules: {
        designation: "required",
    },
    messages: {
        designation: "New Designation is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>chrm/add_designation_data", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(data1) {
                var $select = $('select#desig');
                $select.empty(); 

                for(var i = 0; i < data1.length; i++) {
                    var option = $('<option/>').attr('value', data1[i].id).text(data1[i].designation);
                    $select.append(option); 
                }

                $select.val(data1[data1.length - 1].id);

                toastr.success('Designation has been saved successfully.', "Success", { 
                   closeButton: false,
                   timeOut: 1000
                });
                $('#designation_modal').modal('hide');
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});
   
// Add Bank   
$("#add_bank").validate({
    rules: {
        bank_name: "required",
        ac_name: "required",
        ac_no: "required",
        branch: "required"
    },
    messages: {
        bank_name: "Bank name is required",
        ac_name: "Account name is required",
        ac_no: "Account number is required",
        branch: "Branch is required"
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>chrm/add_bank", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(data) {
                var $select = $('select#bank_name');
                $select.empty(); 

                for (var i = 0; i < data.bankdata.length; i++) {
                    var option = $('<option/>').attr('value', data.bankdata[i].bank_name).text(data.bankdata[i].bank_name);
                    $select.append(option); 
                }

                var lastBankName = data.bankdata.length > 0 ? data.bankdata[data.bankdata.length - 1].bank_name : '';
                $select.val(lastBankName); 
                toastr.success(data.msg, "Success", { 
                   closeButton: false,
                   timeOut: 1000
                });
                $('#add_bank_info').modal('hide');
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});


// Insert Daily Break
$("#insert_daily_break").validate({
    rules: {
        dbreak: "required",
    },
    messages: {
        dbreak: "Daily Break is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>chrm/add_dailybreak_info", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(data1) {
                var $select = $('select.dailybreak');
                $select.empty(); 

                for(var i = 0; i < data1.length; i++) {
                    var option = $('<option/>').attr('value', data1[i].dailybreak_name).text(data1[i].dailybreak_name);
                    $select.append(option); 
                }
                $select.val(data1[data1.length - 1].dailybreak_name);
                toastr.success('Daily Break Added Successfully.', "Success", { 
                   closeButton: false,
                   timeOut: 1000
                });
                $('#dailybreak_add').modal('hide');
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});


// Add State
$("#addState").validate({
    rules: {
        state_name: "required",
    },
    messages: {
        state_name: "State Name is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/add_state", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status == 1){
                    toastr.success(response.message, "Success", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    $('#add_states').modal('hide');
                }else{
                    toastr.error(response.message, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

// Add StateTax

$("#addstatetax").validate({
    rules: {
        selected_state: "required",
        state_tax_name: "required"
    },
    messages: {
        selected_state: "State Name is required",
        state_tax_name: "Tax Name is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/add_state_tax", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status == 1){
                    toastr.success(response.message, "Success", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    $('#add_state_tax').modal('hide');
                }else{
                    toastr.error(response.message, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

// Add City
$("#cityTax").validate({
    rules: {
        city_name: "required",
    },
    messages: {
        city_name: "City Name is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/add_city", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status == 1){
                    toastr.success(response.message, "Success", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    $('#add_city_info').modal('hide');
                }else{
                    toastr.error(response.message, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

// Add City Tax
$("#addCityTax").validate({
    rules: {
        selected_city: "required",
        city_tax_name: "required"
    },
    messages: {
        selected_city: "City Name is required",
        city_tax_name: "City Tax name is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/add_city_state_tax", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status == 1){
                    toastr.success(response.message, "Success", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    $('#add_city_tax').modal('hide');
                }else{
                    toastr.error(response.message, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

// Add County
$("#addCounty").validate({
    rules: {
        county: "required"
    },
    messages: {
        county: "County name is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/add_county", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status == 1){
                    toastr.success(response.message, "Success", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    $('#add_county_info').modal('hide');
                }else{
                    toastr.error(response.message, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

// Add County Tax
$("#addCountyTax").validate({
    rules: {
        selected_county: "required",
        county_tax_name: "required"
    },
    messages: {
        selected_county: "County Name is required",
        county_tax_name: "County Tax name is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/add_county_tax", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status == 1){
                    toastr.success(response.message, "Success", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    $('#add_city_tax').modal('hide');
                }else{
                    toastr.error(response.message, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

document.addEventListener('change', function (event) {
    if (event.target && event.target.id === 'timesheetSelect') {
        var selectedId = event.target.value;
        var baseLink = '<?php echo base_url('chrm/w2Form/'); ?>';
        window.location.href = selectedId ? baseLink + selectedId : baseLink;
    }
});
document.addEventListener('change', function (event) {
    if (event.target && event.target.id === 'form941') {
        var selectedId = event.target.value;
        var baseLink = '<?php echo base_url('chrm/form941Form/'); ?>';
        window.location.href = selectedId ? baseLink + selectedId : baseLink;
    }
});
document.addEventListener('change', function (event) {
    if (event.target && event.target.id === 'timesheetSelect3') {
        var selectedId = event.target.value;
        var baseLink = '<?php echo base_url('chrm/formnj927/'); ?>';
        window.location.href = selectedId ? baseLink + selectedId : baseLink;
    }
});
document.addEventListener('change', function (event) {
    if (event.target && event.target.id === 'UC_2a_form') {
        var selectedId = event.target.value;
        var baseLink = '<?php echo base_url('chrm/UC_2a_form/'); ?>';
        window.location.href = selectedId ? baseLink + selectedId : baseLink;
    }
});
document.addEventListener('change', function (event) {
    if (event.target && event.target.id === 'timesheetSelecttwo') {
        var selectedId = event.target.value;
        var baseLink = '<?php echo base_url('chrm/formfl099nec/'); ?>';
        window.location.href = selectedId ? baseLink + selectedId : baseLink;
    }
});


// Select Notification Source
function selectSource(element) 
{
    var row = $(element).closest('tr');
    var source = $(element).val();

    if (source === 'EMAIL') {
        row.find('.select_email').show();
    } else {
        row.find('.select_email').hide();
    }
}


// Insert Reminder 
$("#notificationForm").validate({
    rules: {
        title: "required",
        select_date: "required",
        select_source: "required",
        select_email: "required",
    },
    messages: {
        title: "Title is required",
        select_date: "Date is required",
        select_source: "Source is required",
        select_email: "Email is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

        $('.disableButton').text("Loading...").prop('disabled', true);

        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Cweb_setting/insertreminder", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                if(response.status == 1){
                    toastr.success(response.msg, "Success", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                    $('#reminders').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }else{
                    toastr.error(response.msg, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

// Reminder Modal Popup in dashboard top Right Bell Icon to click Open Modal
function reminderModals() {
   
    var formData = new FormData();
    formData.append(csrfName, csrfHash);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Cweb_setting/showBellNotification", 
        data: formData, 
        dataType: "json",
        contentType: false, 
        processData: false,
        success: function(response) {
            var tableBody = $("#tableNotificationAlerts tbody");
            tableBody.empty();

            if (response && response.length > 0) {
                response.forEach(function(item) {
                    var formattedDatestart = changedateFormat(item.start);
                    var formattedDatedue_date = changedateFormat(item.due_date);
                    var row = `<tr>
                        <td>${item.title}</td>
                        <td>${formattedDatedue_date}</td>
                        <td>${formattedDatestart}</td>
                        <input type='hidden' class='schedule_id' name='schedule_id' value='${item.id}' />
                        <input type='hidden' class='user_id' name='user_id' value='${item.created_by}' />
                    </tr>`;
                    tableBody.append(row);
                });
            } else {
                var noDataRow = `<tr>
                    <td colspan="3" style="text-align:center;">No reminders available</td>
                </tr>`;
                tableBody.append(noDataRow);
            }
            $('.total_alerts').text(response && response.length > 0 ? response.length : 0);
        }
    });
}

// Close Reminder to Update Bell Notification
$(document).ready(function() {
    reminderModals();
    $('.closeUpdate').click(function() {
        $('#tableNotificationAlerts tbody tr').each(function() {
            var sch_id = $(this).find('.schedule_id').val(); 
            var user_id = $(this).find('.user_id').val();   

            if (sch_id && user_id) {
                var formData = new FormData();
                formData.append(csrfName, csrfHash); 
                formData.append('schedule_id', sch_id); 
                formData.append('user_id', user_id);   
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>Cweb_setting/updateBellNotification", 
                    data: formData, 
                    dataType: "json",
                    contentType: false, 
                    processData: false,
                    success: function(response) {
                        location.reload();
                        console.log("Response for Schedule ID:", sch_id, response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error for Schedule ID:", sch_id, status, error);
                    }
                });
            }
        });
    });
});

// Select Period To change quater wise due date
function selectPeriodDate() {
   var selectPeriod = $('#period').val();
   console.log("Selected Period: ", selectPeriod);
   var selectedDate = '';
   var currentYear = new Date().getFullYear();
   if (selectPeriod == 'Quater 1') {
     selectedDate = '01-05-' + currentYear;  // May 1st for Quarter 1
   } else if (selectPeriod == 'Quater 2') {
     selectedDate = '07-31-' + currentYear;// July 31st for Quarter 2
   } else if (selectPeriod == 'Quater 3') {
      selectedDate = '08-31-' + currentYear; // August 31st for Quarter 3
   } else if (selectPeriod == 'Quater 4') {
     selectedDate = '01-31-' + currentYear; // January 31st for Quarter 4 (next year)
   } else if (selectPeriod == 'Year') {
     selectedDate = '01-31-' + currentYear;  // December 31st for the year
   }
   $('#due_dates').val(selectedDate);
}

// Date Format Change Function 
function changedateFormat(dateString) 
{
    var date = new Date(dateString);
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var day = String(date.getDate()).padStart(2, '0');
    var year = date.getFullYear();
    return `${month}-${day}-${year}`;
}

// Validation in Add Reminder

$("#calanderaddreminder").validate({
    rules: {
        title: "required",
        description: "required",
        start: "required",
        end: "required",
    },
    messages: {
        title: "Title is required",
        description: "Description is required",
        start: "Start is required",
        end: "End is required",
    },
    errorPlacement: function(error, element) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next('span.select2')); 
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault();
        var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Cweb_setting/add_reminder", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
                if(response.status == 1){
                    toastr.success(response.msg, "Success", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                    $('#calanderreminders').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }else{
                    toastr.error(response.msg, "Error", { 
                       closeButton: false,
                       timeOut: 1000
                    });
                }
            },
            error: function (error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
            }
        });
    }
});

</script>

