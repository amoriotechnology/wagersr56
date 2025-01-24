<style>
body {
  font-size : 14px;
}
.pe-7s-cart{
    position: absolute;
    top: -44px;
    left: 50px;
    margin-left: 769px;
}
.pe-7s-help1{
    position: absolute;
    top:-68px;
    left:95px;
    margin-left: 770px
}
.pe-7s-settings{
    position: absolute;
    top:-92px;
    left:142px;
    margin-left: 770px;
}
 .label{
    position: absolute;
    top: -79px;
    display: none;
 }
 .navbar {
    height: 40px;
 }
 .sidebar-toggle{
    margin-top: -97px;
    margin-left: -971px;
 }
.pe-7s-bell{
    position: relative;
    left: 768px;
}
  </style>
<html>
<body bgcolor="#A0A0A0" vlink="blue" link="blue">
<div id="download"  >
    <div class="page-1"  id="one">
      <img src="<?php echo base_url()  ?>assets/images/uc_2a.jpg"  width="100%" />
      <?php
        $Federal_Pin_Number = isset($get_cominfo[0]['Federal_Pin_Number']) ? $get_cominfo[0]['Federal_Pin_Number'] : '';
        $digits = str_split(str_pad(str_replace('-', '', $Federal_Pin_Number), 9, '0'));
      ?>
      <div class="sample-typed">
        <div class="grid">
            <?php foreach ($digits as $digit): ?>
              <input type="text" value="<?php echo $digit; ?>" />
            <?php endforeach; ?>
        </div>
      </div>
      <div class="sample-handwritten">
        <div class="grid">
          <?php foreach ($digits as $digit): ?>
            <input type="text" value="<?php echo $digit; ?>" />
          <?php endforeach; ?>
        </div>
      </div>
      <?php
      $company_name = isset($get_cominfo[0]['company_name']) ? $get_cominfo[0]['company_name'] : '';
      ?>
      <div class="ename">
        <input type="text"  value="<?php  echo strtoupper($company_name);  ?>"  style="width:205px;" />
      </div>
      <div class="acc-no">
        <input type="text"  value="00000" style="text-align:center;" />
      </div>
      <div class="check-digi">
        <input type="text" />
      </div>
      <div class="year">
              <input type="text" value="<?php 
           $quarter = isset($quarter) ? $quarter : 'Unknown';
            echo $quarter . ' / ' . date('Y');
        ?>" />

      </div>
   
      <div class="date">
      <input type="text" value=" <?php
        $quarter_end_dates = ['Q1' => '03/31','Q2' => '06/30','Q3' => '09/30','Q4' => '12/31'];
        if (isset($quarter) && array_key_exists($quarter, $quarter_end_dates)) {
            $quarter_end_date = $quarter_end_dates[$quarter] . '/' . date('Y'); 
        }
        echo $quarter_end_date;
        ?>"   style="text-align: center;"  />
      </div>
      <?php
      $mobile = isset($get_cominfo[0]['mobile']) ? $get_cominfo[0]['mobile'] : '';
      ?>
      <div class="tele-1">
        <input type="text" value="<?php echo strtoupper($company_name); ?>"    />
        <br>
         <input type="text" value="<?php echo $mobile; ?>"  style="position: absolute;top: 23px;"   />
      </div>
      <div class="tele-2">
        <input type="text" />
      </div>
      <div class="report">
        <input type="text" />
      </div>
      <div class="page">
         <input type="text" value='<?php  echo count($info_for_nj); ?>'/>
      </div>
      <div class="plant">
        <input type="text" />
      </div>
      <div class="wages">
        <div class="grid">
        <?php 
          $sum = isset($overall_amount[0]['OverallTotal']) ? number_format($overall_amount[0]['OverallTotal'], 0, '.', '') : '';
          $one = substr($sum, 0, 1);
          $two = substr($sum, 1, 1);
          $three = substr($sum, 2, 1);
          $four = substr($sum, 3, 1);
          $five = substr($sum, 4, 1);
        ?>
          <input type="text"  value="<?php echo $one;   ?>"    />
          <input type="text"  value="<?php echo $two;   ?>"    />
          <input type="text"  value="<?php echo $three; ?>"    />
          <input type="text"  value="<?php echo $four;  ?>"    /> 
          <input type="text"  value="<?php echo $five;  ?>"    />
          <input type="text"  />
          <input type="text"   value="0" style="margin-left: 76px;" />
          <input type="text"   value="0"  />
         </div>
      </div>
      <div class="print">
        <input type="radio" />
      </div>
      <div>
        <div class="ssn">
          <?php 
            $ssn = isset($info_for_nj[0]['social_security_number']) ? $info_for_nj[0]['social_security_number'] : '';
            for ($i = 0; $i < strlen($ssn); $i++) { ?>
            <input type="text" value="<?php echo $ssn[$i]; ?>" />
          <?php } ?>
        </div>
        <div class="fi">
          <?php 
            $firstName = isset($info_for_nj[0]['first_name']) ? $info_for_nj[0]['first_name'] : ''; 
            $fi = strtoupper(substr($firstName, 0, 1));
          ?>
          <input type="text" value="<?php echo $fi; ?>" />
        </div>
        <div class="mi">
          <?php 
            $middleName = isset($info_for_nj[0]['middle_name']) ? $info_for_nj[0]['middle_name'] : '';
            $mi = strtoupper(substr($middleName, 0, 1));
          ?>
          <input type="text" value="<?php echo $mi; ?>"/>
        </div>
        <div class="last">
          <?php 
            $lastName = isset($info_for_nj[0]['last_name']) ? $info_for_nj[0]['last_name'] : '';
            for ($i = 0; $i < strlen($lastName); $i++) {
                echo '<input type="text" value="' . strtoupper(substr($lastName, $i, 1)) . '" />'; 
            }
          ?>
        </div>
        <div class="example">
          <?php 
            $thisrate = isset($info_for_nj[0]['OverallTotal']) ? number_format($info_for_nj[0]['OverallTotal'], 0, '.', '') : '';
            $thisrate = str_replace('.', '', $thisrate);
            for ($i = 0; $i < strlen($thisrate); $i++) {
                echo '<input type="text" value="' . substr($thisrate, $i, 1) . '" />';
            }
          ?>
        </div>
        <div class="credit">
          <input type="text" />
          <input type="text" />
        </div>
      </div>
     <?php 
      $s = 1; 
      foreach ($info_for_nj as $value) { 
      ?>
        <div class="e<?php echo $s; ?>">
            <div class="ssn<?php echo $s; ?>">
                <?php 
                    $ssn = isset($value['social_security_number']) ? $value['social_security_number'] : '';
                    for ($i = 0; $i < strlen($ssn); $i++) { ?>
                    <input type="text" value="<?php echo $ssn[$i]; ?>" />
                <?php } ?>
            </div>

            <div class="fi<?php echo $s; ?>">
                <?php 
                    $firstName = isset($value['first_name']) ? $value['first_name'] : '';
                    $fi = strtoupper(substr($firstName, 0, 1));
                ?>
                <input type="text" value="<?php echo $fi; ?>" />
            </div>

            <div class="mi<?php echo $s; ?>">
                <?php 
                    $middleName = isset($value['middle_name']) ? $value['middle_name'] : '';
                    $mi = strtoupper(substr($middleName, 0, 1));
                ?>
                <input type="text" value="<?php echo $mi; ?>" />
            </div>

            <div class="last<?php echo $s; ?>">
                <?php 
                    $lastName = isset($value['last_name']) ? $value['last_name'] : '';
                    $lastName = substr($lastName, 0, 15);
                    for ($i = 0; $i < strlen($lastName); $i++) {
                        echo '<input type="text" value="' . strtoupper(substr($lastName, $i, 1)) . '" />'; 
                    }
                ?>
            </div>

            <div class="example<?php echo $s; ?>">
                <?php 
                    $thisrate = isset($value['OverallTotal']) ? number_format($value['OverallTotal'], 0, '.', '') : '';
                    for ($i = 0; $i < strlen($thisrate); $i++) {
                        echo '<input type="text" value="' . substr($thisrate, $i, 1) . '" />';
                    }
                ?>
            </div>

            <div class="credit<?php echo $s; ?>">
                <input type="text" />
                <input type="text" />
            </div>
        </div>
      <?php $s++; } ?>

     <div class="l11">
        <input type="text"  value='<?php echo $currency . number_format(isset($overall_amount[0]['OverallTotal']) ? $overall_amount[0]['OverallTotal'] : 0, 0, '.', ''); ?>'/>
      </div>   
      <div class="l11a">
        <?php 
        $sum = isset($overall_amount[0]['OverallTotal']) ? number_format($overall_amount[0]['OverallTotal'], 0, '.', '') : '';
        ?>
         <?php 
             $one = substr($sum, 0, 1);
             $two = substr($sum, 1, 1);
             $three = substr($sum, 2, 1);
             $four = substr($sum, 3, 1);
             $five = substr($sum, 4, 1);
        ?>
          <input type="text"  value="<?php echo $one;   ?>"  />
          <input type="text"  value="<?php echo $two;   ?>"  style="margin-left:-4px;"  />
          <input type="text"  value="<?php echo $three; ?>"  style="margin-left:-2px;"  />
          <input type="text"  value="<?php echo $four;  ?>"  style="margin-left:-1px;"  /> 
          <input type="text"  value="<?php echo $five;  ?>"  style="margin-left:-4px;"  />
          <input type="text"  />
          <input type="text"   value="0" style="margin-left: 8px;" />
          <input type="text"   value="0"  />
        </div>
      <div class="l12">
        <input type="text" value='<?php  echo count($info_for_nj);  ?>'/>
      </div>
      <div class="l13">
        <input type="text">
      </div>
      <div class="l13b">
        <input type="text">
      </div>
    </div>
  </body>
