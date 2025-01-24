<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?php echo 'Calendar View' ?></h1>
         <small></small>
         <ol class="breadcrumb">
            <li><a href="<?php echo base_url('/') ?>"><i class="pe-7s-home"></i> <?php echo 'Home' ?></a></li>
            <li class="active" style="color: orange;"><?php echo 'Calendar' ?></li>
         </ol>
      </div>
   </section>
   <style>
      th{
      text-align:center;
      }
   </style>
   <section class="content">
      <!-- Manage Language -->
      <?php
         $message = $this->session->userdata('message');
         if (isset($message)) {
         ?>
      <div class="alert alert-info alert-dismissable" style="background-color:#38469f;color:white;font-weight:bold;">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $message ?>                    
      </div>
      <?php 
         }
         ?>
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-heading">
                  <div class="panel-title">
                     <button class="btn btnclr" data-toggle="modal" data-target="#calanderreminders">+ Add Reminder</button>
                  </div>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <div id="calendar"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<style type="text/css">
   .btn-info{
      background-color: #38469f !important;
      border-color: #38469f !important;
   }

   .badge{
      background-color: #28a745 !important;
   }
   
   .color_text{
       color: #000 !important;
   }
</style>

<?php 
   $modaldata['bootstrap_modals'] = array('calanderreminders');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>

<script src='https://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-2.4.0/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.min.js'></script>

<script type="text/javascript">
  $(document).ready(function() {
      var insertdata = '<?php echo $insertdata; ?>';
      var eventData = JSON.parse(insertdata);  
      var currentDate = new Date();
      $('#calendar').fullCalendar({
         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
         },
         defaultDate: currentDate,
         editable: false,
         eventLimit: true, 
         events: eventData
      });

      $('#calendar').on('click', '.fc-prev-button', function() {
         $('#calendar').fullCalendar( 'removeEvents' );
         $('#calendar').fullCalendar( 'addEventSource', eventData);
      });
  });
</script>

