<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url() ?>assets/images/salesreport.png" class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9">
        <h1 class="stateTax">State Tax - <?php echo $tax_n; ?></h1>
         </div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;" >
               <li><a href="<?php echo base_url()?>"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
               <li><a href="#"><?php echo display('report') ?></a></li>
               <li class="active" style="color:orange"><?php  echo $tax_n; ?></li>
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
            <div class="col-sm-12" style="position: relative; left: 20%;">
                <div class="col-md-4 col-sm-4" style="display: flex; justify-content: center; align-items: center;">
                    <label>Employee</label>&nbsp;&nbsp;&nbsp;
                    <select id="customer-name-filter" name="employee_name" class="form-control employee_name" style="width: 50% !important">
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
                      <input class="daterangepicker_field dateSearch" name="daterangepicker-field" autocomplete="off" id="daterangepicker-field" placeholder="Search..." readonly>
                    </div>
                    <input type="button" id="searchtrans" name="btnSave" class="btn btnclr" value="Search" style="margin-bottom: 5px; margin-left: 10px;"/>
                    <input type="hidden" name="tax_name" class="taxName" value="<?php echo $tax_n; ?>">
                </div>
            </div>   
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="error_display mb-2"></div>
               <div class="panel panel-bd lobidrag">
                  <div class="panel-body" style="border: 3px solid #D7D4D6;">
                     <table class="table table-bordered" cellspacing="0" width="100%" id="socialsecuritytax_list">
                        <thead class="sortableTable">
                            <tr class="sortableTable__header btnclr">
                                <th rowspan="2" class="1 value" data-col="1" style="height: 45.0114px; text-align:center; "><?php echo 'S.NO'?></th>
                                <th rowspan="2" class="2 value" data-col="2" style="text-align:center;"><?php echo 'Employee Name'?></th>
                                <th rowspan="2" class="2 value" data-col="2" style="text-align:center; "><?php echo 'Employee Tax'?></th>
                                <th rowspan="2" class="2 value" data-col="2" style="text-align:center; "><?php echo 'Working State Tax'?></th>
                                <th rowspan="2" class="2 value" data-col="2" style="text-align:center;"><?php echo 'Living State Tax'?></th>
                                <th rowspan="2" class="3 value" data-col="3" style="text-align:center; "><?php echo 'TimeSheet ID'?></th>
                                <th rowspan="2" class="3 value" data-col="3" style="text-align:center; "><?php echo 'Month'?></th>
                                <th rowspan="2" class="3 value" data-col="3" style="text-align:center; "><?php echo 'Cheque Date'?></th>
                                <th colspan="2" class="3 value" data-col="3" style="text-align:center; "><?php echo 'Employee Contribution'?></th>   

                                 <th colspan="2" class="3 value" data-col="3" style="text-align:center;"><?php echo 'Employer Contribution'?></th>  
                            </tr>
                            <tr class="btnclr" >
                                <th  class="3 value" data-col="3" style="text-align:center; "><?php echo 'Working State Tax'?></th>
                                <th  class="3 value" data-col="3" style="text-align:center;"><?php echo 'Living State Tax'?></th>
                                <th  class="3 value" data-col="3" style="text-align:center; "><?php echo 'Working State Tax'?></th>
                            <th  class="3 value" data-col="3" style="text-align:center; "><?php echo 'Living State Tax'?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="btnclr">
                                <th colspan="8" style="text-align: end;" >Total </th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
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

