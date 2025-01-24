<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
            <img src="<?= base_url('assets/images/payslip.png') ?>" class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9">
         <h1>Generated Pay Slips List</h1>
         </div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;" >
               <li><a href="<?= base_url()?>"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
               <li><a href="#"><?= 'Hr'; ?></a></li>
               <li class="active" style="color:orange"><?= 'Payslip List';?></li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="panel panel-bd lobidrag">
         <div class="panel-heading" style="height: 60px; border: 3px solid #D7D4D6;">
            <div class="col-sm-12" style="position: relative; left: 280px;">
                <div class="col-md-4 col-sm-4" style="display: flex; justify-content: center; align-items: center;">
                    <label>Employee</label>&nbsp;&nbsp;&nbsp;
                    <select id="customer-name-filter" name="employee_name" class="form-control employee_name">
                        <option value="All">All</option> 
                        <?php
                          foreach ($employee_data as $emp) {
                            $emp['first_name']=trim($emp['first_name']);
                            $emp['last_name']=trim($emp['last_name']);
                          ?>
                        <option value="<?= $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; ?>"><?= $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="search">
                      <span class="fa fa-search"></span>
                      <input class="daterangepicker_field dateSearch" name="daterangepicker-field" autocomplete="off" id="daterangepicker-field" placeholder="Search..." readonly>
                    </div>
                    <input type="button" id="searchtrans" name="btnSave" class="btn btnclr" value="Search" style="margin-bottom: 5px; margin-left: 10px;"/>
                </div>
            </div>   
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="error_display mb-2"></div>
               <div class="panel panel-bd lobidrag">
                  <div class="panel-body" style="border: 3px solid #D7D4D6;">
                     <table class="table table-bordered" cellspacing="0" width="100%" id="payslip_list">
                        <thead>
                           <tr class="btnclr">
                              <th class="text-center" width="5%"> S.No </th>
                              <th class="text-center">Employee Name </th>
                              <th class="text-center">Job Title </th>
                              <th class="text-center">Month </th>
                              <th class="text-center">Total hours/Days </th>
                              <th class="text-center">Over Time </th>
                              <th class="text-center">Sales Commision </th>
                              <th class="text-center">Total Amount </th>
                              <th class="text-center" width="8%">Action </th>
                           </tr>
                        </thead>
                        <tfoot>
                            <tr class="btnclr">
                                <th colspan="5" style="text-align:right">Total:</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>     
            </div>
         </div>
      </div>
   </section>
</div>

<style type="text/css">
.style-column {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>

<script type="text/javascript">

var payslipDataTable;

$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#payslip_list')) {
        $('#payslip_list').DataTable().clear().destroy();
    }
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    payslipDataTable = $('#payslip_list').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "ajax": {
            "url": "<?= base_url('Chrm/payslipIndexData?id='); ?>" + 
                encodeURIComponent('<?= $_GET['id']; ?>') + 
                '&admin_id=' + encodeURIComponent('<?= $_GET['admin_id']; ?>'),
            "type": "POST",
            "data": function(d) {
                d['<?= $this->security->get_csrf_token_name(); ?>'] =
                    '<?= $this->security->get_csrf_hash(); ?>';
                d.employee_name = $('.employee_name').val(); 
                d['payslip_date_search'] = $('#daterangepicker-field').val();
            },
            "dataSrc": function(json) {
               csrfHash = json[
                    '<?= $this->security->get_csrf_token_name(); ?>'];
                return json.data;
            }
        },
         "columns": [
         { "data": "table_id" },
         { "data": "first_name" , "className": "style-column" },
         { "data": "job_title" , "className": "style-column" },
         { "data": "month" },
         { "data": "total_hours" },
         { "data": "overtime" },
         { "data": "sales_comm" },
         { "data": "tot_amt" },
         { "data": "action" },
         ],
        "order": [[0, "desc"]],
        "columnDefs": [{
            "orderable": false,
            "targets": [0, 8],
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
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();
        var totalHours = 0;
            var totalAmount = 0;
            var totalOvertimeHours = 0;
            var totalSalesCommission = 0;
            function convertToHours(overtime) {
            if (!overtime) return 0; 
            var timeParts = overtime.split(':');
            var hours = parseInt(timeParts[0], 10) || 0; 
            var minutes = parseInt(timeParts[1], 10) || 0; 
            return hours + minutes / 60;
        }
        function convertToHHMM(totalHours) {
            var hours = Math.floor(totalHours);
            var minutes = Math.round((totalHours - hours) * 60); 
            return hours + ':' + (minutes < 10 ? '0' : '') + minutes; 
        }
            api.rows({ page: 'current' }).every(function() {
                var rowData = this.data();
                totalAmount += parseFloat(rowData.tot_amt) || 0;
                totalOvertimeHours += convertToHours(rowData.overtime); 
                totalSalesCommission += parseFloat(rowData.sales_comm) || 0;
            });
            var totalOvertimeFormatted = convertToHHMM(totalOvertimeHours);
            $(api.column(5).footer()).html(totalOvertimeFormatted); 
            $(api.column(6).footer()).html(totalSalesCommission.toFixed(2)); 
            $(api.column(7).footer()).html(totalAmount.toFixed(2)); 
        },
        "stateSaveCallback": function(settings, data) {
            localStorage.setItem('quotation', JSON.stringify(data));
        },
        "stateLoadCallback": function(settings) {
            var savedState = localStorage.getItem('quotation');
            return savedState ? JSON.parse(savedState) : null;
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "buttons": [{
                "extend": "copy",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':not(:eq(8))'
                }
            },
            {
                "extend": "csv",
                "title": "Generated Pay Slips List Report",
                "text": "Excel",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':not(:eq(8))'
                }
            },
            {
                "extend": "print",
                "className": "btn-sm",
                "title": '',  
                "exportOptions": {
                    "columns": ':not(:eq(8))'  
                },
                "customize": function(win) {
                    $(win.document.body).find('div.dt-buttons').remove();
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend('<div style="text-align:center;"><h3>Generated Pay Slips List</h3></div>');
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    var rows = $(win.document.body).find('table tbody tr');
                    rows.each(function() {
                        if ($(this).find('td').length === 0) {
                            $(this).remove();
                        }
                    });
                    var totalAmount = 0;
                    var totalOvertime = 0;
                    var totalSalesCommission = 0;
                    $(win.document.body).find('table tbody tr').each(function() {
                        var amount = parseFloat($(this).find('td:eq(5)').text()) || 0; 
                        var overtime = parseFloat($(this).find('td:eq(6)').text()) || 0; 
                        var salesCommission = parseFloat($(this).find('td:eq(7)').text()) || 0;
                        totalAmount += amount;
                        totalOvertime += overtime;
                        totalSalesCommission += salesCommission;
                    });
                    $(win.document.body).find('table tbody').append(
                        '<tr>' +
                            '<th colspan="5" style="text-align:right; font-weight: bold;">Total</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + totalAmount.toFixed(2) + '</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + totalOvertime.toFixed(2) + '</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + totalSalesCommission.toFixed(2) + '</th>' +
                        '</tr>'
                    );
                    $(win.document.body).find('div:last-child').css('page-break-after', 'auto');
                }
            },
            {
               "extend": "colvis",
               "className": "btn-sm"
            }
        ]
    });

    $('.employee_name').on('change', function() {
        payslipDataTable.ajax.reload();
    });
    
    $('#searchtrans').on('click', function() {
        var dateValue = $('.dateSearch').val();
        if (dateValue === '') {
            toastr.error('Please select a date before searching.', 'Error');
            $('.dateSearch').addClass('error-border');
            return; 
        }
        toastr.clear();
        $('.dateSearch').removeClass('error-border');
        payslipDataTable.draw();
    });
});
</script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<script src='<?php echo base_url();?>assets/js/moment.min.js'></script>
<script src='<?php echo base_url();?>assets/js/knockout-debug.js'></script>
<script  src="<?php echo base_url() ?>assets/js/scripts.js"></script>
