<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js"></script>
<?php  error_reporting(1); ?>

<style type="text/css">
   .badge-success{
      background-color: #28a745!important;
   }
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url(); ?>assets/images/hrpayrollreport.png"  class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      
      <div class="header-title">
         <div class="logo-holder logo-9"><h1>Reminder Notification</h1></div>
 
       <small></small>
         <ol class="breadcrumb" style="border: 3px solid #d7d4d6;">
         <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li><a href="#">Settings</a></li>
            <li class="active" style="color:orange">Reminder Notification</li>
         </ol>
      </div>
   </section>

 
   <section class="content">
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
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <button class="btnclr btn" style="margin-left: 20px !important;" data-toggle="modal" data-target="#reminders"><i class="fa fa-bell" aria-hidden="true"></i> Reminder Setup</button>
                  </div>
               </div>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">Reminder List</h3>
                     <div class="col-sm-9 text-right">
                        
                     </div>
                     <br>

                     <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                           <div class="panel-body">
                              <div class="table-responsive" >
                                 <form action="<?php echo base_url(); ?>Chrm/add_taxes_detail" method="post">
                                    <table class="table table-bordered" id="reminder_list">
                                          <thead>
                                             <tr style="height:25px;">
                                                <th class='btnclr' style="width: 170px;">S.No</th>
                                                <th class='btnclr' class="text-center">Source</th>
                                                <th class='btnclr' class="text-center">Due Date</th>
                                                <th class='btnclr' class="text-center">Schedule Date</th>
                                                <th class='btnclr' class="text-center">Status</th>
                                                <th class='btnclr' class="text-center">Created Date</th>
                                                <th class='btnclr' class="text-center">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             
                                       
                                          </tbody>
                                    </table>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>  
</div>

<?php 
   $modaldata['bootstrap_modals'] = array('reminders');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>

<script>
$(document).ready(function() {
   if ($.fn.DataTable.isDataTable('#reminder_list')) {
      $('#reminder_list').DataTable().clear().destroy();
   }
   var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
   var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
   $('#reminder_list').DataTable({
      "processing": true,
      "serverSide": true,
      "lengthMenu":[[10,25,50,100],[10,25,50,100]],
      "ajax": {
           "url": "<?= base_url('Cweb_setting/reminderLists?id='); ?>" +encodeURIComponent('<?= $_GET['id']; ?>')+'&admin_id='+'<?= $_GET['admin_id'] ?>',
          "type": "POST",
         "data": function(d) {
            d['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
         },
         "dataSrc": function(json) {
             csrfHash = json['<?= $this->security->get_csrf_token_name(); ?>'];
            return json.data;
         }
      },
      "columns": [
           { "data": "id" },
           { "data": "source", "className": "style-column"},
           { "data": "due_date" , "className": "style-column"},
           { "data": "end" , "className": "style-column"},
           { "data": "schedule_status" },
           { "data": "create_date" },
           { "data": "action" },
      ],
      "order": [[0, "desc"]],
      "columnDefs": [
         { "orderable": false, "targets": [0, 6] }
      ],
      "pageLength": 10,
      "colReorder": true,
      "stateSave": true,
      "stateSaveCallback": function(settings, data) {
          localStorage.setItem('notification', JSON.stringify(data));
      },
      "stateLoadCallback": function(settings) {
          var savedState = localStorage.getItem('notification');
          return savedState ? JSON.parse(savedState) : null;
      },
     "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
      "buttons": [
      {
          "extend": "print",
          "title": "Manage Reminder List",
          "className": "btn-sm",
          "exportOptions": { "columns": ':visible' },
          "customize": function(win) {
              $(win.document.body).css('font-size', '10px') .css('text-align', 'center') .css('margin', '0') .css('padding', '0'); 
              $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit'); 

              $(win.document.body).find('h1').css('font-size', '16px') .css('text-align', 'center').css('margin', '0 0 10px 0'); 

              var rows = $(win.document.body).find('table tbody tr');
              rows.each(function() {
                  if ($(this).find('td').length === 0) {
                      $(this).remove();
                  }
              });

              $(win.document.body).find('div:last-child').css('page-break-after', 'auto');
          }
      },
      { "extend": "colvis", "className": "btn-sm" }
  ]
   });
});

</script>



