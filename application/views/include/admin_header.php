<script src="https://kit.fontawesome.com/38e0f06f81.js" crossorigin="anonymous"></script>
<?php
   $CI = & get_instance();
   $CI->load->model('Web_settings');
   $CI->load->model('Users');
   $CI->load->model('Hrm_model');
   $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
   $retrieve_user_data = $CI->Web_settings->retrieve_user_data();
   

   $user_comp_id = isset($_GET['id']) ? $_GET['id'] : null;
   $adminId = isset($_GET['admin_id']) ? $_GET['admin_id'] : null;
   $userId   = decodeBase64UrlParameter($user_comp_id);
   $adminId   = decodeBase64UrlParameter($adminId);


   $retrieve_admin_data = $CI->Web_settings->retrieve_admin_data($userId, $adminId);

   $state_tax_list = $CI->Hrm_model->state_tax_list();
   $state_tax_list_employer = $CI->Hrm_model->state_tax_list_employer();
   $state_tax_list = is_array($state_tax_list) ? $state_tax_list : [];
   $state_tax_list_employer = is_array($state_tax_list_employer) ? $state_tax_list_employer : [];
   function compare_tax($a, $b) {
      return strcmp($a['tax'], $b['tax']);
   }
   $unique_taxes = array_udiff($state_tax_list_employer, $state_tax_list, 'compare_tax');
   $retrieve_company_data = $CI->Web_settings->retrieve_companyall_data();
   $users = $CI->Users->profile_edit_data();
?>
<style>
   .navbar-custom-menu>.navbar-nav>li>.dropdown-menu {
   position: absolute;
   right: 0;
   left: auto;
   width: 850px;
   top: 111%;
   padding: 20px;
   border-radius: 10px;
   }
   ul.dropdown-submenu {
   padding: 0;
   }
   ul.dropdown-submenu>li {
   list-style: none;
   }
   ul.dropdown-submenu>li>a {
   padding: 5px 10px;
   color: #777;
   display: block;
   clear: both;
   font-weight: 400;
   line-height: 1.42857143;
   white-space: nowrap;
   }
   ul.dropdown-submenu>li>.menu-title a{
   color: #777;
   font-size: 16px;
   font-weight: 500;
   }
   ul.dropdown-submenu>li>a:hover{
   color: #333;
   }
   ul.dropdown-submenu>li>a>i {
   font-size: 16px;
   margin-right: 10px;
   }
