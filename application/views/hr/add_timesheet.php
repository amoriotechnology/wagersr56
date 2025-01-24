
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/toastr.min.css')?>" />

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"> <i class="pe-7s-note2"></i> </div>
        <div class="header-title">
            <h1>Timesheet</h1>
            <small><?= $title ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
                <li><a href="#">HRM</a></li>
                <li class="active" style="color:orange">Timesheet</li>
            </ol>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">                
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading" style="height: 50px;">
                        <div class="panel-title">
                            <a style="float:right;color:white;" href="<?= base_url('Chrm/manage_timesheet?id=' . $_GET['id'] . '&admin_id=' . $_GET['admin_id']); ?>" class="btnclr btn m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?= "Manage TimeSheet" ?> </a>
                        </div>
                    </div>
                <?= form_open_multipart('Chrm/pay_slip?id=' . $_GET['id'], 'id="validate"'); ?>
                  <?php  $id = random_int(100000, 999999); ?>
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="customer" class="col-sm-4 col-form-label">Employee Name<i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="tsheet_id" value="<?= $id ; ?>" name="tsheet_id" />
                                    <input  type="hidden" readonly id="unique_id" value="<?= $this->session->userdata('unique_id') ?>" name="unique_id" />

                                    <input type ="hidden"  id="admin_company_id" value="<?= $_GET['id'];  ?>" name="admin_company_id" />
                                    <input type ="hidden" id="adminId" value="<?= $_GET['admin_id'];  ?>" name="adminId" />
                                    <select name="templ_name" id="templ_name" class="form-control"  required  tabindex="3" style="width:100;">
                                        <option value=""> <?= ('Select Employee Name') ?></option>
                                    <?php foreach($employee_name as $emp_name) { ?>
                                        <option value="<?php  echo $emp_name['id'] ;?>"> <?= isset($emp_name['first_name']) ? $emp_name['first_name'] . " " : ""; echo isset($emp_name['middle_name']) ? $emp_name['middle_name'] . " " : ""; echo isset($emp_name['last_name']) ? $emp_name['last_name'] : ""; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <label for="qdate" class="col-sm-4 col-form-label">Job title</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="job_title" id="job_title" placeholder="Job title" value="" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="dailybreak" class="col-sm-4 col-form-label">Date Range<i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input id="reportrange" name="date_range" type="text" class="form-control"/>
                                    <div id='check_date' style='font-weight:bold;color:red;'></div>
                                </div>
                            </div>
                            
                             <div class="col-sm-6">
                                <label for="dailybreak" class="col-sm-4 col-form-label">Payroll Frequency <i class="text-danger"></i></label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="payroll_freq" class="form-control" id="payroll_freq"  placeholder="Payroll Type">

                                    <input type="hidden" name="payroll_type" class="form-control" id="payroll_type">
                                </div>
                             </div>
                        </div>

                        <div class="table-responsive work_table col-md-12">
                            <table class=" table table-striped table-bordered" cellspacing="0" width="100%" id="PurList"> 
                                <thead class="btnclr" id='tHead'>
                                </thead>
                                <tbody id="tBody" class="HideTable">
                                </tbody>
                                <tfoot id="tFoot">
                                </tfoot>
                            </table>
                        </div>

                        <input type="submit" value="Submit" class="sub_btn btnclr btn text-center"/> 
                        <input type="hidden" id="csrf" data-name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                        <input type="hidden" id="week_setting" data-start="<?= (!empty($setting_detail[0]['start_week'])) ? $setting_detail[0]['start_week'] : 'Monday'; ?>" data-end="<?= (!empty($setting_detail[0]['end_week']) ? $setting_detail[0]['end_week'] : 'Friday'); ?>" >
                    </div>               
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>

</div>
<br><br>

<?php 
   $modaldata['bootstrap_modals'] = array('daily_break');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>

<script>

$('.decimal').keydown(function (e) {
  var match = $(this).val().match(/\./g);
  if(match!=null){
     if ($.inArray(e.keyCode, [46,8, 9, 27, 13, 110]) !== -1 ||
         (e.keyCode == 65 && e.ctrlKey === true) ||
         (e.keyCode >= 35 && e.keyCode <= 39)) {
       return;
    }   
    else if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105 )&&(e.keyCode==190)) {
      e.preventDefault();
    }
  } else {
     if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         (e.keyCode == 65 && e.ctrlKey === true) ||
         (e.keyCode >= 35 && e.keyCode <= 39)) {
       return;
    }
     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  }
});


