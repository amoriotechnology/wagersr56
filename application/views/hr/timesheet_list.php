<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js" /></script>
<style type="text/css">
.style-column {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>
<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url() ?>assets/images/payslip.png" class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9"><h1>Manage Time Sheet</h1></div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;" >
               <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
               <li><a href="#"><?php echo display('hrm') ?></a></li>
               <li class="active" style="color:orange"><?php echo ('Manage Time Sheet') ?></li>
            <div class="load-wrapp">
               <div class="load-10">
                  <div class="bar"></div>
               </div>
            </div>
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
      <div class="panel panel-bd lobidrag">
         <div class="panel-heading" style="height: 60px;border: 3px solid #D7D4D6;">
            <div class="col-sm-12" style="height:69px;">
                <div class="col-sm-2" style="display: flex; justify-content: space-between; align-items: left;">
                <?php  foreach(  $this->session->userdata('admin_data') as $test){
                    $split=explode('-',$test);
                    if(trim($split[0])=='hrm' && $_SESSION['u_type'] ==3 && trim($split[1])=='1000'){
                    ?>
                <a href="<?php echo base_url('Chrm/add_timesheet').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>" class="btn btnclr dropdown-toggle" style="color:white;border-color: #2e6da4;height: fit-content;"><i class="far fa-file-alt"> </i> <?php echo ('Add Time Sheet') ?></a> 

                <?php break;}} 
                    if($_SESSION['u_type'] == 2) { 
                ?>
                <a href="<?php echo base_url('Chrm/add_timesheet').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>" class="btn btnclr dropdown-toggle" style="color:white;border-color: #2e6da4;height: fit-content;"><i class="far fa-file-alt"> </i> <?php echo ('Add Time Sheet') ?></a>
                <?php  } ?>
                </div>
                <div class="col-md-6 col-sm-6" style="display: flex; justify-content: center; align-items: center;">
                    <label>Employee</label>&nbsp;&nbsp;&nbsp;
                    <select id="customer-name-filter" name="employee_name" class="form-control employee_name">
                        <option value="All">All</option>
                        <?php
                          foreach ($employee_data as $emp) {
                            $emp['first_name']=trim($emp['first_name']);
                            $emp['last_name']=trim($emp['last_name']);
                          ?>
                        <option value="<?php echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; ?>"><?php echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
         </div>
         
         <div class="row">
            <div class="col-sm-12">
               <div class="panel panel-bd lobidrag">
                  <div class="panel-body" style="border: 3px solid #D7D4D6;">
                     <table class="table table-bordered" cellspacing="0" width="100%" id="managetimesheetList">
                        <thead>
                           <tr class="btnclr">
                                <th class="text-center"><?php echo display('sl') ?></th>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Job title</th>
                                <th class="text-center">Payroll Type</th>
                                <th class="text-center">Date Range</th>
                                <th class="text-center">Total Hours/Days</th>
                                <th class="text-center">Payslip Status</th>
                                <th class="text-center">Action</th>
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



<script type="text/javascript">
var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

var manageTimesheetdata;
$(document).ready(function() {

    if ($.fn.DataTable.isDataTable('#managetimesheetList')) {
        $('#managetimesheetList').DataTable().clear().destroy();
    }
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    manageTimesheetdata = $('#managetimesheetList').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "order": [[0, "desc"]],
        "ajax": {
            "url": "<?php echo base_url('Chrm/manageTimesheetListData?id='); ?>" + 
                encodeURIComponent('<?php echo $_GET['id']; ?>') + 
                '&admin_id=' + encodeURIComponent('<?php echo $_GET['admin_id']; ?>'),

            "type": "POST",
            "data": function(d) {
                d['<?php echo $this->security->get_csrf_token_name(); ?>'] =
                    '<?php echo $this->security->get_csrf_hash(); ?>';
                d.employee_name = $('.employee_name').val(); 
            },
            "dataSrc": function(json) {
               csrfHash = json[
                    '<?php echo $this->security->get_csrf_token_name(); ?>'];
                return json.data;
            }
        },
         "columns": [
         { "data": "id" },
         { "data": "first_name" , "className": "style-column" },
         { "data": "job_title" , "className": "style-column" },
         { "data": "payroll_type" , "className": "style-column" },
         { "data": "month" },
         { "data": "total_hours" },
         { "data": "uneditable" },
         { "data": "action" },
         ],
        "columnDefs": [{
            "orderable": false,
            "targets": [0, 7],
            searchBuilder: {
                defaultCondition: '='
            },
            "initComplete": function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $(
                            '<select><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util
                                .escapeRegex(
                                    $(this).val()
                                );
                            column.search(val ? '^' + val + '$' :
                                '', true, false).draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d +
                            '">' + d + '</option>')
                    });
                });
            },
        }],
        "pageLength": 10,
        "colReorder": true,
        "stateSave": true,
        "stateSaveCallback": function(settings, data) {
            localStorage.setItem('managetimesheet', JSON.stringify(data));
        },
        "stateLoadCallback": function(settings) {
            var savedState = localStorage.getItem('managetimesheet');
            return savedState ? JSON.parse(savedState) : null;
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "buttons": [{
                "extend": "copy",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':not(:eq(7))'
                }
            },
            {
                "extend": "csv",
                "title": "Manage Timesheet",
                "text": "Excel",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':not(:eq(7))'
                }
            },
            {
                "extend": "print",
                "className": "btn-sm",
               "title": "Manage Timesheet",
                "exportOptions": {
                    "columns": ':not(:eq(7))'
                },
            },
            {
               "extend": "colvis",
               "className": "btn-sm"
            }
        ]
    });

    $('.employee_name').on('change', function() {
        manageTimesheetdata.ajax.reload();
    });

});

// Delete Employee List Data - Madhu
function deleteTimesheetdata(id, month) 
{
    var succalert = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    
    var failalert = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    if (id !== "") {
        var confirmDelete = confirm("Are you sure you want to delete this Timesheet?");
    
        if (confirmDelete) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo base_url(); ?>chrm/timesheet_delete",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': csrfHash, id: id, month: month},
                success: function(response) {
                    console.log(response, "response");
                    if (response.status === 'success') {
                        toastr.success(response.msg, "Success", { 
                           closeButton: false,
                           timeOut: 1000
                        });
                        window.setTimeout(function() {
                            manageTimesheetdata.ajax.reload(null, false);
                            $('.error_display').html('');
                        }, 2500);
                    } else {
                        toastr.error(response.msg, "Error", { 
                           closeButton: false,
                           timeOut: 1000
                        });
                    }
                },
                error: function(error) {
                    toastr.error(error, "Error", { 
                        closeButton: false,
                        timeOut: 1000
                    });
                }
            });
        }
    }
}

</script>

<style type="text/css">


.form-control{
    width: 40% !important;
}


.error-border {
    border: 2px solid red;
}

.green{
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
      background-color: #28a745 !important;
    border-radius: 10px;
}
.red{
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #B22222 !important;
    border-radius: 10px;
}
</style>
