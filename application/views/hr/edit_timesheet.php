<div class="content-wrapper">

    <section class="content-header" style="height:70px;">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>

        <div class="header-title">
            <h1>Edit TimeSheet</h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
                <li><a href="#">HRM</a></li>
                <li class="active" style="color:orange">Edit Timesheet</li>
            </ol>
        </div>
    </section>

    <section class="content">
     
        <div class="row">
            <div class="col-sm-12">                
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading" style="height:50px;">
                        <div class="panel-title">
                            <a style="float:right;color:white;" href="<?php echo base_url('Chrm/manage_timesheet?id=' . $_GET['id']); ?>" class="btnclr btn  m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo "Manage TimeSheet" ?> </a>
                        </div>
                    </div>
                  
                    <?php echo form_open_multipart('Chrm/pay_slip?id=' . $_GET['id'], 'id="validate"'); ?>
                  
                    <div class="panel-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="customer" class="col-sm-4 col-form-label">Employee Name<i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input  type="hidden" readonly id="tsheet_id" value="<?= $time_sheet_data[0]['timesheet_id'];?>" name="tsheet_id" />
                                    <input  type="hidden" readonly id="unique_id" value="<?= $time_sheet_data[0]['unique_id'];?>" name="unique_id" />          
                                    <input type ="hidden"  id="admin_company_id" value="<?php echo $_GET['id'];  ?>" name="admin_company_id" />
                                    <select name="templ_name" <?php if($time_sheet_data[0]['uneditable']==1){ echo 'disabled';}  ?> id="templ_name" class="form-control"    tabindex="3" style="width100">
                                        <option value="<?= $employee_name[0]['id'] ;?>"> <?= $employee_name[0]['first_name']." ".$employee_name[0]['last_name'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="qdate" class="col-sm-4 col-form-label">Job title</label>
                                <div class="col-sm-6">
                                <input type="text" name="job_title" id="job_title" readonly placeholder="Job title" value="<?php  echo $employee_name[0]['designation']; ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="dailybreak" class="col-sm-4 col-form-label">Date Range<i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input id="reportrange" type="text" readonly name="date_range" <?php if($time_sheet_data[0]['uneditable']==1){ echo 'readonly';}  ?> value="<?= $time_sheet_data[0]['month']; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="dailybreak" class="col-sm-4 col-form-label">Payroll Frequency <i class="text-danger"></i></label>
                                <div class="col-sm-6">
                                      <input type="text" readonly name="payroll_freq" class="form-control" id="payroll_freq"  value="<?= $time_sheet_data[0]['payroll_freq'] ; ?>" placeholder="Payroll Type">
                                    <input id="payroll_type" name="payroll_type" type="hidden" value="<?= $time_sheet_data[0]['payroll_type'] ; ?>" readonly class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive work_table col-md-12">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="PurList"> 
                                <thead class="btnclr">
                                    <tr> 
                                        <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                                            <th style='height:25px;' class="col-md-2">Date</th>
                                            <th style='height:25px;' class="col-md-1">Day</th>
                                            <th class="col-md-1">Daily Break in mins</th>
                                            <th style='height:25px;' class="col-md-2">Start Time (HH:MM)</th>
                                            <th style='height:25px;' class="col-md-2">End Time (HH:MM)</th>
                                            <th style='height:25px;' class="col-md-5">Hours</th>
                                            <th style='height:25px;' class="col-md-2">Over Time</th>
                                            <th style='height:25px;' class="col-md-5">Action</th>
                                        <?php } elseif ($employee_name[0]['payroll_type'] == 'Fixed') { ?>
                                            <th style='height:25px;' class="col-md-2">Date</th>
                                            <th style='height:25px;' class="col-md-1">Day</th>
                                            <th style='height:25px; ' class="col-md-5">Present / Absence</th>
                                        <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                                        
                                        <?php } ?>
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
                                $split_date = explode(' - ', $time_sheet_data[0]['month']);
                                $start_date = date('Y-m-d', strtotime($split_date[0]));
                                $end_date = date('Y-m-d', strtotime($split_date[1]));
                                $btw_days = date_diff(date_create($start_date),date_create($end_date));
                                $get_days = (int)($btw_days->format('%a') + 1);
                                $end_week = $setting_detail[0]['end_week'];
                                
                                if($employee_name[0]['payroll_type'] == 'Hourly') { ?>

                                <tbody id="tBody">
                                <?php
                                    usort($time_sheet_data, 'compareDates');
                                    $printedDates = array();
                                    foreach($time_sheet_data as $tsheet) {
                                        $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit'=> $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break'], 'over_time' => $tsheet['over_time']];
                                        if( !empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates)) {
                                         
                                            $printedDates[] = $tsheet['Date'];
                                        }
                                    }
                                    $data_id=0;
                                    $weekly_data = json_decode($time_sheet_data[0]['weekly_hours']);$j=0;
                                    for($i = 0; $i < $get_days; $i++) {
                                        $date = date('m/d/Y', strtotime($start_date .' +'.$i.' day'));
                                        
                                ?>
                                
                                <tr>
                                    <td class="date"> <input type="text" readonly value="<?= $date; ?>" name="date[]"> </td>
                                    
                                    <td class="day">
                                        <input type="text" readonly value="<?= (!empty($timesheetdata[$date]['day'])) ? $timesheetdata[$date]['day'] : date('l', strtotime($date)); ?>" name="day[]">
                                    </td>
                                    <td style="text-align:center;" class="daily-break">
                                        <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                                            <?php foreach ($dailybreak as $dbd) { ?>
                                                <option value="<?= $dbd['dailybreak_name']; ?>" <?= ($timesheetdata[$date]['break'] == $dbd['dailybreak_name']) ? 'selected' : ''; ?> >
                                                    <?= $dbd['dailybreak_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td class="start-time">
                                        <input <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> name="start[]" data-id='<?php echo $data_id;  ?>' class="hasTimepicker start" value="<?= empty($timesheetdata[$date]['start']) ? 'readonly' : $timesheetdata[$date]['start']; ?>" type="time">
                                    </td>
                                    <td class="finish-time">
                                        <input <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'readonly'; } ?> name="end[]" data-id='<?php echo $data_id;  ?>' class="hasTimepicker end" value="<?= empty($timesheetdata[$date]['end']) ? 'readonly' : $timesheetdata[$date]['end']; ?>" type="time">
                                    </td>
                                  
                                    <td class="hours-worked">
                                        <input readonly name="sum[]" class="timeSum hourly_tot_<?php echo $data_id;  ?>" value="<?= empty($timesheetdata[$date]['per_hour']) ? '0:00' : $timesheetdata[$date]['per_hour']; ?>" type="text">
                                    </td>
                                    <td class="overtime">
                                        <input readonly name="over_time[]" class="overTime_<?php echo $data_id;  ?>" id="overTime_<?php echo $i; ?>" value="<?= empty($timesheetdata[$date]['over_time']) ? '0:00' : $timesheetdata[$date]['over_time']; ?>" type="text">
                                    </td>
                                    <td>
                                        <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2 <?php if ($timesheetdata[$date]['edit'] == 1) { echo 'disabled'; } ?> "><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    </td>
                                    <?php if($end_week == $timesheetdata[$date]['day']) {
                                        echo '<tr>
                                            <td colspan="5" class="text-right" style="font-weight:bold;">Weekly Total Hours:</td>
                                            <td> <input type="text" class="weekly_hour" name="hour_weekly_total[]" id="hourly_'.$data_id.'" value="'.$weekly_data[$j].'"> </td>
                                        </tr>';
                                         $j++;
                                        $data_id++;
                                    } ?>
                                </tr>                                
                                <?php } ?>
                            </tbody>

                        <?php } elseif ($employee_name[0]['payroll_type'] == 'Fixed') { ?>

                            <tbody id="tBody">
                            <?php
                                $i = 0;
                                usort($time_sheet_data, 'compareDates');
                                $printedDates = array();
                                foreach($time_sheet_data as $tsheet) {
                                    $timesheetdata[$tsheet['Date']] = ['date' => $tsheet['Date'], 'day' => $tsheet['Day'], 'edit'=> $tsheet['uneditable'], 'start' => $tsheet['time_start'], 'end' => $tsheet['time_end'], 'per_hour' => $tsheet['hours_per_day'], 'check' => $tsheet['present'], 'break' => $tsheet['daily_break']];
                                    if( empty($tsheet['hours_per_day']) && !in_array($tsheet['Date'], $printedDates)) {
                                        $printedDates[] = $tsheet['Date'];
                                    }
                                }

                                $time_tot = 0;
                                for($j = 0; $j < $get_days; $j++) {
                                    $date = date('m/d/Y', strtotime($start_date .' +'.$j.' day'));
                                    $stru_time = (empty($timesheetdata[$date]['per_hour'])) ? '00:00' : str_replace(['.'], ':', $timesheetdata[$date]['per_hour']);
                                    $split_time = explode(':', $stru_time);
                                    $time_tot  += ((float)$split_time[0] * 3600);
                                    $time_tot += ((float)$split_time[1] * 60);

                            ?>
                            <tr>
                                <td class="date">
                                    <input type="text" name="date[]" value="<?= $date; ?>" readonly />
                                </td>
                                <td class="day">
                                    <input type="text" name="day[]" readonly value="<?= $timesheetdata[$date]['day']; ?>">
                                </td>
                                <?php if($employee_name[0]['payroll_type'] == 'Fixed') { ?>
                                <td class="hours-worked">
                                    <label class="switch" style="width:100px;">
                                        <input type="checkbox" class="timeSum present checkbox switch-input" id="blockcheck_<?= $i; ?>" name="present[]"
                                            <?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'present') ? 'checked="checked"' : ''; ?>
                                            data-present="<?= $timesheetdata[$date]['check'] ?? ''; ?>">
                                        <span class="switch-label" data-on="Present" data-off="Absent"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <input type="hidden" name="block[]" id="block_<?= $i; ?>" value="<?= (isset($timesheetdata[$date]['check']) && $timesheetdata[$date]['check'] === 'absent') ? 'absent' : 'present'; ?>" />
                                </td>
                                <?php } ?>
                            </tr>
                            <?php
                            
                            $i++;
                        } ?>
                </tbody>
                <?php } ?>

                <tfoot>
                <tr style="text-align:end"> 
                    <?php if ($employee_name[0]['payroll_type'] == 'Hourly') { ?>
                    <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours :</td> 
                    <td style="text-align: center;"> <input  type="text" readonly id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />    </td> 

                    <?php } elseif ($employee_name[0]['payroll_type'] == 'Fixed') { ?>
                    <td colspan="2" class="text-right" style="font-weight:bold;">No of Days:</td> 
                    <td style="text-align: center;"> <input  type="text" readonly id="total_net" value="<?= $time_sheet_data[0]['total_hours'] ; ?>" name="total_net" />    </td> 

                    <?php } elseif ($employee_name[0]['payroll_type'] == 'SalesCommission') { ?>
                    <?php } ?>
                </tr> 

            </tfoot>
        </table>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-4"><br/>
            <?php if($time_sheet_data[0]['uneditable']==1){ 
                echo '<b>Note : </b>'.'This Timesheet is locked'; 
            }  ?>
            <input type="submit" style="<?php if($time_sheet_data[0]['uneditable']==1){ echo 'display:none;';}  ?>color:white;" value="Submit" class="sub_btn btnclr btn btn-info"/> 
        </div>               
    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
