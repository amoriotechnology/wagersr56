<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js" ></script>

<!-- Company List Start -->
<style>
.btnclr{
   background-color:<?= $setting_detail[0]['button_color']; ?>;
   color: white;
}
.style-column {
   max-width: 200px;
   word-wrap: break-word;
   word-break: break-word;
   white-space: normal;
}
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?= display('manage_company') ?></h1>
         <small></small>
         <ol class="breadcrumb">
            <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
            <li><a href="#"><?= display('web_settings') ?></a></li>
            <li class="active" style="color:orange;" ><?= display('manage_company') ?></li>
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

      <!-- Company List -->
      <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                  <div class="panel-heading">
                     <div class="panel-title">
                        <a href="<?= base_url('company_setup/company_branch?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>" class="btnclr btn m-b-5 m-r-2" style="color:white;" ><i class="ti-plus"> </i> <?= display('Add Company') ?>  </a>
                     </div>
                  </div>
                    <div class="panel-body">
                        <div id="dataTableExample3">
                            <table class="table table-bordered" cellspacing="0" width="100%" id="company_list">
                                <thead>
                                    <tr style="background-color: #424f5c;color:#fff;">
                                       <th>S.No</th>
                                       <th>User Name</th>
                                       <th>Company Name</th>
                                       <th>Address</th>
                                       <th>Mobile</th>
                                       <th>Website</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
</div>
<!-- Company List End -->

<script type="text/javascript">
$(document).ready(function() {
   if ($.fn.DataTable.isDataTable('#company_list')) {
      $('#company_list').DataTable().clear().destroy();
   }
   var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
   var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
   $('#company_list').DataTable({
      "processing": true,
      "serverSide": true,
      "lengthMenu":[[10,25,50,100],[10,25,50,100]],
      "ajax": {
           "url": "<?= base_url('Company_setup/companyLists?id='); ?>" +encodeURIComponent('<?= $_GET['id']; ?>')+'&admin_id='+'<?= $_GET['admin_id'] ?>',
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
           { "data": "company_id" },
           { "data": "username", "className": "style-column" },
           { "data": "company_name", "className": "style-column" },
           { "data": "address" , "className": "style-column"},
           { "data": "mobile" },
           { "data": "website", "className": "style-column" },
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
          localStorage.setItem('company', JSON.stringify(data));
      },
      "stateLoadCallback": function(settings) {
          var savedState = localStorage.getItem('company');
          return savedState ? JSON.parse(savedState) : null;
      },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
         "buttons": [
         {
            "extend": "copy",
            "className": "btn-sm",
            "exportOptions": { "columns": ':not(:last-child)' }
         },
         {
            "extend": "csv",
            "title": "Manage Company",
            "className": "btn-sm",
            "exportOptions": { "columns": ':not(:last-child)' }
         },
         {
            "extend": "pdf",
            "title": "Manage Company",
            "className": "btn-sm",
            "exportOptions": { "columns": ':not(:last-child)' }
         },
         {
             "extend": "print",
             "title": "Manage Company",
             "className": "btn-sm",
             "exportOptions": { "columns": ':not(:last-child)' },
             "customize": function(win) {
                 $(win.document.body).css('font-size', '14px') .css('text-align', 'center') .css('margin', '0') .css('padding', '0'); 
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
