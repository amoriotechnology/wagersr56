<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url() ?>assets/images/salesreport.png" class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9">
         <h1><?php echo ('Unemployment Tax'); ?></h1>
         </div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;" >
               <li><a href="<?php echo base_url()?>"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
               <li><a href="#"><?php echo display('report') ?></a></li>
               <li class="active" style="color:orange"><?php echo 'Unemployment Tax';?></li>
            <div class="load-wrapp">
               <div class="load-10">
                  <div class="bar"></div>
               </div>
            </div>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="panel panel-bd lobidrag">
         <div class="panel-heading" style="height: 60px;border: 3px solid #D7D4D6;">
            <div class="col-sm-12" style="position: relative; left: 50px;">
              <div class="col-md-2 col-sm-2"></div>
                <div class="col-md-4 col-sm-4" style="display: flex; justify-content: center; align-items: center;">
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
                <div class="col-md-6 col-sm-6">
                    <div class="search">
                      <span class="fa fa-search"></span>
                      <input class="daterangepicker_field dateSearch" name="daterangepicker-field" readonly autocomplete="off" id="daterangepicker-field" placeholder="Search...">
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
                     <table class="table table-bordered" cellspacing="0" width="100%" id="socialsecuritytax_list">
                        <thead>
                            <tr  class="btnclr">
                                <th rowspan="2" class="1 value" data-col="1" style="height: 45.0114px; text-align:center; width: 100px;"><?php echo 'S.NO'?></th>
                                <th rowspan="2" class="2 value" data-col="2" style="text-align:center; width: 100px;"><?php echo 'Employee Name'?></th>
                                 <th rowspan="2" class="2 value" data-col="2" style="text-align:center; width: 100px;"><?php echo 'Employee Tax'?></th>
                                <th rowspan="2" class="3 value" data-col="3" style="text-align:center; width: 100px;"><?php echo 'TimeSheet ID'?></th>
                                <th rowspan="2" class="4 value" data-col="4" style="text-align:center; width: 100px;"><?php echo 'Pay Period'?></th>
                                <th rowspan="2" class="4 value" data-col="4" style="text-align:center; width: 100px;"><?php echo 'Cheque Date'?></th>
                                <th colspan="2" class="4 value" data-col="4" style="text-align:center;width: 300px;"><?php echo ('Unemployment Tax')?></th>
                            </tr>
                            <tr class="btnclr">
                               <th class="4 value" data-col="4" style="text-align:center;width: 200px;"><?php echo ('Employee Contribution')?></th>
                                <th class="4 value" data-col="4" style="text-align:center;width: 200px;"><?php echo ('Employer Contribution')?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="btnclr">
                                <th colspan="6" style="text-align: end;" >Total </th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
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
<script type="text/javascript">
var federalincomeDataTable;
$(document).ready(function() {
$(".sidebar-mini").addClass('sidebar-collapse') ;
    if ($.fn.DataTable.isDataTable('#socialsecuritytax_list')) {
        $('#socialsecuritytax_list').DataTable().clear().destroy();
    }
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    federalincomeDataTable = $('#socialsecuritytax_list').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "ajax": {
            "url": "<?php echo base_url('Chrm/unemploymenttaxIndexData?id='); ?>" +
                encodeURIComponent('<?php echo $_GET['id']; ?>'),
            "type": "POST",
            "data": function(d) {
                d['<?php echo $this->security->get_csrf_token_name(); ?>'] =
                    '<?php echo $this->security->get_csrf_hash(); ?>';
                d.employee_name = $('.employee_name').val(); 
                d['federal_date_search'] = $('#daterangepicker-field').val();
            },
            "dataSrc": function(json) {
               csrfHash = json[
                    '<?php echo $this->security->get_csrf_token_name(); ?>'];
                return json.data;
            }
        },
         "columns": [
         { "data": "table_id" },
         { "data": "first_name" },
         { "data": "employee_tax" },
         { "data": "timesheet_id" },
         { "data": "month" },
         { "data": "cheque_date" },
         { "data": "u_utax" },
         { "data": "tu_utax" },
         ],
        "order": [[0, "desc"]],
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
        "colReorder": false,
        "stateSave": true,
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            function calculateTotal(columnIndex) {
                var total = 0;
                api.column(columnIndex, { page: 'current' }).data().each(function(value) {
                    if (value && typeof value === 'string') {
                        total += parseFloat(value.replace(/[^0-9.-]/g, '')) || 0; 
                    }
                });
                return total;
            }
            var employeeContributionTotal = calculateTotal(6);
            var employerContributionTotal = calculateTotal(7);
            $(api.column(6).footer()).html('$' + employeeContributionTotal.toFixed(2));
            $(api.column(7).footer()).html('$' + employerContributionTotal.toFixed(2));
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
                    "columns": ':visible'
                }
            },
            {
                "extend": "csv",
                "title": "Unemployment Tax Report",
                "text": "Excel",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": "print",
                "className": "btn-sm",
                "title": "",
                "exportOptions": {
                    "columns": ':visible'
                },
                "customize": function(win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<div style="text-align:center;"><h3>Unemployment Tax</h3></div>'
                        );
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    var rows = $(win.document.body).find('table tbody tr');
                    rows.each(function() {
                        if ($(this).find('td').length === 0) {
                            $(this).remove();
                        }
                    });
                    var employeeContributionTotal = 0;
                    var employerContributionTotal = 0;
                    $(win.document.body).find('table tbody tr').each(function() {
                        var employeeamount = parseFloat($(this).find('td:eq(6)').text()) || 0; 
                        var employeramount = parseFloat($(this).find('td:eq(7)').text()) || 0;
                        employeeContributionTotal += employeeamount;
                        employerContributionTotal += employeramount;
                    });
                    $(win.document.body).find('table tbody').append(
                        '<tr>' +
                            '<th colspan="6" style="text-align:right; font-weight: bold;">Total</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + employeeContributionTotal.toFixed(2) + '</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + employerContributionTotal.toFixed(2) + '</th>' +
                        '</tr>'
                    );
                    $(win.document.body).find('div:last-child')
                        .css('page-break-after', 'auto');
                    $(win.document.body)
                        .css('margin', '0')
                        .css('padding', '0');
                }
            },
            {
                extend: 'colvis',
                className: 'btn-sm',
                columnText: function (dt, idx, title) {
                    if (title === 'Employee Contribution') {
                        return 'Unemployment Employee Contribution';
                    } else if (title === 'Employer Contribution') {
                        return 'Unemployment Employer Contribution';
                    }
                    return title;
                }
            }
        ]
    });
    $('.employee_name').on('change', function() {
        federalincomeDataTable.ajax.reload();
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
        federalincomeDataTable.draw();
    });
});
</script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<script src='<?php echo base_url();?>assets/js/moment.min.js'></script>
<script src='<?php echo base_url();?>assets/js/knockout-debug.js'></script>
<script  src="<?php echo base_url() ?>assets/js/scripts.js"></script>