</section>


</div>

<script>
var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';
  
$('#insert_adm').submit(function (event) {
    event.preventDefault();

    var dataString = {
        dataString : $("#insert_adm").serialize()
    };
    dataString[csrfName] = csrfHash;
    $.ajax({
        type:"POST",
        dataType:"json",
        url:"<?= base_url(); ?>Chrm/insert_data_adsr",
        data:$("#insert_adm").serialize(),
        success:function (data1) {  
            var $select = $('select#insert_adm');
                $select.empty();

            for(var i = 0; i < data1.length; i++) {
                var option = $('<option/>').attr('value', data1[i].adms_name).text(data1[i].adms_name);
                $select.append(option); 
            }
        }
    });
});

var data = {
    value:$('#customer_name').val()
};


var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';

$('body').on('change','#reportrange',function(){
var date = $(this).val();
$('#tBody').empty();
const myArray = date.split("-");
var start = myArray[0];
var s_split=start.split("/");
var end = myArray[1];
var e_split=end.split("/");
const weekDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
let chosenDate = start; 
var Date1 = new Date (s_split[2], s_split[0], s_split[1]);
var Date2 = new Date (e_split[2], e_split[0], e_split[1]);
var Days = Math.round((Date2.getTime() - Date1.getTime())/(1000*60*60*24));
console.log(s_split[2]+"/"+ s_split[1]+"/"+ s_split[0]+"/"+Days);
const validDate = new Date(chosenDate);
let newDate;
const monStartWeekDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

for(let i = 0; i <= Days; i++) {
    newDate = new Date(validDate); 
    newDate.setDate(validDate.getDate() + i); 
    var date=$('#date_'+i).html();
    var day=$('#day_'+i).html();
    $('#tBody').append(
        `<tr>
            <td  class="date" id="date_`+i+`"><input type="hidden" value="`+`${newDate.getDate()}/${newDate.getMonth() + 1}/${newDate.getFullYear()}" name="date[]"   />`+`${newDate.getDate()} / ${newDate.getMonth() + 1} / ${newDate.getFullYear()}</td>
            <td  class="day" id="day_`+i+`"><input type="hidden" value="`+`${weekDays[newDate.getDay()].slice(0,10)}" name="day[]"   />`+`${weekDays[newDate.getDay()].slice(0,10)}</td>
        <?php if ($time_sheet_data[0]['payroll_type'] == 'Hourly') { ?>
            <td style="text-align:center;" class="daily-break_<?= $i; ?>">
                <select name="dailybreak[]" class="form-control datepicker dailybreak" style="width: 100px; margin: auto; display: block;">
                    <?php foreach ($dailybreak as $dbd) { ?>
                        <option value="<?= $dbd['dailybreak_name']; ?>"><?= $dbd['dailybreak_name']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td class="start-time_<?= $i; ?>"><input id="startTime<?= $monStartWeekDays[$i]; ?>" name="start[]" class="hasTimepicker start" type="time" /></td>
            <td class="finish-time_<?= $i; ?>"><input id="finishTime<?= $monStartWeekDays[$i]; ?>" name="end[]" class="hasTimepicker end" type="time" /></td>
            <td class="hours-worked_<?= $i; ?>"><input id="hoursWorked<?= $monStartWeekDays[$i]; ?>" name="sum[]" class="timeSum" readonly type="text" /></td>
            <td class="overtime__<?= $i; ?>"><input id="overTime_<?= $monStartWeekDays[$i]; ?>" name="over_time[]" readonly type="text" /></td>
        <?php } elseif ($time_sheet_data[0]['payroll_type'] == 'Fixed') { ?>
            <td style="display:none;" class="start-time_<?= $i; ?>"><input id="startTime<?= $monStartWeekDays[$i]; ?>" name="start[]" class="hasTimepicker start" type="time" /></td>
            <td style="display:none;" class="finish-time_<?= $i; ?>"><input id="finishTime<?= $monStartWeekDays[$i]; ?>" name="end[]" class="hasTimepicker end" type="time" /></td>
            <td class="hours-worked_<?= $i; ?>">
                <input id="hoursWorked<?= $monStartWeekDays[$i]; ?>" name="present[]" class="timeSum present" readonly type="checkbox" style="width: 20px; height: 20px" />
            </td>
        <?php } ?>
            <td>
                <a style="color:white;" class="delete_day btnclr btn m-b-5 m-r-2"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
            </td>
        </tr>`);
    }
});

