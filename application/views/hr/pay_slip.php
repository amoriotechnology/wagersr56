<style>
  th,td {
  padding: 2px;
  font-size: 12px;
  }
  #content {
  margin: 0px auto;
  padding: 35px;
  position: relative;
  }
</style>
<div class="content-wrapper">
<section class="content-header" style="height:70px;">
  <div class="header-icon">
    <i class="pe-7s-note2"></i>
  </div>
  <div class="header-title">
    <h1>Employee Payslip</h1>
    <small></small>
    <ol class="breadcrumb">
      <li><a href="#"><i class="pe-7s-home"></i> <?php echo display("home"); ?></a></li>
      <li><a href="#">Payslip</a></li>
      <li class="active">Add Employee Payslip</li>
    </ol>
  </div>
</section>
<section class="content">
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default thumbnail">
  <?php $arr = preg_split("/\s+(?=\S*+$)/", $company_info[0]["address"]);?>
  <div class="panel-body">
    <p align="right"> 
      <a id="download" class='btn btnclr'> <i class="fa fa-download"></i><?php echo display("Download"); ?>
      </a>
      <a href="<?php echo base_url('Chrm/pay_slip_list?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>" style="color:white;" class="btnclr btn"><i class="ti-align-justify"> </i> Manage Payslip </a>
    </p>
    <div id="content" style="margin-left:12px;padding:10px;">
      <div class="row" style="padding:0px;width:780px;">
        <div class="col-md-12 col-sm-12 top_section"
          style="height:268px;display: flex; justify-content: center; border: 2px solid #8c99ae; display: none;"
          id="downloadLink">
          <div class="second_section" style="width: 100%;">
            <p></p>
            <?php $fs = strtoupper($employee_info[0]["first_name"]);?>
            <div class="r">
              <p style="padding-left:430px;margin-top: 50px;"><?php echo date("m-d-Y"); ?></p>
            </div>
            <div class="r" style="height:23px;">
              <p style="width: 385px;margin-top: 53px;  display: block;"><?php echo $fs . " " . strtoupper($employee_info[0]["middle_name"]) ." " . strtoupper($employee_info[0]["last_name"]); ?></p>
            </div>
            <div class="r amount_word" style="width: 535px;float:center"></div>
            <div class="custom-row net_period" style="float:right"></div>
          </div>
        </div>

        <div class="separator" id="separator_line"
          style="border: 1px solid #8c99ae !important;display: none;">
          <div style='border: 1px solid rgb(140, 153, 174) !important;height: 322px;'
            class="sep-line mt-10 mb-15 res-991-mtb-20"></div>
        </div>
      </div>
      <br />
      <div class="payTop_details row">
        <div class="col-md-6">
          <p style='font-size:12px;'>
            <strong style='font-size:18px;'><?php echo $company_info[0]["company_name"]; ?></strong><br> <?php echo $arr[0] . " " . $arr[1]; ?><br> Email :
            <?php echo $company_info[0]["email"]; ?><br> Tel:<?php echo " " . $company_info[0]["mobile"]; ?>
          </p>
        </div>
        <div class="col-md-6">
          <p style='float:right;font-size:12px;'>
            <strong style='font-size:18px;'><?php echo isset($employee_info[0]["first_name"]) ? $employee_info[0]["first_name"] . " " : ""; ?>
              <?php echo isset($employee_info[0]["middle_name"]) ? $employee_info[0]["middle_name"] . " " : ""; ?> <?php echo isset($employee_info[0]["last_name"]) ? $employee_info[0]["last_name"] : ""; ?></strong><br> <?php echo htmlspecialchars($employee_info[0]["address_line_1"]) . " " . htmlspecialchars($employee_info[0]["city"]) . " " . htmlspecialchars($employee_info[0]["zip"]); ?> <br />
            <span style="display: inline-block; ">Designation : <?php echo $employee_info[0]["des"]; ?></span>
            <br />
            <span style="display: inline-block; ">Employee ID : <?php echo $employee_info[0]["id"]; ?></span>
          </p>
        </div>
        <div class="col-md-12" style="float:center;">
          <style>
            .table td {
            padding: 10px;
            }
            table {
            border: none;
            text-align: center;
            table-layout: fixed;
            margin: 0 auto;
            }
            table th {
            background-color: <?php echo "#" . $setting[0]["color"];
?>padding: 8px 14px;
            text-align: center;
            }
            #forcolor {
            background-color: <?php echo "#" . $setting[0]["color"];
