<style>
.switch-input[disabled] + .switch-label {
    pointer-events: none;
    background-color: #f2f2f2; 
    color: #999; 
}

.switch-input[disabled] + .switch-label::after {
    border-color: #999; 
}
.switch {
  margin-top: 5px;
  position: relative;
  display: inline-block;
  vertical-align: top;
  width: 56px;
  height: 20px;
  padding: 3px;
  background-color: white;
  border-radius: 18px;
  box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
  cursor: pointer;
  background-image: -webkit-linear-gradient(top, #EEEEEE, white 25px);
  background-image: -moz-linear-gradient(top, #EEEEEE, white 25px);
  background-image: -o-linear-gradient(top, #EEEEEE, white 25px);
  background-image: linear-gradient(to bottom, #EEEEEE, white 25px);
}
.switch-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.switch-label {
  position: relative;
  display: block;
  height: inherit;
  font-size: 10px;
  text-transform: uppercase;
  background: #ECEEEF;
  border-radius: inherit;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
  -webkit-transition: 0.15s ease-out;
  -moz-transition: 0.15s ease-out;
  -o-transition: 0.15s ease-out;
  transition: 0.15s ease-out;
  -webkit-transition-property: opacity background;
  -moz-transition-property: opacity background;
  -o-transition-property: opacity background;
  transition-property: opacity background;
}
.switch-label:before, .switch-label:after {
  position: absolute;
  top: 50%;
  margin-top: -.5em;
  line-height: 1;
  -webkit-transition: inherit;
  -moz-transition: inherit;
  -o-transition: inherit;
  transition: inherit;
}
.switch-label:before {
  content: attr(data-off);
  right: 11px;
  color: #aaa;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
  content: attr(data-on);
  left: 11px;
  color: white;
  text-shadow: 0 1px rgba(0, 0, 0, 0.2);
  opacity: 0;
}
.switch-input:checked ~ .switch-label {
  background: #38469F;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
  opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
  opacity: 1;
}
.switch-handle {
  position: absolute;
  top: 4px;
  left: 4px;
  width: 18px;
  height: 18px;
  background: white;
  border-radius: 10px;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
  background-image: -webkit-linear-gradient(top, white 40%, #F0F0F0);
  background-image: -moz-linear-gradient(top, white 40%, #F0F0F0);
  background-image: -o-linear-gradient(top, white 40%, #F0F0F0);
  background-image: linear-gradient(to bottom, white 40%, #F0F0F0);
  -webkit-transition: left 0.15s ease-out;
  -moz-transition: left 0.15s ease-out;
  -o-transition: left 0.15s ease-out;
  transition: left 0.15s ease-out;
}
.switch-handle:before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -6px 0 0 -6px;
  width: 12px;
  height: 12px;
  background: #F9F9F9;
  border-radius: 6px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
  background-image: -webkit-linear-gradient(top, #EEEEEE, white);
  background-image: -moz-linear-gradient(top, #EEEEEE, white);
  background-image: -o-linear-gradient(top, #EEEEEE, white);
  background-image: linear-gradient(to bottom, #EEEEEE, white);
}
.switch-input:checked ~ .switch-handle {
  left: 85px;
  box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-green > .switch-input:checked ~ .switch-label {
  background: #4FB845;
}
 .btnclr ,th{
   background-color:<?=$setting_detail[0]['button_color'];?>;
   color: white;
   }
.table {
    width: 100%; 
    table-layout: fixed; 
}

.table th,
.table td {
    width: auto;
    border: 1px solid #ccc;
    padding: 8px;
   
}
.table input[type="text"],input[type="time"] {
    text-align:center;
    background-color: inherit;
    border-radius: 4px;
    padding: 8px;
}
input {border:0;outline:0;}
.work_table td {
    height: 36px;
}
.btnclr{
    background-color:<?=$setting_detail[0]['button_color'];?>;
    color: <?=$setting_detail[0]['button_color'];?>;

}
th,td{
    text-align:center;
}
.select2-selection{
    display :none;
}
.mt-4 {
    margin-top: 3rem;
}
.m-3 {
    margin: 2rem;
}

.error{
    font-size: 14px;
}
</style>

<div class="content-wrapper">
    <section class="content-header" style="height:70px;">
        <div class="header-icon"><i class="pe-7s-note2"></i></div>

        <div class="header-title">
            <h1>Payment Administration</h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?=display('home')?></a></li>
                <li><a href="#">HRM</a></li>
                <li class="active" style="color:orange">Payment Administration</li>
            </ol>
        </div>
    </section>

<section class="content">

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading" style="height:50px;">
                    <div class="panel-title">
                        <a style="float:right;color:white;" href="<?php echo base_url('Chrm/manage_timesheet?id=' . $_GET['id'] . '&admin_id=' . $_GET['admin_id']); ?>" class="btnclr btn m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo "Manage TimeSheet" ?> </a>
                    </div>
                </div>
                <?=form_open_multipart('Chrm/adminApprove', 'id="datavalidate"')?>
                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="customer" class="col-sm-4 col-form-label">Employee Name<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="hidden" readonly id="tsheet_id" value="<?=$time_sheet_data[0]['timesheet_id'];?>" name="tsheet_id" />
                                <input type="hidden" readonly id="unique_id" value="<?=$time_sheet_data[0]['unique_id'];?>" name="unique_id" />
                                <select name="templ_name" id="templ_name" class="form-control" tabindex="3" required>
                                    <?php foreach ($employee_name as $pt) {?>
                                        <option value="<?=$pt['id'];?>" <?=($employee[0]['id'] == $pt['id']) ? 'selected' : '';?> ><?=$pt['first_name'] . " " . $pt['last_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                         <div class="col-sm-6">
                            <label for="qdate" class="col-sm-4 col-form-label">Job title</label>
                            <div class="col-sm-6">
                                <input type="text" name="job_title" id="job_title" readonly placeholder="Job title" value="<?=empty($employee_name[0]['designation']) ? 'Sales Partner' : $employee_name[0]['designation'];?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="dailybreak" class="col-sm-4 col-form-label">Date Range<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input id="reportrange" type="text" readonly name="date_range" <?php if ($time_sheet_data[0]['uneditable'] == 1) {echo 'readonly';}?> value="<?=$time_sheet_data[0]['month'];?>" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="dailybreak" class="col-sm-4 col-form-label">Payroll Frequency <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input id="payroll_freq" name="payroll_freq" type="text" value="<?=$time_sheet_data[0]['payroll_freq'];?>" readonly class="form-control"/>
                                <input  type="hidden" id="payroll_type"  value="<?=$employee[0]['payroll_type'];?>" name="payroll_type" />
                            </div>
                        </div>
                    </div>

                    <!-------------- Time Sheet table Start here -------------------->
                    <div class="table-responsive work_table col-md-12">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="PurList">
                            <thead class="btnclr">
                                <tr style="text-align:center;">
                                    <?php if ($employee_name[0]['payroll_type'] == 'Hourly') {?>
                                        <th style='height:25px;' class="col-md-2">Date</th>
                                        <th style='height:25px;' class="col-md-1">Day</th>
                                        <th class="col-md-1">Daily Break in mins <a class="btnclr client-add-btn btn dailyBreak" aria-hidden="true" style="color:white;border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#dailybreak_add"><i class="fa fa-plus"></i></a>
                                        </th>
                                        <th style='height:25px;' class="col-md-2">Start Time (HH:MM)</th>
                                        <th style='height:25px;' class="col-md-2">End Time (HH:MM)</th>
                                        <th style='height:25px;' class="col-md-5">Hours</th>
                                        <th style='height:25px;' class="col-md-5">Over Time</th>
                                        <?php if ($time_sheet_data[0]['uneditable'] != '1') { echo "<th style='height:25px;' class='col-md-5'>Action</th>"; } ?>

                                    <?php } elseif ($employee_name[0]['payroll_type'] != 'Hourly') {?>
                                        <th style='height:25px;' class="col-md-2">Date</th>
                                        <th style='height:25px;' class="col-md-1">Day</th>
                                        <th style='height:25px;' class="col-md-1">Present / Absent</th>
                                    <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') {?>
                                    <?php }?>
                                </tr>
                            </thead>

<?php
function compareDates($a, $b) {
    $dateA = DateTime::createFromFormat('d/m/Y', $a['Date']);
    $dateB = DateTime::createFromFormat('d/m/Y', $b['Date']);
    if ($dateA === false || $dateB === false) {
        return 0; 
    }
    return $dateA <=> $dateB;
}
$timesheetdata = [];
$split_date    = explode(' - ', $time_sheet_data[0]['month']);
$start_date    = date('Y-m-d', strtotime($split_date[0]));
$end_date      = date('Y-m-d', strtotime($split_date[1]));
$btw_days      = date_diff(date_create($start_date), date_create($end_date));
$get_days      = (int) ($btw_days->format('%a') + 1);
$end_week      = $setting_detail[0]['end_week'];

if ($employee_name[0]['payroll_type'] == 'Hourly') {?>

                            <tbody id="tBody">
                            <?php
if (!empty($time_sheet_data)) {

    
    usort($time_sheet_data, 'compareDates');
    $printedDates = array();

    foreach ($time_sheet_data as $tsheet) {
        $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit' => $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break'], 'over_time' => $tsheet['over_time']];
        if (!empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates)) {
            $printedDates[] = $tsheet['Date'];
        }
    }

    $weekly_data = json_decode($time_sheet_data[0]['weekly_hours']);
    $j           = 0;
    $data_id     = 0;
    for ($i = 0; $i < $get_days; $i++) {
        $date = date('m/d/Y', strtotime($start_date . ' +' . $i . ' day'));
        ?>
                            <tr>
                                <?php if ($employee_name[0]['payroll_type'] == 'Hourly') {?>
                                <td class="date">
                                    <input type="text" value="<?=$date;?>" name="date[]" readonly>
                                </td>
                                <td class="day">
                                    <input type="text" value="<?=empty($timesheetdata[$date]['day']) ? date('l', strtotime($date)) : $timesheetdata[$date]['day'];?>" name="day[]" readonly>
                                </td>
                                <td style="text-align:center;" class="daily-break">
                                    <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                                    <option value="<?=$timesheetdata[$date]['break'];?>"><?=$timesheetdata[$date]['break'];?></option>
                                        <?php foreach ($dailybreak as $dbd) {?>
                                            <option value="<?=$dbd['dailybreak_name'];?>"><?=$dbd['dailybreak_name'];?></option>
                                        <?php }?>
                                    </select>
                                </td>
                                <td class="start-time">
                                    <input type="time" <?php if ($timesheetdata[$date]['edit'] == 1) {echo 'readonly';}?> name="start[]" readonly data-id='<?php echo $data_id; ?>' class="hasTimepicker start" value="<?=empty($date) ? 'readonly' : $timesheetdata[$date]['start'];?>">
                                </td>
                                <td class="finish-time">
                                    <input type="time" <?php if ($timesheetdata[$date]['edit'] == 1) {echo 'readonly';}?> name="end[]" readonly data-id='<?php echo $data_id; ?>' class="hasTimepicker end" value="<?=empty($date) ? 'readonly' : $timesheetdata[$date]['end'];?>">
                                </td>
                                <td class="hours-worked">
                                    <input readonly name="sum[]" class="timeSum hourly_tot_<?php echo $data_id; ?>" value="<?=empty($date) ? 'readonly' : $timesheetdata[$date]['per_hour'];?>" type="text">
                                </td>

                                <td class="overtime">
                                    <input readonly name="over_time[]" class="overTime_<?php echo $data_id; ?>" value="<?=empty($timesheetdata[$date]['over_time']) ? '0.00' : $timesheetdata[$date]['over_time'];?>" type="text">
                                </td>

                                <?php if($time_sheet_data[0]['uneditable'] != 1) { ?>
                                    <td>
                                        <a style="color: white;" class="delete_day btnclr btn m-b-5 m-r-2" >
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                <?php } ?>

                                <?php if ($end_week == $timesheetdata[$date]['day']) {
                                    echo '<tr>
                                        <td colspan="5" class="text-right" style="font-weight:bold;">Weekly Total Hours:</td>
                                        <td> <input type="text" class="weekly_hour" name="hour_weekly_total[]" id="hourly_' . $data_id . '" value="' . $weekly_data[$j] . '"> </td>
                                    </tr>';
                                    $data_id++;
                                    $j++;
                                }?>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'Salaried-weekly' || $employee_name[0]['payroll_type'] == 'Salaried-BiWeekly' || $employee_name[0]['payroll_type'] == 'Salaried-Monthly' || $employee_name[0]['payroll_type'] == 'Salaried-BiMonthly') {?>
                                <td class="date">
                                    <input type="text" <?php if ($timesheetdata[$date]['edit'] == 1) {echo 'readonly';}?> value="<?=empty($timesheetdata[$date]['date']) ? 'readonly' : $timesheetdata[$date]['date'];?>" name="date[]">
                                </td>
                                <td class="day">
                                    <input type="text" <?php if ($timesheetdata[$date]['edit'] == 1) {echo 'readonly';}?> value="<?=empty($timesheetdata[$date]['Day']) ? 'readonly' : $timesheetdata[$date]['Day'];?>" name="day[]">
                                </td>
                                <td class="hours-worked">
                                    <input name="sum[]" class="timeSum" type="checkbox" style="width: 20px;height: 20px"
                                    <?=(isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === "no") ? 'checked' : '';?>
                                    <?=(!isset($timesheetdata[$date]['check']) || $timesheetdata[$date]['check'] === '') ? 'disabled' : '';?>>
                                </td>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') {}?>
                            </tr>
                            <?php } } ?>
                        </tbody>
                        <?php } else {?>

                        <tbody id="tBody">
                            <?php
                            if (!empty($time_sheet_data)) {
                                usort($time_sheet_data, 'compareDates');
                                $printedDates = array();
                                foreach ($time_sheet_data as $tsheet) {
                                    $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit' => $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break']];
                                    if (empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates)) {
                                        $printedDates[] = $tsheet['Date'];
                                    }
                                }
                                $data_id     = 0;
                                $weekly_data = json_decode($time_sheet_data[0]['weekly_hours']);
                                for ($j = 0; $j < $get_days; $j++) {
                                $date = date('m/d/Y', strtotime($start_date . ' +' . $j . ' day'));
                            ?>
                            <tr>
                                <?php if ($employee_name[0]['payroll_type'] == 'Hourly') {?>
                                <td class="date">
                                    <input type="text" name="date[]" value="<?=$date;?>" readonly>
                                </td>
                                <td class="day">
                                    <input type="text" value="<?=empty($timesheetdata[$date]['day']) ? '' : $timesheetdata[$date]['day'];?>" name="day[]" readonly>
                                </td>
                                <td style="text-align:center;" class="daily-break">
                                    <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                                    <option value="<?=$timesheetdata[$date]['break'];?>"><?=$timesheetdata[$date]['break'];?></option>
                                        <?php foreach ($dailybreak as $dbd) {?>
                                            <option value="<?=$dbd['dailybreak_name'];?>"><?=$dbd['dailybreak_name'];?></option>
                                        <?php }?>
                                    </select>
                                </td>
                                <td class="start-time">
                                    <input <?php if ($timesheetdata[$date]['edit'] == 1) {echo 'readonly';}?> name="start[]" readonly data-id='<?php echo $data_id; ?>' class="hasTimepicker start" value="<?=empty($timesheetdata[$date]['day']) ? 'readonly' : $timesheetdata[$date]['start'];?>" type="time">
                                </td>
                                <td class="finish-time">
                                    <input <?php if ($timesheetdata[$date]['edit'] == 1) {echo 'readonly';}?> name="end[]" readonly data-id='<?php echo $data_id; ?>' class="hasTimepicker end" value="<?=empty($timesheetdata[$date]['day']) ? 'readonly' : $timesheetdata[$date]['end'];?>" type="time">
                                </td>
                                <td class="hours-worked">
                                    <input readonly name="sum[]" class="timeSum hourly_tot_<?php echo $data_id; ?>" value="<?=empty($timesheetdata[$date]['day']) ? 'readonly' : $timesheetdata[$date]['per_hour'];?>" type="text">
                                </td>
                                <td>
                                    <a style='color:white;' class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                </td>
                                <?php if ($end_week == $timesheetdata[$date]['day']) {
                                    echo '<tr>
                                        <td colspan="5" class="text-right" style="font-weight:bold;">Weekly Total Hours:</td>
                                        <td> <input type="text" class="weekly_hour" name="hour_weekly_total[]" id="hourly_' . $data_id . '" value="' . $weekly_data[$i] . '" readonly> </td>
                                    </tr>';
                                    $data_id++;
                                }?>

                                <?php } elseif ($employee_name[0]['payroll_type'] != 'Hourly') {?>
                                <td class="date">
                                    <input type="text" value="<?=empty($date) ? 'readonly' : $date;?>" name="date[]" readonly>
                                </td>
                                <td class="day">
                                    <input type="text" value="<?=empty($timesheetdata[$date]['day']) ? '' : $timesheetdata[$date]['day'];?>" name="day[]" readonly>
                                </td>
                                <td class="hours-worked">
                                    <label class="switch" style="width:100px;">
                                        <input type="checkbox" class="timeSum present checkbox switch-input" id="blockcheck_<?=$i;?>" name="present[]" <?=(isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'present') ? 'checked="checked"' : '';?> data-present="<?=$timesheetdata[$date]['check'] ?? '';?>" disabled>
                                        <span contenteditable="false" class="switch-label" data-on="Present" data-off="Absent"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <input readonly type="hidden" name="block[]" id="block_<?=$i++;?>" value="<?=(isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'absent') ? 'absent' : 'present';?>" />
                                </td>

                                <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') {?>
                                <?php }?>

                            </tr>
                            <?php
}
}?>
                        </tbody>
                        <?php }?>

                        <tfoot>

                       <tr style="text-align:end">



                  <?php if ($employee_name[0]['payroll_type'] == 'Hourly') {?>
                        <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours :</td>
                      <td style="text-align: center;"> <input  type="text"   readonly value="<?php echo $time_sheet_data[0]['total_hours']; ?>" name="total_net" id="total_net" /> </td>
  

 <?php
function convertToDecimalHours($time) {
    list($hours, $minutes) = explode(':', $time);
    return $hours + ($minutes / 60);
}
    $working_hour = 0;
    if ($employee_name[0]['payroll_freq'] == 'Weekly') {
        $working_hour = $extratime_info[0]['work_hour'];
    } elseif ($employee_name[0]['payroll_freq'] == 'Bi-Weekly') {
        $working_hour = ($extratime_info[0]['work_hour'] + $extratime_info[0]['work_hour']);
    }
    $total_hours_numeric = convertToDecimalHours($time_sheet_data[0]['total_hours']);
    $work_hour_numeric   = convertToDecimalHours($working_hour);

    if ($total_hours_numeric > $work_hour_numeric) {?>
    <input  type="hidden"   readonly id="above_extra_beforehours"
     value="<?php
$mins      = $time_sheet_data[0]['total_hours'] - $working_hour;
        $get_value = $time_sheet_data[0]['total_hours'] - $mins;
        $get_value = sprintf('%d:00', $get_value);
        echo $get_value
        ;?>"
         <?php
        $hrate = $employee_name[0]['hrate'];
        list($hours, $minutes) = explode(':', $get_value);


        $total_hours = (int) $hours + ((int) $minutes / 60);


        $total_cost = $total_hours * $hrate;


        $total_cost = round($total_cost, 2);
//For YTD
        $total                 = $time_sheet_data[0]['total_hours'];
        list($hours, $minutes) = explode(':', $total);
        $total_hours_ytd       = $hours + ($minutes / 60);
        $total_cost_ytd        = $total_hours_ytd * $hrate;
        $total_cost_ytd        = round($total_cost_ytd, 2);
        ?>
     name="above_extra_beforehours" />

        <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?php echo $employee_name[0]['hrate']; ?>" />
        <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?php echo $total_cost; ?>" />
        <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?php echo $get_value; ?>" />
        <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?php echo $total_cost; ?>" />
        <?php } else {

        $hrate                 = $employee_name[0]['hrate'];
        list($hours, $minutes) = explode(':', $get_value);
        $total_hours           = (int) $hours + ((int) $minutes / 60);
        $total_cost            = $total_hours * $hrate;
        $total_cost            = round($total_cost, 2);

        $total                 = $time_sheet_data[0]['total_hours'];
        list($hours, $minutes) = explode(':', $total);
        $total_hours_ytd       = $hours + ($minutes / 60);
        $total_cost_ytd        = $total_hours_ytd * $hrate;
        $total_cost_ytd        = round($total_cost_ytd, 2);
        ?>
                    <input type="hidden" readonly id="above_extra_beforehours"
                    value="<?php echo $time_sheet_data[0]['total_hours'];
        ?>" name="above_extra_beforehours" />
                    <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?php echo $employee_name[0]['hrate']; ?>" />
                    <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?php echo $total_cost_ytd; ?>" />
                    <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?php echo $time_sheet_data[0]['total_hours']; ?>" />
                    <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?php echo $total_cost_ytd; ?>" />

                  <?php
}?>
                                <?php } elseif ($employee_name[0]['payroll_type'] == 'Fixed') {?>
                                <td colspan="2" class="text-right" style="font-weight:bold;">No of Days:</td>
                                  <td style="text-align: center;"> <input  type="text"   readonly id="total_net" value="<?php echo $time_sheet_data[0]['total_hours']; ?>" name="total_net" id="total_net"/>    </td>
                              <?php if ($total_hours_numeric > $work_hour_numeric) {?>
                <input  type="hidden"   readonly id="above_extra_beforehours"
                 value="<?php
      
        echo $time_sheet_data[0]['total_hours'] ?? '';

    $mins      = $time_sheet_data[0]['total_hours'] - $extratime_info[0]['work_hour'];
    $get_value = $time_sheet_data[0]['total_hours'];
    echo $get_value
    ; ?>"
                 name="above_extra_beforehours" />

                    <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?php echo $employee_name[0]['hrate']; ?>" />
                    <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?php echo $get_value * $employee_name[0]['hrate']; ?>" />
                    <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?php echo $get_value; ?>" />
                    <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?php echo $get_value * $employee_name[0]['hrate']; ?>" />


                    <?php } else {?>
                    <input type="hidden" readonly id="above_extra_beforehours"
                    value="<?php echo $time_sheet_data[0]['total_hours'];?>" name="above_extra_beforehours" />
                    <input type="hidden" id="above_extra_rate" name="above_extra_rate" value="<?php echo $employee_name[0]['hrate']; ?>" />
                    <input type="hidden" id="above_extra_sum" name="above_extra_sum" value="<?php echo $time_sheet_data[0]['total_hours'] * $employee_name[0]['hrate']; ?>" />
                    <input type="hidden" id="extra_this_hour" name="extra_this_hour" value="<?php echo !empty($get_value) ? $get_value : 0; ?>" />
                    <input type="hidden" id="above_this_hours" name="above_this_hours" value="<?php echo $time_sheet_data[0]['total_hours']; ?>" />
                    <input type="hidden" id="above_extra_ytd" name="above_extra_ytd" value="<?php echo $time_sheet_data[0]['total_hours'] * $employee_name[0]['hrate']; ?>" />
                    <?php }?>

                    <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') {?>
                   <?php }?>
                                 </tr>
                                 <br>
                              <?php if ($employee_name[0]['payroll_type'] == 'Hourly') {
    $hourly_rate = $employee_name[0]['hrate'] * $extratime_info[0]['extra_workamount'];
    if ($total_hours_numeric > $work_hour_numeric) {
        list($hours, $minutes) = explode(':', $overtime);
        $total_hours_decimal   = (int) $hours + ((int) $minutes / 60);
        $total_cost            = $total_hours_decimal * $hourly_rate;
        $total_cost            = round($total_cost, 2);

        ?>
                                 <input type="hidden" id="extra_hour" name="extra_hour" value="<?php echo ($total_hours_numeric > $work_hour_numeric) ? ($overtime) : '0'; ?>" />
                                 <input type="hidden" id="extra_rate" name="extra_rate" value="<?php echo $employee_name[0]['hrate'] * $extratime_info[0]['extra_workamount']; ?>" />
                                 <input type="hidden" id="extra_thisrate" name="extra_thisrate" value="<?php echo $total_cost; ?>" />
                                 <input type="hidden" id="extra_this_hour" name="extra_this_hour" value="<?php echo $overtime; ?>" />
                                 <input type="hidden" id="extra_ytd" name="extra_ytd" value="<?php echo $total_cost; ?>"   />
                                 <?php
} else {
        list($hours, $minutes) = explode(':', $overtime);
        $total_hours_ytd       = (int) $hours + ((int) $minutes / 60);
        $total_c               = $total_hours_ytd * $employee_name[0]['hrate'];
        $total_c               = round($total_c, 2);
        ?>
                                 <input type="hidden" id="extra_hour" name="extra_hour" value="<?php echo ($total_hours_numeric > $work_hour_numeric) ? ($overtime) : '0'; ?>" />
                                 <input type="hidden" id="extra_rate" name="extra_rate" value="<?php echo $employee_name[0]['hrate'] * $extratime_info[0]['extra_workamount']; ?>" />

                                 <input type="hidden" id="extra_thisrate" name="extra_thisrate" value="<?php echo ($total_c); ?>" />
                                <?php
}
}?>
                                </tfoot>

                </table>
            </div>

            <div class="form-group row">
                <div class="col-sm-4"></div>
                    <div class="col-sm-4" style="border: 5px solid gainsboro;border-radius: 20px;">
                        <div class="">
                            <div class="panel-title">
                            <br/>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <label for="administrator_person">Administrator Name<i class="text-danger">*</i></label>
                                    </div>

                                    <div class="col-sm-4">
                                        <select name="administrator_person" id="administrator_person" class="form-control" required data-placeholder="<?=display('select_one');?>">
                                                <option value="">Select Administrator Name</option>
                                            <?php foreach ($administrator as $adv) {?>
                                                <option value="<?=$adv['adm_id'];?>" <?=($time_sheet_data[0]['admin_name'] == $adv['adm_id']) ? 'selected' : '';?> ><?=$adv['adm_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <a class="client-add-btn btn btnclr text-white" aria-hidden="true"  data-toggle="modal" data-target="#add_admst" ><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        <div class="panel-title">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <label for="selector">Payment Method <i class="text-danger">*</i> </label>
                                </div>

                                <div class="col-sm-6">
                                    <select id="selector" name="payment_method" onchange="yesnoCheck(this);" class="form-control" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="Cheque" <?=($time_sheet_data[0]['payment_method'] == "Cheque") ? 'Selected' : '';?>>Cheque/Check </option>
                                        <option value="Bank" <?=($time_sheet_data[0]['payment_method'] == "Bank") ? 'Selected' : '';?>>Bank</option>
                                        <option value="Cash" <?=($time_sheet_data[0]['payment_method'] == "Cash") ? 'Selected' : '';?>>Cash</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="adc" ><br/>
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="aadhar">Cheque No<i class="text-danger">*</i></label>
                                </div>

                                <div class="col-sm-6">
                                    <input type="number" id="cheque_no" name="cheque_no"  value="<?php echo $time_sheet_data[0]['cheque_no']; ?>"  class="form-control" requried /><br />
                                </div>

                                <div class="col-sm-6">
                                    <label for="aadhar">Cheque Date<i class="text-danger">*</i></label>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" id="datepicker_cheque" name="cheque_date" value="<?php echo $time_sheet_data[0]['cheque_date']; ?>"  class="form-control"  requried/><br />
                                </div>
                            </div>
                        </div>

                        <div id="pc" >
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="pan">Bank Name<i class="text-danger">*</i></label>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" id="bank_name" name="bank_name" value="<?=$time_sheet_data[0]['bank_name'];?>"  class="form-control" requried /><br />
                                </div>

                                <div class="col-sm-6">
                                    <label for="pan">Payment Reference No<i class="text-danger">*</i></label>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" id="payment_refno" name="payment_refno" value="<?=$time_sheet_data[0]['payment_ref_no'];?>"  class="form-control"  requried/><br />
                                </div>
                            </div>
                        </div>

                        <div id="ps" style="display:none;">
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="pass">Cash<i class="text-danger">*</i></label>
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" id="cash" name="cash"  class="form-control"  value="Cash" readonly /><br />
                                    <input type ="hidden" id="admin_company_id" value="<?php echo $_GET['id']; ?>" name="admin_company_id" />
                                    <input type ="hidden" id="adminId" value="<?php echo $_GET['admin_id']; ?>" name="adminId" />
                                </div>
                            </div>
                        </div>

                        <!--Cash Method -->
                        <div id="Cashmethod">
                            <br/>
                            <div class="col-sm-12" style="padding-top:20px;">
                                <div class="col-sm-6">
                                    <label for="aadhar">Date<i class="text-danger">*</i></label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" id="datepicker" name="cash_date" value="<?=$time_sheet_data[0]['cheque_date'];?>"  class="form-control" requried /><br />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-12 m-3" align="center">
                <?php
                    $isDisabled  = $time_sheet_data[0]['uneditable'] == 1 ? 'disabled' : '';
                    $buttonStyle = 'float:right; color:white; background-color: #38469f;';
                    $mouseEvents = $time_sheet_data[0]['uneditable'] == 1 ? 'onmouseover="showToast()" onmouseleave="hideToast()"' : '';
                ?>
                <input type="submit" style="<?=$buttonStyle?>" value="Generate pay slip" class="btn btn-info m-b-5 m-r-2" <?=$isDisabled?> <?=$mouseEvents?> />

                </div>
            </div>
                <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
   $modaldata['bootstrap_modals'] = array('daily_break');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>

<script>
function yesnoCheck(that) {
  if (that.value == "Cheque") {
        document.getElementById("adc").style.display = "block";
        document.getElementById("pc").style.display = "none";
        document.getElementById("Cashmethod").style.display = "none";
    } else if (that.value == "Bank") {
        document.getElementById("adc").style.display = "none";
        document.getElementById("pc").style.display = "block";
        document.getElementById("Cashmethod").style.display = "block";
    } else if (that.value == "Cash") {
        document.getElementById("adc").style.display = "none";
        document.getElementById("pc").style.display = "none";
        document.getElementById("Cashmethod").style.display = "block";
    } else {
        document.getElementById("adc").style.display = "none";
        document.getElementById("pc").style.display = "none";
        document.getElementById("Cashmethod").style.display = "none";
    }
}

$(document).ready(function(){
    var that=$('#selector').val();
    if (that == "Cheque") {
        $('#adc').show();
        $('#pc').hide();
        $('#Cashmethod').hide();
    } else if (that == "Bank") {
        $('#adc').hide();
        $('#pc').show();
        $('#Cashmethod').hide();
    } else if (that == "Cash") {
        $('#adc').hide();
        $('#pc').hide();
        $('#Cashmethod').show();
    } else {
        $('#adc').hide();
        $('#pc').hide();
        $('#Cashmethod').hide();
    }
 });

</script>


<?php
$modaldata['bootstrap_modals'] = array('add_administrator');
$this->load->view('include/bootstrap_modal', $modaldata);
?>


<script src="<?=base_url('assets/js/moment.min.js');?>"></script>

<script>

var data = {
    value:$('#customer_name').val()
};
var csrfName = '<?=$this->security->get_csrf_token_name();?>';
var csrfHash = '<?=$this->security->get_csrf_hash();?>';

$('body').on('input select change','#reportrange',function(){
    var date = $(this).val();
    const myArray = date.split("-");
    var start = myArray[0];
    var end = myArray[1];
    getTimesheet(start, end);
});

function getTimesheet(start, end) {

    const weekDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    let chosenDate = start;
    var s_split = start.split("/");
    var e_split = end.split("/");
    var Date1 = new Date (s_split[2]+'/'+s_split[0]+'/'+s_split[1]);
    var Date2 = new Date (e_split[2]+'/'+e_split[0]+'/'+e_split[1]);
    var Days = Math.round((Date2.getTime() - Date1.getTime())/(1000*60*60*24));

    const validDate = new Date(chosenDate);
    let newDate;
    const monStartWeekDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

    var end_week = "<?php echo (!empty($setting_detail[0]['end_week'])) ? $setting_detail[0]['end_week'] : 'Sunday'; ?>";
    var total_pres = 0;
    var data_id = 0;
    var tbody = '';
    for(let i = 0; i <= Days; i++) {
        newDate = new Date(validDate.getTime());
        newDate.setDate(validDate.getDate() + i);
        var date=$('#date_'+i).html();
        let dayString = weekDays[newDate.getDay()].slice(0, 10);
        let days = ("0" + newDate.getDate()).slice(-2);
        let month = ("0" + (newDate.getMonth() + 1)).slice(-2);
        let dateString = `${month}/${days}/${newDate.getFullYear()}`;

        var day=$('#day_'+i).html();
        tbody += $('#tBody').append( `
            <tr>
                <td  class="date" id="date_`+i+`"><input type="hidden" value="${newDate.getDate()}/${newDate.getMonth() + 1}/${newDate.getFullYear()}" name="date[]"   />${dateString}</td>
                <td  class="day" id="day_`+i+`"><input type="hidden" value="`+`${weekDays[newDate.getDay()].slice(0,10)}" name="day[]"   />`+`${weekDays[newDate.getDay()].slice(0,10)}</td>
                <td style="text-align:center;" class="daily-break_${i}">
                    <select disabled name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                        <?php foreach ($dailybreak as $dbd) {?>
                            <option value="<?=$dbd['dailybreak_name'];?>"><?=$dbd['dailybreak_name'];?></option>
                        <?php }?>
                    </select>
                </td>
                <td class="start-time_`+i+`">
                    <input id="startTime${monStartWeekDays[i]}" name="start[]"  readonly data-id='<?php echo $data_id; ?>' class="hasTimepicker start" type="time" />
                </td>
                <td class="finish-time_`+i+`">
                    <input id="finishTime${monStartWeekDays[i]}" name="end[]" readonly data-id='<?php echo $data_id; ?>' class="hasTimepicker end" type="time" />
                </td>
                <td class="hours-worked_`+i+`">
                    <input id="hoursWorked${dayString}" ="sum[]" class="timeSum" readonly type="text" />
                </td>
                <td>
                    <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                </td>
            </tr>`);

         if(end_week == dayString) {
            tbody += $('#tBody').append(`<tr>
                <td colspan="5" class="text-right" style="font-weight:bold;"> Weekly Total Hours:</td>
                <td class="hour_week_total">
                    <input type="text" class="weekly_hour" readonly name="hour_weekly_total" id="hourly_`+data_id+`" value="" readonly />
                </td>
            </tr>`);
            data_id++;
        }
    }
    return tbody;
}

function converToMinutes(s) {
    var c = s.split(':');
    return parseInt(c[0]) * 60 + parseInt(c[1]);
}

function parseTime(s) {
    return Math.floor(parseInt(s) / 60) + ":" + parseInt(s) % 60
}

$(document).on('select change', '#templ_name', function () {
    var data = {
        value:$('#templ_name').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data,
        dataType:"json",
        url:'<?=base_url();?>Chrm/getemployee_data',
        success: function(result, statut) {
            $('#job_title').val(result[0]['designation']);
        }
    });
});

$(document).ready(function() {
    function updateCounter() {
        var sumOfDays = $('input[type="checkbox"].present:checked').length;
        $('#total_net').val(sumOfDays);
    }

    $(document).on('change', 'input[type="checkbox"].present', updateCounter);
    var payroll_type = $('#payroll_type').val();

    if(payroll_type !== 'Hourly') {
        updateCounter();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var checkboxes = document.querySelectorAll('.checkbox.switch-input');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var idSuffix = this.id.split('_')[1];
            var correspondingInputField = document.getElementById('block_' + idSuffix);
            correspondingInputField.value = this.checked ? "present" : "absent";
        });
    });
});

// End Date
$(document).on('select change', '.start', function onStartDateChange() {
    handleTimeCalculation($(this).closest('tr'));
});

$(document).on('select change', '.end', function onEndDateChange() {
    handleTimeCalculation($(this).closest('tr'));
});

$(document).on('select change', '.dailybreak', function onDailyBreakChange() {
    handleTimeCalculation($(this).closest('tr'));
});

function handleTimeCalculation(row) {
    var begin = row.find('.start').val();
    var end = row.find('.end').val();
    let valuestart = moment(begin, "HH:mm");
    let valuestop = moment(end, "HH:mm");
    let timeDiff = moment.duration(valuestop.diff(valuestart));
    var dailyBreakValue = parseInt(row.find('.dailybreak').val()) || 0; 
    var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;
    var hours = Math.floor(totalMinutes / 60);
    var minutes = totalMinutes % 60;

    var formattedTime = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');

    if (isNaN(parseFloat(formattedTime))) {
        row.find('.timeSum').val('00:00');
    } else {
        row.find('.timeSum').val(formattedTime);
    }

    var data_id = row.find('.start, .end').data('id');
    var total_netH = 0;
    var total_netM = 0;
    var week_netH = 0;
    var week_netM = 0;

    $('.table').each(function () {
        var tableHours = 0;
        var tableMinutes = 0;
        var weekHours = 0;
        var weekMinutes = 0;

        $(this).find('.hourly_tot_' + data_id).each(function () {
            var total_week = $(this).val();
            if (total_week && typeof total_week === 'string' && total_week.includes(':')) {
                var [weekhour, weekmin] = total_week.split(':').map(Number);
                weekHours += weekhour || 0;
                weekMinutes += weekmin || 0;
            }
        });
        week_netH += weekHours;
        week_netM += weekMinutes;

        $(this).find('.timeSum').each(function () {
            var precio = $(this).val();
            if (precio && typeof precio === 'string' && precio.includes(':')) {
                var [hours, minutes] = precio.split(':').map(parseFloat);
                tableHours += hours;
                tableMinutes += minutes;
            }
        });
        total_netH += tableHours;
        total_netM += tableMinutes;
    });

    var overtimeMinutes = Math.max(0, totalMinutes - 480); 
    var overtimeHours = Math.floor(overtimeMinutes / 60);
    var overtimeMinutesRemaining = overtimeMinutes % 60;
    var overtimeFormatted = overtimeHours.toString().padStart(2, '0') + ':' + overtimeMinutesRemaining.toString().padStart(2, '0');

    row.find('input[name="over_time[]"]').val(overtimeMinutes > 0 ? overtimeFormatted : '00:00');

    var timeConvertion = convertToTime(week_netH, week_netM);
    $('#hourly_' + data_id).val(timeConvertion).trigger('change');
    var totalTimeConvertion = convertToTime(total_netH, total_netM);
    $('#total_net').val(totalTimeConvertion).trigger('change');
}



function sumHours () {
    var time1 = $begin.timepicker().getTime();
    var time2 = $end.timepicker().getTime();
    if ( time1 && time2 ) {
      if ( time1 > time2 ) {
        v = new Date(time2);
        v.setDate(v.getDate() + 1);
      } else {
        v = time2;
      }
      var diff = ( Math.abs( v - time1) / 36e5 ).toFixed(2);
      $input.val(diff);
    } else {
      $input.val('');
    }
}

$('#total_net').on('keyup',function(){
    var value=$(this).val();
   if($(this).val() == ''){
$(".hasTimepicker").prop("readonly", false);
    $('#tBody .hasTimepicker').prop('defaultValue');
    }else{
   $(".hasTimepicker").prop("readonly", true);
    }
});
$(document).on('change', '.weekly_hour', function () {
    var tableHours = 0;
    var tableMinutes = 0;
    $('.weekly_hour').each(function () {
        var time = $(this).val().trim();
        if (time && time.includes(':')) {
            var [hours, minutes] = time.split(':').map(function (val) {
                return parseInt(val, 10); 
            });
            tableHours += hours;
            tableMinutes += minutes;
        }
    });
  if (tableMinutes >= 60) {
        tableHours += Math.floor(tableMinutes / 60);
        tableMinutes = tableMinutes % 60;
    }
        tableMinutes = tableMinutes.toString().padStart(2, '0');
       $('#total_net').val(tableHours+':'+tableMinutes).trigger('change');
});
$(document).on('click', '.delete_day', function() {
    $(this).closest('tr').remove();

    var total_netH = 0;
    var total_netM = 0;

    $('.table').each(function() {
        $(this).find('.timeSum').each(function() {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
                var [hours, minutes] = precio.split('.').map(parseFloat);
                total_netH += hours;
                total_netM += minutes;
            }
        });
    });

    // Convert total hours and minutes to the correct format
    var timeConversion = convertToTime(total_netH, total_netM);
    $('#total_net').val(timeConversion).trigger('change');

});

function convertToTime(hr,min) {
    let hours = Math.floor(min / 60);
    let minutes = min % 60;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return `${hours+hr}:${minutes}`;
}

$(function() {
    $("#datepicker").datepicker({
        dateFormat: 'mm-dd-yy',
        maxDate: 0
    });
    $("#datepicker_cheque").datepicker({
        dateFormat: 'mm-dd-yy',
        maxDate: 0
    });
});

function showToast() {
    toastr.warning("This payslip has been approved, and another cannot be generated", {
        closeButton: false,
        timeOut: 1000
    });
}

function hideToast() {
    toastr.clear();
}


$("#datavalidate").validate({
    rules: {
      cheque_no: "required",
      cheque_date: "required",  
      administrator_person: "required",  
      payment_method: "required",  
      bank_name: "required",
      payment_refno: "required",
      cash_date: "required"
    },
    messages: {
      cheque_no: "Cheque no is required",
      cheque_date: "Cheque date is required",
      administrator_person: "Administrator Person is required",
      payment_method: "Payment Method is required",
      bank_name: "Bank Name is required",
      payment_refno: "Payment Reference No is required",
      cash_date: "Cash Date is required"
    }
});

</script>
