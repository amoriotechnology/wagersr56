<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/daterangepicker.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css')?>" />
<script src="<?php echo base_url('assets/js/toastr.min.js')?>" ></script>


<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1 id="headpartemployeeadd"><?php echo ('Add Employee') ?></h1>
         <h1 id="headpartsalespartner" style="display: none;"><?php echo ('Add Sales Partner') ?></h1>
         <small></small>
         <ol class="breadcrumb">
            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li><a href="#"><?php echo display('hrm') ?></a></li>
            <li class="active" style="color:orange display: none;"><?php echo html_escape($title) ?></li>
         </ol>
      </div>
   </section>

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
                <div class="panel-title form_employee"  style="float:left ;">
                  <div class="row"> 
                     <div class="col-md-6">
                        <label for="ISF" class="col-form-label" style="font-size: 14px; margin-top: 7px;"><?php echo('Select Employee / Sales Partner');?>
                        <i class="text-danger">*</i>
                        </label>
                     </div>
                     <div class="col-md-6">
                        <select class="form-control" id="selectemployeeTypes" required>
                           <option value="">Select Employee / Sales Partner</option>
                           <option value="addEmployees">Employee</option>
                           <option value="salesPartner">Sales Partner</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="panel-title form_employee"  style="float:right ;">
                  <a href="<?php echo base_url('Chrm/manage_employee?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>"   style="color:white;" class="btnclr btn"><i class="ti-align-justify"> </i> Manage Employee </a>
               </div>
            </div>
         </div>

         <!-- Create Employee -->
         <div class="panel-body" id="employeeForms" style="display: none;">
            <form id="employeeInsertForm" method="post" enctype="multipart/form-data">
            <div class="row">
               <!-- Left Side -->
               <div class="col-sm-6">
                  <div class="form-group row">
                     <label for="first_name" class="col-sm-4 col-form-div"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="company_id"/>
                         <input type="hidden" value="<?php echo $_GET['admin_id'] ?>" name="admin_id"/>
                        <input name="first_name" class="form-control" type="text" placeholder="<?php echo display('first_name') ?>" required oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="middle_name" class="col-sm-4 col-form-div"><?php echo "Middle Name"; ?></label>
                     <div class="col-sm-8">
                        <input name="middle_name" class="form-control" type="text" placeholder="<?php echo "Middle Name"; ?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="last_name" class="col-sm-4 col-form-div"><?php echo display('last_name') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="last_name" class="form-control" type="text" placeholder="<?php echo display('last_name') ?>" required oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row" id="designation">
                     <label for="designation" class="col-sm-4 col-form-label"> <?php echo display('designation') ?> <i class="text-danger">*</i> </label>
                     <div class="col-sm-7">
                        <select name="designation" id="desig" class="form-control" style="width: 100%;"required>
                           <option value="">Select Designation</option>
                           <?php foreach($desig as $ds){ ?>
                           <option value="<?php echo $ds['id'] ;?>"><?php echo $ds['designation'] ;?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-sm-1">
                        <a class="btnclr client-add-btn btn clearValue" aria-hidden="true" data-toggle="modal" data-target="#designation_modal"><i class="fa fa-plus"></i></a>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="phone" class="col-sm-4 col-form-div"><?php echo display('phone') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="phone" class="form-control" type="number" placeholder="<?php echo display('phone') ?>" id="phone" oninput="exitnumbers(this, 10)" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Profile Image" class="col-sm-4 col-form-label">
                     Email 
                     </label>
                     <div class="col-sm-8">
                        <input name="email" class="form-control" type="email" placeholder="<?php echo display('email') ?>" id="email" oninput="validateEmail(this)">
                        <span id="validateemails" style="margin-top: 10px;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address_line_1" class="col-sm-4 col-form-div"><?php echo display('address_line_1') ?></label>
                     <div class="col-sm-8">
                        <textarea name="address_line_1" rows='1' class="form-control" placeholder="<?php echo display('address_line_1') ?>" id="address_line_1"></textarea> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address_line_2" class="col-sm-4 col-form-div"><?php echo display('address_line_2') ?></label>
                     <div class="col-sm-8">
                        <textarea name="address_line_2" rows='1' class="form-control" placeholder="<?php echo display('address_line_2') ?>" id="address_line_2"></textarea> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="city" class="col-sm-4 col-form-div"><?php echo display('city') ?></label>
                     <div class="col-sm-8">
                        <input name="city" class="form-control" type="text" placeholder="<?php echo display('city') ?>" id="city" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="state" class="col-sm-4 col-form-label"><?php echo display('state'); ?> <i class="text-danger"></i></label>
                     <div class="col-sm-8">
                        <input class="form-control" name="state" id="state" type="text" style="border:2px solid #D7D4D6;"    placeholder="<?php echo display('state') ?>"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo display('zip') ?></label>
                     <div class="col-sm-8">
                        <input name="zip" class="form-control" type="text" placeholder="<?php echo display('zip') ?>" id="zip" oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="country" class="col-sm-4 col-form-div"><?php echo display('country') ?></label>
                     <div class="col-sm-8">
                        <select name="country" class="form-control">
                        <option value="">Select Country</option>
                           <?php foreach($country_data as $value) { ?>
                              <option value="<?= $value['name']; ?>" <?= $value['name'] === 'UNITED STATES' ? 'selected' : ''; ?>> <?= $value['name']; ?> 
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="emergencycontact" class="col-sm-4 col-form-label"> <?php echo "Emergency Contact Person" ?> </label>
                     <div class="col-sm-8">
                        <input class="form-control" name="emergencycontact" id="emergencycontact" type="text"  style="border:2px solid #D7D4D6;"   placeholder="Emergency Contact person"  oninput="limitAlphabetical(this, 20)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="emergencycontactnum" class="col-sm-4 col-form-label"> <?php echo "Emergency Contact  number" ?> </label>
                     <div class="col-sm-8">
                        <input class="form-control" name="emergencycontactnum" id="emergencycontactnum" type="number"  style="border:2px solid #D7D4D6;"   placeholder="Emergency Contact  number"  oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
               </div>
               <!-- Right Side -->
               <div class="col-sm-6">
                  <div class="form-group row">
                     <label for="employee_type" class="col-sm-4 col-form-div">
                     Employee Type <i class="text-danger">*</i>
                     </label>
                     <div class="col-sm-7">
                        <select  name="employee_type" id="emp_type" class="required form-control" required>
                           <option value="">Select Employee Type</option>
                           <option value="Full Time (W4)">Full Time (W4)</option>
                           <option value="Part time">Part time</option>
                           <?php foreach($emp_data as $emp_type){ ?>
                           <option value="<?php  echo $emp_type['employee_type'] ;?>"><?php  echo $emp_type['employee_type'] ;?></option>
                           <?php  } ?>
                        </select>
                     </div>
                     <div class="col-sm-1">
                        <a  class="btnclr client-add-btn btn clearEmpType" aria-hidden="true"   data-toggle="modal" data-target="#employees_type" ><i class="fa fa-plus"></i></a>
                     </div>
                  </div>
                  <div class="form-group row" id="payment_from">
                     <label for="city" class="col-sm-4 col-form-div"><?php echo  ('Sales Commission') ?></label>
                     <div class="col-sm-8">
                        <input name="sc" class="form-control" type="text" placeholder="<?php echo 'sales commission percentage' ?>">
                     </div>
                  </div>
                  <div class="form-group row" id="payment_from">
                     <label for="choice" class="col-sm-4 col-form-div">Commission Withholding</label>
                     <div class="col-sm-8">
                        <input type="radio" name="choice" value="Yes">Yes &nbsp;
                        <input type="radio" name="choice" value="No">No
                     </div>
                  </div>
                  <div class="form-group row" id="payment_from">
                     <label for="payroll_type" class="col-sm-4 col-form-label"> Payroll Type <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select  name="payroll_type" id="payroll_type" requried class="form-control"  >
                           <option value="">Select the Payroll Type</option>
                           <option value="Hourly">Hourly</option>
                           <option value="Fixed">Salaried/Fixed</option>
                           
                        </select>
                     </div>
                  </div>
                  <div class="form-group row" id="">
                     <label for="payroll_freq" class="col-sm-4 col-form-label"> Payroll Frequency <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select  name="payroll_freq" id="payroll_freq" requried class="form-control">
                           <option value="">Select the Payroll Frequency</option>
                           <option value="Weekly">Weekly</option>
                           <option value="Bi-Weekly">Bi-Weekly</option>
                           <option value="Monthly">Monthly</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="hourly_rate_or_salary" id="cost" class="col-sm-4 col-form-div"> Pay rate(<?php echo $currency; ?>) <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="hrate" class="form-control" type="text" placeholder="<?php echo "Pay rate" ?>" id="hrate" oninput="validateInput(this)">
                     </div>
                  </div>
                  <div class="form-group row"  id="payment_from">
                     <label for="paytype" class="col-sm-4 col-form-label"> Payment Type </label>
                     <div class="col-sm-7" >
                        <select name="paytype"  id="paytype" class="form-control" style="width: 100%;" >
                           <option value="">Select Type</option>
                           <option value="Cheque">Cheque</option>
                           <option value="Direct Deposit">Direct Deposit</option>
                           <option value="Cash">Cash</option>
                           <?php  foreach($paytype as $ptype){ ?>
                           <option value="<?php  echo $ptype['payment_type'] ;?>"><?php  echo $ptype['payment_type'] ;?></option>
                           <?php  } ?>
                        </select>
                     </div>
                     <div class="col-sm-1">
                        <a  class="btnclr client-add-btn btn clearPaymentType" aria-hidden="true" data-toggle="modal" data-target="#payment_type" ><i class="fa fa-plus"></i></a>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="email" class="col-sm-4 col-form-div">Social security number <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="ssn" class="form-control" type="text" placeholder="Social security number" required oninput="exitsocialsecurity(this, 9)">
                     </div>
                  </div>
                  <div class="form-group row" id="bank_name">
                     <label for="bank_name" class="col-sm-4 col-form-label"> <?php echo display('Bank') ?></label>
                     <div class="col-sm-7">
                        <select name="bank_name" id="bank_name"  class="form-control bankpayment">
                           <option>Select Bank</option>
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
                     <div class="col-sm-1">
                        <a data-toggle="modal" href="#add_bank_info" class="btn btnclr addbank_info"><i class="fa fa-plus"></i></a>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="blood_group" class="col-sm-4 col-form-div">Routing number </label>
                     <div class="col-sm-8">
                        <input name="routing_number" class="form-control" type="text" placeholder="Routing number" oninput="routingrestrict(this, 15)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo 'Account Number' ?></label>
                     <div class="col-sm-8">
                        <input type="text" name="account_number" class="form-control" placeholder="Account Number" oninput="routingrestrict(this, 15)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo ('Employee Tax') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select  name="emp_tax_detail" id="emp_tax_detail" class="form-control" required>
                           <option value="">Select Tax</option>
                           <option value="single">Single</option>
                           <option value="tax_filling">Tax Filling</option>
                           <option value="married">Married</option>
                           <option value="head_household">Head Household</option>
                        </select>
                     </div>
                  </div>
                  <div id="popup" class="btnclr popup">
                     <!-- Popup content -->
                     <div class="row">
                        <!-- Working Taxes -->
                        <div class="col-sm-6">
                           <h4 style="text-align:center;margin-left: 140px;">WORK LOCATION TAXES</h4>
                           <br>
                           <div class="form-group fg" >
                              <label for="stateTaxDropdown">State Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_tax" name="state_tax" id="stateTaxDropdown" class="form-control">
                              <datalist id="magic_state_tax">
                                 <?php foreach ($state_tx as $st) { ?>
                                 <option value="<?php echo $st['state']; ?>"><?php echo $st['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="localTaxDropdown">City Tax<i class="text-danger">*</i></label>
                              <input list="magic_local_tax" name="city_tax" id="localTaxDropdown" class="form-control">
                              <datalist id="magic_local_tax">
                                 <?php foreach ($get_info_city_tax as $gtct) { ?>
                                 <option value="<?php echo $gtct['state']; ?>"><?php echo $gtct['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="stateLocalTaxDropdown">County Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_local_tax" name="county_tax" id="stateLocalTaxDropdown" class="form-control">
                              <datalist id="magic_state_local_tax">
                                 <?php foreach ($get_info_county_tax as $gtcty) { ?>
                                 <option value="<?php echo $gtcty['state']; ?>"><?php echo $gtcty['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="stateTax2Dropdown">Other Work Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_tax_2" name="other_working_tax" id="stateTax2Dropdown" class="form-control">
                              <datalist id="magic_state_tax_2">
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                        </div>
                        <!-- Living Taxes -->
                        <div class="col-sm-6">
                           <h4 style="text-align:center;margin-left:140px;">LIVING LOCATION TAXES</h4>
                           <br>
                           <div class="form-group fg">
                              <label for="livingStateTax">State Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_state_tax" name="living_state_tax" id="livingStateTax" class="form-control">
                              <datalist id="magic_living_state_tax">
                                 <?php foreach ($state_tx as $st) { ?>
                                 <option value="<?php echo $st['state']; ?>"><?php echo $st['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingCityTax">City Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_city_tax" name="living_city_tax" id="livingCityTax" class="form-control">
                              <datalist id="magic_living_city_tax">
                                 <?php foreach ($get_info_city_tax as $gtct) { ?>
                                 <option value="<?php echo $gtct['state']; ?>"><?php echo $gtct['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingCountyTax">County Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_county_tax" name="living_county_tax" id="livingCountyTax" class="form-control">
                              <datalist id="magic_living_county_tax">
                                 <?php foreach ($get_info_county_tax as $gtcty) { ?>
                                 <option value="<?php echo $gtcty['state']; ?>"><?php echo $gtcty['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingOtherTax">Other living Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_other_tax" name="other_living_tax" id="livingOtherTax" class="form-control">
                              <datalist id="magic_living_other_tax">
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div style='float:right;font-weight:bold;'>
                        <!-- Button to add popup data -->
                        <button type="button"   style="background-color:green;margin-left: 335px;width:60px;"  class="btn btnclr"   id="addPopupData">Save</button>
                        <button type="button" class="btn btn-danger"   onclick="closeModal()">Close</button>
                     </div>
                     <br>
                     <br>
                  </div>
                  <div class="form-group row">
                     <label for="withholding_tax" class="col-sm-4 col-form-label">Withholding Tax <span class="text-danger">*</span></label>
                     <div class="col-sm-8">
                        <button type="button" class="btnclr btn" id="showPopup">Add Withholding Tax</button>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="ETA" class="col-sm-4 col-form-label"><?php echo display('Attachments ') ?></label>
                        <div class="col-sm-6">
                           <p>
                              <label for="attachment">
                              <a class="btnclr btn text-light" role="button" aria-disabled="false"><i class="fa fa-upload"></i>&nbsp; Choose Files</a>
                              </label>
                              <input type="file" name="files[]" class="upload" id="attachment" style="visibility: hidden; position: absolute;" multiple/>
                           </p>
                           <p id="files-area">
                              <span id="filesList">
                              <span id="files-names"></span>
                                 </span>
                           </p>
                        </div>
                  </div>

                  <div class="form-group row"  id="payrolltype">
                     <label for="profile_image" class="col-sm-4 col-form-label">
                     Profile Image
                     </label>
                     <div class="col-sm-8">
                        <input type="file" name="profile_image" class="form-control">
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

         <!-- Sales Partner -->
          <div class="panel-body" id="salesPartnerForms" style="display: none;">
            <form id="salespartnerInsertForm" method="post" enctype="multipart/form-data">
            <div class="row">
               <!-- Left Side -->
               <div class="col-sm-6">
                  <div class="form-group row">
                     <label for="first_name" class="col-sm-4 col-form-div"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                         <input type="hidden" value="<?php echo $_GET['id'] ?>" name="company_id"/>
                         <input type="hidden" value="<?php echo $_GET['admin_id'] ?>" name="admin_id"/>
                        <input name="first_name" class="form-control" type="text" placeholder="<?php echo display('first_name') ?>" required oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="middle_name" class="col-sm-4 col-form-div"><?php echo "Middle Name"; ?></label>
                     <div class="col-sm-8">
                        <input name="middle_name" class="form-control" type="text" placeholder="<?php echo "Middle Name"; ?>" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="last_name" class="col-sm-4 col-form-div"><?php echo display('last_name') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="last_name" class="form-control" type="text" placeholder="<?php echo display('last_name') ?>" required oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="last_name" class="col-sm-4 col-form-div"><?php echo ("Business Name") ?></label>
                     <div class="col-sm-8">
                        <input name="salesbusiness_name" class="form-control" type="text" placeholder="<?php echo "Business Name" ?>" id="salesbusiness_name" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="phone" class="col-sm-4 col-form-div"><?php echo display('phone') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input name="phone" class="form-control" type="number" placeholder="<?php echo display('phone') ?>" id="phone" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Profile Image" class="col-sm-4 col-form-label">
                     Email 
                     </label>
                     <div class="col-sm-8">
                        <input name="email" class="form-control" type="email" placeholder="<?php echo display('email') ?>" id="email" oninput="validateEmail(this)">
                        <span id="validateemails" style="margin-top: 10px;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address_line_1" class="col-sm-4 col-form-div"><?php echo display('address_line_1') ?></label>
                     <div class="col-sm-8">
                        <textarea name="address_line_1" rows='1' class="form-control" placeholder="<?php echo display('address_line_1') ?>" id="address_line_1"></textarea> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address_line_2" class="col-sm-4 col-form-div"><?php echo display('address_line_2') ?></label>
                     <div class="col-sm-8">
                        <textarea name="address_line_2" rows='1' class="form-control" placeholder="<?php echo display('address_line_2') ?>" id="address_line_2"></textarea> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="city" class="col-sm-4 col-form-div"><?php echo display('city') ?></label>
                     <div class="col-sm-8">
                        <input name="city" class="form-control" type="text" placeholder="<?php echo display('city') ?>" id="city" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="state" class="col-sm-4 col-form-label"><?php echo display('state'); ?> <i class="text-danger"></i></label>
                     <div class="col-sm-8">
                        <input class="form-control" name="state" id="state" type="text" style="border:2px solid #D7D4D6;"    placeholder="<?php echo display('state') ?>"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo display('zip') ?></label>
                     <div class="col-sm-8">
                        <input name="zip" class="form-control" type="text" placeholder="<?php echo display('zip') ?>" id="zip" oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="country" class="col-sm-4 col-form-div"><?php echo display('country') ?></label>
                     <div class="col-sm-8">
                        <select name="country" class="form-control">
                           <option value="">Select Country</option>
                           <?php foreach($country_data as $value) { ?>
                              <option value="<?= $value['name']; ?>" <?= $value['name'] === 'UNITED STATES' ? 'selected' : ''; ?>> <?= $value['name']; ?> 
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="emergencycontact" class="col-sm-4 col-form-label"> <?php echo "Emergency Contact Person" ?> </label>
                     <div class="col-sm-8">
                        <input class="form-control" name="emergencycontact" id="emergencycontact" type="text"  style="border:2px solid #D7D4D6;"   placeholder="Emergency Contact person"  oninput="limitAlphabetical(this, 20)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="emergencycontactnum" class="col-sm-4 col-form-label"> <?php echo "Emergency Contact  number" ?> </label>
                     <div class="col-sm-8">
                        <input class="form-control" name="emergencycontactnum" id="emergencycontactnum" type="number"  style="border:2px solid #D7D4D6;"   placeholder="Emergency Contact  number"  oninput="exitnumbers(this, 10)">
                     </div>
                  </div>
               </div>
               <!-- Right Side -->
               <div class="col-sm-6">
                  <div class="form-group row" id="payment_from">
                     <label for="city" class="col-sm-4 col-form-div"><?php echo  ('Sales Commission') ?></label>
                     <div class="col-sm-8">
                        <input name="sc" class="form-control" type="text" placeholder="<?php echo 'Sales Commission Percentage' ?>" oninput="salesCommisionInput(this)">
                     </div>
                  </div>
                  <div class="form-group row" id="payment_from">
                        <label for="choice" class="col-sm-4 col-form-div">Commission Withholding</label>
                     <div class="col-sm-8">
                        <input type="radio" name="choice" value="Yes">Yes &nbsp;
                        <input type="radio" name="choice" value="No">No
                        </div>
                  </div>
                  <div class="form-group row">
                     <label for="email" class="col-sm-4 col-form-div">Social security number <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input id="ssnInput" name="ssn" class="form-control" type="text" placeholder="Social security number" required oninput="exitsocialsecurity(this, 9)">
                     </div>
                     <br><br>
                     <span style="margin-left: 532px; font-weight: bold;">(OR)</span>
                  </div>
                  <div class="form-group row">
                     <label for="hourly_rate_or_salary" id="cost" class="col-sm-4 col-form-div"><?php echo ('Federal Identification Number') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <input id="federalInput" name="federalidentificationnumber" class="form-control" type="text" placeholder="Federal Identification Number" oninput="exitsocialsecurity(this, 9)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="hourly_rate_or_salary" id="cost" class="col-sm-4 col-form-div"><?php echo ('Federal Tax Classification') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select name="federaltaxclassification" id="federaltaxclassification" class="form-control" style="width: 100%;" required>
                           <option value="">Select Federal Tax Classification</option>
                           <option value="Individual/sole proprietor">Individual/sole proprietor</option>
                           <option value="C corporation">C corporation</option>
                           <option value="S corporation">S corporation</option>
                           <option value="Partnership">Partnership</option>
                           <option value="Trust/estate">Trust/estate</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row"  id="payment_from">
                     <label for="paytype" class="col-sm-4 col-form-label"> Payment Type </label>
                     <div class="col-sm-7" >
                        <select name="paytype"  id="paytype" class="form-control" style="width: 100%;" >
                           <option value="">Select Type</option>
                           <option value="Cheque">Cheque</option>
                           <option value="Direct Deposit">Direct Deposit</option>
                           <option value="Cash">Cash</option>
                           <?php  foreach($paytype as $ptype){ ?>
                           <option value="<?php  echo $ptype['payment_type'] ;?>"><?php  echo $ptype['payment_type'] ;?></option>
                           <?php  } ?>
                        </select>
                     </div>
                     <div class="col-sm-1">
                        <a  class="btnclr client-add-btn btn clearPaymentType" aria-hidden="true"    data-toggle="modal" data-target="#payment_type" ><i class="fa fa-plus"></i></a>
                     </div>
                  </div>
                  
                  <div class="form-group row" id="bank_name">
                     <label for="bank_name" class="col-sm-4 col-form-label"> <?php echo display('Bank') ?>  </label>
                     <div class="col-sm-7">
                        <select name="bank_name" id="bank_name"  class="form-control bankpayment">
                           <option>Select Bank</option>
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
                     <div class="col-sm-1">
                        <a data-toggle="modal" href="#add_bank_info" class="btn btnclr addbank_info"><i class="fa fa-plus"></i></a>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="blood_group" class="col-sm-4 col-form-div">Routing number </label>
                     <div class="col-sm-8">
                        <input name="routing_number" class="form-control" type="text" placeholder="Routing number" oninput="routingrestrict(this, 15)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo 'Account Number' ?></label>
                     <div class="col-sm-8">
                        <input type="text" name="account_number" class="form-control" placeholder="Account Number" oninput="routingrestrict(this, 15)">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zip" class="col-sm-4 col-form-div"><?php echo ('Employee Tax') ?><i class="text-danger">*</i></label>
                     <div class="col-sm-8">
                        <select  name="emp_tax_detail" id="emp_tax_detail" class="form-control" required>
                           <option value="">Select Tax</option>
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
                              <input list="magic_state_tax" name="state_tax" id="stateTaxDropdown" class="form-control">
                              <datalist id="magic_state_tax">
                                 <?php foreach ($state_tx as $st) { ?>
                                 <option value="<?php echo $st['state']; ?>"><?php echo $st['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="localTaxDropdown">City Tax<i class="text-danger">*</i></label>
                              <input list="magic_local_tax" name="city_tax" id="localTaxDropdown" class="form-control">
                              <datalist id="magic_local_tax">
                                 <?php foreach ($get_info_city_tax as $gtct) { ?>
                                 <option value="<?php echo $gtct['state']; ?>"><?php echo $gtct['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="stateLocalTaxDropdown">County Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_local_tax" name="county_tax" id="stateLocalTaxDropdown" class="form-control">
                              <datalist id="magic_state_local_tax">
                                 <?php foreach ($get_info_county_tax as $gtcty) { ?>
                                 <option value="<?php echo $gtcty['state']; ?>"><?php echo $gtcty['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="stateTax2Dropdown">Other Work Tax<i class="text-danger">*</i></label>
                              <input list="magic_state_tax_2" name="other_working_tax" id="stateTax2Dropdown" class="form-control">
                              <datalist id="magic_state_tax_2">
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                        </div>
                        <!-- Living Taxes -->
                        <div class="col-sm-6">
                           <h4 style="text-align:center;margin-left:140px;">LIVING LOCATION TAXES</h4>
                           <br>
                           <div class="form-group fg">
                              <label for="livingStateTax">State Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_state_tax" name="living_state_tax" id="livingStateTax" class="form-control">
                              <datalist id="magic_living_state_tax">
                                 <?php foreach ($state_tx as $st) { ?>
                                 <option value="<?php echo $st['state']; ?>"><?php echo $st['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingCityTax">City Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_city_tax" name="living_city_tax" id="livingCityTax" class="form-control">
                              <datalist id="magic_living_city_tax">
                                 <?php foreach ($get_info_city_tax as $gtct) { ?>
                                 <option value="<?php echo $gtct['state']; ?>"><?php echo $gtct['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingCountyTax">County Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_county_tax" name="living_county_tax" id="livingCountyTax" class="form-control">
                              <datalist id="magic_living_county_tax">
                                 <?php foreach ($get_info_county_tax as $gtcty) { ?>
                                 <option value="<?php echo $gtcty['state']; ?>"><?php echo $gtcty['state']; ?></option>
                                 <?php } ?>
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                           <div class="form-group fg">
                              <label for="livingOtherTax">Other living Tax<i class="text-danger">*</i></label>
                              <input list="magic_living_other_tax" name="other_living_tax" id="livingOtherTax" class="form-control">
                              <datalist id="magic_living_other_tax">
                                 <option value="Not Applicable">Not Applicable</option>
                              </datalist>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div style='float:right;font-weight:bold;'>
                        <!-- Button to add popup data -->
                        <button type="button"   style="background-color:green;margin-left: 335px;width:60px;"  class="btn btnclr"   id="addPopupsalespartnerData">Save</button>
                        <button type="button" class="btn btn-danger"   onclick="closeModalsalepartner()">Close</button>
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
                           </p>
                           <p id="salesfiles-area">
                              <span id="salesfilesList"><span id="salesfiles-names"></span></span>
                           </p>
                        </div>
                  </div>

                  <div class="form-group row"  id="payrolltype">
                     <label for="profile_image" class="col-sm-4 col-form-label">
                     Profile Image
                     </label>
                     <div class="col-sm-8">
                        <input type="file" name="profile_image" class="form-control" accept=".png, .jpg, .jpeg">
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

<div class="modal fade" id="myModal1" role="dialog" >
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="margin-top: 190px;">
         <div class="modal-header btnclr"  style="text-align:center;" >
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo ('Add Employee') ?></h4>
         </div>
         <div class="modal-body" id="bodyModal1" style="text-align:center;font-weight:bold;">
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>

<?php 
   $modaldata['bootstrap_modals'] = array('bank_info_modal', 'designation_modal', 'city_tax_modal', 'payroll_type_modal', 'emp_type_modal', 'pay_type_modal');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>

<script type="text/javascript">
   var payrollTypeSelect = document.getElementById('payroll_type');
   var asteriskSpan = document.getElementById('asterisk');
   
   payrollTypeSelect.addEventListener('change', function() {
      var hrateInput = document.getElementById('hrate');
      if (this.value === 'SalesCommission') {
         hrateInput.removeAttribute('required');
      } else {
         hrateInput.setAttribute('required', '');
      }
   });
   
   // Trigger change event on page load to initialize the asterisk
   payrollTypeSelect.dispatchEvent(new Event('change'));
   $(document).ready(function(){
       $('#payroll_type').change(function(){
           var selectedOption = $(this).val();
           if(selectedOption === 'Hourly') {
               $('#cost').html('Pay rate (Hourly) <span class="text-danger">*</span>').show(); 
               $('#hrate').show(); 
           } else if (selectedOption === 'SalesCommission') {
               $('#cost').hide(); 
               $('#hrate').hide(); 
           } else { 
               $('#cost').html('Pay rate (Daily) <span class="text-danger">*</span>').show();
               $('#hrate').show(); 
           }
       });
   });
   
   
   const dt = new DataTransfer();
   $("#attachment").on('change', function(e){
       for(var i = 0; i < this.files.length; i++){
           let fileBloc = $('<span/>', {class: 'file-block'}),
                fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
           fileBloc.append('<span class="file-delete"><span><i class="fa fa-trash-o"></i></span></span>')
               .append(fileName);
           $("#filesList > #files-names").append(fileBloc);
       };
       for (let file of this.files) {
           dt.items.add(file);
       }
       this.files = dt.files;
   
       $('span.file-delete').click(function(){
           let name = $(this).next('span.name').text();
           $(this).parent().remove();
           for(let i = 0; i < dt.items.length; i++){
               if(name === dt.items[i].getAsFile().name){
                   dt.items.remove(i);
                   continue;
               }
           }
           document.getElementById('attachment').files = dt.files;
       });
   });

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
      
      // JavaScript to show the popup
      document.getElementById("showPopup").addEventListener("click", function() {
         document.getElementById("popup").style.display = "block";
      });
   
      function closeModal() {
         document.getElementById("showPopup").style.display = "none";
      }
   
      document.getElementById("addPopupData").addEventListener("click", function() {
         document.getElementById("popup").style.display = "none";
       });
      
      function closeModal() {
         document.getElementById("popup").style.display = "none";
      }

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

// get Employee select dropdown
$(document).ready(function(){
   $('#selectemployeeTypes').change(function() {
     var selectedValue = $(this).val();
      if(selectedValue == 'addEmployees') {
         $('#employeeForms').css('display', 'block');
         $('#headpartemployeeadd').css('display', 'block');
         $('#salesPartnerForms').css('display', 'none');
         $('#headpartsalespartner').css('display', 'none');
      } else if(selectedValue == 'salesPartner') {
         $('#salesPartnerForms').css('display', 'block');
         $('#headpartsalespartner').css('display', 'block');
         $('#employeeForms').css('display', 'none');
         $('#headpartemployeeadd').css('display', 'none');
     }
   });

   // Clear Designation Input
   $('.clearValue').on('click', function() {
      $('.clearDesignation').val('');  
   });

   // Clear Bank Input 
   $('.addbank_info').on('click', function() {
      $('.clearinputValue').val('');  
   });

   // Clear Employee Type
   $('.clearEmpType').on('click', function() {
      $('#emps_type').val('');  
   });

   // Clear Payment Type
   $('.clearPaymentType').on('click', function() {
      $('#new_payment_type').val('');  
   });
});


// Employee Fomr Insert 
$("#employeeInsertForm").validate({
    rules: {
        first_name: "required",
        employee_type: "required",
        last_name: "required",
        designation: "required",
        payroll_type: "required",
        payroll_freq: "required",
        phone: "required",
        ssn: {required: true, minlength: 9, digits: true},
        emp_tax_detail: "required",
        hrate: "required",
    },
    messages: {
        first_name: "First name is required",
        employee_type: "Employee type is required",
        last_name: "Last name is required",
        designation: "Designation is required",
        payroll_type: "Payroll type is required",
        payroll_freq: "Payroll frequency is required",
        phone: "Phone is required",
        ssn: {
            required: "Social Security Number is required",
            minlength: "Social Security Number must be at least 9 digits",
            digits: "Social Security Number must contain only numeric characters"
        },
        emp_tax_detail: "Employee tax is required",
        hrate: "Pay rate is required",
    },
    submitHandler: function(form) {
        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>chrm/employee_create", 
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
                  setTimeout(function () {
                     window.location.href = "<?= base_url('Chrm/manage_employee?id='); ?>" + "<?= $_GET['id']; ?>" + "&admin_id=" + "<?= $_GET['admin_id']; ?>";
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


// Sales Partner
$(document).ready(function () {
   $("#salespartnerInsertForm").validate({
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
                url: "<?php echo base_url(); ?>chrm/salespartner_create",
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

    form.settings.rules.federalidentificationnumber.required = ssnLength === 0;
    form.settings.rules.ssn.required = federalLength === 0;
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
</style>