?>padding: 8px 14px;
            text-align: center;
            }
          </style>
          <?php
function add_time($time1, $time2) {
    list($hours1, $minutes1) = explode(':', $time1);
    list($hours2, $minutes2) = explode(':', $time2);
    $total_minutes           = ($hours1 * 60 + $minutes1) + ($hours2 * 60 + $minutes2);
    $hours                   = floor($total_minutes / 60);
    $minutes                 = $total_minutes % 60;
    return sprintf('%02d:%02d', $hours, $minutes);
}
?>
          <table class="table" style='margin-bottom:0px;'>
            <tr class='btnclr'>
              <th style='font-size:12px;'>EARNINGS</th>
              <th>
                <?php
if (
    $employee_info[0]["payroll_type"] == "Hourly" &&
    in_array($employee_info[0]["payroll_freq"], ["Weekly", "Bi-Weekly", "Monthly"])
) {
    echo "HRS/ UNIT";
} elseif (
    $employee_info[0]["payroll_type"] == "Fixed" &&
    in_array($employee_info[0]["payroll_freq"], ["Weekly", "Bi-Weekly", "Monthly"])
) {
    echo "DAYS";
}
?>
              </th>
              <th>RATE(<?php echo $setting[0]["currency"]; ?>)</th>
              <?php if($timesheet_info[0]["sc_amount"] != 0){ ?>
               <th>Sales Commision</th>
               <?php  }  ?>
              <th>THIS PERIOD(<?php echo $setting[0]["currency"]; ?>)</th>
              <th> <?php
if (
    $employee_info[0]["payroll_type"] == "Hourly" &&
    in_array($employee_info[0]["payroll_freq"], ["Weekly", "Bi-Weekly", "Monthly"])
) {
    echo "HRS/HOURS";
} elseif (
    $employee_info[0]["payroll_type"] == "Fixed" &&
    in_array($employee_info[0]["payroll_freq"], ["Weekly", "Bi-Weekly", "Monthly"])
) {
    echo "YTD DAYS";
}
?>
              </th>
              <th>YTD(<?php echo $setting[0]["currency"]; ?>)</th>
            </tr>
            <tr>
              <td>Salary</td>
              <td><?php echo $timesheet_info[0]["hour"]; ?></td>
              <td><?php echo $timesheet_info[0]["h_rate"]; ?></td>
              <?php if($timesheet_info[0]["sc_amount"] != 0){ ?>
              <td><?php echo $timesheet_info[0]["sc_amount"]; ?></td>
              <?php } ?>
              <td id="total_period">
              <?php 
              $totalAmount =$timesheet_info[0]["amount"]+$timesheet_info[0]["sc_amount"];
              echo round($totalAmount, 2); 
              ?></td>
              <td style="display:none;" id="total_period"><?php echo $ytd["ytd_salary"]; ?></td>
              <td><?php