function converToMinutes(s) {
    var c = s.split(':');
    return parseInt(c[0]) * 60 + parseInt(c[1]);
}
function parseTime(s) {
    return Math.floor(parseInt(s) / 60) + ":" + parseInt(s) % 60
}
function convertToTime(hr,min)
{
    let hours = Math.floor(min / 60);
    let minutes = min % 60;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return `${hours+hr}:${minutes}`;
}

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
                var [weekhour, weekmin] = total_week.split(':').map(parseFloat);
                weekHours += weekhour;
                weekMinutes += weekmin;
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

    var dataId = row.find('input[name="over_time[]"]').attr('id');
    if (dataId) {
        $('#' + dataId).val(overtimeMinutes > 0 ? overtimeFormatted : '00:00');
    }

    var timeConvertion = convertToTime(week_netH, week_netM);
    $('#hourly_' + data_id).val(timeConvertion).trigger('change');
    var totalTimeConvertion = convertToTime(total_netH, total_netM);
    $('#total_net').val(totalTimeConvertion).trigger('change');
}


$(document).on('input','.timeSum', function () {
    var $addtotal = $(this).closest('tr').find('.timeSum').val();
});

$('body').on('keyup','.end',function(){

    var start=$(this).closest('tr').find('.strt').val();
    var end=$(this).closest('td').find('.end').val();
    var breakv=$('#dailybreak').val();
    var calculate=parseInt(start)+parseInt(end);
    var final =calculate-parseInt(breakv);
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
$(document).on('select change'  ,'#templ_name', function () {
    var data = {      
        value:$('#templ_name').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data, 
        dataType:"json",
        url:'<?= base_url();?>Chrm/getemployee_data',
        success: function(result, statut) {
            $('#job_title').val(result[0]['designation']);
            $('#payroll_type').val(result[0]['payroll_type']);
        }
    });
});


function sumHours () 
{

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

$(document).on('click','.delete_day',function(e){

    e.preventDefault();
    const isConfirmed = confirm("Are you sure you want to delete this?");
    if (!isConfirmed) {
        return;
    }
    
    $(this).closest('tr').remove();
    var total_net=0;
    var weeklyNet=0;
    var data_id = $(this).closest('tr').children('.start-time').find('.start').data('id');

    $('.table').each(function() {
        $(this).find('.timeSum').each(function() {
            var precio = $(this).val();
            if (precio && typeof precio === 'string' && precio.includes(':')) {
                total_net += parseFloat(precio);
            }
        });
        
        $(this).find('.hourly_tot_'+data_id).each(function() {
            var weeklydata = $(this).val();
            if (weeklydata && typeof weeklydata === 'string' && weeklydata.includes(':')) {
                weeklyNet += parseFloat(weeklydata);
            }
        });
    });

    $('#total_net').val(total_net.toFixed(2));
    $('#hourly_'+data_id).val(weeklyNet.toFixed(2));

    var weekHours = $('.weekly_hour').val();
    if(weekHours != "0:00" && weekHours != "0.00" && weekHours != "" && weekHours != undefined) {
        $('.sub_btn').removeAttr('disabled');
    } else {
        $('.sub_btn').attr('disabled', 'disabled');
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



$(document).ready(function() {
    function updateCounter() {
        var sumOfDays = 0;
        sumOfDays = $('input[type="checkbox"].present:checked').length;
        $('#total_net').val(sumOfDays);
    }
    $(document).on('change', 'input[type="checkbox"].present', function() {
        console.log('active');
        updateCounter();
    });
    var t=$('#payroll_type').val();
    if(t !=='Hourly'){
        updateCounter();
    }
});

$('.sub_btn').on('mouseenter', function() {
    if ($(this).is(':disabled')) {
        showToast();
    }
});
$('.sub_btn').on('mouseleave', function() {
    hideToast();
});

function showToast() {
    toastr.warning("Please ensure all required fields are completed: Employee Name and Date Range.", {
        closeButton: false,
        timeOut: 1000
    });
}
function hideToast() {
    toastr.clear();
}

</script>