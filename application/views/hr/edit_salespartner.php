<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/daterangepicker.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css')?>" />
<script src="<?php echo base_url('assets/js/toastr.min.js')?>" ></script>


<div class="content-wrapper">

   <style>
      .popup label{
      color:white;
      }
      .popup {
      border-top-right-radius: 20px;
      border-bottom-left-radius: 20px;
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border: 1px solid #000;
      padding: 20px;
      background-color: #fff;
      z-index: 9999;
      width: 90%;
      max-width: 800px;
      box-sizing: border-box;
      }
      .popup .row {
      margin-top: 10px;
      }
      .popup .col-sm-6 {
      width: 50%;
      box-sizing: border-box;
      }

      .popupsalespartner label{
      color:white;
      }
      .popupsalespartner {
      border-top-right-radius: 20px;
      border-bottom-left-radius: 20px;
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border: 1px solid #000;
      padding: 20px;
      background-color: #fff;
      z-index: 9999;
      width: 90%;
      max-width: 800px;
      box-sizing: border-box;
      }
      .popupsalespartner .row {
      margin-top: 10px;
      }
      .popupsalespartner .col-sm-6 {
      width: 50%;
      box-sizing: border-box;
      }
      input[type=number]::-webkit-inner-spin-button, 
      input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0; 
      }
      .select2-selection{
      display:none;
      }
      .btnclr{
      background-color:<?php echo $setting_detail[0]['button_color']; ?>;
      color: white;
      }
      .ui-selectmenu-text{
      display:none;
      }
   </style>
   <!-- New Employee Type -->

   <!-- <div class="row"> -->
   <div class="col-sm-12">
   <?php
      $message = $this->session->userdata('message');
      $error_message = $this->session->userdata('error_message');
      if (isset($message) || isset($error_message)) { ?>
          <script type="text/javascript">
              <?php if (isset($message)) { ?>
                  toastr.success("<?php echo $message; ?>", "Success", { closeButton: false });
              <?php $this->session->unset_userdata('message'); } ?>
              <?php if (isset($error_message)) { ?>
                  toastr.error("<?php echo $message; ?>", "Error", { closeButton: false });
              <?php $this->session->unset_userdata('error_message'); } ?>
          </script>
      <?php } ?>
      <div class="panel panel-bd lobidrag">
         <div class="panel-heading">
            <div class="panel-title" style="height:35px;">
               <div class="panel-title form_employee"  style="float:right ;">
                  <a href="<?php echo base_url('Chrm/manage_employee?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>"   style="color:white;" class="btnclr btn"><i class="ti-align-justify"> </i> Manage Sales Partner </a>
               </div>
            </div>
         </div>
         <!-- Sales Partner -->
          <div class="panel-body">
            <form id="salespartnerupdateForm" method="post" enctype="multipart/form-data">
            <div class="row">
               <!-- Left Side -->
               <div class="col-sm-6">
                  <div class="form-group row">
                     <label for="first_name" class="col-sm-4 col-form-div"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="first_name" class="form-control" type="text" placeholder="<?= display('first_name') ?>" id="first_name" value="<?= html_escape($employee_data[0]['first_name'])?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                        <input type="hidden" name="employee_id" value="<?= html_escape($employee_data[0]['id']);?>">
                        <input type="hidden" name="old_first_name" value="<?= html_escape($employee_data[0]['first_name'])?>">
                        <input type="hidden" name="company_id" value="<?= html_escape($_GET['id']);?>">
                        <input type="hidden" name="admin_id" value="<?= html_escape($_GET['admin_id']);?>">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="middle_name" class="col-sm-4 col-form-div"><?php echo "Middle Name"; ?></label>
                     <div class="col-sm-8">
                        <input name="middle_name" class="form-control" type="text" placeholder="<?= "Middle Name"; ?>" value="<?= html_escape($employee_data[0]['middle_name'])?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                        <input type="hidden" name="old_middle_name" value="<?= html_escape($employee_data[0]['middle_name'])?>">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="last_name" class="col-sm-4 col-form-div"><?php echo display('last_name') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="last_name" class="form-control" type="text" placeholder="<?= display('last_name') ?>" id="last_name" value="<?= html_escape($employee_data[0]['last_name'])?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                        <input type="hidden" name="old_last_name" value="<?= html_escape($employee_data[0]['last_name'])?>">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="last_name" class="col-sm-4 col-form-div"><?php echo ("Business Name") ?></label>
                     <div class="col-sm-8">
                        <input name="salesbusiness_name" class="form-control" type="text" placeholder="<?php echo "Business Name" ?>" id="salesbusiness_name" value="<?= html_escape($employee_data[0]['salesbusiness_name'])?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="phone" class="col-sm-4 col-form-div"><?php echo display('phone') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="phone" class="form-control" type="text" placeholder="<?= display('phone') ?>" id="phone" value="<?= html_escape($employee_data[0]['phone'])?>" oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Profile Image" class="col-sm-4 col-form-label">
                     Email 
                     </label>
                     <div class="col-sm-8">
                        <input name="email" class="form-control" type="email" placeholder="<?= display('email') ?>" id="email" value="<?= html_escape($employee_data[0]['email'])?>" oninput="validateEmail(this)">
                        <span id="validateemails" style="margin-top: 10px;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address_line_1" class="col-sm-4 col-form-div"><?php echo display('address_line_1') ?></label>
                     <div class="col-sm-8">
                        <textarea name="address_line_1" rows='1' class="form-control" placeholder="<?= display('address_line_1') ?>" id="address_line_1"><?= html_escape($employee_data[0]['address_line_1'])?></textarea> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address_line_2" class="col-sm-4 col-form-div"><?php echo display('address_line_2') ?></label>
                     <div class="col-sm-8">
                        <textarea name="address_line_2" rows='1' class="form-control" placeholder="<?= display('address_line_2') ?>" id="address_line_2"><?= html_escape($employee_data[0]['address_line_2'])?></textarea> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="city" class="col-sm-4 col-form-div"><?php echo display('city') ?></label>
                     <div class="col-sm-8">
                        <input name="city" class="form-control" type="text" placeholder="<?= display('city') ?>" id="city" value="<?= html_escape($employee_data[0]['city']);?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="state" class="col-sm-4 col-form-label"><?php echo display('state'); ?> <i class="text-danger"></i></label>
                     <div class="col-sm-8">
                        <input name="state" class="form-control" type="text" placeholder="<?= display('state') ?>" id="state" value="<?= html_escape($employee_data[0]['state']);?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo display('zip') ?></label>
                     <div class="col-sm-8">
                        <input name="zip" class="form-control" type="text" placeholder="<?= display('zip') ?>" id="zip" value="<?= html_escape($employee_data[0]['zip']);?>" oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="country" class="col-sm-4 col-form-div"><?php echo display('country') ?></label>
                     <div class="col-sm-8">
                        <select name="country" class="form-control">
                           <option value="">Select Country</option>
                           <?php foreach($country_data as $value) { ?>
                              <option value="<?= $value['name']; ?>" <?= ((!empty($employee_data[0]['country']) && ($employee_data[0]['country'] == $value['name'])) ? 'selected' : ''); ?> > <?= $value['name']; ?> </option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="emergencycontact" class="col-sm-4 col-form-label"> <?php echo "Emergency Contact Person" ?> </label>
                     <div class="col-sm-8">
                        <input class="form-control" name="emergencycontact" id="emergencycontact" type="text"  style="border:2px solid #D7D4D6;"   placeholder="Emergency Contact person" value="<?= html_escape($employee_data[0]['emergencycontact'])?>"  oninput="limitAlphabetical(this, 20)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="emergencycontactnum" class="col-sm-4 col-form-label"> <?php echo "Emergency Contact  number" ?> </label>
                     <div class="col-sm-8">
                        <input class="form-control" name="emergencycontactnum" id="emergencycontactnum" type="number"  style="border:2px solid #D7D4D6;"   placeholder="Emergency Contact  number" value="<?= html_escape($employee_data[0]['emergencycontactnum'])?>"  oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
               </div>
               <!-- Right Side -->
               <div class="col-sm-6">
                  <div class="form-group row" id="payment_from">
                     <label for="city" class="col-sm-4 col-form-div"><?php echo  ('Sales Commission') ?></label>
                     <div class="col-sm-8">
                        <input name="sc" class="form-control" type="text"  value="<?= html_escape($employee_data[0]['sc']);?>" placeholder="<?php echo 'Sales Commission Percentage' ?>" oninput="salesCommisionInput(this)">
                     </div>
                  </div>
                  <div class="form-group row" id="payment_from">
                     <label for="choice" class="col-sm-4 col-form-div">Commission Withholding</label>
                     <div class="col-sm-8">
                        <input type="radio" name="choice" value="Yes" <?= ($employee_data[0]['choice'] == "Yes") ? 'checked' : ''; ?>> Yes &nbsp;
                        <input type="radio" name="choice" value="No" <?= ($employee_data[0]['choice'] == "No") ? 'checked' : ''; ?>> No
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="email" class="col-sm-4 col-form-div">Social security number <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input id="ssnInput" name="ssn" class="form-control" type="text" value="<?= $employee_data[0]['social_security_number'];?>" placeholder="Social security number" required oninput="exitsocialsecurity(this, 9)">
                     </div>
                     <br><br>
                     <span style="margin-left: 532px; font-weight: bold;">(OR)</span>
                  </div>
                  <div class="form-group row">
                     <label for="hourly_rate_or_salary" id="cost" class="col-sm-4 col-form-div"><?php echo ('Federal Identification Number') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input id="federalInput" name="federalidentificationnumber" class="form-control" type="text" placeholder="Federal Identification Number" value="<?= $employee_data[0]['federalidentificationnumber'];?>" oninput="exitsocialsecurity(this, 9)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="hourly_rate_or_salary" id="cost" class="col-sm-4 col-form-div"><?php echo ('Federal Tax Classification') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select name="federaltaxclassification" id="federaltaxclassification" class="form-control" style="width: 100%;" required>
                           <option value="">Select Federal Tax Classification</option>
                           <option value="Individual/sole proprietor" <?= ($employee_data[0]['federaltaxclassification'] == "Individual/sole proprietor") ? 'selected' : ''; ?>>Individual/sole proprietor</option>
                           <option value="C corporation" <?= ($employee_data[0]['federaltaxclassification'] == "C corporation") ? 'selected' : ''; ?>>C corporation</option>
                           <option value="S corporation" <?= ($employee_data[0]['federaltaxclassification'] == "S corporation") ? 'selected' : ''; ?>>S corporation</option>
                           <option value="Partnership" <?= ($employee_data[0]['federaltaxclassification'] == "Partnership") ? 'selected' : ''; ?>>Partnership</option>
                           <option value="Trust/estate" <?= ($employee_data[0]['federaltaxclassification'] == "Trust/estate") ? 'selected' : ''; ?>>Trust/estate</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row"  id="payment_from">
                     <label for="paytype" class="col-sm-4 col-form-label"> Payment Type </label>
                     <div class="col-sm-8">
                        <select name="paytype"  id="paytype" class="form-control" style="width: 100%;" >
                           <option value="<?= html_escape($employee_data[0]['rate_type'])?>"><?= html_escape($employee_data[0]['rate_type'])?></option>
                           <option value="Cheque">Cheque</option>
                           <option value="Direct Deposit">Direct Deposit</option>
                           <option value="Cash">Cash</option>
                           <?php  foreach($paytype as $ptype){ ?>
                           <option value="<?= $ptype['payment_type'] ;?>"><?= $ptype['payment_type'] ;?></option>
                           <?php  } ?>
                        </select>
                     </div>
                  </div>
                  
                  <div class="form-group row" id="bank_name">
                     <label for="bank_name" class="col-sm-4 col-form-label"> <?php echo display('Bank') ?>  </label>
                     <div class="col-sm-8">
                        <select name="bank_name" id="bank_name"  class="form-control bankpayment">
                           <option value="<?= $employee_data[0]['bank_name']; ?>" <?php if($employee_data[0]['bank_name']) { echo 'selected'; } ?>><?= $employee_data[0]['bank_name']; ?>
                           </option>
                           <option value="NA">NA (Not Applicable)</option>
                           <option value="JPMorgan Chase">JPMorgan Chase</option>
                           <option value="New York City">New York City</option>
                           <option value="Bank of America">Bank of America</option>
                           <option value="Citigroup">Citigroup</option>
                           <option value="Wells Fargo">Wells Fargo</option>
                           <option value="Goldman Sachs">Goldman Sachs</option>
                           <option value="Morgan Stanley">Morgan Stanley</option>
                           <option value="U.S. Bancorp">U.S. Bancorp</option>
                           <option value="PNC Financial Services">PNC Financial Services</option>
                           <option value="Truist Financial">Truist Financial</option>
                           <option value="Charles Schwab Corporation">Charles Schwab Corporation</option>
                           <option value="TD Bank, N.A.">TD Bank, N.A.</option>
                           <option value="Capital One">Capital One</option>
                           <option value="The Bank of New York Mellon">The Bank of New York Mellon</option>
                           <option value="State Street Corporation">State Street Corporation</option>
                           <option value="American Express">American Express</option>
                           <option value="Citizens Financial Group">Citizens Financial Group</option>
                           <option value="HSBC Bank USA">HSBC Bank USA</option>
                           <option value="SVB Financial Group">SVB Financial Group</option>
                           <option value="First Republic Bank ">First Republic Bank </option>
                           <option value="Fifth Third Bank">Fifth Third Bank</option>
                           <option value="BMO USA">BMO USA</option>
                           <option value="USAA">USAA</option>
                           <option value="UBS">UBS</option>
                           <option value="M&T Bank">M&T Bank</option>
                           <option value="Ally Financial">Ally Financial</option>
                           <option value="KeyCorp">KeyCorp</option>
                           <option value="Huntington Bancshares">Huntington Bancshares</option>
                           <option value="Barclays">Barclays</option>
                           <option value="Santander Bank">Santander Bank</option>
                           <option value="RBC Bank">RBC Bank</option>
                           <option value="Ameriprise">Ameriprise</option>
                           <option value="Regions Financial Corporation">Regions Financial Corporation</option>
                           <option value="Northern Trust">Northern Trust</option>
                           <option value="BNP Paribas">BNP Paribas</option>
                           <option value="Discover Financial">Discover Financial</option>
                           <option value="First Citizens BancShares">First Citizens BancShares</option>
                           <option value="Synchrony Financial">Synchrony Financial</option>
                           <option value="Deutsche Bank">Deutsche Bank</option>
                           <option value="New York Community Bank">New York Community Bank</option>
                           <option value="Comerica">Comerica</option>
                           <option value="First Horizon National Corporation">First Horizon National Corporation</option>
                           <option value="Raymond James Financial">Raymond James Financial</option>
                           <option value="Webster Bank">Webster Bank</option>
                           <option value="Western Alliance Bank">Western Alliance Bank</option>
                           <option value="Popular, Inc.">Popular, Inc.</option>
                           <option value="CIBC Bank USA">CIBC Bank USA</option>
                           <option value="East West Bank">East West Bank</option>
                           <option value="Synovus">Synovus</option>
                           <option value="Valley National Bank">Valley National Bank</option>
                           <option value="Credit Suisse ">Credit Suisse </option>
                           <option value="Mizuho Financial Group">Mizuho Financial Group</option>
                           <option value="Wintrust Financial">Wintrust Financial</option>
                           <option value="Cullen/Frost Bankers, Inc.">Cullen/Frost Bankers, Inc.</option>
                           <option value="John Deere Capital Corporation">John Deere Capital Corporation</option>
                           <option value="MUFG Union Bank">MUFG Union Bank</option>
                           <option value="BOK Financial Corporation">BOK Financial Corporation</option>
                           <option value="Old National Bank">Old National Bank</option>
                           <option value="South State Bank">South State Bank</option>
                           <option value="FNB Corporation">FNB Corporation</option>
                           <option value="Pinnacle Financial Partners">Pinnacle Financial Partners</option>
                           <option value="PacWest Bancorp">PacWest Bancorp</option>
                           <option value="TIAA">TIAA</option>
                           <option value="Associated Banc-Corp">Associated Banc-Corp</option>
                           <option value="UMB Financial Corporation">UMB Financial Corporation</option>
                           <option value="Prosperity Bancshares">Prosperity Bancshares</option>
                           <option value="Stifel">Stifel</option>
                           <option value="BankUnited">BankUnited</option>
                           <option value="Hancock Whitney">Hancock Whitney</option>
                           <option value="MidFirst Bank">MidFirst Bank</option>
                           <option value="Sumitomo Mitsui Banking Corporation">Sumitomo Mitsui Banking Corporation</option>
                           <option value="Beal Bank">Beal Bank</option>
                           <option value="First Interstate BancSystem">First Interstate BancSystem</option>
                           <option value="Commerce Bancshares">Commerce Bancshares</option>
                           <option value="Umpqua Holdings Corporation">Umpqua Holdings Corporation</option>
                           <option value="United Bank (West Virginia)">United Bank (West Virginia)</option>
                           <option value="Texas Capital Bank">Texas Capital Bank</option>
                           <option value="First National of Nebraska">First National of Nebraska</option>
                           <option value="FirstBank Holding Co">FirstBank Holding Co</option>
                           <option value="Simmons Bank">Simmons Bank</option>
                           <option value="Fulton Financial Corporation">Fulton Financial Corporation</option>
                           <option value="Glacier Bancorp">Glacier Bancorp</option>
                           <option value="Arvest Bank">Arvest Bank</option>
                           <option value="BCI Financial Group">BCI Financial Group</option>
                           <option value="Ameris Bancorp">Ameris Bancorp</option>
                           <option value="First Hawaiian Bank">First Hawaiian Bank</option>
                           <option value="United Community Bank">United Community Bank</option>
                           <option value="Bank of Hawaii">Bank of Hawaii</option>
                           <option value="Home BancShares">Home BancShares</option>
                           <option value="Eastern Bank">Eastern Bank</option>
                           <option value="Cathay Bank">Cathay Bank</option>
                           <option value="Pacific Premier Bancorp">Pacific Premier Bancorp</option>
                           <option value="Washington Federal">Washington Federal</option>
                           <option value="Customers Bancorp">Customers Bancorp</option>
                           <option value="Atlantic Union Bank">Atlantic Union Bank</option>
                           <option value="Columbia Bank">Columbia Bank</option>
                           <option value="Heartland Financial USA">Heartland Financial USA</option>
                           <option value="WSFS Bank">WSFS Bank</option>
                           <option value="Central Bancompany">Central Bancompany</option>
                           <option value="Independent Bank">Independent Bank</option>
                           <option value="Hope Bancorp">Hope Bancorp</option>
                           <option value="SoFi">SoFi</option>
                           <?php foreach($bank_data as $bank){  ?>
                           <option value="<?php  echo $bank['bank_name'] ;?>"><?php  echo $bank['bank_name'] ;?></option>
                           <?php  } ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="blood_group" class="col-sm-4 col-form-div">Routing number </label>
                     <div class="col-sm-8">
                        <input name="routing_number" class="form-control" type="text" placeholder="Routing number" value="<?= $employee_data[0]['routing_number'];?>" oninput="routingrestrict(this, 15)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo 'Account Number' ?></label>
                     <div class="col-sm-8">
                        <input type="text" name="account_number" class="form-control" value="<?= $employee_data[0]['account_number'];?>" placeholder="Account Number" oninput="routingrestrict(this, 15)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo ('Employee Tax') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select  name="emp_tax_detail" id="emp_tax_detail" class="form-control" required>
                           <option value="<?= html_escape($employee_data[0]['employee_tax'])?>"><?= html_escape($employee_data[0]['employee_tax'])?></option>
                           <option value="single">Single</option>
                           <option value="tax_filling">Tax Filling</option>
                           <option value="married">Married</option>
                           <option value="head_household">Head Household</option>
                        </select>
                     </div>
                  </div>
                  <div id="popupsalespartner" class="btnclr popupsalespartner">
                     <!-- Popup content -->
                     <div class="row">
                        <!-- Working Taxes -->
                        <div class="col-sm-6">
                           <h4 style="text-align:center;margin-left: 140px;">WORK LOCATION TAXES</h4>
                           <br>
                           <div class="form-group fg" >
                              <label for="stateTaxDropdown">State Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_tax" name="state_tax" id="stateTaxDropdown"  value="<?= html_escape($employee_data[0]['working_state_tax'])?>"   class="form-control">
                              <datalist id="magic_state_tax">
                                 <?php foreach ($state_tx as $st) { ?>
                                 <option value="<?= $st['state']; ?>"><?= $st['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="localTaxDropdown">City Tax<i class="text-danger">*</i></label>
                              <input list="magic_local_tax" name="city_tax" id="localTaxDropdown"  value="<?= html_escape($employee_data[0]['working_city_tax'])?>"    class="form-control">
                              <datalist id="magic_local_tax">
                                 <?php foreach ($get_info_city_tax as $gtct) { ?>
                                 <option value="<?= $gtct['state']; ?>"><?= $gtct['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="stateLocalTaxDropdown">County Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_local_tax" name="county_tax" id="stateLocalTaxDropdown"  value="<?= html_escape($employee_data[0]['working_county_tax'])?>"   class="form-control">
                              <datalist id="magic_state_local_tax">
                                 <?php foreach ($get_info_county_tax as $gtcty) { ?>
                                 <option value="<?= $gtcty['state']; ?>"><?= $gtcty['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="stateTax2Dropdown">Other Working Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_tax_2" name="other_working_tax" id="stateTax2Dropdown"   value="<?= html_escape($employee_data[0]['working_other_tax'])?>"  class="form-control">
                           </div>
                        </div>
                        <!-- Living Taxes -->
                        <div class="col-sm-6">
                           <h4 style="text-align:center;margin-left:140px;">LIVING LOCATION TAXES</h4>
                           <br>
                           <div class="form-group fg">
                              <label for="livingStateTax">State Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_state_tax" name="living_state_tax"  value="<?= html_escape($employee_data[0]['living_state_tax'])?>"    id="livingStateTax" class="form-control">
                              <datalist id="magic_living_state_tax">
                                 <?php foreach ($state_tx as $st) { ?>
                                 <option value="<?= $st['state']; ?>"><?= $st['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingCityTax">City Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_city_tax" name="living_city_tax" id="livingCityTax"  value="<?= html_escape($employee_data[0]['living_city_tax'])?>"   class="form-control">
                              <datalist id="magic_living_city_tax">
                                 <?php foreach ($get_info_city_tax as $gtct) { ?>
                                 <option value="<?= $gtct['state']; ?>"><?= $gtct['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingCountyTax">County Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_county_tax" name="living_county_tax" id="livingCountyTax"   value="<?= html_escape($employee_data[0]['living_county_tax'])?>"      class="form-control">
                              <datalist id="magic_living_county_tax">
                                 <?php foreach ($get_info_county_tax as $gtcty) { ?>
                                 <option value="<?= $gtcty['state']; ?>"><?= $gtcty['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingOtherTax">Other Living Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_other_tax" name="other_living_tax" id="livingOtherTax"  value="<?= html_escape($employee_data[0]['living_other_tax'])?>"   class="form-control">
                           </div>
                        </div>
                     </div>
                     <br>
                     <div style='float:right;font-weight:bold;'>
                        <!-- Button to add popup data -->
                        <button type="button"   style="background-color:green;margin-left: 335px;width:60px;"  class="btn btnclr"   id="addPopupsalespartnerData">Save</button>
                        <button type="button" class="btn btn-danger" onclick="closeModalsalepartner()">Close</button>
                     </div>
                     <br>
                     <br>
                  </div>
                  <div class="form-group row">
                     <label for="withholding_tax" class="col-sm-4 col-form-label">Withholding Tax <span class="text-danger">*</span></label>
                     <div class="col-sm-8">
                        <button type="button" class="btnclr btn" id="showPopupsalespartner">Add Withholding Tax</button>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="ETA" class="col-sm-4 col-form-label"><?php echo display('Attachments') ?></label>
                        <div class="col-sm-6">
                           <p>
                              <label for="salesattachment">
                              <a class="btnclr btn text-light" role="button" aria-disabled="false"><i class="fa fa-upload"></i>&nbsp; Choose Files</a>
                              </label>
                              <input type="file" name="salespartnerfiles[]" id="salesattachment" class="upload" style="visibility: hidden; position: absolute;" multiple accept=".pdf, .docx, .txt, .png, .jpg"/>
                              <input type="hidden" name="old_salespartnerimage" value="<?= html_escape($employee_data[0]['files']);?>">
                           </p>
                           <p id="salesfiles-area">
                              <span id="salesfilesList"><span id="salesfiles-names"></span></span>
                           </p>
                           <?php
                              echo '<div class="file-container">';
                              foreach ($employee_data as $attachment) {
                                 $Final_files = explode(",", $attachment['files']);
                                 foreach ($Final_files as $file) {
                                    $encoded_file = rawurlencode(trim($file));
                                    echo '<span class="file-item"><a href="' . base_url() . 'assets/uploads/salespartner/' . $encoded_file . '" target="_blank">' . trim($file) . '</a></span>';

                                    echo '<input type="hidden" name="old_salespartnerimage[]" value="' . trim($file) . '">';
                                 }
                              }
                              echo '</div>';
                           ?>
                        </div>
                  </div>

                  <div class="form-group row"  id="payrolltype">
                     <label for="profile_image" class="col-sm-4 col-form-label">
                     Profile Image
                     </label>
                     <div class="col-sm-8">
                        <input type="file" name="profile_image" class="form-control" accept=".png, .jpg, .jpeg">
                        <input type="hidden" name="old_profileimage" value="<?= html_escape($employee_data[0]['profile_image']);?>">
                        <br>
                        <input type="hidden" name="form_type" value="<?= $employee_data[0]['sales_partner']; ?>">
                        <?php
                        $profile_image_path = !empty($employee_data[0]['profile_image']) ? base_url('assets/uploads/profile/salespartner/') . $employee_data[0]['profile_image'] : '';
                        ?>
                        <?php if ($profile_image_path): ?>
                           <img src="<?= $profile_image_path; ?>" height="80px" width="80px">
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <br><br><br>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <button type="submit" id="checkSubmit" class="btnclr btn btn-success w-md m-b-5"><?php echo display('save') ?></button> 
                  </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
   </section>
</div>

<script type="text/javascript">
   const sales = new DataTransfer();
      $("#salesattachment").on('change', function(e){
          for(var i = 0; i < this.files.length; i++){
              let fileBloc = $('<span/>', {class: 'file-block'}),
                   fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
              fileBloc.append('<span class="file-delete"><span><i class="fa fa-trash-o"></i></span></span>')
                  .append(fileName);
              $("#salesfilesList > #salesfiles-names").append(fileBloc);
          };
          for (let file of this.files) {
              sales.items.add(file);
          }
          this.files = sales.files;
      
          $('span.file-delete').click(function(){
              let name = $(this).next('span.name').text();
              $(this).parent().remove();
              for(let i = 0; i < sales.items.length; i++){
                  if(name === sales.items[i].getAsFile().name){
                      sales.items.remove(i);
                      continue;
                  }
              }
              document.getElementById('salesattachment').files = sales.files;
          });
      });
      
      // Sales Partner
      document.getElementById("showPopupsalespartner").addEventListener("click", function() {
         document.getElementById("popupsalespartner").style.display = "block";
      });
   
      function closeModalsalepartner() {
         document.getElementById("showPopupsalespartner").style.display = "none";
      }
   
      document.getElementById("addPopupsalespartnerData").addEventListener("click", function() {
         document.getElementById("popupsalespartner").style.display = "none";
      });
      
      function closeModalsalepartner() {
         document.getElementById("popupsalespartner").style.display = "none";
      }
       
   
      // Validate Email
      function validateEmail(input) {
         var regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
         var submitButton = document.getElementById("checkSubmit");
          input.addEventListener("input", function(event) {
              var value = input.value;
              var newValue = '';
              for (var i = 0; i < value.length; i++) {
                  var char = value.charAt(i);
                  if (/[@._A-Za-z0-9-]/.test(char) || event.shiftKey) {
                      newValue += char;
                  }
              }
              input.value = newValue;

              var isValid = regex.test(input.value);
              
              if (isValid) {
                  var lastPart = input.value.split('.').pop();
                  if (lastPart !== 'com' && lastPart !== 'in') {
                      isValid = false;
                  }
              }

              if (isValid) {
                  document.getElementById("validateemails").style.color = "green";
                  document.getElementById("validateemails").textContent = "Valid email address";
                  submitButton.disabled = false;
              } else {
                  document.getElementById("validateemails").style.color = "red";
                  document.getElementById("validateemails").textContent = "Invalid email address";
                  submitButton.disabled = true;
              }
          });
      }
   
      // Allow Numbers
      function validateInput(input) {
         input.value = input.value.replace(/[^0-9.]/g, '');
      }
   
      function exitnumbers(input, maxLength) {
         input.value = input.value.replace(/\D/g, '');
         if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
         }
      }
   
      // Only Allow 20 Characters
      function limitAlphabetical(input, maxLength) {
         input.value = input.value.replace(/[^A-Za-z ]/g, '');
   
         if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
         }
      }
   
      // Sales Commision allow 2 digits
      function exitsalecommission(input, maxLength) {
         input.value = input.value.replace(/\D/g, '');
         if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
         }
      }

      // Social Security number 
      function exitsocialsecurity(input, maxLength) {
         input.value = input.value.replace(/\D/g, '');
         if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
         }
      }

      // Routing Number
      function routingrestrict(input, maxLength) {
         input.value = input.value.replace(/\D/g, '');
         if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
         }
      }

      // sales Commision Input
      function salesCommisionInput(input) {
         const value = input.value;
         const validValue = value.match(/^\d*%?$/);
         if (!validValue) {
            input.value = value.slice(0, -1); 
         }
      }
</script>

<script type="text/javascript">
// Sales Partner
var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';
$(document).ready(function () {
   $("#salespartnerupdateForm").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            phone: "required",
            federaltaxclassification: "required",
            emp_tax_detail: "required",
            ssn: {
               minlength: 9,
               digits: true
            },
            federalidentificationnumber: {}
        },
        messages: {
            first_name: "First name is required",
            last_name: "Last name is required",
            phone: "Phone is required",
            federaltaxclassification: "Federal Tax Classification is required",
            emp_tax_detail: "Employee Tax is required",
            ssn: {
               required: "Social Security Number is required",
               minlength: "Social Security Number must be at least 9 digits",
               digits: "Social Security Number must contain only numeric characters"
            },
            federalidentificationnumber: {
               required: "Federal Identification Number is required"
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            formData.append(csrfName, csrfHash);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>chrm/update_salesPartner",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                  console.log(response, "response");
                    if (response.status == 1) {
                        toastr.success(response.msg, "Success", {
                           closeButton: false,
                           timeOut: 1000
                        });
                        setTimeout(function () {
                           window.location.href = "<?= base_url('Chrm/manage_employee?id='); ?>" +
                                "<?= $_GET['id']; ?>" +
                                "&admin_id=" + "<?= $_GET['admin_id']; ?>";
                        }, 1000);
                    } else {
                        toastr.error(response.msg, "Error", {
                           closeButton: false,
                           timeOut: 3000
                        });
                    }
                },
                error: function(xhr, status, error) {
                  var errorMsg = xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : "An error occurred.";
                  toastr.error(errorMsg, "Error", {
                     closeButton: false,
                     timeOut: 1000
                  });
               }
            });
        }
    });

   $('#ssnInput, #federalInput').on('keyup', function () {
      const ssnInput = $('#ssnInput');
      const federalInput = $('#federalInput');
      const form = $("#salespartnerInsertForm").validate();

      const ssnLength = ssnInput.val().trim().length;
      const federalLength = federalInput.val().trim().length;

      if ($(this).attr('id') === 'ssnInput' && ssnLength > 0) {
         federalInput.val('');
      } else if ($(this).attr('id') === 'federalInput' && federalLength > 0) {
         ssnInput.val('');
      }

      ssnInput.removeAttr('required');
      federalInput.removeAttr('required');

      if (ssnLength === 0 && federalLength === 0) {
         ssnInput.attr('required', true); 
      } else if (ssnLength === 0) {
         federalInput.attr('required', true); 
      } else if (federalLength === 0) {
         ssnInput.attr('required', true); 
      }

      form.settings.rules.ssn.required = ssnLength === 0 && federalLength === 0;
      form.settings.rules.federalidentificationnumber.required = federalLength === 0 && ssnLength === 0;

      form.element('#ssnInput');
      form.element('#federalInput');
   });


});
</script>

<style>
   #files-area{
      margin: 0 auto;
   }
   .file-block{
      border-radius: 10px;
      background-color: #38469f;
      margin: 5px;
      color: #fff;
      display: inline-flex;
      padding: 4px 10px 4px 4px;
   }
   .file-delete{
      display: flex;
      width: 24px;
      color: initial;
      background-color: #38469f;
      font-size: large;
      justify-content: center;
      margin-right: 3px;
      cursor: pointer;
      color: #fff;
   }
   span.name{
      position: relative;
      top: 2px;
   }
   .btn-primary {
      color: #fff;
      background-color: #38469f !important;
      border-color: #38469f !important;
   }
   .fg {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
   }
   .fg label {
      width: 40%;
   }
   .fg input {
      width: 60%;
   }
   .file-container {
   display: flex;          
   flex-wrap: wrap;        
   gap: 14px;             
   }

   .file-item {
      max-width: 150px;       
      white-space: nowrap;    
      overflow: hidden;      
      text-overflow: ellipsis; 
      display: inline-block;  
   }

   .file-item a {
      text-decoration: none;  
      color: #424f5c;         
      font-size: 14px;        
   }
</style>