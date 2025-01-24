<style>
 .table{
   display: block;
   overflow-x: auto;
   }
   .tax_head {
   text-align:center;
   background-color: #34495e;
   color: #fff;
}
.tax_head >label {
   color: #fff;
}
</style>
<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
         <img src="<?php echo base_url() ?>assets/images/salesreport.png"  class="headshotphoto" style="height:50px;" />
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9">
            <h1><?php echo 'State Overall Summary' ?></h1>
         </div>
         <ol class="breadcrumb"   style=" border: 3px solid #d7d4d6;"   >
            <li><a href="<?php echo base_url() ?>"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li><a href="#"><?php echo display('report') ?></a></li>
            <li class="active" style="color:orange"><?php echo 'State Overall Summary'; ?></li>
            <div class="load-wrapp">
               <div class="load-10">
                  <div class="bar"></div>
               </div>
            </div>
         </ol>
      </div>
   </section>
   <section class="content">
<div class="row">
<div class="col-sm-12 col-md-12">
    <div class="panel panel-bd lobidrag" style='height:80px; border: 3px solid #d7d4d6;'>
        <div class='col-sm-12'>
            <form id="fetch_tax">
                <table class="table" align="center" style="overflow-x: unset;position: relative;">
                <tr style='text-align:center;font-weight:bold;' class="filters">
                    <td class="search_dropdown" style="color: black;">
                        <input type="hidden" class="txt_csrfname" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                        <span><?php echo 'Employee'; ?></span>
                        <select id="customer-name-filter" name="employee_name" class="form-control">
                            <option value="All">All</option>
                            <?php
                                foreach ($emp_name as $emp) {
                                    $emp['first_name'] = trim($emp['first_name']);
                                    $emp['last_name']  = trim($emp['last_name']);
                                    ?>
                                <option value="<?php echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; ?>"><?php echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; ?></option>
                                <?php
                            }?>
                        </select>
                    </td>
                    <td class="search_dropdown" style="color: black;">
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="company_id" id="company_id"/>
                        <span>Tax Choice </span>
                        
                        <select id="tax_Choice" name="tax_Choice" class="tax_Choice form-control">
                            <option value="All">All</option>
                            <option value="working_state">Working State Tax</option>
                            <option value="living_state">Living State Tax</option>
                        </select>
                    </td>
                    <td class="search_dropdown" style="color: black;">
                        <span>State</span>
                        <select id="tax_Choice" name='selectState' class="selectState form-control">
                            <option value="">Select Your State</option>
                            <?php foreach ($state_list as $value) {?>
                            <option value="<?php echo $value['state_code']; ?>"><?php echo $value['state']; ?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td class="search_dropdown" style="color: black;">
                        <span>Tax Type </span>
                        <select id="tax_Choice" name='taxType' class="taxType form-control" >
                            <option value="">Select Your Tax Type</option>
                            <?php foreach ($state_tax_list as $value) {?>
                            <option value="<?php echo $value['tax']; ?>"><?php echo $value['tax']; ?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td class="search_dropdown" style="color: black; position: relative; top: 4px;">
                        <div id="datepicker-container">
                            <input type="text" class="form-control daterangepicker_field getdate_reults" id="daterangepicker-field" name="daterangepicker-field" style="margin-top: 15px;padding: 5px; width: 200px; border-radius: 8px; height: 35px;" readonly/>
                        </div>
                    </td>
                    <input type="hidden" class="getcurrency" value="<?php echo $currency; ?>">
                    
                    <td style='float: left;width:30px; position: relative; top: 4px;'>
                        <input type="submit"  name="btnSave" class="btn btnclr" style='margin-top: 15px;' value='Search'/>
                    </td>
                    
                    <td style='float: left; position: relative; top: 19px; left: 50px;'>
                        <button class="btnclr btn btn" onclick="exportToExcel()">Download Excel</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </div>
</div>
</form>
<div class="row">
    <div class="hide_panel panel panel-bd lobidrag" id="panel" style="border: 3px solid #d7d4d6;">
        <div  class="hide_panel panel-body">
            <div class="sortableTable__container">
                <div class="sortableTable__discard"></div>
              
                
           
                    <div class="panel-body">
                
                    <div id='printableArea'>
     <div class="panel-body work_state table-responsive">
               <p class="tax_head work_head"><label>WORKING STATE TAX </label></p>
               <table class="work_state table table-bordered StateTaxTable" cellspacing="0" width="100%" id="StateTaxTable">
                  <thead></thead>
                  <tbody></tbody>
                  <tfoot></tfoot>
               </table>
            </div>
            <div class="panel-body living_state table-responsive">
               <p class="tax_head living_head"><label>LIVING STATE TAX </label></p>
               <table class="living_state table table-bordered LivingStateTaxTable" cellspacing="0" width="100%" id="LivingStateTaxTable">
                  <thead></thead>
                  <tbody></tbody>
                  <tfoot></tfoot>
               </table>
            </div>
         </div>

                    </div>
              
              
            </div>
        </div>
    </div>
</section>
</div>
<script>
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
$(document).ready(function () {
    $('.tax_head,.hide_panel').hide();
   $('#fetch_tax').submit(function (event) {
      event.preventDefault();
      var formData = $(this).serialize();
      var taxtpe = $('#tax_Choice').val();
      $.ajax({
         type: "POST",
         dataType: "json",
         url: "<?= base_url('Chrm/state_tax_search_summary'); ?>",
         data: formData,
         success: function (response) {
            $('.tax_head,.hide_panel').show();
            $('#tablesContainer').css('display', 'block');
             $('.work_state, .living_state').show();
               $('#LivingStateTaxTable_wrapper, #StateTaxTable_wrapper').css('display','block'); 
          if(taxtpe == 'working_state') {
               $('.living_state').hide();
               $('.work_state,.work_head').show();    

               $('#LivingStateTaxTable_wrapper').css('display','none');
            } else if( taxtpe == 'living_state'){
               $('.work_state').hide();
               $('.living_state,.living_head').show();               
               $('#StateTaxTable_wrapper').css('display','none');
            }
            populateTable(response);
         },
         error: function (xhr, status, error) {
            console.error("Error:", xhr.responseText);
         }
      });
   });
});
function initializeTable() {
    var printableArea = $("#printableArea");
    printableArea.empty();
    var tableHtml = `
     <div id='date_period_range' style='text-align: center;font-weight: bolder;font-size: x-large;color: #337ab7;'></div>
        <table class="table table-bordered " cellspacing="0" width="100%"   id="ProfarmaInvList">
            <thead></thead>
            <tbody></tbody>
            <tfoot></tfoot>
         </table>
    `;
    printableArea.append(tableHtml);
}

function generateTaxTable(taxType, employerContributions, employeeContributions, table) {
    const allTaxTypes = {};
    const taxTypeCounts = {};
    
   
    employerContributions.forEach(item => {
        const taxKey = item.tax + "-" + (item.code ? item.code : "");
        allTaxTypes[taxKey] = item.taxType || '';  
        taxTypeCounts[taxKey] = (taxTypeCounts[taxKey] || 0) + 1;
    });
    
   
    employeeContributions.forEach(item => {
        const taxKey = item.tax + "-" + (item.code ? item.code : "");
        allTaxTypes[taxKey] = item.taxType || '';
        taxTypeCounts[taxKey] = (taxTypeCounts[taxKey] || 0) + 1;
    });
    
    const taxTypeMap = {};
    Object.keys(allTaxTypes).forEach(taxKey => {
        const taxType = allTaxTypes[taxKey];
        if (!taxTypeMap[taxType]) {
            taxTypeMap[taxType] = [];
        }
        taxTypeMap[taxType].push(taxKey);
    });
    
    if (Object.keys(taxTypeMap).length > 0) {
        let taxHeaders = "<tr class='btnclr'><th rowspan='2'>S.No</th><th rowspan='2'>Employee Name</th>";
        taxHeaders += "<th rowspan='2' style='border-bottom:none;text-align:center'>Gross</th><th rowspan='2' style='border-bottom:none;text-align:center'>Net</th>";
        
        // Generate tax headers
        Object.keys(taxTypeMap).forEach(taxType => {
            const taxes = taxTypeMap[taxType];
            const displayTaxType = (taxType === "living_state_tax") ? "LIVING STATE TAX" : "WORKING STATE TAX";
            taxHeaders += "<th colspan='" + (2 * taxes.length) + "' style='text-align:center'>" + displayTaxType + "</th>";
        });
        
        taxHeaders += "</tr><tr class='btnclr'>";
        Object.keys(taxTypeMap).forEach(taxType => {
            const taxes = taxTypeMap[taxType];
            taxes.forEach(taxKey => {
                const taxName = taxKey.split('-')[0];
                const code = taxKey.split('-')[1];
                var changecode = code === 'PS' ? 'Pennsylvania' : code === 'ML' ? 'Maryland' : code === 'NJ' ? 'New Jersey' : 'New Jersey';
                taxHeaders += "<th colspan='2' style='text-align:center'>" + taxName + "-" + changecode + "</th>";
            });
        });
        taxHeaders += "</tr><tr class='btnclr'><th></th><th></th><th></th><th></th>"; 
        Object.keys(taxTypeMap).forEach(taxType => {
            const taxes = taxTypeMap[taxType];
            taxes.forEach(() => {
                taxHeaders += "<th style='text-align:center'>Employee Contribution</th><th style='text-align:center'>Employer Contribution</th>";
            });
        });
        taxHeaders += "</tr>";
        table.find("thead").append(taxHeaders);

        const consolidatedContributions = {};
        
     
        employerContributions.forEach(item => {
            const employeeName = item.employee_name;
            const taxKey = item.tax + "-" + (item.code ? item.code : "");
            if (!consolidatedContributions[employeeName]) {
                consolidatedContributions[employeeName] = { gross: 0, net: 0 }; 
            }
            if (!consolidatedContributions[employeeName][taxKey]) {
                consolidatedContributions[employeeName][taxKey] = { employee: "0.00", employer: "0.00" };
            }
            consolidatedContributions[employeeName][taxKey].employer = parseFloat(item.total_amount).toFixed(2) || "0.00";
            
          
            if (item.taxType === 'living_state_tax' || item.taxType === 'state_tax') {
                consolidatedContributions[employeeName].gross = item.gross || 0;
                consolidatedContributions[employeeName].net = item.net || 0;
            }
        });

      
        employeeContributions.forEach(item => {
            const employeeName = item.employee_name;
            const taxKey = item.tax + "-" + (item.code ? item.code : "");
            if (!consolidatedContributions[employeeName]) {
                consolidatedContributions[employeeName] = { gross: 0, net: 0 }; 
            }
            if (!consolidatedContributions[employeeName][taxKey]) {
                consolidatedContributions[employeeName][taxKey] = { employee: "0.00", employer: "0.00" };
            }

           
            if (parseFloat(item.total_amount) > 0) {
                consolidatedContributions[employeeName][taxKey].employee = parseFloat(item.total_amount).toFixed(2) || "0.00";
                consolidatedContributions[employeeName].gross = item.gross || consolidatedContributions[employeeName].gross;
                consolidatedContributions[employeeName].net = item.net || consolidatedContributions[employeeName].net;
            }

           
            if (parseFloat(item.total_amount) === 0) {
                consolidatedContributions[employeeName][taxKey].employee = "0.00";
                // Set gross and net from employer contribution
                consolidatedContributions[employeeName].gross = consolidatedContributions[employeeName].gross || 0;
                consolidatedContributions[employeeName].net = consolidatedContributions[employeeName].net || 0;
            }
        });

        const tbody = table.find("tbody");
        let serialNumber = 1;
        Object.keys(consolidatedContributions).forEach(employeeName => {
            const contributions = consolidatedContributions[employeeName];
            const row = $("<tr>");
            row.append("<td>" + serialNumber++ + "</td>");
            row.append("<td>" + employeeName + "</td>");
           row.append("<td>$" + contributions.gross.toFixed(2) + "</td>");
            row.append("<td>$" + (isNaN(parseFloat(contributions.net)) ? '0.00' : parseFloat(contributions.net).toFixed(2)) + "</td>");
            Object.keys(taxTypeMap).forEach(taxType => {
                const taxes = taxTypeMap[taxType];
                taxes.forEach(taxKey => {
                    const taxData = contributions[taxKey] || { employee: "0.00", employer: "0.00" };
                    row.append("<td>$" + taxData.employee + "</td>");
                    row.append("<td>$" + taxData.employer + "</td>");
                });
            });
            tbody.append(row);
        });

        const tfoot = table.find("tfoot");
        let totalGross = 0;
        let totalNet = 0;
        Object.keys(consolidatedContributions).forEach(employeeName => {
            const contributions = consolidatedContributions[employeeName];
            totalGross += isNaN(parseFloat(contributions.gross)) ? 0 : parseFloat(contributions.gross);
            totalNet += isNaN(parseFloat(contributions.net)) ? 0 : parseFloat(contributions.net);
        });

        const footerRow = $("<tr class='btnclr'>").append("<td colspan='2'>Total</td>");
        footerRow.append("<td>$" + totalGross.toFixed(2) + "</td>");
        footerRow.append("<td>$" + totalNet.toFixed(2) + "</td>");
        Object.keys(taxTypeMap).forEach(taxType => {
            const taxes = taxTypeMap[taxType];
            taxes.forEach(taxKey => {
                let totalEmployeeContribution = 0;
                let totalEmployerContribution = 0;
                Object.keys(consolidatedContributions).forEach(employeeName => {
                    const contribution = consolidatedContributions[employeeName][taxKey];
                    if (contribution) {
                        totalEmployeeContribution += parseFloat(contribution.employee);
                        totalEmployerContribution += parseFloat(contribution.employer);
                    }
                });
                footerRow.append("<td>$" + totalEmployeeContribution.toFixed(2) + "</td>");
                footerRow.append("<td>$" + totalEmployerContribution.toFixed(2) + "</td>");
            });
        });
        tfoot.append(footerRow);
    } else {
        const columnCount = table.find("thead th").length;
        table.find("tbody").append(
            "<tr style='border:none;'>" +
            "<td colspan='" + columnCount + "' style='width:2000px;text-align:center;'>No data available</td>" +
            "</tr>"
        );
    }
}

function populateTable(response) {
   const stateTaxTable = $("#StateTaxTable");
   const livingStateTaxTable = $("#LivingStateTaxTable");
   stateTaxTable.find("thead, tbody, tfoot").empty();
   livingStateTaxTable.find("thead, tbody, tfoot").empty();
   const hasEmployerContributions = Object.keys(response.employer_contribution).length > 0;
   const hasEmployeeContributions = Object.keys(response.employee_contribution).length > 0;
   if (!hasEmployerContributions && !hasEmployeeContributions) {
      stateTaxTable.find("tbody").append("<tr><td colspan='100%' style='text-align:center;'>No data found</td></tr>");
      livingStateTaxTable.find("tbody").append("<tr><td colspan='100%' style='text-align:center;'>No data found</td></tr>");
      return;  
   }
   generateTaxTable("state_tax", response.employer_contribution.state_tax, response.employee_contribution.state_tax, stateTaxTable);
   generateTaxTable("living_state_tax", response.employer_contribution.living_state_tax, response.employee_contribution.living_state_tax, livingStateTaxTable);   
   var rowCount = $('#livingStateTaxTable tr').length;
   stateTaxTable.DataTable();
   livingStateTaxTable.DataTable();
}


function exportToExcel()
{
    var dateSearch = $('.getdate_reults').val();
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.aoa_to_sheet([]);
    function createBoldCell(value) {
        return {
            v: value,
            s: {
                font: { bold: true }
            }
        };
    }
    XLSX.utils.sheet_add_aoa(ws, [[createBoldCell("Pay Period: " + dateSearch)]], { origin: { r: 0, c: 0 } });
    XLSX.utils.sheet_add_aoa(ws, [[createBoldCell("WORKING STATE TAX")]], { origin: { r: 1, c: 0 } });
    var table1 = document.querySelector(".StateTaxTable");
    if (table1) {
        var data1 = XLSX.utils.sheet_to_json(XLSX.utils.table_to_sheet(table1), { header: 1 });
        var range1 = data1.length;
        XLSX.utils.sheet_add_aoa(ws, data1, { origin: { r: 2, c: 0 } });
    } else {
        console.error("StateTaxTable not found.");
        return;
    }
    var spacing = 2;
    XLSX.utils.sheet_add_aoa(ws, [[]], { origin: { r: range1 + spacing, c: 0 } });
    XLSX.utils.sheet_add_aoa(ws, [[createBoldCell("Living STATE TAX")]], { origin: { r: range1 + spacing + 1, c: 0 } });
    var table2 = document.querySelector(".LivingStateTaxTable");
    if (table2) {
        var data2 = XLSX.utils.sheet_to_json(XLSX.utils.table_to_sheet(table2), { header: 1 });
        XLSX.utils.sheet_add_aoa(ws, data2, { origin: { r: range1 + spacing + 2, c: 0 } });
    } else {
        console.error("LivingStateTaxTable not found.");
        return;
    }
    XLSX.utils.book_append_sheet(wb, ws, "Merged Table");
    XLSX.writeFile(wb, "State Overallsummary.xlsx");
}
</script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<script src='<?php echo base_url(); ?>assets/js/moment.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/knockout-debug.js'></script>
<script  src="<?php echo base_url() ?>assets/js/scripts.js"></script>
<script src='<?php echo base_url();?>assets/js/table2excel.min.js'></script>
<script src='<?php echo base_url();?>assets/js/xlsx.full.min.js'></script>