</style>
<header class="main-header" style="background-color:<?php echo $Web_settings[0]['top_menu_bar'] ; ?>"  >
   <a href="<?php echo base_url() ?>" class="logo">
      <!-- Logo -->
      <span class="logo-mini">
         <img src="<?php
            if (isset($Web_settings[0]['favicon'])) {
                echo html_escape($Web_settings[0]['favicon']);
            }
            ?>" alt="" style="float: left;" >
      </span>
      <span class="logo-lg">
         <img src="<?php echo base_url().$retrieve_company_data[0]['logo'];?>" alt="" style="float:left;margin-top:10px;"><?php echo $this->session->userdata('company_name'); ?>
      </span>
   </a>
   <!-- Header Navbar -->
   <nav class="navbar navbar-static-top text-center"  style="background-color:<?php echo $Web_settings[0]['top_menu_bar'] ; ?>"  >
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
         <!-- Sidebar toggle button-->
         <span class="sr-only">Toggle navigation</span>
         <span class="pe-7s-keypad"></span>
      </a>
      <?php
         $user_comp_id = $this->session->userdata('user_id');
         $adminId = $this->session->userdata('unique_id');
         $encode_com_id   = encodeBase64UrlParameter($user_comp_id);
         $encode_admin_id   = encodeBase64UrlParameter($adminId);
         $urcolp = '0';
         if($this->uri->segment(2) =="gui_pos" ){
           $urcolp = "gui_pos";
         }
         if($this->uri->segment(2) =="pos_invoice" ){
           $urcolp = "pos_invoice";
         }
         foreach(  $this->session->userdata('admin_data') as $admtest){
         $split=explode('-',$admtest);
         if(trim($split[0])=='sale'){
      ?>
      <?php }}?>
      <?php 
         foreach(  $this->session->userdata('admin_data') as $admtest){
         $split=explode('-',$admtest);
         if(trim($split[0])=='accounts'){
      ?>
      <?php }} ?>
      <?php 
         foreach(  $this->session->userdata('admin_data') as $admtest){
         $split=explode('-',$admtest);
         if(trim($split[0])=='accounts'){
          ?>
      <?php }} ?>
      <?php 
         foreach(  $this->session->userdata('admin_data') as $admtest){
         $split=explode('-',$admtest);
         if(trim($split[0])=='expense'){
      ?>
      <?php }} ?>
      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
               <a href="#" onclick="reminderModals()" data-toggle="modal" data-target="#notifications">
               <i class="pe-7s-bell" title="Alerts"></i>
               <span class="label total_alerts" style="background-color: #fff;"></span>
               </a>
            </li>
            <li class="dropdown notifications-menu">
               <a href="<?php echo base_url('Cinvoice/addCart') ?>">
               <i class="pe-7s-cart" title="View Cart"></i>
               <span class="label total-count"></span>
               </a>
            </li>
            <li class="dropdown notifications-menu">
               <a href="<?php echo base_url('Cservice/help_desk_show') ?>" >
               <i class="pe-7s-help1" title="Help"></i>
               <span class="label" style="background-color: #e53952;">?</span>
               </a>
            </li>
            <!-- settings -->
            <li class="dropdown dropdown-user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
               <div class="dropdown-menu">
                  <?php if($_SESSION['u_type']==2){ ?>
                  <div class="row">
                     <div class="menuCol col-xl-3 col-lg-3 col-md-12">
                        <ul class="dropdown-submenu">
                           <?php 
                              foreach(  $this->session->userdata('admin_data') as $admtest){
                              $split=explode('-',$admtest);
                              if(trim($split[0])=='setting'){
                               ?>
                           <li class="menu-title" style="color:#17202a"><b><?php echo display('role_permission');  ?></b></li>
                           <li><a href=" <?php echo base_url('Permission/add_role') ?>"><i class="pe-7s-users"></i><?php echo display('add_role'); ?></a></li>
                           <li><a href="<?php echo base_url('Permission/role_list') ?>"><i class="ti-dashboard"></i><?php echo display('role_list'); ?></a></li>
                           <li><a href=" <?php echo base_url('Permission/user_assign') ?>"><i class="pe-7s-settings"></i><?php echo display('user_assign_role'); ?></a></li>
                           <?php break; } } ?>
                        </ul>
                     </div>
                     <div class="menuCol col-xl-3 col-lg-3 col-md-12">
                        <ul class="dropdown-submenu">
                         <li class="menu-title" style="color:#17202a"><b><?php echo ('User Details');  ?></b></li>

                           <li> <a href="<?php echo base_url('Company_setup/manage_company?id=' . $encode_com_id . '&admin_id=' . $encode_admin_id); ?>"> <i class="ti-settings"></i>&nbsp;&nbsp;Manage My Company </a> </li>

                           <li><a href="<?php echo base_url('User/manage_user?id=' . $encode_com_id . '&admin_id=' . $encode_admin_id); ?>"><i class="ti-settings"></i>&nbsp;&nbsp;Manage Users </a></li>

                           <li><a href="<?php echo base_url('Admin_dashboard/edit_profile') ?>"><i class="pe-7s-users"></i> <?php  echo  display('user_profile'); ?></a></li>

                         <li><a href=" <?php echo base_url('Admin_dashboard/change_password_form') ?>"><i class="pe-7s-settings"></i><?php   echo display('Change Password'); ?></a></li>
                         
                        </ul>
                     </div>
                     <div class="menuCol col-xl-3 col-lg-3 col-md-12">
                        <ul class="dropdown-submenu">
                           <?php 
                              foreach(  $this->session->userdata('admin_data') as $admtest){
                              $split=explode('-',$admtest);
                              if(trim($split[0])=='setting'){
                           ?>
                           <li class="menu-title" style="color:#17202a"><b><?php echo display('Admin Details');  ?></b></li>
                           
                           <li><a href="<?php echo base_url('/Cweb_setting') ?>"><i class="ti-settings"></i>&nbsp;&nbsp;Setting </a></li>
                           <li><a href=" <?php echo base_url('Admin_dashboard/dashboardsetting') ?>"><i class="ti-dashboard"></i>Dashboard Settings</a></li>
                           <br>
                           <?php            
                              break;
                              }
                              } ?>
                        </ul>
                     </div>
                       <div class="menuCol col-xl-3 col-lg-3 col-md-12">
                          <ul class="dropdown-submenu"><li class="menu-title" style="color:#17202a"><b><?php echo ('LogOut');  ?></b></li>
                           <li><a href="<?php echo base_url('Admin_dashboard/logout') ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;<?php echo display('logout');  ?></a></li>
                           </ul>
                           </div>
                  </div>
                  <?php } ?>
                  <?php if($_SESSION['u_type']==1 ){ ?>
                  <div class="menuCol col-xl-3 col-lg-3 col-md-12">
                     <ul class="dropdown-submenu">
                        <li class="menu-title" style="color:#17202a"><b><?php echo display('Admin Details');  ?></b></li>
                        <li><a href="  <?php echo base_url('Admin_dashboard/edit_profile') ?>"><i class="pe-7s-users"></i><?php echo  display('user_profile'); ?> </a></li>
                        <li><a href=" <?php echo base_url('Admin_dashboard/change_password_form') ?>"><i class="pe-7s-settings"></i><?php   echo display('Change Password'); ?> </a></li>
                        <li><a href="<?php echo base_url('Admin_dashboard/logout') ?>"><i class="pe-7s-key"></i>&nbsp;&nbsp;<?php echo display('logout');  ?></a></li>
                     </ul>
                  </div>
                  <?php } ?>
                  <?php if($_SESSION['u_type']==3){ ?>
                  <div class="menuCol col-xl-3 col-lg-3 col-md-12">
                     <ul class="dropdown-submenu"  style="width: auto;">
                        <li class="menu-title" style="color:#17202a"><b><?php echo display('User Setting');  ?> </b></li>
                        <li><a href="  <?php echo base_url('Admin_dashboard/edit_profile') ?>"><i class="pe-7s-users"></i><?php echo  display('user_profile'); ?> </a></li>
                        <li><a href=" <?php echo base_url('Admin_dashboard/change_password_form') ?>"><i class="pe-7s-settings"></i><?php   echo display('Change Password'); ?> </a></li>
                        <li><a href="<?php echo base_url('Admin_dashboard/logout') ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;<?php echo display('logout');  ?></a></li>
                     </ul>
                  </div>
                  <?php } ?>
               </div>
            </li>
         </ul>
      </div>
   </nav>
