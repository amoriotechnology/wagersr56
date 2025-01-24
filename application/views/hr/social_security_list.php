<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js" /></script>
<div class="content-wrapper">
    <section class="content-header" style="height:70px;">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
             <h1><?php echo display('setup_tax') ?></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('tax') ?></a></li>
                <li class="active" style="color:orange;"><?php echo display('add_incometax') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
        ?>
        <div class="alert alert-info alert-dismissable" style="color:white;background-color:#38469f;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message ?>                    
        </div>
<script>
    $('.alert').delay(1000).fadeOut('slow');
    </script>
        <?php 
            $this->session->unset_userdata('message');
            }
            $error_message = $this->session->userdata('error_message');
            if (isset($error_message)) {
        ?>
        <div class="alert alert-danger alert-dismissable" style="color:white;background-color:#38469f;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>                    
        </div>
        <?php 
            $this->session->unset_userdata('error_message');
            }
        ?>
<style>
    td,th{
        text-align:center;
    }
    body
{
    counter-reset: Serial;          
}
table
{
    border-collapse: separate;
}
tbody tr td:first-child:before
{
  counter-increment: Serial;     
  content: counter(Serial); 
}
    </style>
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                       <a style="float:right; color:white;" href="<?php echo base_url('Chrm/payroll_setting?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>" class="btnclr btn  m-b-5 m-r-2"><i class="ti-align-justify"> </i> Manage Taxes </a>
                    </div>
                </div>
                    <div class="panel-body">
                    <?php echo  form_open('Caccounts/create_tax_federal') ?>
                    <input type="hidden" name="url" value="<?php echo  $this->uri->segment(2);  ?>"/>
                    <input type="hidden" name="tax_name" value="Social Security"/>
                    <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                    <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id'];  ?>" name="adminId" />
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <table class="table table-bordered table-hover"   id="POITable"  border="0">
        <thead>
<tr class="btnclr" >
            <th rowspan="2" style="padding-bottom: 45px;"><?php echo display('sl') ?></th>
            <th rowspan="2" style="padding-bottom: 45px;">Employer%<strong><i class="text-danger">*</i></strong></th>
            <th rowspan="2" style="padding-bottom: 45px;">Employee%<strong><i class="text-danger">*</i></strong></th>
            <th rowspan="2" style="padding-bottom: 45px;">Details<strong><i class="text-danger">*</i></strong></th>
            <th colspan="2">Single<strong><i class="text-danger">*</i></strong></th>
             <th colspan="2">Tax filling jointly / Married<strong><i class="text-danger">*</i></strong></th>
          <th colspan="2">Married - file separately<strong><i class="text-danger">*</i></strong></th>
          <th colspan="2">Head of household<br>(single mom / father - have children)<strong><i class="text-danger">*</i></strong></th>
            <th rowspan="2" style="padding-bottom: 45px;"><?php echo display('delete') ?></th>
            <th rowspan="2" class="btnclr" style="padding-bottom: 45px;"><?php echo display('add_more') ?></th>
<tr class="btnclr">
    <th>From</th>
    <th>To</th>
    <th>From</th>
    <th>To</th>
    <th>From</th>
    <th>To</th>
    <th>From</th>
    <th>To</th>