<?php 
  $modaldata['bootstrap_modals'] = array('generatedownload');
  $this->load->view('include/bootstrap_modal', $modaldata);
?>  
<style>
.page-1 {
  width: 21cm;
  height: 29.7cm;
  position: relative;
  margin: 0 auto;
  page-break-after: always;
}
.sample-typed input {
  height: 17px;
  width: 17px;
  margin-left: -4px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  text-align: center !important;
}
.sample-typed {
  position: absolute;
  top: 127px;
    left: 101px;
}
.sample-typed .grid{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 2px;
}
.sample-handwritten input {
  height: 17px;
  width: 17px;
  margin-left: -1px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  text-align: center !important;
}
.sample-handwritten {
  position: absolute;
  top: 127px;
  left: 354px;
}
.sample-handwritten .grid{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 2px;
}
.wages .grid{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 2px;   
}
.ename input {
  height: 20px;
  width: 206px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
}
.ename {
  position: absolute;
  top: 192px;
  left: 46px;
}
.acc-no input {
  height: 20px;
  width: 155px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
}
.acc-no {
  position: absolute;
  top: 192px;
  left: 260px;
}
.check-digi input {
  height: 20px;
  width: 19px;
  border: 0px !important;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  text-align: center !important;
}
.check-digi {
  position: absolute;
  top: 192px;
  left: 427px;
}
.year input {
  height: 20px;
  width: 104px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  text-align: center !important;
}
.year {
  position: absolute;
  top: 192px;
  left: 454px;
}
.date input {
  height: 20px;
  width: 174px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
}
.date {
  position: absolute;
  top: 192px;
  left: 575px;
}
.tele-1 input,
.tele-2 input {
  height: 20px;
  width: 297px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
}
.tele-1 {
  position: absolute;
  top: 246px;
  left: 47px;
}
.report input,
.page input,
.plant input {
  height: 22px;
  width: 45px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  text-align: center !important;
}
.report {
  position: absolute;
  top: 273px;
  left: 385px;
}
.page {
  position: absolute;
  top: 273px;
  left: 533px;
}
.plant {
  position: absolute;
  top: 273px;
  left: 677px;
}
.wages input {
  height: 20px;
  width: 16px;
  margin-left: -2px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  letter-spacing: 10px;
}
.wages {
  position: absolute;
  top: 345px;
  left: 43px;
}
.print input {
  height: 33px;
  width: 18px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
}
.print {
  position: absolute;
  top: 312px;
    left: 707px;
}
/* e1 */
.ssn input {
  height: 22px;
  width: 16px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.ssn {
  position: absolute;
  top: 420px;
  left: 42px;
}
.fi input,
.mi input {
  height: 22px;
  width: 16px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
}
.fi {
  position: absolute;
  top: 420px;
  left: 213px;
}
.mi {
  position: absolute;
  top: 420px;
  left: 241px;
}
.last input,
.example input {
 height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last {
  position: absolute;
  top: 420px;
  left: 272px;
}
.example {
  position: absolute;
  top: 420px;
  left: 548px;
}
.credit input {
  height: 22px;
  width: 16px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  /* margin-left: 1px; */
}
.credit {
  position: absolute;
  top: 420px;
  left: 718px;
}
/* e2 */
.ssn2 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
  }
 .e1 {display:none;}
.ssn2 {
  position: absolute;
  top: 445px;
  left: 39px;
}
.fi2 input,
.mi2 input {
  height: 22px;
  width: 16px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
}
.fi2 {
  position: absolute;
  top: 445px;
  left: 213px;
}
.mi2 {
  position: absolute;
  top: 445px;
  left: 241px;
}
.last2 input,
.example2 input {
height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last2 {
  position: absolute;
  top: 445px;
  left: 270px;
}
.example2 {
  position: absolute;
  top: 445px;
  left: 548px;
}
.credit2 input {
  height: 22px;
  width: 16px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  /* margin-left: 1px; */
}
.credit2 {
  position: absolute;
  top: 445px;
  left: 718px;
}
/* e3 */
.ssn3 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
  }
.ssn3 {
  position: absolute;
  top: 471px;
  left: 43px;
}
.fi3 input,
.mi3 input {
  height: 22px;
  width: 16px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
}
.fi3 {
  position: absolute;
  top: 471px;
  left: 213px;
}
.mi3 {
  position: absolute;
  top: 471px;
  left: 241px;
}
.last3 input,
.example3 input {
  height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last3 {
  position: absolute;
  top: 471px;
  left: 271px;
}
.example3 {
  position: absolute;
  top: 471px;
  left: 550px;
}
.credit3 input {
  height: 22px;
  width: 16px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  /* margin-left: 1px; */
}
.credit3 {
  position: absolute;
  top: 498px;
  left: 718px;
}
/* e4 */
.ssn4 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
  }
.ssn4 {
  position: absolute;
  top: 498px;
  left: 42px;
}
.fi4 input,
.mi4 input {
  height: 22px;
  width: 16px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
}
.fi4 {
  position: absolute;
  top: 498px;
  left: 213px;
}
.mi4 {
  position: absolute;
  top: 498px;
  left: 241px;
}
.last4 input,
.example4 input {
  height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last4 {
  position: absolute;
  top: 498px;
  left: 270px;
}
.example4 {
  position: absolute;
  top: 498px;
  left: 548px;
}
.credit4 input {
  height: 22px;
  width: 16px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  /* margin-left: 1px; */
}
.credit4 {
  position: absolute;
  top: 498px;
  left: 718px;
}
/* e5 */
.ssn5 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
  }
.ssn5 {
  position: absolute;
  top: 522px;
  left: 42px;
}
.fi5 input,
.mi5 input {
  height: 22px;
  width: 16px;
  border: 0px red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
}
.fi5 {
  position: absolute;
  top: 522px;
  left: 213px;
}
.mi5 {
  position: absolute;
  top: 522px;
  left: 241px;
}
.last5 input,
.example5 input {
  height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last5 {
  position: absolute;
  top: 522px;
  left: 270px;
}
.example5 {
  position: absolute;
  top: 522px;
  left: 548px;
}
.credit5 input {
  height: 22px;
  width: 16px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  /* margin-left: 1px; */
}
.credit5 {
  position: absolute;
  top: 522px;
  left: 718px;
}
/* e6 */
.ssn6 input {
    height: 22px;
    width: 16px;
    border:0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn6 {
    position: absolute;
    top: 548px;
    left: 42px;
}
.fi6 input,
.mi6 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi6 {
    position: absolute;
    top: 548px;
    left: 213px;
}
.mi6 {
    position: absolute;
    top: 548px;
    left: 241px;
}
.last6 input,
.example6 input {
  height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last6 {
    position: absolute;
    top: 548px;
    left: 270px;
}
.example6 {
    position: absolute;
    top: 548px;
    left: 548px;
}
.credit6 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit6 {
    position: absolute;
    top: 548px;
    left: 718px;
}
/* e7 */
.ssn7 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn7 {
    position: absolute;
    top: 572px;
    left: 42px;
}
.fi7 input,
.mi7 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi7 {
    position: absolute;
    top: 572px;
    left: 213px;
}
.mi7 {
    position: absolute;
    top: 572px;
    left: 241px;
}
.last7 input,
.example7 input {
  height: 22px;
  width: 19.5px;
  border: 0 red solid;
  background-color: transparent !important;
  margin-left: -1px;
  text-align: center !important;
  margin-left: -2px;
}
.last7 {
    position: absolute;
    top: 572px;
    left: 270px;
}
.example7 {
    position: absolute;
    top: 572px;
    left: 572px;
}
.credit7 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit7 {
    position: absolute;
    top: 572px;
    left: 718px;
}
/* e8 */
.ssn8 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn8 {
    position: absolute;
    top: 597px;
    left: 42px;
}
.fi8 input,
.mi8 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi8 {
    position: absolute;
    top: 597px;
    left: 213px;
}
.mi8 {
    position: absolute;
    top: 597px;
    left: 241px;
}
.last8 input,
.example8 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    margin-left: 1px;
}
.last8 {
    position: absolute;
    top: 597px;
    left: 270px;
}
.example8 {
    position: absolute;
    top: 597px;
    left: 548px;
}
.credit8 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit8 {
    position: absolute;
    top: 597px;
    left: 718px;
}
/* e9 */
.ssn9 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn9 {
    position: absolute;
    top: 623px;
    left: 42px;
}
.fi9 input,
.mi9 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi9 {
    position: absolute;
    top: 623px;
    left: 213px;
}
.mi9 {
    position: absolute;
    top: 623px;
    left: 241px;
}
.last9 input,
.example9 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last9 {
    position: absolute;
    top: 623px;
    left: 270px;
}
.example9 {
    position: absolute;
    top: 623px;
    left: 548px;
}
.credit9 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit9 {
    position: absolute;
    top: 623px;
    left: 718px;
}
/* e10 */
.ssn10 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn10 {
    position: absolute;
    top: 649px;
    left: 42px;
}
.fi10 input,
.mi10 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi10 {
    position: absolute;
    top: 649px;
    left: 213px;
}
.mi10 {
    position: absolute;
    top: 649px;
    left: 241px;
}
.last10 input,
.example10 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last10 {
    position: absolute;
    top: 649px;
    left: 270px;
}
.example10 {
    position: absolute;
    top: 649px;
    left: 548px;
}
.credit10 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit10 {
    position: absolute;
    top: 649px;
    left: 718px;
}
/* e11 */
.ssn11 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn11 {
    position: absolute;
    top: 674px;
    left: 42px;
}
.fi11 input,
.mi11 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi11 {
    position: absolute;
    top: 674px;
    left: 213px;
}
.mi11 {
    position: absolute;
    top: 674px;
    left: 241px;
}
.last11 input,
.example11 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last11 {
    position: absolute;
    top: 674px;
    left: 270px;
}
.example11 {
    position: absolute;
    top: 674px;
    left: 548px;
}
.credit11 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit11 {
    position: absolute;
    top: 674px;
    left: 718px;
}
/* e12 */
.ssn12 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn12 {
    position: absolute;
    top: 700px;
    left: 42px;
}
.fi12 input,
.mi12 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi12 {
    position: absolute;
    top: 700px;
    left: 213px;
}
.mi12 {
    position: absolute;
    top: 700px;
    left: 241px;
}
.last12 input,
.example12 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last12 {
    position: absolute;
    top: 700px;
    left: 270px;
}
.example12 {
    position: absolute;
    top: 700px;
    left: 548px;
}
.credit12 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit12 {
    position: absolute;
    top: 700px;
    left: 718px;
}
/* e13 */
.ssn13 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn13 {
    position: absolute;
    top: 725px;
    left: 42px;
}
.fi13 input,
.mi13 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi13 {
    position: absolute;
    top: 725px;
    left: 213px;
}
.mi13 {
    position: absolute;
    top: 725px;
    left: 241px;
}
.last13 input,
.example13 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last13 {
    position: absolute;
    top: 725px;
    left: 270px;
}
.example13 {
    position: absolute;
    top: 725px;
    left: 548px;
}
.credit13 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.credit13 {
    position: absolute;
    top: 725px;
    left: 718px;
}

.ssn14 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn14 {
    position: absolute;
    top: 750px;
    left: 42px;
}
.fi14 input,
.mi14 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi14 {
    position: absolute;
    top: 750px;
    left: 213px;
}
.mi14 {
    position: absolute;
    top: 750px;
    left: 241px;
}
.last14 input,
.example14 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last14 {
    position: absolute;
    top: 750px;
    left: 270px;
}
.example14 {
    position: absolute;
    top: 750px;
    left: 548px;
}
.credit14 input {
    height:22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit14 {
    position: absolute;
    top: 750px;
    left: 718px;
}
/* e15 */
.ssn15 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn15 {
    position: absolute;
    top: 774px;
    left: 42px;
}
.fi15 input,
.mi15 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi15 {
    position: absolute;
    top: 774px;
    left: 213px;
}
.mi15 {
    position: absolute;
    top: 774px;
    left: 241px;
}
.last15 input,
.example15 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last15 {
    position: absolute;
    top: 774px;
    left: 270px;
}
.example15 {
    position: absolute;
    top: 774px;
    left: 548px;
}
.credit15 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit15 {
    position: absolute;
    top: 774px;
    left: 718px;
}
/* e16 */
.ssn16 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn16 {
    position: absolute;
    top: 799px;
    left: 42px;
}
.fi16 input,
.mi16 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi16 {
    position: absolute;
    top: 799px;
    left: 213px;
}
.mi16 {
    position: absolute;
    top: 799px;
    left: 241px;
}
.last16 input,
.example16 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last16 {
    position: absolute;
    top: 799px;
    left: 270px;
}
.example16 {
    position: absolute;
    top: 799px;
    left: 548px;
}
.credit16 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit16 {
    position: absolute;
    top: 799px;
    left: 718px;
}
/* e17 */
.ssn17 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn17 {
    position: absolute;
    top: 824px;
    left: 42px;
}
.fi17 input,
.mi17 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi17 {
    position: absolute;
    top: 824px;
    left: 213px;
}
.mi17 {
    position: absolute;
    top: 824px;
    left: 241px;
}
.last17 input,
.example17 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last17 {
    position: absolute;
    top: 824px;
    left: 270px;
}
.example17 {
    position: absolute;
    top: 824px;
    left: 548px;
}
.credit17 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit17 {
    position: absolute;
    top: 824px;
    left: 718px;
}
/* e18 */
.ssn18 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn18 {
    position: absolute;
    top: 850px;
    left: 42px;
}
.fi18 input,
.mi18 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi18 {
    position: absolute;
    top: 850px;
    left: 213px;
}
.mi18 {
    position: absolute;
    top: 850px;
    left: 241px;
}
.last18 input,
.example18 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last18 {
    position: absolute;
    top: 850px;
    left: 270px;
}
.example18 {
    position: absolute;
    top: 850px;
    left: 548px;
}
.credit18 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit18 {
    position: absolute;
    top: 850px;
    left: 718px;
}
/* e19 */
.ssn19 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn19 {
    position: absolute;
    top: 876px;
    left: 42px;
}
.fi19 input,
.mi19 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi19 {
    position: absolute;
    top: 876px;
    left: 213px;
}
.mi19 {
    position: absolute;
    top: 876px;
    left: 241px;
}
.last19 input,
.example19 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last19 {
    position: absolute;
    top: 876px;
    left: 270px;
}
.example19 {
    position: absolute;
    top: 876px;
    left: 548px;
}
.credit19 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    /* margin-left: 1px; */
}
.credit19 {
    position: absolute;
    top: 876px;
    left: 718px;
}
/* e20 */
.ssn20 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: -2px;
}
.ssn20 {
    position: absolute;
    top: 903px;
    left: 42px;
}
.fi20 input,
.mi20 input {
    height: 22px;
    width: 16px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.fi20 {
    position: absolute;
    top: 903px;
    left: 213px;
}
.mi20 {
    position: absolute;
    top: 903px;
    left: 241px;
}
.last20 input,
.example20 input {
    height: 22px;
    width: 16.5px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.last20 {
    position: absolute;
    top: 903px;
    left: 270px;
}
.example20 {
    position: absolute;
    top: 903px;
    left: 548px;
}
.credit20 input {
    height: 22px;
    width: 16px;
    border: 0 red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
}
.credit20 {
    position: absolute;
    top: 903px;
    left: 718px;
}
.l11 input ,.l12 input,.l13 input,.l13b input{
    height: 18px;
    width: 70px;
    background-color: transparent;
    border: 0;
}
.l11{
    position: absolute;
    bottom: 158px;
    left: 360px;
}
.l11a input {
    height: 22px;
    width: 16.5px;
    border: 0px red solid;
    background-color: transparent !important;
    margin-left: -1px;
    text-align: center !important;
    margin-left: 1px;
}
.l11a {
    position: absolute;
    top: 945px;
    left: 548px;
}
.l12{
    position: absolute;
    bottom: 141px;
    left: 417px;
}
.l13{
    position: absolute;
    bottom: 111px;
    left: 389px;
}
.l13b{
    position: absolute;
    bottom: 111px;
    left: 436px;
}
input {
  border: 0;
  background-color: transparent;
}
  </style>
</html>

<script>
$(document).ready(function() {
     downloadPagesAsPDF();
});
async function downloadPagesAsPDF() {
  $('#generatedownload').modal('show');
  const elements = [document.getElementById('one')];
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
        pdf.save(`UC-2A_${formattedDateTime}.pdf`);
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('An error occurred while generating the PDF. Please try again.');
        $('#generatedownload').modal('hide');
    }
}
</script>
