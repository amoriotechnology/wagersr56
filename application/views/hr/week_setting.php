<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js" ></script>

<?php  error_reporting(1); ?>
<!-- Manage Invoice Start -->
<style>
table.table.table-hover.table-borderless td {
   border: 0;
}

.select2{
   display:none;
}

.btnclr{
   background-color:<?= $setting_detail[0]['button_color']; ?>;
   color: white;
}

tr.noBorder td {
   border: 0;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
   border-top:none;
}

.bg-success {
    background-color: green;
}
</style>
 

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
        <figure class="one">
            <img src="<?= base_url('assets/images/hrpayrollreport.png'); ?>"  class="headshotphoto" style="height:50px;" />
        </figure>
      </div>
      
      <div class="header-title">
        <div class="logo-holder logo-9"><h1>Week Setting</h1></div>
 
       <small></small>
         <ol class="breadcrumb" style="border: 3px solid #d7d4d6;">
         <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
            <li><a href="#">HRM</a></li>
            <li class="active" style="color:orange">Week Setting</li>
         </ol>
      </div>
   </section>

 
   <section class="content">
      <!-- Alert Message -->
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
      <!-- date between search -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <div class="row">
                            <form action="<?= base_url('Chrm/save_week_setting'); ?>" method="post">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_week">Start Week</label>
                                            <select name="start_week" id="start_week" class="form-control" required>
                                            <?php
                                                $weeks = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thusday', 5 => 'Friday', 6 => 'Saturday'];
                                                foreach($weeks as $week) {
                                            ?>
                                                <option value="<?= $week ?>" <?= (!empty($setting_detail[0]['start_week']) && ($setting_detail[0]['start_week'] == $week)) ? 'selected' : ''; ?>><?= $week; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_week">End Week</label>
                                            <select name="end_week" id="end_week" class="form-control" required>
                                            <?php foreach($weeks as $week) { ?>
                                                <option value="<?= $week ?>" <?= (!empty($setting_detail[0]['end_week']) && ($setting_detail[0]['end_week'] == $week)) ? 'selected' : ''; ?>><?= $week; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="hidden" name="url_id" value="<?= $_GET['id']; ?>">
                                        <input type="hidden" name="url_admin_id" value="<?= $_GET['admin_id']; ?>">
                                        <button type="submit" name="submit" class="btn btn-primary mt-4">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">Week Setting</h3>
                     <div class="col-sm-9 text-right"></div>
                     <br>

                     <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag" >
                           <div class="panel-body">
                              <div class="table-responsive" >
                                <table class="table table-hover table-bordered" cellspacing="0" width="100%" id="">
                                    <thead>
                                        <tr style="height:25px;">
                                            <th class='btnclr'>SL</th>
                                            <th class='btnclr' class="text-center">Start Week</th>
                                            <th class='btnclr' class="text-center">End Week</th>
                                            <th class='btnclr' class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($setting_detail[0]['start_week'])) { ?>
                                        <tr class="text-center">
                                            <td>1</td>
                                            <td><?= (!empty($setting_detail[0]['start_week'])) ? $setting_detail[0]['start_week'] : ''; ?></td>
                                            <td><?= (!empty($setting_detail[0]['end_week'])) ?  $setting_detail[0]['end_week'] : ''; ?></td>
                                            <td><?= (!empty($setting_detail[0]['start_week']) && !empty($setting_detail[0]['end_week'])) ? '<span class="badge bg-success">Active</span>' : ''; ?> </td>
                                        </tr>
                                        <?php } else { echo '<tr> <td colspan="4" align="center"> No data available in table </td> </tr>'; } ?>
                                    </tbody>
                                </table>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>