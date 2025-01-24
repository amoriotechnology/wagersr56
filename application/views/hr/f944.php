<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <body bgcolor="#A0A0A0" vlink="blue" link="blue">
        <div id="download">
            <div class="page-1" id="one">
                <img src="<?php echo base_url()  ?>assets/images/f942_1.jpg" width="100%" />
                <?php
                    $Federal_Pin_Number = isset($get_cominfo[0]['Federal_Pin_Number']) ? $get_cominfo[0]['Federal_Pin_Number'] : '';
                    if (strlen($Federal_Pin_Number) >= 9) {
                        $one = substr($Federal_Pin_Number, 0, 2);
                        $two = substr($Federal_Pin_Number, -7);
                        $one1 = $one[0];
                        $one2 = $one[1];
                        $two3 = $two[0]; 
                        $two4 = $two[1]; 
                        $two5 = $two[2]; 
                        $two6 = $two[3];
                        $two7 = $two[4]; 
                        $two8 = $two[5]; 
                        $two9 = $two[6]; 
                    } else {
                        $one = '00'; 
                        $two = '0000000'; 
                    }
                ?>
      <div class="two-digit d-flex gap-3">
          <input class="ein-number" value=" <?php echo $one1; ?>" />
          <input class="ein-number second-value" value="<?php echo $one2; ?>" />
        </div>
        <div class="two-digit-2 d-flex gap-1">
          <input class="ein-number-2" value="<?php echo $two3; ?>" />
          <input
            class="ein-number-2 print-check"
            style="margin-left: 13px"
            value="<?php echo $two4; ?>"
          />
          <input
            class="ein-number-2 print-check-2"
            style="margin-left: 15px"
            value="<?php echo $two5; ?>"
          />
          <input
            class="ein-number-2 print-check-3"
            style="margin-left: 13px"
            value="<?php echo $two6; ?>"
          />
          <input
            class="ein-number-2 print-check-4"
            style="margin-left: 13px"
            value="<?php echo $two7; ?>"
          />
          <input
            class="ein-number-2 print-check-5"
            style="margin-left: 13px"
            value="<?php echo $two8; ?>"
          />
          <input
            class="ein-number-2 print-check-6"
            style="margin-left: 13px"
            value="<?php echo $two9; ?>"
          />
        </div>
        <?php
            if (isset($get_cominfo) && !empty($get_cominfo)) {
                $company_name = $get_cominfo[0]['company_name'];
                $mobile  = $get_cominfo[0]['mobile'];
            } else {
                $company_name = 'Default Name';
                $mobile  = 'Default Name';
            }
        ?>
        <div class="name-text">
          <input type="text" value="<?php echo $company_name; ?>" />
        </div>
        <div class="trade-text">
          <input type="text" value="<?php echo $company_name; ?>" />
        </div>
        <?php
            $address = isset($get_cominfo[0]['address']) ? $get_cominfo[0]['address'] : 'Default Address';
            $get_address = explode(',' , $address);
        ?>
        <div class="Address-text">
          <input type="text" value="<?php echo $get_address[0]; ?>" />
        </div>
        <div class="city-text">
          <input type="text" value="<?php echo $get_address[1]; ?>" />
        </div>
        <div class="state-text">
          <input type="text" value="<?php echo $get_address[2]; ?>" />
        </div>
        <div class="zipcode-text">
          <input type="text" value=" <?php echo $get_address[3]; ?>" />
        </div>
                <div class="country">
                    <input type="text" value="" />
                </div>
                <div class="foreign">
                    <input type="text" value="" />
                </div>
                <div class="postal-code">
                    <input type="text" value="" />
                </div>
                <?php
                    $t_tax = 0;
                    $t_tax = $get_payslip_info[0]['overalltotal_amount'];
                    $formatted_tax = number_format($t_tax, 2);
                    $parts = explode('.', $formatted_tax);
                    $inter = $parts[0];
                    $decimal = isset($parts[1]) ? $parts[1] : '00'; 
                ?> 
                <div class="row1">
                    <input type="text" value="$<?php echo $inter; ?>"  style="margin-left: -35px;width: 80px;text-align: right;"  /> 
                     <input type="text" value="<?php echo $decimal; ?>" />
                </div>
                <?php
                    $ftotal_amount = isset($get_payslip_info[0]['ftotal_amount']) ? $get_payslip_info[0]['ftotal_amount'] : '0';
                    $formatted_tax = number_format($ftotal_amount, 2);
                    $parts = explode('.', $formatted_tax);
                    $inter1 = $parts[0]; 
                    $decimal1 = isset($parts[1]) ? $parts[1] : '00';
                ?>
                <div class="row2">
                    <input type="text" value="$<?php echo $inter1; ?>"  style="margin-left: -55px;text-align: right;width: 80px;"  />
                    <input type="text" value="<?php echo str_pad($decimal1, 2, '0', STR_PAD_RIGHT); ?>" />
                </div>
                <div class="row3">
                    <input type="checkbox">
                </div>
                <?php
                    $overalltotal_amount = isset($get_payslip_info[0]['overalltotal_amount']) ? $get_payslip_info[0]['overalltotal_amount'] : '0';
                    $formatted_overalltax = number_format($overalltotal_amount, 2);
                    $parts = explode('.', $formatted_overalltax);
                    $inter2 = $parts[0]; 
                    $decimal2 = isset($parts[1]) ? $parts[1] : '00'; 
                ?>
                <div class="row4">
                    <input type="text" value="<?php echo $currency . $inter2; ?>"  style="margin-left: -49px;text-align: right;"  />
                    <input type="text" value="<?php echo $decimal2; ?>" />
                </div>
                <div class="row4a1">
                    <input type="text" value="" />
                </div>
                <div class="row4a2">
                    <input type="text" value="" />
                </div>
                <div class="row4b">
                    <input type="text" value="" />
                </div>
                <?php
                    $total_medi_tax = $overalltotal_amount * 0.029 ;
                    $formatted_total_medi_tax = number_format($total_medi_tax, 2);
                    $totalsocialsecurity_Medicaretax = $total_medi_tax + $social_security;
                    $formatted_result = number_format($totalsocialsecurity_Medicaretax, 2);
                    $totaltaxesbeforeadjustments = $ftotal_amount + $totalsocialsecurity_Medicaretax;
                    $formatted_resultbfa = number_format($totaltaxesbeforeadjustments, 2);
                    $currentyear_adjustments = 0;
                    $totaltax_afteradjustments = $totaltaxesbeforeadjustments + $currentyear_adjustments;
                    $formattedtotaltax_afteradjustments = number_format($totaltax_afteradjustments, 2);
                    $parts = explode('.', $formatted_overalltax);
                    $inter6 = $parts[0];
                    $decimal6 = isset($parts[1]) ? $parts[1] : '00'; 
                ?>
                <div class="row4c">
                    <input type="text" value="<?php echo $currency . $inter6; ?>"  style="margin-left: -47px; text-align: right;"  />
                    <input type="text" value="<?php echo $decimal6 ; ?>" />
                </div>
                <div class="row4d">
                    <input type="text" value="" />
                </div>
                <?php
                    $social_security = $overalltotal_amount * 0.124;
                    $formatted_social_security = number_format($social_security, 2);
                    $parts = explode('.', $formatted_social_security);
                    $inter7 = $parts[0]; 
                    $decimal7 = isset($parts[1]) ? $parts[1] : '00'; 
                ?>
                <div class="row4c2a">
                    <input type="text" value="<?php echo $currency . $inter7; ?>" style="margin-left: -52px;text-align: right;" />
                    <input type="text" value="<?php echo $decimal7; ?>" />
                </div>
                <div class="row4c2b">
                    <input type="text" value="" />
                </div>
                <div class="row4c2c">
                    <input type="text" value="" />
                </div>
                <div class="row4c2d">
                    <input type="text" value="" />
                </div>
                <?php
                    $mw = $overalltotal_amount * 0.029;
                    $formatted_mm = number_format($mw, 2);
                    $parts = explode('.', $formatted_mm);
                    $inter8 = $parts[0]; 
                    $decimal8 = isset($parts[1]) ? $parts[1] : '00'; 
                ?>
                <div class="row4c2e">
                    <input type="text" value="<?php echo $currency . $inter8 ; ?>" style="margin-left:-69px;text-align:right;"  />
                    <input type="text" value="<?php echo $decimal8; ?>"  style="margin-left:5px;"  />
                </div>
                <div class="row4c2f">
                    <input type="text" value="" />
                </div>
                <?php
                    $total_amount = $social_security + $mw + $ftotal_amount;
                    $formatted_amount = number_format($total_amount, 2); 
                    $parts = explode('.', $formatted_amount); 
                    $inter10 = $parts[0]; 
                    $decimal10 = $parts[1];
                ?>

                <div class="row5">
                    <input type="text" value="<?php echo $currency . $inter10 ; ?>"  style="margin-left:-50px;text-align:right;" />
                    <input type="text" value="<?php echo $decimal10; ?>" />
                </div>
                <?php
                    $parts = explode('.', $social_security + $mw);
                    $inter9 = $parts[0]; 
                    $decimal9 = isset($parts[1]) ? substr(sprintf('%f', $parts[1]), 0, 2) : '00';  
                ?>
                 <div class="row5a">
                    <input type="text" value="<?php echo $currency . $inter9; ?>" style="margin-left:-70px;text-align:right;width: 90px;" />
                    <input type="text" value="<?php echo $decimal9; ?>"  />
                </div>
                <div class="row6">
                    <input type="text" value="" />
                </div>
                <div class="row7">
                    <input type="text" value="<?php echo $currency . $inter10; ?>"  style="width: 80px;margin-left: -63px;text-align: right;" />
                    <input type="text" value="<?php echo $decimal10; ?>"  style="width: 20px;margin-left: 4px;" />
                </div>
                <div class="row8a">
                    <input type="text" value="" />
                </div>
                <div class="row8b">
                    <input type="text" value="" />
                </div>
                <div class="row8c">
                    <input type="text" value="" />
                </div>
                <div class="row8d">
                    <input type="text" value="" />
                </div>
            </div>
            <div class="page-2" id="two">
                <img src="<?php echo base_url()  ?>assets/images/f942_2.jpg" width="100%" />
                <div class="row8e">
                    <input type="text" value="<?php echo $company_name; ?>" />
                </div>
                <div class="ein-p3">
                    <input type="text" value="<?php echo $Federal_Pin_Number; ?>">
                </div>
                <div class="row8f">
                    <input type="text" value="" />
                </div>
                <div class="row8g">
                    <input type="text" value="" />
                </div>
                <div class="row9">
                    <input type="text" value="" />
                </div>
                <div class="row10a">
                    <input type="text" value="" />
                </div>
                <div class="row10b">
                    <input type="text" value="" />
                </div>
                <div class="row10c">
                    <input type="text" value="" />
                </div>
                <div class="row10d">
                    <input type="text" value="" />
                </div>
                <div class="row10e">
                    <input type="text" value="" />
                </div>
                <div class="row10f">
                    <input type="text" value="" />
                </div>
                <div class="row10g">
                    <input type="text" value="" />
                </div>
                <div class="row10h">
                    <input type="text" value="" />
                </div>
                <div class="row10i">
                    <input type="text" value="" />
                </div>
                <div class="row10j">
                    <input type="text" value="" />
                </div>
                <div class="row11">
                    <input type="text" value="" />
                </div>
                <div class="row12">
                    <input type="text" value="" />
                </div>
                <div class="row12a">
                    <input type="checkbox" />
                </div>
                <div class="row12b">
                    <input type="checkbox" />
                </div>
                <div class="row13aa">
                    <input type="checkbox" />
                </div>
                <div class="row13bb">
                    <input type="checkbox" />
                </div>
                <div class="row13a">
                    <input type="text" value="">
                </div>
                <div class="row13b">
                    <input type="text" value="">
                </div>
                <div class="row13c">
                    <input type="text" value="">
                </div>
                <div class="row13d">
                    <input type="text" value="">
                </div>
                <div class="row13e">
                    <input type="text" value="">
                </div>
                <div class="row13f">
                    <input type="text" value="">
                </div>
                <div class="row13g">
                    <input type="text" value="">
                </div>
                <div class="row13h">
                    <input type="text" value="">
                </div>
                <div class="row13i">
                    <input type="text" value="">
                </div>
                <div class="row13j">
                    <input type="text" value="">
                </div>
                <div class="row13k">
                    <input type="text" value="">
                </div>
                <div class="row13l">
                    <input type="text" value="">
                </div>
                <div class="row13m">
                    <input type="text" value="">
                </div>
            </div>
            <div class="page-3" id="three">
                <img src="<?php echo base_url()  ?>assets/images/f942_3.jpg" width="100%" />
                <div class="trade-name">
                    <input type="text" value="<?php echo $company_name; ?>">
                </div>
                <div class="ein-p3">
                    <input type="text" value="<?php echo $Federal_Pin_Number; ?>">
                </div>
                <div class="row14">
                    <input type="checkbox">
                </div>
                <div class="row14a">
                    <input type="text" style="letter-spacing: 4px; font-size: 16px;" value="<?php echo date('m d Y'); ?>">
                </div>
                <div class="row15">
                    <input type="text" value="">
                </div>
                <div class="row16">
                    <input type="text" value="">
                </div>
                <div class="row17">
                    <input type="text" value="">
                </div>
                <div class="row18">
                    <input type="text" value="">
                </div>
                <div class="row19">
                    <input type="text" value="">
                </div>
                <div class="row20">
                    <input type="text" value="">
                </div>
                <div class="row21">
                    <input type="text" value="">
                </div>
                <div class="row22">
                    <input type="text" value="">
                </div>
                <div class="row23">
                    <input type="text" value="">
                </div>
                <div class="row24">
                    <input type="text" value="">
                </div>
                <div class="row25">
                    <input type="text" value="">
                </div>
                <div class="row26">
                    <input type="text" value="">
                </div>
                <div class="row27a">
                    <input type="checkbox" />
                </div>
                <div class="row27b">
                    <input type="text" value="" />
                </div>
                <div class="row27c">
                    <input type="text" value="" />
                </div>
                <div class="row28">
                    <input type="checkbox" />
                </div>
                <div class="row28b">
                    <input type="text" value="" />
                    <input type="text" value="" style="margin-left: 3px;" />
                    <input type="text" value="" style="margin-left: 6px;" />
                    <input type="text" value="" style="margin-left: 7px;" />
                    <input type="text" value="" style="margin-left: 7px;" />
                </div>
                <div class="row29a">
                    <input type="text" value=" " />
                </div>
                <div class="row29b">
                    <input type="text" value="<?php echo date('m/d/Y'); ?>" />
                </div>
                <div class="row29c">
                    <input type="text" value="<?php echo $company_name; ?>" />
                </div>
                <div class="row29d">
                    <input type="text" value="Admin" />
                </div>
                <div class="row29e">
                    <input type="text" value="<?php echo $mobile; ?>" />
                </div>
                <div class="row30">
                    <input type="checkbox" />
                </div>
                <div class="pre-name">
                    <input type="text" value="" />
                </div>
                <div class="pre-sign">
                    <input type="text" value="" />
                </div>
                <div class="first-name">
                    <input type="text" value="" />
                </div>
                <div class="address">
                    <input type="text" value="" />
                </div>
                <div class="pre-city">
                    <input type="text" value="" name="" id="" />
                </div>
                <div class="pre-state">
                    <input type="text" value="" />
                </div>
                <div class="pre-zipcode">
                    <input type="text" value="" />
                </div>
                <div class="pre-pin">
                    <input type="text" value="" />
                </div>
                <div class="pre-date">
                    <input type="text" value="" />
                </div>
                <div class="pre-ein">
                    <input type="text" value="" />
                </div>
                <div class="pre-phone">
                    <input type="text" value="" />
                </div>
            </div>
            <div class="page-4" id="four">
                <img src="<?php echo base_url()  ?>assets/images/f942_4.jpg" width="100%" />
            </div>
            <div class="page-5" id="five">
                <img src="<?php echo base_url()  ?>assets/images/f942_5.jpg" width="100%" />
                <div class="row1-ein">
                    <input type="text" value="<?php echo $Federal_Pin_Number; ?>" />
                </div>
                <div class="dollar">
                    <input type="text" value="<?php echo $currency . $inter10 ; ?>" />
                </div>
                <div class="cent">
                    <input type="text" value="<?php echo $decimal10; ?>" />
                </div>
                <div class="busniess-name">
                    <input type="text" value="<?php echo $company_name; ?>">
                </div>
                <div class="b-address">
                    <input type="text" value="<?php echo $get_address[0]; ?>">
                </div>
                <div class="city-state-code">
                    <input type="text" style='font-size:12px;width:100%;' value="<?php echo $get_address[1] .' '. $get_address[2] .' '. $get_address[3] ; ?> " />
                </div>
            </div>
            <div class="page-6" id="six">
                <img src="<?php echo base_url()  ?>assets/images/f942_6.jpg" width="100%" />
            </div>
        </div>
    </body>
    <?php 
       $modaldata['bootstrap_modals'] = array('generatedownload');
       $this->load->view('include/bootstrap_modal', $modaldata);
    ?>
    <style>
        .page-1,
        .page-2,
        .page-3,
        .page-4,
        .page-5,
        .page-6 {
            width: 21cm;
            height: 29.7cm;
            position: relative;
            margin: 0 auto;
            page-break-after: always;
        }
        input {
            border: 0;
            background-color: transparent;
        }
        .two-digit {
            position: absolute;
            top: 93px;
            left: 239px;
        }
        .two-digit-2 {
            position: absolute;
            top: 94px;
            left: 323px;
        }
        .ein-number {
            width: 23px;
            height: 23px;
            text-align: center;
        }
        .ein-number-2 {
            width: 15px;
            height: 20px;
            text-align: center;
        }
        .name-text {
            position: absolute;
            top: 124px;
            left: 181px;
        }
        .name-text input {
            height: 20px;
            width: 250px;
        }
        .trade-text {
            position: absolute;
            top: 157px;
            left: 147px;
        }
        .trade-text input {
            height: 20px;
            width: 250px;
        }
        .Address-text {
            position: absolute;
            top: 187px;
            left: 107px;
        }
        .Address-text input {
            height: 20px;
            width: 250px;
        }
        .city-text {
            position: absolute;
            top: 227px;
            left: 107px;
        }
        .city-text input {
            height: 20px;
            width: 225px;
        }
        .state-text {
            position: absolute;
            top: 226px;
            left: 407px;
        }
        .state-text input {
            height: 20px;
            width: 30px;
        }
        .zipcode-text {
            position: absolute;
            top: 227px;
            left: 473px;
        }
        .zipcode-text input {
            height: 20px;
            width: 80px;
        }
        .country {
            position: absolute;
            top: 266px;
            left: 110px;
        }
        .country input {
            height: 20px;
            width: 100px;
        }
        /* foreign */
        .foreign {
            position: absolute;
            top: 266px;
            left: 386px;
        }
        .foreign input {
            height: 20px;
            width: 100px;
        }
        /* postal-code */
        .postal-code {
            position: absolute;
            top: 267px;
            left: 474px;
        }
        .postal-code input {
            height: 20px;
            width: 80px;
        }
        .row1 {
            position: absolute;
            top: 386px;
            left: 667px;
        }
        .row1 input {
            height: 20px;
            width: 45px;
        }
        .row2 {
            position: absolute;
            top: 417px;
            left: 687px;
        }
        .row2 input {
            height: 20px;
            width: 40px;
        }
        .row3 {
            position: absolute;
            top: 439px;
            left: 578px;
        }
        .row3 input {
            height: 15px;
            width: 15px;
        }
        .row4 {
            position: absolute;
            top: 501px;
            left: 334px;
        }
        .row4 input {
            height: 15px;
            width: 80px;
        }
        .row4a1 {
            position: absolute;
            top: 534px;
            left: 334px;
        }
        .row4a2 {
            position: absolute;
            top: 565px;
            left: 334px;
        }
        .row4a2 input {
            height: 20px;
            width: 80px;
        }
        .row4b {
            position: absolute;
            top: 595px;
            left: 334px;
        }
        .row4b input {
            height: 20px;
            width: 80px;
        }
        .row4c {
            position: absolute;
            top: 626px;
            left: 334px;
        }
        .row4c input {
            height: 20px;
            width: 80px;
        }
        .row4d {
            position: absolute;
            top: 674px;
            left: 334px;
        }
        .row4d input {
            height: 20px;
            width: 80px;
        }
        .row4c2a {
            position: absolute;
            top: 503px;
            left: 525px;
        }
        .row4c2a input {
            height: 20px;
            width: 80px;
        }
        .row4c2b input {
            height: 20px;
            width: 80px;
        }
        .row4c2b {
            position: absolute;
            top: 533px;
            left: 520px;
        }
        .row4c2c input {
            height: 20px;
            width: 80px;
        }
        .row4c2c {
            position: absolute;
            top: 565px;
            left: 520px;
        }
        .row4c2d input {
            height: 20px;
            width: 80px;
        }
        .row4c2d {
            position: absolute;
            top: 596px;
            left: 520px;
        }
        .row4c2e input {
            height: 20px;
            width: 80px;
        }
        .row4c2e {
            position: absolute;
            top: 627px;
            left: 540px;
        }
        .row4c2f input {
            height: 20px;
            width: 80px;
        }
        .row4c2f {
            position: absolute;
            top: 673px;
            left: 520px;
        }
        .row5a {
            position: absolute;
            top: 705px;
            left: 692px;
        }
        .row5a input {
            height: 20px;
            width: 40px;
        }
        .row5 {
            position: absolute;
            top: 735px;
            left: 693px;
        }
        .row5 input {
            height: 20px;
            width: 70px;
        }
        .row6 {
            position: absolute;
            top: 768px;
            left: 679px;
        }
        .row7 {
            position: absolute;
            top: 798px;
            left: 693px;
        }
        .row8a {
            position: absolute;
            top: 830px;
            left: 679px;
        }
        .row8b {
            position: absolute;
            top: 867px;
            left: 679px;
        }
        .row8c {
            position: absolute;
            top: 899px;
            left: 679px;
        }
        .row8d {
            position: absolute;
            top: 938px;
            left: 679px;
        }
        .row8e {
            position: absolute;
            top: 56px;
            left: 49px;
        }
        .row8f {
            position: absolute;
            top: 134px;
            left: 478px;
        }
        .row8g {
            position: absolute;
            top: 167px;
            left: 679px;
        }
        .row9 {
            position: absolute;
            top: 198px;
            left: 679px;
        }
        .row10a {
            position: absolute;
            top: 238px;
            left: 679px;
        }
        .row10b {
            position: absolute;
            top: 270px;
            left: 679px;
        }
        .row10c {
            position: absolute;
            top: 300px;
            left: 679px;
        }
        .row10d {
            position: absolute;
            top: 339px;
            left: 679px;
        }
        .row10e {
            position: absolute;
            top: 369px;
            left: 679px;
        }
        .row10f {
            position: absolute;
            top: 410px;
            left: 679px;
        }
        .row10g {
            position: absolute;
            top: 442px;
            left: 679px;
        }
        .row10h {
            position: absolute;
            top: 473px;
            left: 679px;
        }
        .row10i {
            position: absolute;
            top: 503px;
            left: 679px;
        }
        .row10j {
            position: absolute;
            top: 533px;
            left: 679px;
        }
        .row11 {
            position: absolute;
            top: 564px;
            left: 679px;
        }
        .row12 {
            position: absolute;
            top: 594px;
            left: 427px;
        }
        .row12a {
            position: absolute;
            top: 596px;
            left: 550px;
        }
        .row12b {
            position: absolute;
            top: 596px;
            left: 653px;
        }
        .row13aa {
            position: absolute;
            top: 644px;
            left: 143px;
        }
        .row13bb {
            position: absolute;
            top: 666px;
            left: 143px;
        }
        .row13a {
            position: absolute;
            top: 728px;
            left: 213px;
        }
        .row13b {
            position: absolute;
            top: 767px;
            left: 213px;
        }
        .row13c {
            position: absolute;
            top: 806px;
            left: 213px;
        }
        .row13d {
            position: absolute;
            top: 728px;
            left: 371px;
        }
        .row13e {
            position: absolute;
            top: 767px;
            left: 371px;
        }
        .row13f {
            position: absolute;
            top: 806px;
            left: 371px;
        }
        .row13g {
            position: absolute;
            top: 728px;
            left: 530px;
        }
        .row13h {
            position: absolute;
            top: 767px;
            left: 530px;
        }
        .row13i {
            position: absolute;
            top: 806px;
            left: 530px;
        }
        .row13j {
            position: absolute;
            top: 728px;
            left: 679px;
        }
        .row13k {
            position: absolute;
            top: 767px;
            left: 679px;
        }
        .row13l {
            position: absolute;
            top: 806px;
            left: 679px;
        }
        .row13m {
            position: absolute;
            top: 837px;
            left: 679px;
        }
        /* page-3 */
        .trade-name {
            position: absolute;
            top: 57px;
            left: 83px;
        }
        .ein-p3 {
            position: absolute;
            top: 59px;
            left: 527px;
        }
        .row14 {
            position: absolute;
            top: 98px;
            left: 628px;
        }
        .row14a {
            position: absolute;
            top: 129px;
            left: 280px;
        }
        .row15 {
            position: absolute;
            top: 160px;
            left: 679px;
        }
        .row16 {
            position: absolute;
            top: 187px;
            left: 679px;
        }
        .row17 {
            position: absolute;
            top: 215px;
            left: 679px;
        }
        .row18 {
            position: absolute;
            top: 241px;
            left: 679px;
        }
        .row19 {
            position: absolute;
            top: 268px;
            left: 679px;
        }
        .row20 {
            position: absolute;
            top: 295px;
            left: 679px;
        }
        .row21 {
            position: absolute;
            top: 331px;
            left: 679px;
        }
        .row22 {
            position: absolute;
            top: 358px;
            left: 679px;
        }
        .row23 {
            position: absolute;
            top: 385px;
            left: 679px;
        }
        .row24 {
            position: absolute;
            top: 422px;
            left: 679px;
        }
        .row25 {
            position: absolute;
            top: 471px;
            left: 679px;
        }
        .row26 {
            position: absolute;
            top: 518px;
            left: 679px;
        }
        .row27a {
            position: absolute;
            top: 588px;
            left: 66px;
        }
        .row27b {
            position: absolute;
            top: 584px;
            left: 319px;
        }
        .row27c {
            position: absolute;
            top: 584px;
            left: 567px
        }
        .row28 {
            position: absolute;
            top: 631px;
            left: 66px;
        }
        .row28b input {
            height: 18px;
            width: 18px;
        }
        .row28b {
            position: absolute;
            top: 614px;
            left: 541px;
        }
        .row29a {
            position: absolute;
            top: 715px;
            left: 196px;
        }
        .row29b {
            position: absolute;
            top: 766px;
            left: 189px;
        }
        .row29e {
            position: absolute;
            top: 764px;
            left: 598px;
        }
        .row29d {
            position: absolute;
            top: 733px;
            left: 556px;
        }
        .row29c {
            position: absolute;
            top: 701px;
            left: 554px;
        }
        .row30 {
            position: absolute;
            top: 794px;
            left: 718px;
        }
        .pre-name {
            position: absolute;
            top: 826px;
            left: 162px;
        }
        .pre-sign {
            position: absolute;
            top: 855px;
            left: 162px;
        }
        .first-name {
            position: absolute;
            top: 888px;
            left: 162px;
        }
        .address {
            position: absolute;
            top: 920px;
            left: 162px;
        }
        .pre-city {
            position: absolute;
            top: 950px;
            left: 162px;
        }
        .pre-state {
            position: absolute;
            top: 950px;
            left: 460px;
        }
        .pre-pin {
            position: absolute;
            top: 826px;
            left: 581px;
        }
        .pre-date {
            position: absolute;
            top: 855px;
            left: 581px;
        }
        .pre-ein {
            position: absolute;
            top: 888px;
            left: 581px;
        }
        .pre-phone {
            position: absolute;
            top: 920px;
            left: 581px;
        }
        .pre-zipcode {
            position: absolute;
            top: 950px;
            left: 581px;
        }
        /* page-5 */
        .row1-ein {
            position: absolute;
           bottom: 291px;
             left: 89px;
        }
        .dollar {
            position: absolute;
            bottom: 302px;
            left: 606px;
        }
        .cent {
            position: absolute;
            bottom: 303px;
            left: 711px;
        }
        .busniess-name {
            position: absolute;
            bottom: 257px;
            left: 308px;
        }
        .b-address {
            position: absolute;
            bottom: 227px;
            left: 309px;
        }
        .city-state-code {
            position: absolute;
            bottom: 195px;
            left: 309px;
        }
    </style>
