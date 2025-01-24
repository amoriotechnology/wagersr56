<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css')?>" />
<script src="<?php echo base_url('assets/js/toastr.min.js')?>" ></script>
<?php error_reporting(1);?>
<style>
    .toast-success {
        background-color: #006400 !important;
        color: white !important;
        opacity: 0;
        animation: fadeIn 1s forwards;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    .style-column {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>
<div class="content-wrapper">
    <section class="content-header" style="height: 65px;">
        <div class="header-icon">
            <figure class="one">
            <img src="<?= base_url('assets/images/employee.png') ?>"  class="headshotphoto" style="height:50px;" />

         </div>
        <div class="header-title">
            <div class="logo-holder logo-9">
                <h1><strong><?= ('Manage Employee') ?></strong></h1>
            </div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;">
                <li><a href="<?= base_url(); ?>"><i class="pe-7s-home"></i> <?= display('home') ?></a>
                </li>
                <li class="active" style="color:orange;"><?= ('Manage Employee') ?></li>
                <div class="load-wrapp">
                    <div class="load-10"></div>
                </div>
            </ol>
        </div>
    </section>
      
      
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
        
    <section class="content">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading" style='height:50px;'>
                <div class="panel">
                    <div class="panel-body" style='padding:0px !important'>
                        <div class="col-sm-12">
                        <?php 
                            foreach ($this->session->userdata('admin_data') as $test) {
                            $split = explode('-', $test);
                            if (trim($split[0]) == 'hrm' && $_SESSION['u_type'] == 3 && trim($split[1]) == '1000') {
                        ?>
                            <a href="<?= base_url('Chrm/add_employee?id=' . $id . '&admin_id=' . $admin_id); ?>" class="btn btnclr dropdown-toggle" style="color: white; border-color: #2e6da4; height: fit-content;">
                                <i class="far fa-user"></i>&nbsp;Add Employee
                            </a>
                        <?php break;
                            }
                        }
                        if ($_SESSION['u_type'] == 2) {?>
                            <a href="<?= base_url('Chrm/add_employee?id=' . $id . '&admin_id=' . $admin_id); ?>" class="btn btnclr dropdown-toggle" style="color: white; border-color: #2e6da4; height: fit-content;">
                                <i class="far fa-user"></i>&nbsp;Add Employee
                            </a>
                        <?php }?>

                        <a class="btn btnclr dropdown-toggle"  aria-hidden="true" data-toggle="modal" data-target="#designation_modal" ><b class="fa fa-legal"> </b>&nbsp;<?= ('Form instructions') ?></a>

                        <a href="<?= base_url('Chrm/hr_tools?id=' . $id.'&admin_id='.$admin_id) ?>" class="btn btnclr dropdown-toggle"> <i class="far fa-file-alt"> </i> <?= ('Hand Book') ?></a>

                        <a href="<?= base_url('chrm/w4form?id=' . $id.'&admin_id='.$admin_id) ?>" class="btn btnclr dropdown-toggle"> W4 Form</a>

                        <a class="btnclr btn" href="<?= base_url('chrm/w9form?id=' . $id.'&admin_id='.$admin_id) ?>" >W9 Form</a>
                        &emsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <div id="dataTableExample3">
                            <table class="table table-bordered" cellspacing="0" width="100%" id="employee_list">
                                <thead>
                                    <tr style="background-color: #424f5c;color:#fff;">
                                        <th width="2%">S.No</th>
                                        <th width="10%"><?= display('name') ?></th>
                                        <th width="7%"><?= display('designation') ?></th>
                                        <th width="10%"><?= display('phone') ?></th>
                                        <th width="10%"><?= display('email') ?></th>
                                        <th width="10%">Social Security Number</th>
                                        <th width="8%">Employee Type</th>
                                        <th width="8%">Payroll Type</th>
                                        <th width="7%">Routing number</th>
                                        <th width="7%">Account Number</th>
                                        <th width="7%">Employee Tax</th>
                                        <th width="7%">Type</th>
                                        <th width="7%"><?= display('action') ?></th>
                                        </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script>
   $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#employee_list')) {
            $('#employee_list').DataTable().clear().destroy();
        }

         var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
         var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        $('#employee_list').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu":[[10,25,50,100],[10,25,50,100]],
            "ajax": {
                 "url": "<?= base_url('Chrm/getEmployeeDatas?id='); ?>" +encodeURIComponent('<?= $_GET['id']; ?>')+'&admin_id='+'<?= $_GET['admin_id'] ?>',
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
                 { "data": "first_name", "className": "style-column" },
                 { "data": "designation" , "className": "style-column"},
                 { "data": "phone" },
                 { "data": "email", "className": "style-column" },
                 { "data": "social_security_number" , "className": "style-column"},
                 { "data": "employee_type" },
                 { "data": "payroll_type" },
                 { "data": "routing_number" , "className": "style-column"},
                 { "data": "account_number", "className": "style-column" },
                 { "data": "employee_tax" },
                 { "data": "e_type" },
                 { "data": "action" },
            ],
            "order": [[0, "desc"]],
            "columnDefs": [
                { "orderable": false, "targets": [0, 12] }
            ],
            "pageLength": 10,
            "colReorder": true,
            "stateSave": true,
            "stateSaveCallback": function(settings, data) {
                localStorage.setItem('employee', JSON.stringify(data));
            },
            "stateLoadCallback": function(settings) {
                var savedState = localStorage.getItem('employee');
                return savedState ? JSON.parse(savedState) : null;
            },
           "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "buttons": [
            {
                "extend": "copy",
                "className": "btn-sm",
                "exportOptions": { "columns": ':visible' }
            },
            {
                "extend": "csv",
                "title": "Employee Info",
                "className": "btn-sm",
                "exportOptions": { "columns": ':visible' }
            },
            {
                "extend": "pdf",
                "title": "Employee Info",
                "className": "btn-sm",
                "exportOptions": { "columns": ':visible' }
            },
            {
                "extend": "print",
                "title": "Manage Employee",
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

    
// Delete Employee List Data - Madhu
function deleteEmployeedata(id)
{
    var succalert = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    var failalert = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    
    if (id !== "") {
        var confirmDelete = confirm("Are you sure you want to delete this employee?");

        if (confirmDelete) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?= base_url('Chrm/employee_delete?id='); ?>" +encodeURIComponent('<?= $_GET['id']; ?>')+'&admin_id='+'<?= $_GET['admin_id']; ?>',
                data: {'<?= $this->security->get_csrf_token_name(); ?>': csrfHash, id: id},
                success: function(response) {
                    console.log(response, "response");
                    if (response.status === 'success') {
                        $('.error_display').html(succalert + response.msg + '</div>');
                        window.setTimeout(function() {
                            employeeDataTable.ajax.reload(null, false);
                            $('.error_display').html('');
                        }, 2500);
                    } else {
                        $('.error_display').html(failalert + response.msg + '</div>');
                    }
                },
                error: function() {
                    $('.error_display').html(failalert + 'An unexpected error occurred. Please try again.' + '</div>');
                }
            });
        }
    }
}
</script>

<?php 
    $modaldata['bootstrap_modals'] = array('new_emp_form');
    $this->load->view('include/bootstrap_modal', $modaldata);
?>