</tr>
</thead>
<tbody>
        <?php  $s=1; if($taxinfo){foreach ($taxinfo as $tax) {  ?>
        <tr>
            <td></td>
            <td class="paddin5ps" required><input  type="text" class="form-control" id="start_amount" value="<?php if($tax['employer']){ echo $tax['employer'];}else{echo "0";} ?>" name="employer[]"  required/>

                <input  type="hidden" class="form-control" id="row_id" value="<?php if($tax['id']){ echo $tax['id'];}else{echo "0";} ?>" />
            </td>
            <td class="paddin5ps"><input  type="text" class="form-control" id="end_amount" value="<?php if($tax['employee']){ echo $tax['employee'];}else{echo "0";} ?>"  name="employee[]"  required/></td>
            <td class="paddin5ps"><input  type="text" class="form-control" id="details"  value="<?php if($tax['details']){ echo $tax['details'];}else{echo "0";} ?>" name="details[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="single_from" value="<?php if($tax['single']){ $split=explode('-',$tax['single']); if($split[0]){ echo $split[0];}else{echo "0";}} ?>"  name="single_from[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="single_to" value="<?php if($tax['single']){ $split=explode('-',$tax['single']); if($split[1]){ echo $split[1];}else{echo "0";}} ?>"  name="single_to[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="tax_filling_from" value="<?php if($tax['tax_filling']){ $split=explode('-',$tax['tax_filling']); if($split[0]){ echo $split[0];}else{echo "0";}} ?>"  name="tax_filling_from[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="tax_filling_to" value="<?php if($tax['tax_filling']){ $split=explode('-',$tax['tax_filling']); if($split[1]){ echo $split[1];}else{echo "0";}} ?>"  name="tax_filling_to[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="married_from" value="<?php if($tax['married']){ $split=explode('-',$tax['married']); if($split[0]){ echo $split[0];}else{echo "0";}} ?>"  name="married_from[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="married_to" value="<?php if($tax['married']){ $split=explode('-',$tax['married']); if($split[1]){ echo $split[1];}else{echo "0";}} ?>"  name="married_to[]"  required/></td>
             <td class="paddin5ps"><input  type="text" class="form-control" id="head_household_from" value="<?php if($tax['head_household']){ $split=explode('-',$tax['head_household']); if($split[0]){ echo $split[0];}else{echo "0";}} ?>"  name="head_household_from[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="head_household_to" value="<?php if($tax['head_household']){ $split=explode('-',$tax['head_household']); if($split[1]){ echo $split[1];}else{echo "0";}} ?>"  name="head_household_to[]"  required/></td>
              <td class="paddin5ps"><button type="button" id="delPOIbutton" class="btn btn-danger getDataRow" value="Delete" onclick="deleteTaxRow(this)"><i class="fa fa-trash"></i></button></td>
            <td class="paddin5ps"><button type="button" id="addmorePOIbutton" style="color:white;" class="btnclr btn"  value="Add More POIs" onclick="TaxinsRow()"><i class="fa fa-plus-circle"></button></td>
        </tr>
       <?php $s++; }}else{  ?>
        <tr>
            <td></td>
            <td class="paddin5ps" required><input  type="text" class="form-control" id="start_amount"  name="employer[]"  required/></td>
            <td class="paddin5ps"><input  type="text" class="form-control" id="end_amount"   name="employee[]"  required/></td>
            <td class="paddin5ps"><input  type="text" class="form-control" id="rate"   name="details[]"  required/></td>
             <td class="paddin5ps"><input  type="text" class="form-control" id="rate"   name="single_from[]"  required/></td>
              <td class="paddin5ps"><input  type="text" class="form-control" id="rate"   name="single_to[]"  required/></td>
               <td class="paddin5ps"><input  type="text" class="form-control" id="rate"   name="tax_filling_from[]"  required/></td>
                <td class="paddin5ps"><input  type="text" class="form-control" id="rate"   name="tax_filling_to[]"  required/></td>
                <td><input  type="text" class="form-control" id="rate"   name="married_from[]"  required/></td>
                <td><input  type="text" class="form-control" id="rate"   name="married_to[]"  required/></td>
                <td><input  type="text" class="form-control" id="rate"   name="head_household_from[]"  required/></td>
                <td class="paddin5ps"><input  type="text" class="form-control" id="rate"   name="head_household_to[]"  required/></td>
            <td class="paddin5ps"><button type="button" id="delPOIbutton" class="btn btn-danger"  value="Delete" onclick="deleteTaxRow(this)"><i class="fa fa-trash"></i></button></td>
            <td class="paddin5ps"><button type="button" id="addmorePOIbutton" style="color:white; " class="btnclr btn" value="Add More POIs" onclick="TaxinsRow()"><i class="fa fa-plus-circle"></button></td>
        </tr>
               <?php $s++; }   ?>
        </tbody>
        </table>
        <br>
                        <div class="form-group text-center">
                            <button type="submit" style="color:white; " class="btnclr btn w-md m-b-5"><?php echo display('setup') ?></button>
                        </div>
                    <?php echo form_close() ?>
                 </div>  
             </div>
        </div>
    </div>
    </section>
</div>

<script>
    var csrfName = $('.txt_csrfname').attr('name'); 
    var csrfHash = $('.txt_csrfname').val();

    $('.alert').delay(1000).fadeOut('slow');

    $('.getDataRow').on('click', function() {
       var rowId = $(this).closest('tr').find('#row_id').val();
       var confirmDelete = confirm("Are you sure you want to delete this?");
       if (confirmDelete) {
          $.ajax({
             url:"<?php echo base_url(); ?>Caccounts/delete_federal",
             type: 'POST',
             data: {[csrfName]: csrfHash,rowId:rowId},
             success: function(data){
                toastr.success("Successfully Deleted", "Success", { 
                   closeButton: false,
                   timeOut: 1000
                });

                setTimeout(function() {
                   location.reload();
                }, 1000);
             },
             error: function(xhr, status, error) {
                toastr.error(error, "Error", { 
                   closeButton: false,
                   timeOut: 1000
                });
             }
          });
       }
    });
</script>