if (
    $employee_info[0]["payroll_type"] == "Hourly" &&
    in_array($employee_info[0]["payroll_freq"], ["Weekly", "Bi-Weekly", "Monthly"])
) {

    $hours = substr($ytd["ytd_hours_excl_overtime_in_time"], 0, 5);
    echo isset($hours) ? $hours : "00:00";
} elseif (
    $employee_info[0]["payroll_type"] == "Fixed" &&
    in_array($employee_info[0]["payroll_freq"], ["Weekly", "Bi-Weekly", "Monthly"])
) {

    echo $ytd["ytd_hours_excl_overtime"];
}
?>
            </td>
            <td id="total_ytd"><?php echo (int)$ytd["ytd_salary"]; ?></td>
           </tr>
            <?php if ($employee_info[0]["payroll_type"] == "Hourly") {?>
            <tr>
              <td>Over Time</td>
             <td> <?php echo !empty($timesheet_info[0]["extra_hour"]) ? $timesheet_info[0]["extra_hour"] : 0; ?> </td>
             <td> <?php if ($timesheet_info[0]["extra_hour"]) {echo $timesheet_info[0]["extra_rate"];} else {echo 0;}?> </td>
             <?php if($timesheet_info[0]["sc_amount"] != 0){ ?>
             <td></td>
             <?php  }  ?> 
             <td id="above_over_this_period"> <?php if ($timesheet_info[0]["extra_hour"]) {echo $timesheet_info[0]["extra_amount"];} else {echo 0;}?> </td>
              <td> <?php
if ($ytd["ytd_hours_only_overtime"]) {
    $hoursExclOvertime = substr($ytd["ytd_hours_only_overtime"], 0, 5);
    echo $hoursExclOvertime;
} else {
    echo "00:00";
}
    ?> </td>
              <td id="final_over_ytd"> <?php
$salary                = (is_numeric($ytd["ytd_overtime_salary"]) ? $ytd["ytd_overtime_salary"] : 0);
    $formatted_salary      = number_format($salary, 2);
    $salary_without_commas = str_replace(',', '', $formatted_salary);
    echo $salary_without_commas;

    ?> </td>
            </tr>
            <?php }?>
            <?php if ($employee_info[0]["payroll_type"] == "Hourly") {?>
            <tr>
              <th><strong>TOTAL :</strong></td>
              <th> <?php echo $timesheet_info[0]["total_hours"]; ?> </th>
              <th></th>
                <?php if($timesheet_info[0]["sc_amount"] != 0){ ?>
                <th></th>
                <?php  }  ?>
              <th><?php $amount = $timesheet_info[0]["amount"]+$timesheet_info[0]["sc_amount"];
    if ($timesheet_info[0]["extra_hour"]) {
        $extra_amount = $timesheet_info[0]["extra_amount"];
        if ($extra_amount == 0) {
            echo $amount;
        } else {
            echo $amount + $extra_amount;
        }
    } else {
        echo $amount;
    }
    ?></th>
              <th><?php
list($hours1, $minutes1) = explode(":", $ytd["ytd_hours_excl_overtime_in_time"]);
    $totalMinutes1           = $hours1 * 60 + $minutes1;
    $totalMinutes2           = 0;
    if ($ytd["ytd_hours_only_overtime"]) {
        list($hours2, $minutes2) = explode(":", $ytd["ytd_hours_only_overtime"]);
        $totalMinutes2           = $hours2 * 60 + $minutes2;
    }
    $totalMinutes = $totalMinutes1 + $totalMinutes2;
    $hours        = floor($totalMinutes / 60);
    $minutes      = $totalMinutes % 60;
    $total_time   = sprintf("%d:%02d", $hours, $minutes);
    echo $total_time;
    ?></th>
              <th><?php echo round($ytd["ytd_salary"], 3) +
        $ytd["ytd_overtime_salary"]; ?></th>
            </tr>
            <?php
}
?>
          </table>
        </div>
        <div class="col-md-12">
          <div class="col-sm-8">
            <table class="withholding avoid-page-break table" id="table"
              style="margin: 8px; FONT-SIZE:10PX; width: 100%; ">
              <tr class='btnclr' style="outline: thin solid" rowspan="6">
                <th colspan="4">WITHHOLDINGS</th>
              </tr>
              <tr>
                <th style="text-align:left;">DESCRIPTION</th>
                <th>FILING STATUS</th>
                <th>THIS PERIOD(<?php echo $setting[0]["currency"]; ?>)</th>
                <th>YTD(<?php echo $setting[0]["currency"]; ?>)</th>
              </tr>
              <?php if (
    $employee_info[0]["payroll_type"] == "Hourly" ||
    $employee_info[0]["payroll_type"] == "Fixed" ||
    $employee_info[0]["payroll_freq"] == "Weekly" ||
    $employee_info[0]["payroll_freq"] == "Bi-Weekly" ||
    $employee_info[0]["payroll_freq"] == "Monthly" ||
    $employee_info[0]["payroll_freq"] == "SalesCommission"
) {?>
                <?php if ($this_social['tax_data']) {?>
              <tr>
                <td style="text-align:left;"> Social Security</td>
                <td>S O</td>
                <td class="current">
                  <?php if ($this_social["tax_value"]) {
    echo "-" . round($this_social["tax_value"], 3);
}?>
                </td>
                <td class="ytd">
                  <?php if ($this_social["tax_data"]["t_s_tax"]) {
    echo round($this_social["tax_data"]["t_s_tax"], 3);
}?>
                </td>
              </tr>
              <?php }?> <?php if ($this_medicare["tax_data"]) {?>
              <tr>
                <td style="text-align:left;">Medicare</td>
                <td>SMCU O</td>
                <td class="current"><?php if ($this_medicare["tax_value"]) {echo "-" . round($this_medicare["tax_value"], 3);}?></td>
                <td class="ytd"><?php if ($this_medicare["tax_data"]["t_m_tax"]) {
    echo round($this_medicare["tax_data"]["t_m_tax"], 3);
}?></td>
              </tr>
              <?php }?> <?php }?> <?php if ($this_federal["tax_data"]) {?>
              <tr>
                <td style="text-align:left;">Fed Income Tax</td>
                <td></td>
                <td class="current"><?php if (
    $this_federal["tax_value"]) {echo "-" . round($this_federal["tax_value"], 3);} else {
    echo "-0.000";
}?></td>
                <td class="ytd"><?php if ($this_federal["tax_data"]["t_f_tax"]) {echo round($this_federal["tax_data"]["t_f_tax"], 3);} else {
    echo "-0.000";
}?></td>
              </tr>
              <?php }?> <?php if ($this_unemp["tax_data"]["t_u_tax"]) {?>
              <tr>
                <td style="text-align:left;">Unemployment Tax</td>
                <td></td>
                <td class="current"><?php if ($this_unemp["tax_value"]) {echo "-" . round($this_unemp["tax_value"], 3);}?></td>
                <td class="ytd"><?php if ($this_unemp["tax_data"]["t_u_tax"]) {
    echo round($this_unemp["tax_data"]["t_u_tax"], 3);
}?></td>
              </tr>
              <?php }?> <?php foreach ($working_state["this_perid_state_tax"] as $k => $v) {
    if ($v) {
        $split = explode("-", $k);
        $title = str_replace("'employee_", "", $split[0]);
        $rep   = str_replace("'", "", $split[1]);
        ?>
              <tr>
                <td title="<?php echo "Working State Tax - " .
            $title; ?>" style="text-align:left;"><?php if (
            $rep
        ) {
            echo $title . "-" . $rep;
        } else {
            echo $rep;
        }?></td>
                <td></td>
                <td class="current"> <?php echo "-" . round($v, 3); ?></td>
                <td class="ytd"><?php echo round($working_state["overall_state_tax"][$k], 3); ?></td>
              </tr>
              <?php
}
}?> <?php
if (!empty($living_state["this_perid_state_tax"])) {
    foreach ($living_state["this_perid_state_tax"] as $k => $v) {
        if ($v) {
            $split = explode("-", $k);
            $title = str_replace("'employee_", "", $split[0]
            );
            $rep = str_replace("'", "", $split[1]);
            ?>
              <tr>
                <td title="<?php echo "Living State Tax - " .
                $title; ?>" style="text-align:left;"><?php if (
                $rep
            ) {
                echo $title . "-" . $rep;
            } else {
                echo $rep;
            }?></td>
                <td></td>
                <td class="current"> <?php echo "-" .
            round($v, 3); ?></td>
                <td class="ytd"><?php echo round($living_state["overall_state_tax"][$k], 3); ?></td>
              </tr>
              <?php
}
    }
}?>
              <tr class="avoid-page-break">
                <td></td>
                <td></td>
                <td style="border-top: groove;" id="Total_current"></td>
                <td style="border-top: groove;" id="Total_ytd"></td>
              </tr>
            </table>
          </div>
          <div class="col-sm-4">
            <table style="outline: thin solid; font-size: 10px;margin: 8px;" class="table">
              <tr style="text-align: left;">
                <td colspan="2">
                  <span style="font-weight: bold; display: inline-block;">SOCIAL
                  SECURITY NUM : </span> <?php