$('.decimal').keyup(function () {
  if ($(this).val().indexOf(':') != -1) {
    if ($(this).val().split(":")[1].length > 2) {
      if (isNaN(parseFloat(this.value))) return;
      this.value = parseFloat(this.value).toFixed(2);
    }
  }
});


$('#add_pay_terms').submit(function(e){
    e.preventDefault();
    var data = {
        new_payment_terms : $('#new_payment_terms').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data,
        dataType:"json",
        url:'<?= base_url();?>Cpurchase/add_payment_terms',
        success: function(data1, statut) {
            var $select = $('select#terms');
            $select.empty();
            
            for(var i = 0; i < data1.length; i++) {
                var option = $('<option/>').attr('value', data1[i].payment_terms).text(data1[i].payment_terms);
                $select.append(option); 
            }
            $('#new_payment_terms').val('');
            $("#bodyModal1").html("Payment Terms Added Successfully");
            $('#payment_type').modal('hide');
            $('#terms').show();
            $('#myModal1').modal('show');
            window.setTimeout(function(){
            $('#payment_type_new').modal('hide');
            $('#myModal1').modal('hide');
            $('.modal-backdrop').remove();
        }, 2500);
        }
    });
  });


$('body').on('keyup','.end',function(){
    var start = $(this).closest('tr').find('.strt').val();
    var end = $(this).closest('td').find('.end').val();
    var breakv = $('#dailybreak').val();
    var calculate = parseInt(start)+parseInt(end);
    var final = calculate-parseInt(breakv);
    $(this).closest('tr').find('.hours-worked').html(final);
});


var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';

$(document).on('select change', '#templ_name', function () {
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
            if (result.length > 0) { 
            if (result[0]['designation'] !== '') {
                $('#job_title').val(result[0]['designation']);
                $('#payroll_type').val(result[0]['payroll_type']);
                $('#payroll_freq').val(result[0]['payroll_freq']);
            } else {
                $('#job_title').val("Sales Partner");
                $('#payroll_type').val("Sales Partner");
            }
            } else { 
                $('#job_title').val("Sales Partner");
                $('#payroll_type').val("Sales Partner");
            }
        }
    });
});


$('#add_duration').submit(function(e){
    e.preventDefault();
    var data = {
        duration_name : $('#duration_name').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data,
        dataType:"json",
        url:'<?= base_url();?>Chrm/add_durat_info',
        success: function(data1, statut) {
            var $select = $('select#duration');
            $select.empty();

            for(var i = 0; i < data1.length; i++) {
                var option = $('<option/>').attr('value', data1[i].duration_name).text(data1[i].duration_name);
                $select.append(option); 
            }
            $('#duration_name').val('');
            $("#bodyModal1").html("Duration Added Successfully");
            $('#duration_add').modal('hide');
            $('#duration').show();
            $('#myModal1').modal('show');
            window.setTimeout(function(){
                $('#payment_type_new').modal('hide');
                $('#myModal1').modal('hide');
                $('.modal-backdrop').remove();
            }, 2500);
        }
    });
});


var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';

$(document).on('select change', '#templ_name', function () {
    $('#check_date').text('');
    $('.btnclr').show();
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
            if (result.length > 0) { 
                if (result[0]['designation'] !== '') {
                    $('#job_title').val(result[0]['designation']);
                    $('#payroll_type').val(result[0]['payroll_type']);
                    $('#payroll_freq').val(result[0]['payroll_freq']);

                    if(result[0]['payroll_freq'] != "") {
                        getDatePicker(result[0]['payroll_freq']);
                    } else {
                        $('#tHead, #tBody, #tFoot').empty();
                    }

                } else {
                    $('#job_title').val("Sales Partner");
                    $('#payroll_type').val("Sales Partner");
                }
            }
        }
    });
});
    