<style type="text/css">
.style-column {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>

<script type="text/javascript">
var federalincomeDataTable;
$(document).ready(function() {
$(".sidebar-mini").addClass('sidebar-collapse') ;
    if ($.fn.DataTable.isDataTable('#socialsecuritytax_list')) {
        $('#socialsecuritytax_list').DataTable().clear().destroy();
    }
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    var csv_title= $('h1.stateTax').text();

    federalincomeDataTable = $('#socialsecuritytax_list').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "ajax": {
            "url": "<?php echo base_url('Chrm/stateIncomeReportData/Income%20tax?id='); ?>" +
                encodeURIComponent('<?php echo $_GET['id']; ?>'),
            "type": "POST",
            "data": function(d) {
                d['<?php echo $this->security->get_csrf_token_name(); ?>'] =
                    '<?php echo $this->security->get_csrf_hash(); ?>';
                d.employee_name = $('.employee_name').val(); 
                d['federal_date_search'] = $('#daterangepicker-field').val();
                d.taxname = $('.taxName').val();
            },
            "dataSrc": function(json) {
               csrfHash = json['<?php echo $this->security->get_csrf_token_name(); ?>'];
                return json.data;
            }
        },
         "columns": [
            { "data": "table_id" },
            { "data": "first_name" , "className": "style-column"},
            { "data": "employee_tax" },
            { "data": "state_tx" },
            { "data": "living_state_tax" },
            { "data": "time_sheet_id" },
            { "data": "month" },
            { "data": "cheque_date" , "className": "style-column" },
            { "data": "amount" },
            { "data": "weekly" },
            { "data": "employer_tax" },
            { "data": "employer_weekly" },
         ],
        "order": [[0, "desc"]],
        "columnDefs": [{
            "orderable": false,
            "targets": [0, 11],
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
            var employeeContributionTotal = calculateTotal(8);
            var employerContributionTotal = calculateTotal(9);

            var employerworkingContributionTotal = calculateTotal(10);
            var employerstateContributionTotal = calculateTotal(11);

            $(api.column(8).footer()).html('$' + employeeContributionTotal.toFixed(2));
            $(api.column(9).footer()).html('$' + employerContributionTotal.toFixed(2));

            $(api.column(10).footer()).html('$' + employerworkingContributionTotal.toFixed(2));
            $(api.column(11).footer()).html('$' + employerstateContributionTotal.toFixed(2));
        },
        "stateSaveCallback": function(settings, data) {
            localStorage.setItem('StateIncometax', JSON.stringify(data));
        },
        "stateLoadCallback": function(settings) {
            var savedState = localStorage.getItem('StateIncometax');
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
            "title": csv_title,
            "text": "Excel",
            "className": "btn-sm",
                "customize": function(csv) {
                    const replacements = {
                        'Employee Contribution': [
                            'Employee Working State Tax',
                            'Employee Living State Tax',
                        ],
                        'Employer Contribution': [
                            'Employer Working State Tax',
                            'Employer Living State Tax',
                        ]
                    };
                    Object.keys(replacements).forEach(function(oldText) {
                        replacements[oldText].forEach(function(newText) {
                            csv = csv.replace(oldText, newText);
                        });
                    });
                    return csv;
                }
            },
            {
                "extend": "print",
                "className": "btn-sm",
                "title":"",
                "exportOptions": {
                    "columns": ':visible'
                },
                "customize": function(win) {
                    var stateTaxValue = $('h1.stateTax').text();
                   
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<div style="text-align:center;"><h3>' + stateTaxValue + '</h3></div>'
                        );
                    $(win.document.body).css({
                        'margin': '0',
                        'padding': '0',
                        'page-break-after': 'always'
                    });

                    var style = '<style>@media print { @page { size: landscape; } }</style>';
                    $(win.document.head).append(style);

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    var rows = $(win.document.body).find('table tbody tr');
                    rows.each(function() {
                        if ($(this).find('td').length === 0) {
                            $(this).remove();
                        }
                    });
                    
                    var headerRow = $(win.document.body).find('table thead tr');
                    console.log(headerRow.find('th'));
                    headerRow.find('th:eq(7)').text('Employee Working State Tax');
                    headerRow.find('th:eq(8)').text('Employee Living State Tax');
                    headerRow.find('th:eq(9)').text('Employer Working State Tax');
                    headerRow.find('th:eq(10)').text('Employer Living State Tax');
                    $(win.document.body).find('table thead th').css({
                        'font-size': '10px',
                        'word-spacing': '0.5px',
                        'white-space': 'normal',
                        'min-width': '20px',
                        'text-align': 'center',
                        'padding': '5px',
                        'word-wrap': 'break-word'
                    });
                    
                    var employeeWorkingTaxTotal = 0;
                    var employeeLivingStateTaxTotal = 0;
                    var employerWorkingTaxTotal = 0;
                    var employerLivingStateTaxTotal = 0;
 
                    $(win.document.body).find('table tbody tr').each(function() {
                        var employeeamount = parseFloat($(this).find('td:eq(8)').text()) || 0; 
                        var employeramount = parseFloat($(this).find('td:eq(9)').text()) || 0;

                        var Wemployeeamount = parseFloat($(this).find('td:eq(10)').text()) || 0; 
                        var Lemployeramount = parseFloat($(this).find('td:eq(11)').text()) || 0;

                        employeeWorkingTaxTotal += employeeamount;
                        employeeLivingStateTaxTotal += employeramount;

                        employerWorkingTaxTotal += Wemployeeamount;
                        employerLivingStateTaxTotal += Lemployeramount;
                    });
                    $(win.document.body).find('table td').css({
                        'font-size': '11px',
                        'word-spacing': '0.5px',
                        'white-space': 'normal',
                        'min-width': '20px',
                        'text-align': 'center',
                        'padding': '5px',
                        'word-wrap': 'break-word'
                    });
                    $(win.document.body).find('table tbody').append(
                        '<tr>' +
                            '<th colspan="8" style="text-align:right; font-weight: bold;">Total</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + employeeWorkingTaxTotal.toFixed(2) + '</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + employeeLivingStateTaxTotal.toFixed(2) + '</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + employerWorkingTaxTotal.toFixed(2) + '</th>' +
                            '<th style="text-align:center; font-weight: bold;">' + employerLivingStateTaxTotal.toFixed(2) + '</th>' +
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
                    if (idx == 8 && title === 'Working State Tax') {
                        return 'Employee Working State Tax';
                    } else if (idx == 9 && title === 'Living State Tax') {
                        return 'Employee Living State Tax';
                    }
                    if (idx == 10 && title === 'Working State Tax') {
                        return 'Employer Working State Tax';
                    } else if (idx == 11 && title === 'Living State Tax') {
                        return 'Employer Living State Tax';
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

<style type="text/css">
.style-column {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<script src='<?php echo base_url();?>assets/js/moment.min.js'></script>
<script src='<?php echo base_url();?>assets/js/knockout-debug.js'></script>
<script  src="<?php echo base_url() ?>assets/js/scripts.js"></script>

