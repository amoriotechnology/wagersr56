

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
  if ($(this).val().indexOf('.') != -1) {
    if ($(this).val().split(".")[1].length > 2) {
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
        url:'Cpurchase/add_payment_terms',
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


var csrfName = $('#csrf').data('name');
var csrfHash = $('#csrf').val();

$(document).on('select change', '#templ_name', function () {
    var data = {
        value:$('#templ_name').val()
    };

    data[csrfName] = csrfHash;

    $.ajax({
        type:'POST',
        data: data, 
        dataType:"json",
        url: "getemployee_data",
        success: function(result, statut) {
            if (result.length > 0) { 
            if (result[0]['designation'] !== '') {
                $('#job_title').val(result[0]['designation']);
                $('#payroll_type').val(result[0]['payroll_freq']);
            } else {
                $('#job_title').val("Sales Partner");
                $('#payroll_type').val("Sales Partner");
            }
            if(result[0]['payroll_freq'] != "") {
                getDatePicker(result[0]['payroll_type'], result[0]['payroll_freq']);
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
        url:'add_durat_info',
        success: function(data1, statut) {
            var $select = $('select#duration');
            $select.empty();
            // console.log(data);
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


$('#insert_daily_break').submit(function(e){
    e.preventDefault();
    var data = {
        dailybreak_name : $('#dbreak').val()
    };
    data[csrfName] = csrfHash;
    $.ajax({
        type:'POST',
        data: data,
        dataType:"json",
        url:'add_dailybreak_info',
        success: function(data1, statut) {
            var $select = $('select#dailybreak');
            $select.empty();
            for(var i = 0; i < data1.length; i++) {
                var option = $('<option/>').attr('value', data1[i].dailybreak_name).text(data1[i].dailybreak_name);
                $select.append(option); 
            }
            $('#dailybreak_name').val('');
            $("#bodyModal1").html("Daily Break Added Successfully");
            $('#dailybreak_add').modal('hide');
            $('#dailybreak').show();
            $('#myModal1').modal('show');
            window.setTimeout(function(){
                $('#payment_type_new').modal('hide');
                $('#myModal1').modal('hide');
                $('.modal-backdrop').remove();
            }, 2500);
        }
    });
});

function diffDays(startday, endday) {
    var res = 7;
    if(startday > endday) {
        if(endday == 0) {
            res = (7 - startday);
        } else {
            res = (endday + parseInt(startday - endday));
        }
    } else if(endday > startday) {
        res = parseInt(endday - startday);
    }
    return res;
}
var weeks = {'Sunday' : 0, 'Monday' : 1, 'Tuesday': 2, 'Wednesday' : 3, 'Thusday' : 4, 'Friday' : 5, 'Saturday' : 6};


function getDatePicker(payroll_type, payroll_freq) {

    var start = moment().startOf('isoWeek'); 
    var end = moment().endOf('isoWeek'); 
    var startOfLastWeek = moment().subtract(1, 'week').startOf('week');
    var endOfLastWeek = moment().subtract(1, 'week').endOf('week').add(1, 'day'); 
    function cb(start, end) {
        $('#reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    var start_week = $('#week_setting').data('start');
    var end_week = $('#week_setting').data('end');

    var ThisWeekStart = moment().weekday(weeks[start_week]).startOf()._d;
    var LastWeekStart = moment().subtract(1,  'week').startOf().weekday(weeks[start_week])._d;
    var BeforeLastWeekStart = moment().subtract(2,  'week').startOf().weekday(weeks[start_week])._d;
    
    var date_range = {};
    if(payroll_freq == "Weekly") {
        date_range = {
            maxDate: 0,
            startDate: start,
            endDate: end,
            ThisWeek: ThisWeekStart,
            LastWeek: LastWeekStart,
            beforeWeek:BeforeLastWeekStart,
            ranges: {
                'Last Week Before': [BeforeLastWeekStart , moment(BeforeLastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], weeks[end_week]), 'days')],
                'Last Week': [LastWeekStart , moment(LastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], weeks[end_week]), 'days')],
                'This Week': [ThisWeekStart, moment(ThisWeekStart).add(diffDays(weeks[start_week], weeks[end_week], weeks[end_week]), 'days')],
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
            startDate: start,
            endDate: end,
            ThisWeek: ThisWeekStart,
            LastWeek: LastWeekStart,
            beforeWeek:BeforeLastWeekStart,
            ranges: {
                'Last Week Before': [BeforeLastWeekStart , moment(BeforeLastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], weeks[end_week]), 'days')],
                'Last Week': [LastWeekStart , moment(LastWeekStart).add(diffDays(weeks[start_week], weeks[end_week], weeks[end_week]), 'days')],
                'This Week': [ThisWeekStart, moment(ThisWeekStart).add(diffDays(weeks[start_week], weeks[end_week], weeks[end_week]), 'days')],
            }
        }
    }

    if(payroll_freq == "Monthly") {
        date_range = {
            startDate: start,
            endDate: end,
            ranges: {
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }
    }

    $('#reportrange').daterangepicker(date_range, cb);

}



$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
    
    var startDate = $('#week_setting').data('start');
    var endDate = $('#week_setting').data('end');
    var btwDays = diffDays(weeks[startDate], weeks[endDate]);
    var sDate = moment(picker.startDate._d);
    var eDate = moment(picker.startDate._d).add(btwDays, 'days');

    $(this).val(sDate.format('MM/DD/YYYY') + ' - ' + eDate.format('MM/DD/YYYY'));

    var data= {
        selectedDate: $('#reportrange').val(),
        employeeId: $('#templ_name').val() 
    };
    data[csrfName] = csrfHash;
    $.ajax({
        url:'checkTimesheet',
        method: 'POST',
        data:data,
        success: function(response) {
            if(response.includes('Timesheet exists for this date and employee')){
                $('.sub_btn').attr('disabled', 'disabled');
                $('#check_date').text(response);
            }else{
                $('#check_date').text('');
            }
        },
        error: function(xhr, status, error) {}
    });
});



$('#reportrange').on('change', function() {

    var startDate = $('#week_setting').data('start');
    var endDate = $('#week_setting').data('end');
    var btwDays = diffDays(weeks[startDate], weeks[endDate]);
    var sDate = moment().weekday(weeks[startDate]).startOf();
    var eDate = moment(sDate).add(btwDays, 'days');

    $('#reportrange').val(sDate.format('MM/DD/YYYY') + ' - ' + eDate.format('MM/DD/YYYY'));

    var date = $(this).val();

    $('#tBody').empty();
    $('#tHead').empty();  
    $('#tFoot').empty();
    $('.btnclr').show();
    $('#check_date').html('');
    const myArray = date.split("-");
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
        url:'check_employee_pay_type',
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
                url:'sc_cnt',
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

        if (response.includes('salary') || response.includes('Salaried-weekly') || response.includes('Salaried-BiWeekly') || response.includes('Salaried-Monthly')  || response.includes('Salaried-BiMonthly'  )) {
            $('#tHead').append(`
                <tr style="text-align:center;">
                    <th class="col-md-2">Date</th>
                    <th class="col-md-2">Day</th>
                    <th class="col-md-2">Present / Absence</th>
                </tr>`);
            $('#tFoot').append(`
                <tr style="text-align:end">
                    <td colspan="2" class="text-right" style="font-weight:bold;">No of Days:</td> 
                    <td><input type="text" id="total_net" class="sumOfDays" name="total_net" /></td>
                </tr>`);
        } else if (response.includes('Hourly')) {
            $('#tHead').append(`
                <tr style="text-align:center;">
                    <th class="col-md-2">Date</th>
                    <th class="col-md-1">Day</th> 
                    <th class="col-md-1">Daily Break in mins
                        <a class="btnclr client-add-btn btn" aria-hidden="true" style="color:white;border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#dailybreak_add">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                    <th class="col-md-2">Start Time (HH:MM)</th>
                    <th class="col-md-2">End Time (HH:MM)</th>
                    <th class="col-md-2">Hours</th>
                    <th class="col-md-2">Action</th>
                </tr>`);
            $('#tFoot').append(`
                <tr style="text-align:end">
                    <td colspan="5" class="text-right" style="font-weight:bold;">Total Hours:</td> 
                    <td><input type="text" id="total_net" class="sumOfDays" name="total_net" /></td>
                </tr>`);
        } else if (response.includes('SalesCommission')) {
            $('#tFoot').append(`
                <tr style="text-align:end; display:none;">
                    <td colspan="1" class="text-right" style="font-weight:bold;">Total Hours:</td> 
                    <td><input type="text" id="total_net"  value="0.00" name="total_net"  readonly /></td>
                </tr>`);
        }

        var end_week = "<?php echo (!empty($setting_detail[0]['end_week'])) ? $setting_detail[0]['end_week'] : 'Sunday'; ?>";
        var total_pres = 0;
        var data_id = 0;
        for (let i = 0; i <= Days; i++) { 
            let newDate = new Date(validDate.getTime()); 
            newDate.setDate(validDate.getDate() + i); 
            let dayString = weekDays[newDate.getDay()].slice(0, 10);
            let day = ("0" + newDate.getDate()).slice(-2); 
            let month = ("0" + (newDate.getMonth() + 1)).slice(-2); 
            let dateString = `${month}/${day}/${newDate.getFullYear()}`;
            
            if (response.includes('salary') || response.includes('Salaried-weekly') || response.includes('Salaried-BiWeekly') || response.includes('Salaried-Monthly')  || response.includes('Salaried-BiMonthly'  )) {
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
                                <option value="<?php echo $dbd['dailybreak_name']; ?>"><?php echo $dbd['dailybreak_name']; ?></option>
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
                        <td>
                            <a style="color:white;" class="delete_day btnclr btn  m-b-5 m-r-2"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                        </td>
                    </tr>`);
                    if(end_week == dayString) {
                        $('#tBody').append(`<tr> 
                            <td colspan="5" class="text-right" style="font-weight:bold;"> Weekly Total Hours:</td> 
                            <td class="hour_week_total">
                                <input type="text" name="hour_weekly_total" id="hourly_`+data_id+`" value="" readonly />
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
    error: function(xhr, status, error) {
        console.log('An Error Accoure : '+xhr, status, error);
    }
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
    var c = s.split('.');
    return parseInt(c[0]) * 60 + parseInt(c[1]);
}

function parseTime(s) {
    return Math.floor(parseInt(s) / 60) + "." + parseInt(s) % 60
}


$(document).on('select change', '.end','.dailybreak', function () {
    var $begin = $(this).closest('tr').find('.start').val();
    var $end = $(this).closest('tr').find('.end').val();
    let valuestart = moment($begin, "HH:mm");
    let valuestop = moment($end, "HH:mm");
    let timeDiff = moment.duration(valuestop.diff(valuestart));
    var dailyBreakValue = parseInt($(this).closest('tr').find('.dailybreak').val()) || 0;
    var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;
    var hours = Math.floor(totalMinutes / 60);
    var minutes = totalMinutes % 60;
    var formattedTime = hours.toString().padStart(2, '0') + '.' + minutes.toString().padStart(2, '0');
    
    if (isNaN(parseFloat(formattedTime))) {
        $(this).closest('tr').find('.timeSum').val('00.00');
    } else {
        $(this).closest('tr').find('.timeSum').val(formattedTime);
    }

    var data_id = $(this).data('id');
    
    var total_netH = 0;
    var total_netM = 0;
    var week_netH = 0;
    var week_netM = 0;

    $('.table').each(function () {
        var tableTotal = 0;
        var tableHours = 0;
        var tableMinutes = 0;

        var weekTotal = 0;
        var weekHours = 0;
        var weekMinutes = 0;

        $(this).find('.hourly_tot_'+data_id).each(function() {
            var total_week = $(this).val();
            if (!isNaN(total_week) && total_week.length !== 0) {
                var [weekhour, weekmin] = total_week.split('.').map(parseFloat);
               
                weekHours += weekhour;
                weekMinutes += weekmin;
            }
        });
        week_netH += weekHours;
        week_netM += weekMinutes;

        $(this).find('.timeSum').each(function () {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
                var [hours, minutes] = precio.split('.').map(parseFloat);
                
                tableHours += hours;
                tableMinutes += minutes;
            }
        });
        total_netH += tableHours;
        total_netM += tableMinutes;
    });

    var timeConvertion = convertToTime(week_netH, week_netM);
    $('#hourly_'+data_id).val(timeConvertion).trigger('change');

    var timeConvertion = convertToTime(total_netH, total_netM);
    $('#total_net').val(timeConvertion).trigger('change');
});


$(document).on('select change', '.start','.dailybreak', function () {
    var $begin = $(this).closest('tr').find('.start').val();
    var $end = $(this).closest('tr').find('.end').val();
    let valuestart = moment($begin, "HH:mm");
    let valuestop = moment($end, "HH:mm");
    let timeDiff = moment.duration(valuestop.diff(valuestart));
    var dailyBreakValue = parseInt($(this).closest('tr').find('.dailybreak').val()) || 0;
    var totalMinutes = timeDiff.asMinutes() - dailyBreakValue;
    var hours = Math.floor(totalMinutes / 60);
    var minutes = totalMinutes % 60;
    var formattedTime = hours.toString().padStart(2, '0') + '.' + minutes.toString().padStart(2, '0');
    if (isNaN(parseFloat(formattedTime))) {
        $(this).closest('tr').find('.timeSum').val('00.00');
    }else{
        $(this).closest('tr').find('.timeSum').val(formattedTime);
    }

    var data_id = $(this).data('id');
    var total_netH = 0;
    var total_netM = 0;
    var week_netH = 0;
    var week_netM = 0;

    $('.table').each(function () {
        var tableTotal = 0;
        var tableHours = 0;
        var tableMinutes = 0;

        var weekTotal = 0;
        var weekHours = 0;
        var weekMinutes = 0;

        $(this).find('.hourly_tot_'+data_id).each(function() {
            var total_week = $(this).val();
            if (!isNaN(total_week) && total_week.length !== 0) {
                var [weekhour, weekmin] = total_week.split('.').map(parseFloat);
                weekHours += weekhour;
                weekMinutes += weekmin;
            }
        });
        week_netH += weekHours;
        week_netM += weekMinutes;

        $(this).find('.timeSum').each(function () {
            var precio = $(this).val();
            if (!isNaN(precio) && precio.length !== 0) {
                var [hours, minutes] = precio.split('.').map(parseFloat);
                tableHours += hours;
                tableMinutes += minutes;
            }
        });
        total_netH += tableHours;
        total_netM += tableMinutes;
    });
    var timeConvertion = convertToTime(week_netH, week_netM);
    $('#hourly_'+data_id).val(timeConvertion).trigger('change');

    var timeConvertion = convertToTime(total_netH,total_netM);
    $('#total_net').val(timeConvertion).trigger('change');
});


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

    var timeConversion = convertToTime(total_netH, total_netM);
    $('#total_net').val(timeConversion).trigger('change');

    var firstDate = $('.date input').first().val(); 
    var lastDate = $('.date input').last().val(); 
    function convertDateFormat(dateStr) {
        const [day, month, year] = dateStr.split('/');
        return `${month}/${day}/${year}`;
    }
    var firstDateMDY = convertDateFormat(firstDate);
    var lastDateMDY = convertDateFormat(lastDate);
    $('#reportrange').val(firstDateMDY + ' - ' + lastDateMDY);
});


$(function() {
    $('.applyBtn').datepicker({
        onSelect: function(date) {
            $.ajax({
                url: 'checkTimesheet',
                method: 'POST',
                data: {
                    selectedDate: date,
                    employeeId: $('#templ_name').val() 
                },
                success: function(response) {
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

    $(document).on('change keyup', '#total_net, #reportrange, input[type="checkbox"].present:checked', function() {
        var total_net = $('#total_net').val();
        
        if(total_net != "" && total_net != undefined) {
            $('.sub_btn').removeAttr('disabled');
        } else {
            $('.sub_btn').attr('disabled', 'disabled');
        }
    });
});
