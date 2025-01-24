<style>
    .btnclr{
        background-color:<?= $setting_detail[0]['button_color']; ?>;
        color: white;
    }

    .select2{
        display:none;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type=number] {
      -moz-appearance: textfield;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css')?>" />
<script src="<?php echo base_url('assets/js/toastr.min.js')?>" ></script>

<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Edit Company Branch</h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
                <li><a href="#"><?= display('web_settings') ?></a></li>
                <li class="active" style="color:orange;">Edit Company Branch</li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- New user -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
              
                    <div class="form-group row">
                        <a href="<?php echo base_url('Company_setup/manage_company?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>" class="btnclr btn text-white float-right" style="position: relative; right: 2%; top: 15px;"> <i class="ti-align-justify"></i> Manage Company</a>
                    </div>
                    
                    <div class="panel-body">
                    <form id="updateCompany" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= display('Company Name') ?><i class="text-danger">*</i></label>
                                <input type="text" tabindex="1" class="form-control" name="company_name" id="company_name" placeholder="Enter your Company name" value="<?php echo $company_name; ?>" required />
                                <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
                                <input type="hidden" name="url_id" value="<?= (isset($_GET['id']) ? $_GET['id'] : ''); ?>">
                                <input type="hidden" name="url_admin_id" value="<?= (isset($_GET['admin_id']) ? $_GET['admin_id'] : ''); ?>">
                            </div>
                                                  
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= display('email') ?><i class="text-danger">*</i></label>
                                <input type="email" tabindex="1" class="form-control" name="email" id="email" required placeholder="Enter your Company email" value="<?php echo $email; ?>"/>
                            </div>
                        
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= display('Mobile') ?><i class="text-danger">*</i></label>
                                <input type="number" tabindex="1" class="form-control" name="mobile" id="mobile" required placeholder="Enter your mobile" value="<?php echo $mobile; ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= 'City'; ?><i class="text-danger">*</i></label>
                                <input type="text" tabindex="1" class="form-control" name="c_city" id="c_city" required placeholder="Enter your city" value="<?php echo $c_city; ?>" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"/>
                            </div>
                        
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= 'State'; ?><i class="text-danger">*</i></label>
                                <input type="text" tabindex="1" class="form-control" name="c_state" id="c_state" required placeholder="Enter your state" value="<?php echo $c_state; ?>" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"/>
                            </div>
                                                  
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= display('Address') ?><i class="text-danger">*</i></label>
                                <textarea class="form-control" name="address" id="address" required placeholder="Enter your address"><?php echo $address; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">                          
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= display('Website') ?><i class="text-danger">*</i></label>
                                <input type="text" tabindex="1" class="form-control" name="website" id="website" placeholder="Enter your website" value="<?php echo $website; ?>" required />
                            </div>
                        
                            <div class="col-sm-4">
                                <label class="col-form-label"><?= display('Bank_Name') ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" name="Bank_Name" id="Bank_Name"  placeholder="Enter your Bank Name" value="<?php echo $Bank_Name; ?>"/>
                            </div>
                                                  
                            <div class="col-sm-4">
                                <label class=" col-form-label"><?= 'Account Number'?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" name="Account_Number" id="Account_Number"  placeholder="Enter your Account Number" value="<?php echo $Account_Number; ?>" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class=" col-form-label"><?= 'Bank Routing Number' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" name="Bank_Routing_Number" id="Bank_Routing_Number"  placeholder="Enter your Bank Routing Number" value="<?php echo $Bank_Routing_Number; ?>" />
                            </div>
                          
                            <div class="col-sm-4">
                                <label class=" col-form-label"><?= 'Bank Address' ?><i class="text-danger"></i></label>
                                <textarea class="form-control" name="Bank_Address" id="Bank_Address" required placeholder="Enter your address"><?php echo $Bank_Address; ?></textarea>
                            </div>
                        
                            <div class="col-sm-4">
                                <label class=" col-form-label"><?= 'Federal Identification Number' ?><i class="text-danger"></i></label>
                                <input type="number" tabindex="1" class="form-control" name="Federal_Pin_Number" id="Federal_Pin_Number"  placeholder="Enter  Federal Identification Number" value="<?php echo $Federal_Pin_Number; ?>"/>
                            </div>
                        </div>

                        <!-- COMMON USER TAX -->
                        <hr>
                        <?php if(is_array($url)) {
                            foreach($url as $dt) { 
                        ?>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'User Name' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control"  value="<?php echo $dt->user_name; ?>" name="user_name[]" id="user_name" placeholder="Enter User Name" />
                            </div>
                            
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Password' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php  echo $dt->password; ?>" name="password[]" id="password" placeholder="Enter password" />
                            </div>

                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Pin Number' ?><i class="text-danger"></i></label>
                                <input type="number" tabindex="1" class="form-control" value="<?php  echo $dt->pin_number; ?>" name="pin_number[]" id="pin_number" placeholder="Enter Pin Number" />
                            </div>
                        
                            <div class="col-sm-3" id="url-group-1">
                                <label class="col-form-label">URL<i class="text-danger"></i></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="url" tabindex="1" class="form-control" value="<?php  echo $dt->url; ?>" name="url[]" id="url" placeholder="Enter URL" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btnclr client-add-btn btn" onclick="addUrlField()"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>

                        <div id="output"></div>

                        <!-- STATE USER TAX SECTION -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="statetx" class=" col-form-label"><?= 'State Tax ID Number'?><i class="text-danger"></i></label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input list="magic_state_tax_id" name="statetx"  id="statetx" class="form-control" placeholder="Enter your State Tax ID Number" value="<?= $st_tax_id; ?>" onchange="this.blur();" />
                                        <datalist id="magic_state_tax_id">
                                            <?php  foreach($editState as $st){  ?>
                                                <option value="<?php  echo $st->state_tax_id ;?>"><?php  echo $st->state_tax_id ;?></option>
                                            <?php  } ?>
                                        </datalist>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <?php 
                            if(is_array($url_st)) {
                            foreach($url_st as $dt) { 
                        ?>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'User Name (State tax)' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php echo $dt->user_name_st; ?>" name="user_name_st[]" id="user_name_st" placeholder="Enter User Name" />
                            </div>
                            
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Password' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php  echo $dt->password_st; ?>" name="password_st[]" id="password_st" placeholder="Enter password" />
                            </div>

                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Pin Number' ?><i class="text-danger"></i></label>
                                <input type="number" tabindex="1" class="form-control" value="<?php  echo $dt->pin_number_st; ?>" name="pin_number_st[]" id="pin_number_st" placeholder="Enter Pin Number" />
                            </div>
                        
                            <div class="col-sm-3" id="urlst-group-1">
                                <label class=" col-form-label">URL(State tax)<i class="text-danger"></i></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="url" tabindex="1" class="form-control" value="<?php  echo $dt->url_st; ?>" name="url_st[]" id="url_st" placeholder="Enter URL" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btnclr client-add-btn btn" onclick="addUrlstField()"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } } ?>

                        <div id="outputst"></div>

                        <!-- LOCAL TAX USER -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <label for="localtx" class="col-form-label"><?= 'Local Tax ID Number'?><i class="text-danger"></i></label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input list="magic_local_tax_id" name="localtx" id="localtx" class="form-control" placeholder="Enter your State Tax ID Number" value="<?php echo $lc_tax_id; ?>"  onchange="this.blur();" />
                                        <datalist id="magic_local_tax_id">
                                        <?php foreach($local as $st){  ?>
                                        <option value="<?php  echo $st->local_tax_id ;?>"><?php  echo $st->local_tax_id ;?></option>
                                        <?php  } ?>
                                        </datalist>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <?php 
                            if(is_array($url_lctx)) {
                            foreach($url_lctx as $dt) { 
                        ?>

                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'User Name(Local tax)' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php echo $dt->user_name_lctx; ?>" name="user_name_lctx[]" id="user_name_lctx" placeholder="Enter User Name" />
                            </div>
                            
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Password' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php  echo $dt->password_lctx; ?>" name="password_lctx[]" id="password_lctx" placeholder="Enter password" />
                            </div>

                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Pin Number' ?><i class="text-danger"></i></label>
                                <input type="number" tabindex="1" class="form-control" value="<?php  echo $dt->pin_number_lctx; ?>" name="pin_number_lctx[]" id="pin_number_lctx" placeholder="Enter Pin Number" />
                            </div>
                        
                            <div class="col-sm-3" id="urllctx-group-1">
                                <label class="col-form-label">URL(Local tax)<i class="text-danger"></i></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="url" tabindex="1" class="form-control" value="<?php  echo $dt->url_lctx; ?>" name="url_lctx[]" id="url_lctx" placeholder="Enter URL" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btnclr client-add-btn btn" onclick="addUrllctxField()"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                        <div id="outputlctx"></div>

                        <!-- SALES TAX  -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'State Sales Tax Number' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" name="State_Sales_Tax_Number" id="State_Sales_Tax_Number" value="<?php echo $State_Sales_Tax_Number ?>"  placeholder="Enter your State Sales Tax Number" />
                            </div>
                        </div>
                        
                        <?php 
                            if(is_array($url_sstx)) {
                            foreach($url_sstx as $dt) { 
                        ?>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'User Name(State Sales Tax)' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php echo $dt->user_name_sstx; ?>" name="user_name_sstx[]" id="user_name_sstx" placeholder="Enter User Name" />
                            </div>
                                                        
                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Password' ?><i class="text-danger"></i></label>
                                <input type="text" tabindex="1" class="form-control" value="<?php  echo $dt->password_sstx; ?>" name="password_sstx[]" id="password_sstx" placeholder="Enter password" />
                            </div>

                            <div class="col-sm-3">
                                <label class="col-form-label"><?= 'Pin Number' ?><i class="text-danger"></i></label>
                                <input type="number" tabindex="1" class="form-control" value="<?php  echo $dt->pin_number_sstx; ?>" name="pin_number_sstx[]" id="pin_number_sstx" placeholder="Enter Pin Number" />
                            </div>
                        
                            <div class="col-sm-3" id="urlsstx-group-1">
                                <label class="col-form-label">URL(State sales tax)<i class="text-danger"></i></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="url" tabindex="1" class="form-control" value="<?php  echo $dt->url_sstx; ?>"  name="url_sstx[]" id="url_sstx" placeholder="Enter URL" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btnclr client-add-btn btn" onclick="addUrlsstxField()"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                        <div id="outputsstx"></div>

                        <div class="form-group row mt-4">
                            <div class="col-sm-12" style="display: flex; justify-content: center;">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                    <input type="hidden" name="uid" value="<?= $this->session->userdata('user_id'); ?>">
                                <input type="submit" id="add-customer" style="color:white;" class="btnclr btn m-b-5 m-r-2" name="add-user" value="<?= display('save') ?>" tabindex="6"/>
                            </div>
                        </div>
                    </form>
                    </div>
                 
                </div>
            </div>
        </div>
        <br><br><br>
    </section>
</div>


<!------ add new state tax id -->
<div class="modal fade" id="state_tax_id" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr"  style="text-align:center;" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title"><?= 'Add New State Tax ID ' ?></h4>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_state_tax_id" method="post">
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?= $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="customer_name" class="col-md-3 col-form-label" style="width: auto;"><?= 'New State Tax ID ' ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input class="form-control" name ="new_state_tax_id" id="new_state_tax_id" type="text" placeholder="New State Tax ID  "  required="" tabindex="1">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?= display('Close') ?> </a>
         <input type="submit" class="btn btnclr "  value=<?= display('Submit') ?>>
         </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!------ add new local tax id -->
<div class="modal fade" id="local_tax_id" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header btnclr"  style="text-align:center;" >
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title"><?= 'Add New Local Tax ID ' ?></h4>
         </div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_local_tax_id" method="post">
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?= $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="customer_name" class="col-sm-3 col-form-label" style="width: auto;"><?= 'New Local Tax ID ' ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input class="form-control" name ="new_local_tax_id" id="new_local_tax_id" type="text" placeholder="New Local Tax ID  "  required="" tabindex="1">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?= display('Close') ?> </a>
         <input type="submit" class="btn btnclr "  value=<?= display('Submit') ?>>
         </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
   var csrfName = '<?= $this->security->get_csrf_token_name();?>';
   var csrfHash = '<?= $this->security->get_csrf_hash();?>';
   //state tax id number
   $(document).ready(function () {
        $('#add_state_tax_id').submit(function (e) {
            e.preventDefault();
            var formData = $("#add_state_tax_id").serialize();
            formData += "&" + $.param({ csrf_test_name: csrfHash });
            $.ajax({
                type: 'POST',
                data: formData,
                dataType: "json",
                url: '<?= base_url(); ?>Cinvoice/add_state_tax_id',
                success: function (data1, statut) {
                    var $datalist = $('#magic_state_tax_id');
                    // Clear existing options
                    $datalist.empty();
                    // Add new options
                    for (var i = 0; i < data1.length; i++) {
                        var option = $('<option/>').attr('value', data1[i].state_tax_id).text(data1[i].state_tax_id);
                        $datalist.append(option);
                    }
                    $('#new_state_tax_id').val('');
                    $("#bodyModal1").html("state tax id number Tax Added Successfully");
                    $('#state_tax_id').modal('hide');
                    $('#statetx').show();
                    $('#myModal1').modal('show');
                    window.setTimeout(function () {
                        $('#state_tax_id').modal('hide');
                        $('#myModal1').modal('hide');
                    }, 2000);
                }
            });
        });
    });

    //local tax id number
    $(document).ready(function () {
        $('#add_local_tax_id').submit(function (e) {
            e.preventDefault();
            var formData = $("#add_local_tax_id").serialize();
            formData += "&" + $.param({ csrf_test_name: csrfHash });
            $.ajax({
                type: 'POST',
                data: formData,
                dataType: "json",
                url: '<?= base_url(); ?>Cinvoice/add_local_tax_id',
                success: function (data1, statut) {
                    var $datalist = $('#magic_local_tax_id');
                    // Clear existing options
                    $datalist.empty();
                    // Add new options
                    for (var i = 0; i < data1.length; i++) {
                        var option = $('<option/>').attr('value', data1[i].local_tax_id).text(data1[i].local_tax_id);
                        $datalist.append(option);
                    }
                    $('#new_local_tax_id').val('');
                    $("#bodyModal1").html("local tax id number Tax Added Successfully");
                    $('#local_tax_id').modal('hide');
                    $('#localtx').show();
                    $('#myModal1').modal('show');
                    window.setTimeout(function () {
                        $('#local_tax_id').modal('hide');
                        $('#myModal1').modal('hide');
                    }, 2000);
                }
            });
        });
    });
 

    var urlFieldCount = 1;

    function addUrlField() {
        urlFieldCount++;
        var newUrlGroup = document.createElement('div');
        newUrlGroup.className = 'form-group row';
        newUrlGroup.id = 'url-group-' + urlFieldCount;

        newUrlGroup.innerHTML = `
            <div class="">
                <div class="col-sm-3">
                    <label class="col-form-label" style="margin-left:15px;"> User Name </label> 
                    <input type="text" class="form-control" name="user_name[]"/> 
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label"> Password </label> 
                    <input type="text" class="form-control" name="password[]" /> 
                </div> 
                <div class="col-sm-3">
                    <label class="col-form-label"> Pin Number </label> 
                    <input type="text" class="form-control" name="pin_number[]"/> 
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label">URL ${urlFieldCount}</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="url" tabindex="1" class="form-control" name="url[]" placeholder="Enter URL ${urlFieldCount}" />
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btnclr client-add-btn btn" onclick="removeUrlField('url-group-${urlFieldCount}')"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>`;

        var outputDiv = document.getElementById('output');
        outputDiv.appendChild(newUrlGroup);
    }

    function removeUrlField(groupId) {
        var urlGroupToRemove = document.getElementById(groupId);
        if (urlGroupToRemove && urlFieldCount > 1) {
            urlGroupToRemove.parentNode.removeChild(urlGroupToRemove);
            urlFieldCount--;
        }
    }

    var urlstFieldCount = 1;

    function addUrlstField() {
        urlstFieldCount++;
        var newUrlstGroup = document.createElement('div');
        newUrlstGroup.className = 'form-group row';
        newUrlstGroup.id = 'urlst-group-' + urlstFieldCount;

        newUrlstGroup.innerHTML = `
            <div class="">
                <div class="col-sm-3">
                    <label class="col-form-label" style="margin-left:15px;"><?= 'User Name (State tax)' ?></label> 
                    <input type="text"  class="form-control" name="user_name_st[]"/>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label"><?= 'Password' ?></label>
                    <input type="text" class="form-control" name="password_st[]" />
                </div> 
                <div class="col-sm-3">
                    <label class="col-form-label"><?= 'Pin Number' ?></label>
                    <input type="text" class="form-control" name="pin_number_st[]"/>
                </div>

                <div class="col-sm-3">
                    <label class="col-form-label">URL (State tax) ${urlstFieldCount}</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="url" tabindex="1" class="form-control" name="url_st[]" placeholder="Enter URL ${urlstFieldCount}" />
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btnclr client-add-btn btn" onclick="removeUrlstField('urlst-group-${urlstFieldCount}')"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>`;

        var outputDivst = document.getElementById('outputst');
        outputDivst.appendChild(newUrlstGroup);
    }

    function removeUrlstField(groupIdst) {
        var urlstGroupToRemove = document.getElementById(groupIdst);
        if (urlstGroupToRemove && urlstFieldCount > 1) {
            urlstGroupToRemove.parentNode.removeChild(urlstGroupToRemove);
            urlstFieldCount--;
        }
    }


    var urllctxFieldCount = 1;

    function addUrllctxField() {
        urllctxFieldCount++;
        var newUrllctxGroup = document.createElement('div');
        newUrllctxGroup.className = 'form-group row';
        newUrllctxGroup.id = 'urllctx-group-' + urllctxFieldCount;

        newUrllctxGroup.innerHTML = `
        <div class="">
            <div class="col-sm-3">
                <label class="col-form-label" style="margin-left:15px;"><?= 'User Name (Local tax)' ?></label>
                <input type="text" class="form-control" name="user_name_lctx[]"/>
            </div>
            <div class="col-sm-3">
                <label class="col-form-label"><?= 'Password' ?></label>
                <input type="text" class="form-control" name="password_lctx[]" />
            </div> 
            <div class="col-sm-3">
                <label class="col-form-label"><?= 'Pin Number' ?></label>
                <input type="text" class="form-control" name="pin_number_lctx[]"/>
            </div>

            <div class="col-sm-3">
                <label class="col-form-label">URL (Local tax) ${urllctxFieldCount}</label>
                <div class="row">
                    <div class="col-md-10">
                        <input type="url" tabindex="1" class="form-control" name="url_lctx[]" placeholder="Enter URL ${urllctxFieldCount}" />
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btnclr client-add-btn btn" onclick="removeUrllctxField('urllctx-group-${urllctxFieldCount}')"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            </div>
        </div>`;

        var outputDivst = document.getElementById('outputlctx');
        outputDivst.appendChild(newUrllctxGroup);
    }

    function removeUrllctxField(groupIdst) {
        var urllctxGroupToRemove = document.getElementById(groupIdst);
        if (urllctxGroupToRemove && urllctxFieldCount > 1) {
            urllctxGroupToRemove.parentNode.removeChild(urllctxGroupToRemove);
            urllctxFieldCount--;
        }
    }

    var urlsstxFieldCount = 1;

    function addUrlsstxField() {
        urlsstxFieldCount++;
        var newUrlsstxGroup = document.createElement('div');
        newUrlsstxGroup.className = 'form-group row';
        newUrlsstxGroup.id = 'urlsstx-group-' + urlsstxFieldCount;

        newUrlsstxGroup.innerHTML = `
            <div class="">
                <div class="col-sm-3">
                    <label class="col-form-label" style="margin-left:15px;"><?= 'User Name (State sales tax)' ?></label>
                    <input type="text"  class="form-control" name="user_name_sstx[]"/>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label"><?= 'Password' ?></label>
                    <input type="text" class="form-control" name="password_sstx[]" />
                </div> 
                <div class="col-sm-3">
                    <label class="col-form-label"><?= 'Pin Number' ?></label>
                    <input type="text" class="form-control" name="pin_number_sstx[]"/>
                </div>

                <div class="col-sm-3">
                    <label class="col-form-label">URL (State sales tax) ${urlsstxFieldCount}</label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="url" tabindex="1" class="form-control" name="url_sstx[]" placeholder="Enter URL ${urlsstxFieldCount}" />
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btnclr client-add-btn btn" onclick="removeUrlsstxField('urlsstx-group-${urlsstxFieldCount}')"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>        
            </div>`;

        var outputDivst = document.getElementById('outputsstx');
        outputDivst.appendChild(newUrlsstxGroup);
    }

    function removeUrlsstxField(groupIdst) {
        var urlsstxGroupToRemove = document.getElementById(groupIdst);
        if (urlsstxGroupToRemove && urlsstxFieldCount > 1) {
            urlsstxGroupToRemove.parentNode.removeChild(urlsstxGroupToRemove);
            urlsstxFieldCount--;
        }
    }

// Insert Company
$("#updateCompany").validate({
    rules: {
        company_name: "required",
        email: "required",
        mobile: "required",
        c_city: "required",
        c_state: "required",
        address: "required",
        website: "required",
    },
    messages: {
        company_name: "Company name is required",
        email: "Email is required",
        mobile: "Mobile is required",
        c_city: "City is required",
        c_state: "State is required",
        address: "Address is required",
        website: "Website is required",
    },
    submitHandler: function(form) {
        var formData = new FormData(form); 
        formData.append(csrfName, csrfHash); 
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>User/company_update_branch", 
            data: formData, 
            dataType: "json",
            contentType: false, 
            processData: false,
            success: function(response) {
               if(response.status == 1){
                  toastr.success(response.message, "Success", { 
                     closeButton: false,
                     timeOut: 1000
                  });
                  setTimeout(function () {
                     window.location.href = "<?= base_url('Company_setup/manage_company?id='); ?>" + "<?= $_GET['id']; ?>" + "&admin_id=" + "<?= $_GET['admin_id']; ?>";
                  }, 1000);
               } else {
                  toastr.error(response.message, "Error", { 
                     closeButton: false,
                     timeOut: 3000
                  });
               }
            },
            error: function(xhr, status, error) {
               var errorMsg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "An error occurred.";
               toastr.error(errorMsg, "Error", {
                  closeButton: false,
                  timeOut: 1000
               });
            }
        });
    }
});

</script>