$phone_number = $employee_info[0]["social_security_number"];
if (strlen($phone_number) >= 4) {
    $last_four_digits = substr($phone_number, -4);
    $masked_number    = substr_replace($phone_number, str_repeat("X", 4), -4);
    echo $masked_number;
}
?>
                </td>
              </tr>
              <tr style="text-align: left;">
                <td colspan="2">
                  <span style="font-weight: bold; display: inline-block;">PAY PERIOD :
                  </span>
                  <br /> <?php echo $timesheet_info[0]["month"]; ?>
                </td>
              </tr>
            </table>
            <table class="proposedWork pay_table table" style='margin-top:-10px;'
              id="price">
              <tr class="btnclr" style="outline: thin solid">
                <td id='forcolor' style=" color:white;font-weight:bold; background-color: <?php echo "#" .
    $color; ?>" colspan='2'>PAYMENT INFORMATION</td>
              </tr>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Authorized Name</td>
                <td style="width: 60%;"><?php echo $admin[0]["adm_name"]; ?></td>
              </tr>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Title</td>
                <td style="width: 60%;">Admin</td>
              </tr>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Admin ID</td>
                <td style="width: 60%;"><?php echo $admin[0]["adm_id"]; ?></td>
              </tr>
              <?php if (
    !empty($timesheet_info[0]["cheque_date"])
) {?>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Chq Date</td>
                <td style="width: 60%;"><?php echo $timesheet_info[0]["cheque_date"]; ?></td>
              </tr>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Chq No</td>
                <td style="width: 60%;"><?php echo $timesheet_info[0]["cheque_no"]; ?></td>
              </tr>
              <?php } elseif (!empty($timesheet_info[0]["bank_name"])) {?>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Bank Name</td>
                <td style="width: 60%;"><?php echo $timesheet_info[0]["bank_name"]; ?></td>
              </tr>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Ref No</td>
                <td style="width: 60%;"><?php echo $timesheet_info[0]["payment_ref_no"]; ?></td>
              </tr>
              <?php } else {?>
              <tr style="text-align:left;">
                <td style="font-weight:bold;width:20%;">Payment Method</td>
                <td style="width: 60%;"><?php echo "CASH"; ?></td>
              </tr>
              <?php }?>
            </table>
            <table class="table">
              <tr class='btnclr' style="outline: thin solid" rowspan="3">
                <th colspan="3">NET PAY ALLOCATION</th>
              </tr>
              <tr>
                <th style="text-align:left;"><strong>DESCRIPTION</strong></th>
                <th><strong>THIS PERIOD(<?php echo $setting[0]["currency"]; ?>)</strong></th>
                <th><strong>YTD(<?php echo $setting[0]["currency"]; ?>)</strong></th>
              </tr>
              <tr>
                <td style="text-align:left;"><strong>Check Amount</strong></td>
                <td class="net_period"> <strong style="padding-top: 2px;">765.10</strong></td>
                <td class="net_ytd"></td>
              </tr>
              <tr>
                <td style="text-align:left;"><strong>Chkg 404</strong></td>
                <td>0.00</td>
                <td>0.00</td>
              </tr>
              <tr>
                <td style="text-align:left;"><strong>NET PAY</strong></td>
                <td class="net_period" style="font-weight:bold;border-top: groove;">
                </td>
                <td class="net_ytd" style="font-weight:bold;border-top: groove;"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                <script>
          $('#download').on('click',function () {
         $('#downloadLink').css('display', 'block');
         $('#separator_line').css('display', 'block');
         function first(callback1,callback2){
         setTimeout( function(){
          var pdf = new jsPDF('p','pt','a4');
          const invoice = document.getElementById("content");
                 console.log(window);
                  var pageWidth = 8.5;
                  var margin=0.5;
                  var opt = {
         lineHeight : 1.2,
         margin : 0,
         maxLineWidth : pageWidth - margin *1,
                      filename: 'invoice'+'.pdf',
                      allowTaint: true,
                      html2canvas: { scale: 3 },
                      jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
                  };
                   html2pdf().from(invoice).set(opt).toPdf().get('pdf').then(function (pdf) {
         var totalPages = pdf.internal.getNumberOfPages();
         for (var i = 1; i <= totalPages; i++) {
         pdf.setPage(i);
         pdf.setFontSize(10);
         pdf.setTextColor(150);
         }
         }).save('PaySlip_<?php echo $employee_info[0]['first_name'] . " " . $employee_info[0]['last_name'] . "_" . $timesheet_info[0]['month'] ?>.pdf');
         callback1();
         callback2();
              clonedElement.remove();
         $("#content").attr("hidden", true);
         }, 3000 );
         }
         function second(){
         setTimeout( function(){
         $( '#myModal_sale' ).addClass( 'open' );
         if ( $( '#myModal_sale' ).hasClass( 'open' ) ) {
         $( '.container' ).addClass( 'blur' );
         }
         $( '.close' ).click(function() {
         $( '#myModal_sale' ).removeClass( 'open' );
         $( '.cont' ).removeClass( 'blur' );
         });
         }, 1500 );
         }
         function third(){
         setTimeout( function(){
             window.location='<?php echo base_url(); ?>'+'Chrm/pay_slip_list?id='+<?php echo $id; ?>+'&admin_id='+<?php echo $admin_id; ?>;
            window.close();
         }, 3000 );
        }
         first(second,third);
         });
                function capitalize(str) {
                    return str.charAt(0).toUpperCase() + str.slice(1);
                }
                $(document).ready(function() {
                    var sum = 0;var net_period=0;
                    var currency = '<?php echo $setting[0]["currency"]; ?>';
                    $('.table').find('.current').each(function() {
                        var v = $(this).html();
                        sum += parseFloat(v);
                    });
                    $('#Total_current').html(sum.toFixed(2));
                    var sum_ytd = 0;
                    $('.table').find('.ytd').each(function() {
                        var v = $(this).html();
                        sum_ytd += parseFloat(v);
                    });
                    $('#Total_ytd').html(sum_ytd.toFixed(2));
                    debugger;
                    var totalPeriodText = $('#total_period').text();
                    var aboveOverThisPeriodText = $('#above_over_this_period').text();
                    if (isNaN(parseFloat(aboveOverThisPeriodText))) {
                        aboveOverThisPeriodText = "0";
                    }
                    var taxDeductionPeriodWise = parseFloat($('#Total_current').text());
                    var period_wise_total = 0;
                    if (!isNaN(totalPeriodText) && !isNaN(aboveOverThisPeriodText)) {
                        period_wise_total = parseFloat(totalPeriodText) + parseFloat(aboveOverThisPeriodText);
                    } else {
                        console.log("One or both values are not valid numbers.");
                    }
                    var net_period = period_wise_total + taxDeductionPeriodWise;
                    var final_ab_ytd = parseFloat($('#final_over_ytd').text());
                    if (final_ab_ytd) {
                        final_ab_ytd = final_ab_ytd;
                    } else {
                        final_ab_ytd = 0;
                    }
                    console.log(net_period);
                    var ytd_wise_total = parseFloat($('#total_ytd').text());
                    var tax_deduction_ytd_wise = parseFloat($('#Total_ytd').text());
                    var net_ytd = ytd_wise_total - tax_deduction_ytd_wise;
                    var final_ytd = (ytd_wise_total + final_ab_ytd);
                    var fytd = final_ytd - tax_deduction_ytd_wise;
                    $('.net_ytd').html(fytd.toFixed(2));
                    $('#Total_ytd').html(sum_ytd.toFixed(2));
                    var period_wise_total = $('#total_period').text();
                    var tax_deduction_period_wise = $('#Total_current').text();
                    tax_deduction_period_wise = tax_deduction_period_wise.replace(/-/g, '');
                    $('.net_period').html("$" + net_period.toFixed(2));
                    var currencyMap = {
                        '$': 'Dollars',
                        '€': 'Euros',
                        '£': 'Pounds',
                    };
                    var currencyWords = currencyMap[currency] || 'Unknown';
                    var ytd_wise_total = parseFloat($('#total_ytd').html());
                    var tax_deduction_ytd_wise = parseFloat($('#Total_ytd').html());
                    var amount = net_period.toFixed(2);
                    var sanitizedAmount = amount.replace(/[,.]/g, '');
                    var numericAmount = parseFloat(sanitizedAmount);
                    var dollars = Math.floor(numericAmount / 100);
                    var cents = Math.round(numericAmount % 100);
                    var dollarsWords = numberToWords.toWords(dollars);
                    var centsWords = numberToWords.toWords(cents);
                    dollarsWords = dollarsWords.charAt(0).toUpperCase() + dollarsWords.slice(1);
                    centsWords = centsWords.charAt(0).toUpperCase() + centsWords.slice(1);
                    var formattedAmount = '';
                    if (dollars > 0) {
                        formattedAmount = dollarsWords + ' ';
                        formattedAmount = formattedAmount.charAt(0).toUpperCase() + formattedAmount.slice(1);
                    }
                    if (cents > 0) {
                        if (dollars > 0) {
                            formattedAmount += ' and ';
                        }
                        formattedAmount += cents + '/100 ' + currencyWords + ' Only';
                    }
                    formattedAmount = formattedAmount.charAt(0).toUpperCase() + formattedAmount.slice(1);
                    $('.amount_word').html(formattedAmount);
                });
                $(document).ready(function() {
                    var currency = '<?php echo $setting[0]["currency"]; ?>'
                    var currencyMap = {
                        '$': 'Dollars',
                        '€': 'Euros',
                        '£': 'Pounds',
                    };
                    var currencyWords = currencyMap[currency] || 'Unknown';
                    var ytd_wise_total = parseFloat($('#total_ytd').html());
                    var tax_deduction_ytd_wise = parseFloat($('#Total_ytd').html());
                    var net_ytd = ytd_wise_total - tax_deduction_ytd_wise;
                    var amount = net_period.toFixed(2);
                    var sanitizedAmount = amount.replace(/[,.]/g, '');
                    var numericAmount = parseFloat(sanitizedAmount);
                    var dollars = Math.floor(numericAmount / 100);
                    var cents = Math.round(numericAmount % 100);
                    var dollarsWords = numberToWords.toWords(dollars);
                    var centsWords = numberToWords.toWords(cents);
                    dollarsWords = dollarsWords.charAt(0).toUpperCase() + dollarsWords.slice(1);
                    centsWords = centsWords.charAt(0).toUpperCase() + centsWords.slice(1);
                    var formattedAmount = '';
                    if (dollars > 0) {
                        formattedAmount = dollarsWords + ' ' + currencyWords;
                    }
                    if (cents > 0) {
                        if (dollars > 0) {
                            formattedAmount += ' and ';
                        }
                        formattedAmount += centsWords + ' Cents Only';
                    }
                    $('.net_ytd').html(net_ytd.toFixed(2));
                    $('.amount_word').html(formattedAmount);
                    const currentElement = document.querySelector('.current');
                    const value = currentElement.textContent.trim();
                    currentElement.textContent = '-' + value;
                });
                function readURL(input, imgControlName) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $(imgControlName).attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("#imag").change(function() {
                    var imgControlName = "#ImgPreview";
                    readURL(this, imgControlName);
                    $('.preview1').addClass('it');
                    $('.btn-rmv1').addClass('rmv');
                });
                $("#removeImage1").click(function(e) {
                    e.preventDefault();
                    $("#imag").val("");
                    $("#ImgPreview").attr("src", "");
                    $('.preview1').removeClass('it');
                    $('.btn-rmv1').removeClass('rmv');
                });
                </script>
    </section>
</div>
<style type="text/css">
.top_section {
    width: 100%;
    height: 2.9in;
    filter: brightness(150%);
    background-position: center;
}
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
.top_para {
    font-size: 7px;
    color: #10489d;
    font-weight: bold;
    background-color: #9fa7bc;
    height: 18px;
    width: 100%;
    text-align: center;
}
.slanted-text p {
    transform: rotate(269deg);
    margin: 0;
    position: absolute;
    top: 110px;
    left: -48px;
}
.slanted-text1 p {
    transform: rotate(90deg);
    margin: 0;
    position: absolute;
    top: 110px;
    right: -48px;
}
.footer_number {
    background-image: url('<?php echo base_url("/assets/images/logo/footer.png");
?>');
}
.separator .sep-line {
    border-color: #000;
}
.separator .sep-line {
    height: 300px;
    display: block;
    position: relative;
    width: 100%;
}
</style>