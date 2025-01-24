<?php error_reporting(1);  ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/bootstrap.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/font-awesome.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/themify-icons.css'); ?>" />
<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

<style>
label {
   color: #000;
}

.m-3 {
   margin: 10px;
   font-size: 16px;
   font-weight: 700;
   padding: 5px;
   border-radius: 5px;
}

.pro_pic {
   border-radius: 2px solid #000;
}
   
/*//side*/   
.bar {
  float: left;
  width: 25px;
  height: 3px;
  border-radius: 4px;
  background-color: #4b9cdb;
}

.load-10 .bar {
  animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}

@keyframes loadingJ {
  0%,
  100% {
    transform: translate(0, 0);
  }

  50% {
    transform: translate(80px, 0);
    background-color: #f5634a;
    width: 110px;
  }
}
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon"><i class="pe-7s-note2"></i></div>
      <div class="header-title">
         <h1>Employee Details</h1>
         <small></small>
         <ol class="breadcrumb">
            <li><a href=""><i class="pe-7s-home"></i> home </a></li>
            <li><a href="#">HRM</a></li>
            <li class="active">Employee Details</li>
         </ol>
      </div>
   </section>
   
   <section class="content">
      <!-- Sales report -->
      <div class="row">

         <div class="panel panel-bd lobidrag">

            <div class='col-sm-12'>            
               <div class="row">
                  
                  <div class="panel panel-bd lobidrag">
                     <div class="panel-body">
                <a style="float:right;" href="<?= base_url('Chrm/manage_employee?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']) ?>" class="btnclr btn">
                           <i class="ti-align-justify"> </i>Manage Employee
                        </a>
                 
                     <br/>
                        <?php if(!empty($row[0]['profile_image'])) { ?>                     
                           <div class="col-md-12">
                              <img src="<?= base_url('assets/uploads/profile/' . ($row[0]['e_type'] == 1 ? $row[0]['profile_image'] : 'salespartner/' . $row[0]['profile_image'])); ?>" class="pro_pic" alt="Profile Picture" width="100px" height="100px">
                              <br><br>
                           </div>
                        <?php } ?>
                        
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">First Name</label>
                                 <span class="form-group"> : <?= $row[0]['first_name']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Middle Name</label>
                                 <span class="form-group"> : <?= $row[0]['middle_name']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Last Name</label>
                                 <span class="form-group"> : <?= $row[0]['last_name']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Designation</label>
                                 <span class="form-group"> : <?= $row[0]['designation']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Phone</label>
                                 <span class="form-group"> : <?= $row[0]['phone']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">email</label>
                                 <span class="form-group"> : <?= $row[0]['email']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">State</label>
                                 <span class="form-group"> : <?= $row[0]['state']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">City</label>
                                 <span class="form-group"> : <?= $row[0]['city']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Zip code</label>
                                 <span class="form-group"> : <?= $row[0]['zip']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Country</label>
                                 <span class="form-group"> : <?= $row[0]['country']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Address 1</label>
                                 <span class="form-group"> : <?= $row[0]['address_line_1']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Address 2</label>
                                 <span class="form-group"> : <?= $row[0]['address_line_2']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Employee Type</label>
                                 <span class="form-group"> : <?= $row[0]['employee_type']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Houre Rate/Salary</label>
                                 <span class="form-group"> : <?= $row[0]['hrate']; ?></span>
                              </div>
                           </div>
                        </div>

                        <?php if($row[0]['e_type'] == 1) { ?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Payroll Type</label>
                                 <span class="form-group"> : <?= $row[0]['payroll_type']; ?></span>
                              </div>
                           </div>
                        

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Payroll Frequency</label>
                                 <span class="form-group"> : <?= $row[0]['payroll_freq']; ?></span>
                              </div>
                           </div>
                        </div>
                        <?php } ?>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Bank</label>
                                 <span class="form-group"> : <?= $row[0]['bank_name']; ?></span>
                              </div>
                           </div>
                        
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Account Number</label>
                                 <span class="form-group"> : <?= $row[0]['account_number']; ?></span>
                              </div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Employee Tax</label>
                                 <span class="form-group"> : <?= $row[0]['employee_tax']; ?></span>
                              </div>
                           </div>
                        

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Routing Number</label>
                                 <span class="form-group"> : <?= $row[0]['routing_number']; ?></span>
                              </div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-md-12">
                              <p class="bg-warning text-center m-3">Working Location Taxes</p>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">State Tax</label>
                                 <span class="form-group"> : <?= $row[0]['working_state_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">City Tax</label>
                                 <span class="form-group"> : <?= $row[0]['working_city_tax']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Country Tax</label>
                                 <span class="form-group"> : <?= $row[0]['working_county_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Other Working Tax</label>
                                 <span class="form-group"> : <?= $row[0]['working_other_tax']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <p class="bg-warning text-center m-3">Living Location Taxes</p>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">State Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_state_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">City Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_city_tax']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Country Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_county_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Other Living Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_other_tax']; ?></span>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
      <br><br><br>           
   </section>
</div>

 

 