<?php
if(isset($_POST['btnSearch'])){
    $s = $_REQUEST["daterangepicker-field"];
}
    $prev_month = date('Y-m-d', strtotime('first day of january this year'));
    $current=date('Y-m-d');
    $dat2= $prev_month."to". $current;
    $searchdate =(!empty($s)?$s:$dat2);
    $dat = str_replace(' ', '', $searchdate);
    $split=explode("to",$dat);
?>

function formatDate(date) {
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var year = date.getFullYear();

    if (month < 10) month = '0' + month;
    if (day < 10) day = '0' + day;

    return month + '/' + day + '/' + year;
}

var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';

function diffDays(startday, endday, type) {
    if(type == "Bi-Weekly") {
        var res = 14;
    } else {
        var res = 7;
    }
    
    if(startday > endday) {
        if(endday == 0) {
            if(type == "Bi-Weekly") {
                res = (14 - startday);
            } else {
                res = (7 - startday);
            }
        } else {
            res = (endday + parseInt(startday - endday));
        }
    } else if(endday > startday) {
        res = parseInt(endday - startday);
    }
    return res;
}

var weeks = {'Sunday' : 0, 'Monday' : 1, 'Tuesday': 2, 'Wednesday' : 3, 'Thusday' : 4, 'Friday' : 5, 'Saturday' : 6};

function getDatePicker(payroll_freq) {

    var start = moment().startOf('isoWeek'); 
    var end = moment().endOf('isoWeek'); 
    var startOfLastWeek = moment().subtract(1, 'week').startOf('week');
    var endOfLastWeek = moment().subtract(1, 'week').endOf('week').add(1, 'day'); 

    var start_week = $('#week_setting').data('start');
    var end_week = $('#week_setting').data('end');

    var btwDays = diffDays(weeks[start_week], weeks[end_week], payroll_freq);
    var sDate = moment().weekday(weeks[start_week]).startOf();
    
    if(payroll_freq == "Weekly") {
        var eDate = moment(sDate).add(btwDays, 'days');

    } else if(payroll_freq == "Bi-Weekly") {
        var eDate = moment(sDate).add(btwDays, 'days');

    } else {
        var sDate = moment().startOf('month');
        var eDate = moment().endOf('month');
    }
    
    $('#reportrange').val(sDate.format('DD/MM/YYYY') + ' - ' + eDate.format('DD/MM/YYYY'));
    
    var ThisWeekStart = moment().weekday(weeks[start_week]).startOf()._d;
    var LastWeekStart = moment().subtract(1,  'week').startOf().weekday(weeks[start_week])._d;
    var BeforeLastWeekStart = moment().subtract(2,  'week').startOf().weekday(weeks[start_week])._d;
    var BeforeLastLastWeekStart = moment().subtract(4,  'week').startOf().weekday(weeks[start_week])._d;
    var date_range = {};
    if(payroll_freq == "Weekly") {
        date_range = {
            maxDate: 0,
            startDate: sDate,
            endDate: eDate,
            ThisWeek: ThisWeekStart,
            LastWeek: LastWeekStart,
            beforeWeek:BeforeLastWeekStart,
            ranges: {
                'Last Week Before': [BeforeLastWeekStart , moment(BeforeLastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], payroll_freq), 'days')],
                'Last Week': [LastWeekStart , moment(LastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], payroll_freq), 'days')],
                'This Week': [ThisWeekStart, moment(ThisWeekStart).add(diffDays(weeks[start_week], weeks[end_week], payroll_freq), 'days')],
            },
            locale: {
                firstDay: 1
            },
            isInvalidDate: function(date) {
                return date.day() !== weeks[start_week];
            }
        }
    }

    if(payroll_freq == "Bi-Weekly") {
        date_range = {
            startDate: sDate,
            endDate: eDate,
            ThisWeek: ThisWeekStart,
            LastWeek: BeforeLastWeekStart,
            beforeWeek:BeforeLastLastWeekStart,
            ranges: {
                'Last Bi Week Before': [BeforeLastLastWeekStart , moment(BeforeLastLastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], payroll_freq), 'days')],
                'Last Bi Week': [BeforeLastWeekStart , moment(BeforeLastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], payroll_freq), 'days')],
                'This Bi Week': [ThisWeekStart, moment(ThisWeekStart).add(diffDays(weeks[start_week], weeks[end_week], payroll_freq), 'days')],
            },
            locale: {
                firstDay: 1
            },
            isInvalidDate: function(date) {
                return date.day() !== weeks[start_week];
            }
        }
    }

   if(payroll_freq == "Monthly") {
        date_range = {
            startDate: sDate,
            endDate: eDate,
            ranges: {
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            isInvalidDate: function(date) {
                return date.date() !== 1;
            }
        }
    }
    
    $('#reportrange').daterangepicker(date_range);
    Timesheetcheck();

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {

        var startDate = $('#week_setting').data('start');
        var endDate = $('#week_setting').data('end');
        var payroll_freq = $('#payroll_freq').val();
        var btwDays = diffDays(weeks[startDate], weeks[endDate], payroll_freq);
        var sDate = moment(picker.startDate._d);

        if(payroll_freq == "Weekly") {
            var eDate = moment(sDate).add(btwDays, 'days');

        } else if(payroll_freq == "Bi-Weekly") {
            var eDate = moment(sDate).add(btwDays, 'days');
        
        } else {
            var sDate = moment(picker.startDate._d).startOf('month');
            var eDate = moment(sDate).endOf('month');
        }

        $('#reportrange').val(sDate.format('MM/DD/YYYY') + ' - ' + eDate.format('MM/DD/YYYY'));
        Timesheetcheck();
    });

}