</html>

<script>
$(document).ready(function() {
    downloadPagesAsPDF();
});

async function downloadPagesAsPDF() {
  $('#generatedownload').modal('show');
  const elements = [
    document.getElementById('one'),
    document.getElementById('two'),
    document.getElementById('three'),
    document.getElementById('four'),
    document.getElementById('five'),
    document.getElementById('six')
  ];
  generatePDF(elements);
}

async function generatePDF(elements) {
    try {
        const canvases = await Promise.all(elements.map(element =>
            html2canvas(element, { scale: 2 })
        ));
        const pdf = new jspdf.jsPDF({
            orientation: 'p',
            unit: 'px',
            format: [canvases[0].width, canvases[0].height]
        });

        canvases.forEach((canvas, index) => {
            const imgData = canvas.toDataURL('image/jpeg', 1.0);
            if (index > 0) {
                pdf.addPage([canvas.width, canvas.height], 'p');
            }
            pdf.addImage(imgData, 'JPEG', 0, 0, canvas.width, canvas.height);
        });
        $('#generatedownload').modal('hide');
        window.location.href = "<?= base_url('Chrm/payroll_setting?id=' . $_GET['id']); ?>";
        const currentDate = new Date();
        const formattedDate = `${currentDate.getMonth() + 1}-${currentDate.getDate()}-${currentDate.getFullYear()}`;
        const formattedTime = `${currentDate.getHours()}-${currentDate.getMinutes()}-${currentDate.getSeconds()}`;
        const formattedDateTime = `${formattedDate}_${formattedTime}`;
        pdf.save(`944_${formattedDateTime}.pdf`);
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('An error occurred while generating the PDF. Please try again.');
        $('#generatedownload').modal('hide');
    }
}
</script>