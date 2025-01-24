<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $type == 'emp_data' || $type == 'sp_data' ? "Employee Invoice" : "Timesheet Pdf"; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <style>
    @page { 
        margin: 0px 10px;
    }
    body { 
        font-family: Arial, sans-serif; 
        margin-top: 120px;
        padding: 0;
    }
    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 90px;
        text-align: center;
        line-height: 20px;
        font-size: 18px;
        background-color: #fff;
        border-bottom: 1px solid #ccc;
        z-index: 1000;
        padding-top: 20px;
        width: 100%;
        box-sizing: border-box;
    }
    footer { position: fixed; left: 0px; right: 0px; height: 80px;text-align: center; line-height: 20px; font-size: 12px;}
    .pagebreak { page-break-after: always; }
    .pagebreak:last-child { page-break-after: never; }
    .header-table { 
        margin-top: 100px; 
        font-size: 11px !important; 
    }
    table { 
        font-size: 11px ; 
        border-collapse: collapse; 
        width: 95%; 
        margin-bottom: 15px;
        margin-left:20px
    }
    .mainTable th, .mainTable td { 
        border: 1px solid black; 
        padding: 10px; 
        text-align: left; 
        margin-top:50px;
    }
    .invoice-summary th, .invoice-summary td { 
        text-align: center; 
        border: 1px solid darkgray; 
        height:27px;
    }
    .brand-section { 
        margin-top: 20px; 
    }
    .brand-section img { 
        max-width: 100%; 
        height: auto; 
    }
    .company-info, .bill-to { 
        margin-bottom: 15px; 
    }
    .company-info b, .bill-to b { 
        display: block; 
        margin-bottom: 3px; 
    }
    .content {
        page-break-inside: avoid; 
        padding-bottom: 5px; 
    }
    .emp_tbl > tr > th {
        width: 20%;
        text-align: left;
        color: #fff;
        background-color: gray;
    }
    .text-center {
        text-align: center !important;
    }
    </style>
</head>

<body>
<?php 
    $logoPath =  $logo;
    if (file_exists($logoPath)) {
        $logo = base64_encode(file_get_contents($logoPath));
    } else {
        $logo = '';
    }
?>

<header>
    <div class="brand-section">
    <div class="row">
        <div class="col-sm-3" style="color:black;font-weight:bold;margin-right:670px;margin-left:15px;">
            <img src="data:image/png;base64,<?= htmlspecialchars($logo, ENT_QUOTES, 'UTF-8'); ?>" alt="Logo">
        </div>
        <div class="col-sm-2" style="color:black;font-weight:bold;margin-top:-80px">
            <h3 style="text-align: center;font-weight:bold;" >Employee <?= ($type == "emp_data") ? 'Detail' : 'Timesheet'; ?></h3>
        </div>
        <div class="col-sm-6" style="text-align:left;margin-left:550px; margin-top:-80px; font-size:15px;" >
            <b> <?php if($type == 'timesheet') { echo "Date : </b> &nbsp;". $time_data['sheet_date']; } ?>
        </div>
    </div>
    </div>
</header>  

<footer></footer> 