function Timesheetcheck() {
    var data= {
        selectedDate: $('#reportrange').val(),
        employeeId: $('#templ_name').val() 
    };
    data[csrfName] = csrfHash;
    $.ajax({
        url:'<?= base_url();?>Chrm/checkTimesheet',
        method: 'POST',
        dateType: 'json',
        data:data,
        success: function(response) {
            console.log(response);
            if(response.includes('Timesheet exists for this date and employee')){
                $('.sub_btn').attr('disabled', 'disabled');
                $('#check_date').text(response);
                $('.HideTable').hide();
            }else{
                $('#check_date').text('');
                $('.HideTable').show();
            }
        },
        error: function(xhr, status, error) {}
    });

}
$('.sub_btn').on('mouseenter', function() {
    if ($(this).is(':disabled')) {
        showToast();
    }
});
$('.sub_btn').on('mouseleave', function() {
    hideToast();
});

// while active select & change daterangepicker and creating hourly / Fixed table
$('body').on('input select change', '#reportrange',function() {

    var selectdate = $(this).val();
    var start = selectdate.split(" - ");
    var startDate = $('#week_setting').data('start');
    var endDate = $('#week_setting').data('end');
    var pay_freq = $('#payroll_freq').val();
    var btwDays = diffDays(weeks[startDate], weeks[endDate], pay_freq);
    var start_date = new Date(start[0]);
    var sDate = formatDate(start_date);

    if(pay_freq == "Weekly") {
        var eDate = new Date(start_date.setDate(start_date.getDate() + btwDays));
        var date = (sDate + ' - ' + formatDate(eDate));

    } else if(pay_freq == "Bi-Weekly") {
        var eDate = new Date(start_date.setDate(start_date.getDate() + btwDays));
        var date = (sDate + ' - ' + formatDate(eDate));
    
    } else {
        var eDate = new Date(start_date.getFullYear(), start_date.getMonth() + 1, 0);
        var date = (sDate + ' - ' + formatDate(eDate));
    }
    
    $('#reportrange').val(date);
    $('#tHead, #tBody, #tFoot').empty();
    $('.btnclr').show();
    $('#check_date').html('');

    const myArray = date.split(" - ");
    var start = myArray[0];
    var s_split=start.split("/");
    var end = myArray[1];
    var e_split=end.split("/");
    const weekDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    let chosenDate = start;  
    var Date1 = new Date (s_split[2]+'/'+s_split[0]+'/'+s_split[1]);
    var Date2 = new Date (e_split[2]+'/'+e_split[0]+'/'+e_split[1]);
    var Days = Math.round((Date2.getTime() - Date1.getTime())/(1000*60*60*24));
    const validDate = new Date(chosenDate);
    let newDate;
    const monStartWeekDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    var data= {
        employeeId: $('#templ_name').val(),
        reportrange: $('#reportrange').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        url:'<?= base_url();?>Chrm/check_employee_pay_type',
        method: 'POST',
        data:data,
        success: function(response) {
            if (response.includes('SalesCommission') || response.includes('Sales Partner')) {
            var data= {
                employeeId: $('#templ_name').val(), 
                reportrange: $('#reportrange').val()
            };
            data[csrfName] = csrfHash;
            $.ajax({
                url:'<?= base_url();?>Chrm/sc_cnt',
                method: 'POST',
                data:data,
                success: function(response) {
                    var response = JSON.parse(response.trim());
                    var count = response.count;  
                    if(count == 0){
                        $('#check_date').text('No sales found for this period');
                        $('tBody').empty();
                        $('.btnclr').hide();
                    }else{
                        $('#check_date').text('');
                        $('tBody').empty();
                        $('.btnclr').show();
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
        if (
            response.includes('salary') || 
            response.includes('Weekly') || 
            response.includes('Bi-Weekly') || 
            response.includes('Monthly') || 
            response.includes('Fixed')
        ) {
                $('#tHead').append(`
                    <tr style="text-align:center;">
                        <th class="col-md-2">Date</th>
                        <th class="col-md-2">Day</th>
                        <th class="col-md-2">Present / Absence</th>
                    </tr>`);
                $('#tFoot').append(`
                    <tr style="text-align:end">
                        <td colspan="2" class="text-right" style="font-weight:bold;">No of Days:</td> 
                        <td><input type="text" id="total_net" class="sumOfDays" name="total_net" readonly /></td>
                    </tr>`);
            }
            else if (response.includes('Hourly')) {
            $('#tHead').append(`
                <tr style="text-align:center;">
                    <th class="col-md-2">Date</th>
                    <th class="col-md-1">Day</th> 
                    <th class="col-md-1">Daily Break in mins
                        <a class="btnclr client-add-btn btn dailyBreak" aria-hidden="true" style="color:white;border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#dailybreak_add">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                    <th class="col-md-2">Start Time (HH:MM)</th>
                    <th class="col-md-2">End Time (HH:MM)</th>
                    <th class="col-md-2">Hours</th>
                    <th class="col-md-2">Over Time</th>
                    <th class="col-md-2">Action</th>
                </tr>`);
            $('#tFoot').append(`
                <tr style="text-align:end">
                    <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours:</td> 
                    <td><input type="text" id="total_net" class="sumOfDays" name="total_net"  readonly/></td>
                </tr>`);
        } else if (response.includes('SalesCommission')) {
            $('#tFoot').append(`
                <tr style="text-align:end; display:none;">
                    <td colspan="1" class="text-right" style="font-weight:bold;">Total Hours:</td> 
                    <td><input type="text" id="total_net"  value="0.00" name="total_net"   readonly/></td>
                </tr>`);
        }

        var end_week = "<?= (!empty($setting_detail[0]['end_week'])) ? $setting_detail[0]['end_week'] : 'Sunday'; ?>";
        var total_pres = 0;
        var data_id = 0;
        for (let i = 0; i <= Days; i++) { 
            let newDate = new Date(validDate.getTime()); 
            newDate.setDate(validDate.getDate() + i); 
            let dayString = weekDays[newDate.getDay()].slice(0, 10);
            let day = ("0" + newDate.getDate()).slice(-2); 
            let month = ("0" + (newDate.getMonth() + 1)).slice(-2); 
            let dateString = `${month}/${day}/${newDate.getFullYear()}`;
            
            if (
                response.includes('salary') || 
                response.includes('Weekly') || 
                response.includes('Bi-Weekly') || 
                response.includes('Monthly') || 
                response.includes('Fixed')
            ){
                var presentCount = $('input[type="checkbox"].present:checked').length + 1;
                $('#total_net').val(presentCount);
                if(presentCount > 0) {
                    $('.sub_btn').removeAttr('disabled');
                } else {
                    $('.sub_btn').attr('disabled', 'disabled');
                }
                
                total_pres++;
                $('#tBody').append(`
                    <tr>
                        <td class="date" id="date_${i}">
                            <input type="hidden" value="${dateString}" name="date[]"/>${dateString}
                        </td>
                        <td class="day" id="day_${i}">
                            <input type="hidden" value="${dayString}" name="day[]"/>${dayString}
                        </td>
                        <td style="display:none;" class="start-time_`+i+`">
                            <input id="startTime${monStartWeekDays[i]}" name="start[]" class="hasTimepicker start" type="time" />
                        </td>
                        <td style="display:none;"  class="finish-time_`+i+`">
                            <input id="finishTime${monStartWeekDays[i]}" name="end[]" class="hasTimepicker end type="time" />
                        </td> 
                        <td class="hours-worked_`+i+`"> 
                            <label class="switch" style="width:100px;">
                                <input type="checkbox" class="present checkbox switch-input weekly_`+data_id+`" data-id="`+data_id+`" value="" id="blockcheck_`+i+`" name="present[]" checked>
                                <span class="switch-label" data-on="Present" data-off="Absent"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <input type="hidden" name="block[]" id="block_`+i+`" />              
                        </td>
                    </tr>`);
                    
            } else if (response.includes('Hourly')) {
                $('#tBody').append(`
                    <tr> 
                        <td  class="date" id="date_`+i+`">
                            <input type="hidden" value="${dateString}" name="date[]"   />`+`${dateString}
                        </td>
                        <td  class="day" id="day_`+i+`">
                            <input type="hidden" value="`+`${weekDays[newDate.getDay()].slice(0,10)}" name="day[]"   />`+`${weekDays[newDate.getDay()].slice(0,10)}
                        </td>
                        <td style="text-align:center;" class="daily-break_${i}">
                            <select name="dailybreak[]" id="dailybreak" class="form-control datepicker dailybreak" style="width: 100px;margin: auto; display: block;">
                                <?php foreach ($dailybreak as $dbd) { ?>
                                <option value="<?= $dbd['dailybreak_name']; ?>"><?= $dbd['dailybreak_name']; ?></option>
                                <?php } ?>  
                            </select>  
                        </td>
                        <td class="start-time_`+i+`">
                            <input id="startTime${monStartWeekDays[i]}" name="start[]"  class="hasTimepicker start" data-id="`+data_id+`" type="time" />
                        </td>
                        <td class="finish-time_`+i+`">
                            <input id="finishTime${monStartWeekDays[i]}" name="end[]" class="hasTimepicker end" data-id="`+data_id+`" type="time" />
                        </td>
                        <td class="hours-worked_`+i+`"> 
                            <input id="hoursWorked${monStartWeekDays[i]}"  name="sum[]" class="timeSum hourly_tot_`+data_id+`" readonly type="text" />
                        </td>
                        <td class="overtime_`+i+`">
                            <input type="text" id="overTime_`+i+`" name="over_time[]" readonly/>
                        </td>
                        <td>
                            <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                        </td>
                    </tr>`);
                    if(end_week == dayString) {
                        $('#tBody').append(`<tr> 
                            <td colspan="5" class="text-right" style="font-weight:bold;"> Weekly Total Hours:</td> 
                            <td class="hour_week_total">
                                <input type="text" name="hour_weekly_total[]" class= "weekly_hour" id="hourly_`+data_id+`" value="" />
                            </td>
                        </tr>`);
                        data_id++;
                    }
            } else if (response.includes('SalesCommission')) {
                $('#tBody').append(`
                <tr> 
                    <td style="display:none;" class="date" id="date_`+i+`">
                        <input type="hidden" value="`+`${newDate.getDate()}/${newDate.getMonth() + 1}/${newDate.getFullYear()}" name="date[]" />`+`${newDate.getDate()} / ${newDate.getMonth() + 1} / ${newDate.getFullYear()}
                    </td>
                    <td style="display:none;" class="day" id="day_`+i+`">
                        <input type="hidden" value="`+`${weekDays[newDate.getDay()].slice(0,10)}" name="day[]"   />`+`${weekDays[newDate.getDay()].slice(0,10)}
                    </td>
                    <td style="display:none;" class="start-time_`+i+`">
                        <input id="startTime${monStartWeekDays[i]}"  name="start[]"  class="hasTimepicker start" type="time" />
                    </td>
                    <td style="display:none;" class="finish-time_`+i+`">
                        <input id="finishTime${monStartWeekDays[i]}" name="end[]" class="hasTimepicker end" type="time" />
                    </td>
                    <td style="display:none;" class="hours-worked_`+i+`">
                        <input id="hoursWorked${monStartWeekDays[i]}"  name="sum[]" class="timeSum" value="0" readonly type="text" />
                    </td>
                    <td style="display:none;>
                        <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                    </td> 
                </tr>`);
            }
        }
    },
    error: function(xhr, status, error) {}
});
});


$(document).ready(function() {

    function updateCounter() {
        var sumOfDays = 0;
        var sumofWeek = 0;
        var data_id = $('input[type="checkbox"]').data('id');
        $(".weekly_"+data_id+":checkbox:checked").each(function() {

        });
        sumOfDays = $('input[type="checkbox"].present:checked').length;
        $('#total_net').val(sumOfDays);
    }
   
    $(document).on('change', 'input[type="checkbox"].present', function() {
        updateCounter();
    });

    updateCounter();
});


function converToMinutes(s) {
    var c = s.split(':');
    return parseInt(c[0]) * 60 + parseInt(c[1]);
}

function parseTime(s) {
    return Math.floor(parseInt(s) / 60) + ":" + parseInt(s) % 60
}
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


$(document).on('click', '.delete_day', function(e) {
    e.preventDefault();
    const isConfirmed = confirm("Are you sure you want to delete this?");
    if (!isConfirmed) {
        return;
    }
    $(this).closest('tr').remove();
    var total_netH = 0;
    var total_netM = 0;
    var weekly_netH = 0;
    var weekly_netM = 0;
    var data_id = $(this).closest('tr').children('td').find('.start').data('id');    

    $('.table').each(function() {
        $(this).find('.timeSum').each(function() {
            var precio = $(this).val();
            if (precio && typeof precio === 'string' && precio.includes(':')) {
                var [hours, minutes] = precio.split(':').map(parseFloat);
                total_netH += hours;
                total_netM += minutes;
            }
        });

        $(this).find('.hourly_tot_'+data_id).each(function() {
            var weeklydata = $(this).val();
            if (weeklydata && typeof weeklydata === 'string' && weeklydata.includes(':')) {
                var [weeklyhours, weeklyminutes] = weeklydata.split(':').map(parseFloat);
                weekly_netH += weeklyhours;
                weekly_netM += weeklyminutes;
            }
        });
    });

    var timeConversion = convertToTime(total_netH, total_netM);
    $('#total_net').val(timeConversion);

    var weeklytimeConvertion = convertToTime(weekly_netH, weekly_netM);
    $('#hourly_'+data_id).val(weeklytimeConvertion);

    var weekHours = $('.weekly_hour').val();
    if(weekHours != "0:00" && weekHours != "" && weekHours != undefined) {
        $('.sub_btn').removeAttr('disabled');
    } else {
        $('.sub_btn').attr('disabled', 'disabled');
    }
}); 


$(function() {
    $('.applyBtn').datepicker({
        onSelect: function(date) {
            $.ajax({
                url: 'Chrm/checkTimesheet',
                method: 'POST',
                data: {
                    selectedDate: date,
                    employeeId: $('#templ_name').val() 
                },
                success: function(response) {
                    console.log(response);
                    // HideTable
                },
                error: function(xhr, status, error) {
                }
            });
        }
    });
});


document.getElementById('validate').addEventListener('submit', function(event) {
    var checkboxes = document.querySelectorAll('.checkbox.switch-input');
    checkboxes.forEach(function(checkbox) {
        var netheight = checkbox.id;
        var id = netheight.split('_')[1];
        if (checkbox.checked) {
            $('#block_' + id).val("present");
        } else {
            $('#block_' + id).val("absent");
        }
    });
});


function convertToTime(hr,min) 
{
    let hours = Math.floor(min / 60);
    let minutes = min % 60;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return `${hours+hr}:${minutes}`;
}

$(document).ready(function() {
    $('.sub_btn').attr('disabled', 'disabled');
    $(document).on('change keyup', '.weekly_hour, #reportrange, input[type="checkbox"].present:checked', function() {
        var total_net = $('.weekly_hour').val();
        if(total_net != "0:00" && total_net != "" && total_net != undefined) {
            $('.sub_btn').removeAttr('disabled');
        } else {
            $('.sub_btn').attr('disabled', 'disabled');
        }
    });
});

$(document).on('click', '.dailyBreak', function(e) {
    e.preventDefault(); 
    $('.dBreaks').val('');
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