</header>
<aside class="main-sidebar" style="background-color:<?php echo $Web_settings[0]['side_menu_bar'] ; ?>" >
   <!-- sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel text-center row" style="display: flex; align-items: center;">
         <div class="image col-md-6">
            <?php if($_SESSION['u_type']==1){ ?>
            <img src="<?php
               if (isset($users[0]['logo'])) {
                  echo base_url().html_escape($users[0]['logo']);
               }
               ?>" class="img-circle" alt="User Image">
            <?php  } 
               elseif($_SESSION['u_type']==2) {?>
            <img src="<?php
               if (isset($Web_settings[0]['logo'])) {
                   echo base_url().html_escape($Web_settings[0]['logo']);
               }
               ?>" class="img-circle" alt="User Image">
            <?php } 
               elseif($_SESSION['u_type']==3)
               {
                  ?>
            <img src="<?php echo base_url().html_escape($users[0]['logo']);?>" class="img-circle" alt="User Image">
            <?php } ?>
         </div>
         <div class="info col-md-6">
            <?php if($_SESSION['u_type']==1) { ?>
            <p>Super User </p>
            <?php } elseif($_SESSION['u_type']==2) { ?>
            <p style="margin-left: -30px;text-wrap: wrap;"><?php echo ($retrieve_admin_data[0]['username']);?> </p>
            <p style="color:white;"> <?php echo ($retrieve_admin_data[0]['unique_id']);?>   </p>
            <?php } elseif($_SESSION['u_type']==3) { ?>
            <p style="margin-left: -30px;text-wrap: wrap;"><?php echo ($retrieve_user_data[0]['username']);?> <?php 
               $data=$this->session->all_userdata();
            ?></p>
            <p style="color:white;"> <?php echo ($retrieve_admin_data[0]['unique_id']);?>   </p>
            <?php } ?>
         </div>
      </div>
      <?php if($_SESSION['u_type']==1) { ?>
      <!-- sidebar menu -->
      <!-- user 1 -->
      <ul class="sidebar-menu">
         <li class="active">
            <a href="<?php echo base_url(); ?>/"><i class="ti-dashboard"></i> <span><?php echo  display('dashboard'); ?></span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
            </span>
            </a>
         </li>
         <li >
            <a href="<?php echo base_url(); ?>user/managecompany"><i class="ti-dashboard"></i> <span><?php echo display('manage_company'); ?></span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
            </span>
            </a>
         </li>
         <li >
            <a href="<?php echo base_url(); ?>user/adadmin"><i class="ti-dashboard"></i> <span><?php   echo  display('Add Admin');  ?></span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
            </span>
            </a>
         </li>
         <li class="treeview  ">
            <a href="#">
            <i class="ti-key"></i> <span><?php echo ('Admin Role');  ?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Permission/superadmin_add_role"><?php echo ('Add Role'); ?></a></li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Permission/super_role_list"><?php echo ('Role List');  ?></a></li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Permission/company_role_assign"><?php echo  ("Admin Assign Role");  ?></a></li>
            </ul>
         </li>
      </ul>
      <?php } if($_SESSION['u_type']==2) { ?>
      <!-- user 2 -->
      <ul class="sidebar-menu">
      <li class="active">
         <a href="<?php echo base_url(); ?>/"><i class="ti-dashboard"></i> <span><?php  echo display('dashboard'); ?></span>
         <span class="pull-right-container">
         <span class="label label-success pull-right"></span>
         </span>
         </a>
      </li>
      <?php 
         foreach(  $this->session->userdata('admin_data') as $admtest){
         $split=explode('-',$admtest);
         if(trim($split[0])=='hrm'){
      ?>
      <!-- Human Resource New menu start -->
      <li class="treeview">
         <a href="javascript:void(0)">
            <i class="fa fa-balance-scale"></i><span><?php  echo display('hrm_management'); ?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
         <ul class="treeview-menu">
            <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/manage_employee?id=<?php echo $encode_com_id . '&admin_id=' . $encode_admin_id; ?>"><?php  echo display('Employee Info (W4 form)');?></a></li>
            <li class="treeview  "><a href="<?php echo base_url(); ?>Chrm/manage_timesheet?id=<?php echo $encode_com_id . '&admin_id=' . $encode_admin_id; ?>"><?php  echo display('Time sheet');?></a></li>
            <li class="treeview  "><a href="<?php echo base_url(); ?>Chrm/pay_slip_list?id=<?php echo $encode_com_id . '&admin_id=' . $encode_admin_id; ?>"><?php  echo display('Pay slip / Checks per user');?></a></li>
           <li class="treeview ">
            <a href="#">
               <i class=""></i> <span><?php echo ('Reports'); ?></span>
               <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu">
               <li class="treeview  ">
                  <a href="#">
                     <i class=""></i> <span><?php echo ('Federal Tax'); ?></span>
                     <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/federal_tax_report?id=<?php echo $encode_com_id; ?>"><?php echo ('Income Tax');?></a></li>
                     <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/social_tax_report?id=<?php echo $encode_com_id; ?>"><?php echo ('Social Security');?> </a></li>
                     <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/medicare_tax_report?id=<?php echo $encode_com_id; ?>"><?php echo ('Medicare');?></a></li>
                     <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/unemployment_tax_report?id=<?php echo $encode_com_id; ?>"><?php echo ('Unemployment');?></a></li>
                     <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/federal_summary?id=<?php echo $encode_com_id; ?>"><?php echo ('Overall Summary');?></a></li>
                  </ul>
               </li>
               <li class="treeview">
               <a href="#">
                  <i class=""></i> <span><?php echo ('State Tax'); ?></span>
                  <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
               </a>
                  <ul class="treeview-menu">
                     <?php if (!empty($state_tax_list)) : ?>
                        <?php foreach ($state_tax_list as $st) : ?>
                           <li class="treeview">
                              <a href="<?php echo base_url('Chrm/report/' . $st['tax']) . '?id=' . $encode_com_id; ?>"><?php echo $st['tax']; ?></a>
                           </li>
                        <?php endforeach; ?>
                     <?php endif; ?>
                     <?php if (!empty($unique_taxes)) : ?>
                        <?php foreach ($unique_taxes as $st) : 
                        if($st['tax'] != "Disability tax"){
                        ?>
                           <li class="treeview">
                              <a href="<?php echo base_url('Chrm/report/' . $st['tax']) . '?id=' . $encode_com_id; ?>"><?php echo $st['tax']; ?></a>
                           </li>
                        <?php 
                        }
                        endforeach; ?>
                     <?php endif; ?>
                        <li class="treeview  ">
                           <a href="<?php echo base_url(); ?>/Chrm/state_summary?id=<?php echo $encode_com_id; ?>"><?php echo ('State Overall Summary');?></a>
                        </li>
                  </ul>                                          
               </li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/city_local_tax"><?php  echo ('City Tax');?></a></li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/city_tax_report"><?php  echo ('County Tax');?></a></li>                   
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/other_tax"><?php  echo ('Other Taxes');?></a></li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>Chrm/OverallSummary?id=<?php echo $encode_com_id; ?>"><?php echo ('Overall Summary');?></a></li>
            </ul>
         </li>
         <li class="treeview ">
            <a href="#">
               <i class=""></i> <span>Settings</span>
               <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu">
               <li class="treeview"> <a href="<?= base_url('Chrm/payroll_setting?id=' . $encode_com_id . '&admin_id=' . $encode_admin_id); ?>">Payroll Setting</a> </li>
               <li class="treeview  "><a href="<?= base_url('Chrm/payslip_setting?id=').$encode_com_id . '&admin_id=' . $encode_admin_id; ?>">Payslip Setting</a></li>                   
               <li class="treeview  "><a href="<?= base_url('Company_setup/manage_company?id=').$encode_com_id . '&admin_id=' . $encode_admin_id; ?>">Manage My Company</a></li>
               <li class="treeview  "><a href="<?= base_url('Chrm/week_setting?id=').$encode_com_id . '&admin_id=' . $encode_admin_id; ?>">Week Setting</a></li>

               <li class="treeview">
                  <a href="#">
                     <i class=""></i> <span>Settings</span>
                     <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="treeview"><a href="<?= base_url('Cweb_setting/notifications?id=').$encode_com_id . '&admin_id=' . $encode_admin_id; ?>">Notification</a>
                     </li>
                     <li class="treeview  <?php echo ($this->uri->segment(2) == 'calender_view') ? 'active' : ''; ?>">
                        <a href="<?= base_url('Cweb_setting/calender_view?id=').$encode_com_id . '&admin_id=' . $encode_admin_id; ?>">
                        <?php echo 'Calendar'; ?></span>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </li>
      </ul>
   </li>
   <li class="treeview">
      <a href="<?php echo base_url(); ?>/Cweb_setting/viewLogs?id=<?php echo $encode_com_id; ?>">
      <i class="fas fa-history"></i><span><?php echo 'Logs'; ?></span></a>
   </li> 
   <!-- Human Resource New menu end -->
   <?php break; } } ?> 
   <?php } if($_SESSION['u_type']==3) { ?>
      <ul class="sidebar-menu">
         <li class="active">
            <a href="<?php echo base_url(); ?>/"><i class="ti-dashboard"></i> <span><?php echo display('dashboard'); ?></span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
            </span>
            </a>
         </li>
         <?php 
            foreach(  $this->session->userdata('perm_data') as $test){
            $split=explode('-',$test);
            if(trim($split[0])=='hrm'){
         ?>
         <li class="treeview  ">
            <a href="#">
            <i class="fa fa-balance-scale"></i><span><?php  echo display('hrm_management'); ?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/manage_timesheet"><?php  echo display('Time sheet');?></a></li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/pay_slip_list"><?php  echo display('Pay slip / Checks per user');?></a></li>
               <li class="treeview  "><a href="<?php echo base_url(); ?>/Chrm/expense_list"><?php echo display("expense");?></a></li>
            </ul>
         </li>
         <?php break; } } ?>              
      </ul>
   </div>
   <?php } ?>
</aside>