 <?php
    $CI = & get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
    // date_default_timezone_set($Web_settings[0]['timezone']);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= (isset($title)) ? $title : "Online & Offline Inventory System" ?></title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php
        if (isset($Web_settings[0]['logo'])) {
            echo $Web_settings[0]['favicon'];
        }
        ?>" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="<?= base_url() ?>assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?= base_url() ?>assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?= base_url() ?>assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?= base_url() ?>assets/dist/img/ico/apple-touch-icon-144-precomposed.png">
        <!-- Start Global Mandatory Style-->

       <!-- jquery ui css -->
        <link href="<?= base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap --> 
        <link href="<?= base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <?php if (!empty($Web_settings[0]['rtr']) && $Web_settings[0]['rtr'] == 1) {  ?>
        <!-- THEME RTL -->
        <link href="<?= base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <!-- Font Awesome 4.7.0 -->
        <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
  
        <!-- sliderAccess css -->
        <link href="<?= base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
        <link href="<?= base_url() ?>assets/css/wickedpicker.min.css" rel="stylesheet" type="text/css"/>
        <!-- slider  -->
        <link href="<?= base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
        <!-- DataTables CSS -->
        <link href="<?= base_url('assets/datatables/jquery.dataTables.css') ?>" rel="stylesheet" type="text/css"/> 
        <link href="<?= base_url('assets/datatables/colReorder.dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
          <!-- pe-icon-7-stroke -->
        <link href="<?= base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- themify icon css -->
        <link href="<?= base_url('assets/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- Pace css -->
        <link href="<?= base_url('assets/css/toastr.min.css'); ?>" rel=stylesheet type="text/css"/>
   
        <link href="<?= base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?= base_url('assets/css/custom.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/datatables/buttons.dataTables.min.css">     

       
        <?php if (!empty($Web_settings[0]['rtr']) && $Web_settings[0]['rtr'] == 1) {  ?>
            <!-- THEME RTL -->
            <link href="<?= base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <!-- jQuery -->
       <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js?v=3.4.1') ?>" type="text/javascript"></script>
       <script src="<?php echo base_url() ?>assets/js/wickedpicker.min.js" ></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
        
    </head>
    <body class="hold-transition sidebar-mini">
                <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <!--<p>Please wait...</p>-->
            </div>
        </div>
        <!-- #END# Page Loader -->
        <div class="se-pre-con"></div>

        <!-- Site wrapper -->
        <div class="wrapper">
            <?php 
            $url = $this->uri->segment(2);
            if ($url != "login") { $this->load->view('include/admin_header'); } ?>
            {content}
            <?php if ($url != "login") { $this->load->view('include/admin_footer'); } ?>
        </div>
        <!-- ./wrapper -->

        <!-- Start Core Plugins-->
        <script src="<?= base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
        <!-- bootstrap js -->
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
        <!-- pace js -->
        <script src="<?= base_url('assets/js/pace.min.js') ?>" type="text/javascript"></script>  
        <!-- SlimScroll -->
        <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>  
        <!-- bootstrap timepicker -->
     
        <script src="<?= base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> 
        <!-- select2 js -->
        <script src="<?= base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>

        <!-- DataTables JavaScript -->
        <!-- <script src="<?= base_url("assets/datatables/dataTables.min.js") ?>"></script> -->
        <script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/dataTables.colReorder.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/datatables/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/datatables/buttons.colVis.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/vfs_fonts.js"></script>
        <script src="<?= base_url('assets/datatables/buttons.html5.min.js'); ?>"></script>
        <script src="<?= base_url('assets/datatables/buttons.print.min.js'); ?>"></script>

        <!-- ChartJs JavaScript -->
        <script src="<?= base_url('assets/js/Chart.min.js?v=2.5') ?>" type="text/javascript"></script>

        <!-- Table Head Fixer -->
        <script src="<?= base_url() ?>assets/js/tableHeadFixer.js" type="text/javascript"></script> 
        <!-- Admin Script -->
        <script src="<?= base_url('assets/js/frame.js') ?>" type="text/javascript"></script> 
        <script src="<?= base_url('assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script> 
        <script src="<?= base_url('assets/js/toastr.min.js'); ?>"></script>
        <script src="<?= base_url() ?>assets/js/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script> 

        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url() ?>assets/js/custom.js" type="text/javascript"></script>
        <!-- summernote js -->

        <script src="<?= base_url() ?>assets/js/jstree.min.js" ></script>
    </body>
</html>