<div class="container-fluid">
    <div class="subpage" id="editor-container">
        <div class="brand-section content">
            <div class="row">
                <div class="col-sm-6" style="color:black; font-size:12px;">
                    <div class="col-sm-8" style="margin-left:25px;">
                    <span style="font-weight:1;"><b>Company Name :</b> <?= $company_name; ?></span><br>
                    <span style="font-weight:1;"><b>Address :</b> <?= $address; ?><br>
                    <span style="font-weight:1;"><b>Email :</b> <?= $com_email; ?><br>
                    <span style="font-weight:1;"><b>Phone :</b> <?= $com_phone; ?><br>
                    </div>
                </div>
                <?php if($type != 'emp_data' && $type != 'sp_data') { ?>
                    <div class="col-sm-5" style="margin-left:550px;margin-top:-95px; font-size:12px;">
                        <b><span style="font-weight:bold;"> Name : <?= $time_data['first_name'].' '.$time_data['last_name']; ?></span><br> 
                        <span style="font-weight:1;"> Job Title :  <?= $time_data['designation']; ?><br>
                        <span style="font-weight:1;"> Payroll Type : <?= $time_data['payroll_type']; ?><br>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<br>    
<hr style="color:white; margin-top:10px">

<div class="pagebreak">
<?php if($type == 'emp_data' || $type == 'sp_data') { ?>
    <table class="mainTable">
        <tbody class="emp_tbl">
            <tr>
                <th colspan="4" class="text-center"> <?= ($emp_datas[0]['e_type'] == 1) ? 'Employee' : 'Sales Partner'; ?> Information </th>
            </tr>

            <tr>
                <th>Name</th>
                <td> <?= !empty($emp_datas[0]['first_name']) ? $emp_datas[0]['first_name'] : ''; ?> </td>
            
                <th>Phone</th>
                <td> <?= !empty($emp_datas[0]['phone']) ? $emp_datas[0]['phone'] : ''; ?> </td>
            </tr>

            <tr>
                <th>Email</th>
                <td> <?= !empty($emp_datas[0]['email']) ? $emp_datas[0]['email'] : ''; ?> </td>
            
                <th>Designation</th>
                <td> <?= !empty($emp_datas[0]['designation']) ? $emp_datas[0]['designation'] : ''; ?> </td>
            </tr>

            <tr>
                <th>State</th>
                <td> <?= !empty($emp_datas[0]['state']) ? $emp_datas[0]['state'] : ''; ?> </td>
           
                <th>City</th>
                <td> <?= !empty($emp_datas[0]['city']) ? $emp_datas[0]['city'] : ''; ?> </td>
            </tr>

            <tr>
                <th>Country</th>
                <td> <?= !empty($emp_datas[0]['country']) ? $emp_datas[0]['country'] : ''; ?> </td>
           
                <th>Zipcode</th>
                <td> <?= !empty($emp_datas[0]['zip']) ? $emp_datas[0]['zip'] : ''; ?> </td>
            </tr>

            <tr>
                <th>Houre Rate/Salary</th>
                <td> <?= !empty($emp_datas[0]['hrate']) ? $emp_datas[0]['hrate'] : ''; ?> </td>

                <th>Employee Type</th>
                <td> <?= !empty($emp_datas[0]['employee_type']) ? $emp_datas[0]['employee_type'] : ''; ?> </td>
            </tr>

            <?php if($emp_datas[0]['e_type'] == 1) { ?>
                <tr>
                    <th>Payroll Type</th>
                    <td> <?= !empty($emp_datas[0]['payroll_type']) ? $emp_datas[0]['payroll_type'] : ''; ?> </td>

                    <th>Payroll Frequency</th>
                    <td> <?= !empty($emp_datas[0]['payroll_freq']) ? $emp_datas[0]['payroll_freq'] : ''; ?> </td>
                </tr>
            <?php } ?>

            <tr>
                <th>Bank Name</th>
                <td> <?= !empty($emp_datas[0]['bank_name']) ? $emp_datas[0]['bank_name'] : ''; ?> </td>

                <th>Account Number</th>
                <td> <?= !empty($emp_datas[0]['account_number']) ? $emp_datas[0]['account_number'] : ''; ?> </td>
            </tr>

            <tr>
                <th>Employee Tax</th>
                <td> <?= !empty($emp_datas[0]['employee_tax']) ? $emp_datas[0]['employee_tax'] : ''; ?> </td>

                <th>Routing Number</th>
                <td> <?= !empty($emp_datas[0]['routing_number']) ? $emp_datas[0]['routing_number'] : ''; ?> </td>
            </tr>
            
            <tr><td colspan="4"></td></tr>
            <tr>
                <th colspan="4" class="text-center">Working Location Tax</th>
            </tr>
            <tr><td colspan="4"></td></tr>

            <tr>
                <th>State Tax</th>
                <td> <?= !empty($emp_datas[0]['working_state_tax']) ? $emp_datas[0]['working_state_tax'] : ''; ?> </td>

                <th>City Tax</th>
                <td> <?= !empty($emp_datas[0]['working_city_tax']) ? $emp_datas[0]['working_city_tax'] : ''; ?> </td>
            </tr>

            <tr>
                <th>Country Tax</th>
                <td> <?= !empty($emp_datas[0]['working_county_tax']) ? $emp_datas[0]['working_county_tax'] : ''; ?> </td>

                <th>Other Tax</th>
                <td> <?= !empty($emp_datas[0]['working_other_tax']) ? $emp_datas[0]['working_other_tax'] : ''; ?> </td>
            </tr>

            <tr><td colspan="4"></td></tr>
            <tr>
                <th colspan="4" class="text-center">Living Location Tax</th>
            </tr>
            <tr><td colspan="4"></td></tr>

            <tr>
                <th>State Tax</th>
                <td> <?= !empty($emp_datas[0]['living_state_tax']) ? $emp_datas[0]['living_state_tax'] : ''; ?> </td>

                <th>City Tax</th>
                <td> <?= !empty($emp_datas[0]['living_city_tax']) ? $emp_datas[0]['living_city_tax'] : ''; ?> </td>
            </tr>

            <tr>
                <th>Country Tax</th>
                <td> <?= !empty($emp_datas[0]['living_county_tax']) ? $emp_datas[0]['living_county_tax'] : ''; ?> </td>

                <th>Other Tax</th>
                <td> <?= !empty($emp_datas[0]['living_other_tax']) ? $emp_datas[0]['living_other_tax'] : ''; ?> </td>
            </tr>

        </tbody>
    </table>

<?php } else { ?>
   <table class="mainTable">
        <thead style="background-color: #424f5c;">
            <tr style="color:white;text-align:center;">
                <th style="text-align:center; color:white;">Date</th>
                <th style="text-align:center; color:white;" >Day</th>
                <?php if($time_data['payroll_type'] == 'Hourly') { ?>
                    <th style="text-align:center; color:white;">Daily Break in mins</th>
                    <th style="text-align:center; color:white;">Start Time (HH:MM)</th>
                    <th style="text-align:center; color:white;">End Time (HH:MM)</th>
                    <th style="text-align:center; color:white;">Hours</th>
                <?php } else { ?>
                    <th style="text-align:center; color:white;">Present / Absence</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($time_data['timesheet_data'])) {
            foreach ($time_data['timesheet_data'] as $row) { 

                    echo '<tr style="color: black;">
                    <td style="text-align:center;">' . $row['Date'] . '</td>
                    <td style="text-align:center;">' . $row['Day'] . '</td>';
                    if($time_data['payroll_type'] == 'Hourly') { 
                    echo '<td style="text-align:center;">' . $row['daily_break'] . '</td>
                        <td style="text-align:center;">' . $row['time_start'] . '</td>
                        <td style="text-align:center;">' . $row['time_end'] . '</td>
                        <td style="text-align:center;">' . $row['hours_per_day'] . '</td>';
                    } else {
                        echo '<td style="text-align:center;">' . $row['present'] . '</td>';
                    }
                    echo '</tr>';    
            } }
            ?>
        </tbody>
        <tfoot>
            <tr style="color: black;">
                <td colspan="<?= ($time_data['payroll_type'] == 'Hourly') ? 5 : 2; ?>" style="text-align: right;"><b><?= display('TOTAL'); ?> :</b></td>
                <td style="text-align: center;">
                    <input type="text" name="total[]" value="<?= $time_data['currency'] . "" .  $time_data['total_hours']; ?>" style="border: none;" readonly />
                </td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
    <table class="mainTable">
        <thead style="background-color: #424f5c;">
            <tr style="color:white;text-align:center;">
                <th style="text-align:center; color:white;">Administrator Name</th>
                <th style="text-align:center; color:white;">Payment Method</th>
                <th style="text-align:center; color:white;">Cheque No</th>
                <th style="text-align:center; color:white;">Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;"><?= $time_data['admin_name']; ?></td>
                <td style="text-align:center;"><?= $time_data['payment_method']; ?></td>
                <td style="text-align:center;"><?= $time_data['cheque_no']; ?></td>
                <td style="text-align:center;"><?= $time_data['cheque_date']; ?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>
</div>
</body>
</html>
