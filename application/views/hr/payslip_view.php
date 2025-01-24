<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
<!-- Add new customer start -->
<style type="text/css">
  .panel-body{
    padding:25px;
  }

  .dot1, .dot2, .dot3, .dot4, .dot5, .dot6 {
    height: 25px;
    width: 25px;
    background-color: #D7163A;
    display: inline-block;
  }
  .colorpad:hover {
  color: #f4511e;
  }

  #templates>img:hover {
    background-color: orange;
    border: 1px solid orange;
  }

  #templates>img {
    width: 50%;
  }

  #templatetext {
    margin-left:20px;
      font-size: 10px;
    font-style: italic;
    font-family: ui-monospace;
  }

  .logo-9 i{
    font-size:80px;
    position:absolute;
    z-index:0;
    text-align:center;
    width:100%;
    left:0;
    top:-10px;
    color:#34495e;
    -webkit-animation:ring 2s ease infinite;
    animation:ring 2s ease infinite;
  }

  .logo-9 h1{
    font-family: 'Lora', serif;
    font-weight:600;
    text-transform:uppercase;
    font-size:40px;
    position:relative;
    z-index:1;
    color:#e74c3c;
    text-shadow: 3px 3px 0 #fff, -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff;
  }
    
  .logo-9{
    position: relative;
  } 
    
  /*//side*/   
  .bar {
    float: left;
    width: 25px;
    height: 3px;
    border-radius: 4px;
    background-color: #4b9cdb;
  }

  .load-10 .bar {
    animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
  }

  @keyframes loadingJ {
    0%,
    100% {
      transform: translate(0, 0);
    }

    50% {
      transform: translate(80px, 0);
      background-color: #f5634a;
      width: 180px;
    }
  }

  .table td{
    padding:10px;
  }

  table {
    border: none;
    text-align: center;
    table-layout: fixed;
    margin: 0 auto;
  }


  table th {
    padding: 8px 14px;
    text-align: center;
  }
</style>


<div class="content-wrapper">
  <section class="content-header">
    <div class="header-icon">
      <figure class="one">
        <img src="<?= base_url('assets/images/pay.png'); ?>"  class="headshotphoto" style="height:50px;" />
      </figure>
    </div>
      
    <div class="header-title">
      <div class="logo-holder logo-9">
      <h1>Payslip Setting</h1>
    </div>
 
    <small><?= "" ?></small>
      <ol class="breadcrumb" style="border: 3px solid #d7d4d6;">
        <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
        <li><a href="#"><?= display('web_settings') ?></a></li>
        <li class="active" style="color:orange;" ><?= ('Payslip Setting') ?></li>
        <div class="load-wrapp"> 
          <div class="load-10">
            <div class="bar"></div>
          </div>
        </div>
      </ol>
    </div>
  </section>

  <section class="content">
    <!-- Alert Message -->      
    <?php
      $message = $this->session->userdata('message');
      if (isset($message)) { ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= $message ?>                    
        </div>
    <?php
      $this->session->unset_userdata('message'); }
      $error_message = $this->session->userdata('error_message');
      if (isset($error_message)) { ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= $error_message ?>                    
        </div>
    <?php $this->session->unset_userdata('error_message'); } ?>

    <!-- New customer -->
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag" >
            <div class="panel-heading" >
              <!-- <div class="panel-body"> -->
                <div class="panel-title">
                  <div class="">
                    <div class="row">
                      <div class="col-sm-3"> <div class="panel panel-default" style="text-align:center;">
                        <label> Payslip Template </label>

                          <div class="panel-body">
                            <table id="templateformart" >
                              <tr>
                                <td>
                                  <a href=<?= base_url('Chrm/updatepayslipinvoicedesign/1').'/'.$_SESSION['user_id']; ?> id='templates' >
                                    <img src="<?= base_url('assets/images/template_design/amall/1.png') ;?>">
                                    <p id='templatetext'>Classic</p>
                                  </a>                                  
                                </td>

                                <td>
                                  <a href=<?= base_url('Chrm/updatepayslipinvoicedesign/4').'/'.$_SESSION['user_id']; ?> id='templates' >
                                    <img src="<?= base_url('assets/images/template_design/amall/1.png') ;?>">
                                    <p id='templatetext'>UIC</p>
                                  </a>
                                </td>
                              </tr>
                            </table>
                          <br><br>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>

              <?php
                //////////////Design one///////////// 
                if($template==1) { ?>
                
                <div class="col-sm-9">
                  <div class="panel panel-default thumbnail">
                    <div class="panel-body">
                      <div  id="content"> 
                        <div class="payTop_details row">

                          <div class="col-md-6">
                            <p>
                              <strong>NAME</strong>:<br> 
                              <strong>PHONE</strong>:<br> 
                              <strong>ADDRESS</strong>:<br> 
                              <strong>  EMAIL</strong>:<br>
                            </p>
                          </div>
                          <!-- <div class="col-md-2"><img src="<?php //echo  $logo; ?>" width="50px;" height="50px;" /></div> -->
                          <div class="col-md-6">
                            <div style="float: right;"><strong>TIMESHEET ID</strong>:  
                              <br>
                              <span><strong>EMPLOYEE ID:</strong></span>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="col-md-4"></div>

                            <div class="col-md-4 Employee_details row" style='text-align:center;' >
                              <strong>EMPLOYEE NAME</strong> :   
                              <br>
                              <strong>EMPLOYEE TITLE</strong> :  
                            </div>
                            
                            <div class="col-md-4"></div>
                          </div>

                          <div class="col-md-12"><br/></div>
                          <div class="col-md-12" style="float:center;">

                          <table class="table">
                            <tr style="outline: thin solid" rowspan="6">
                              <th colspan="6">Earnings</th>
                            </tr>
                            
                            <tr style="height: 50px;">
                              <th>DESCRIPTION</th>
                              <th>HRS/ UNITS</th>
                              <th>RATE</th>
                              <th>THIS PERIOD($)</th>
                              <th>YTD HOURS</th>
                              <th>YTD($)</th>
                            </tr>

                            <tr style="height: 70px;">
                              <td>Salary</td>
                              <td> </td>
                              <td> </td>
                              <td id="total_period"></td>
                              <td></td>
                              <td id="total_ytd"></td>
                            </tr>
                          </table>
                        </div>

                        <div class="col-md-12"><br/></div>
                        <div class="col-md-12">

                        <div class="col-md-6">
                          <table class="proposedWork pay_table table" id="price">
                            <tr rowspan="6" style="outline: thin solid">
                              <th colspan="6">PERSONAL AND CHECK INFORMATION</th>
                            </tr>

                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Name  </td><td style="width:10px;"> :</td><td></td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Address  </td><td style="width:10px;"> :</td><td ></td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Emp.ID </td><td style="width:10px;"> :</td><td></td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Pay&nbsp;Period</td><td style="width:10px;"> :</td><td></td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Chq&nbsp;Date</td><td style="width:10px;"> :</td><td></td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Chq&nbsp;No</td><td style="width:10px;"> :</td><td> </td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Bank&nbsp;Name</td><td style="width:10px;"> :</td><td></td></tr>
                            <tr style="text-align:left;"><td style="font-weight:bold;width:180px;">Ref&nbsp;No</td><td style="width:10px;"> :</td><td> </td></tr>
                          </table>
                          <br/>

                          <table class="table">
                            <tr style="outline: thin solid" rowspan="3">
                              <th colspan="3">NET PAY ALLOCATION</th>
                            </tr>

                            <tr>
                              <th style="text-align:left;"><strong>DESCRIPTION</strong></th>
                              <th><strong>THIS PERIOD($)</strong></th>
                              <th><strong>YTD($)</strong></th>
                            </tr>

                            <tr>
                              <td style="text-align:left;"><strong>Check Amount</strong></td>
                              <td class="net_period"> <strong style="padding-top: 2px;">0.00</strong></td>
                              <td class="net_ytd">0.00</td>
                            </tr>

                            <tr>
                              <td style="text-align:left;"><strong>Chkg 404</strong></td>
                              <td>0.00</td>
                              <td>0.00 </td>
                            </tr>

                            <tr>
                              <td style="text-align:left;"><strong>NET PAY</strong></td>
                              <td class="net_period" style="font-weight:bold;border-top: groove;"></td>
                              <td class="net_ytd" style="font-weight:bold;border-top: groove;"></td>
                            </tr>
                          </table>
                        </div>

                        <div class="col-md-6">
                          <table class="table" style=" width: 100%; display: table-cell;">
                            <tr style="outline: thin solid" rowspan="6">
                              <th colspan="6">WITHHOLDINGS</th>
                            </tr>

                            <tr>
                              <th style="text-align:left;">DESCRIPTION</th>
                              <th>FILING STATUS</th>
                              <th>THIS PERIOD($)</th>
                              <th>YTD($)</th>
                            </tr>

                            <tr>
                              <td style="text-align:left;"> Social Security</td>
                              <td>S O</td>
                            </tr>

                            <tr>
                            <td style="text-align:left;">Madicare</td>
                            <td>SMCU O</td>

                            </tr>
                            <tr>
                              <td style="text-align:left;">Fed Income Tax</td>
                              <td></td>
                            </tr>

                            <tr>
                              <td style="text-align:left;">Unemployment Tax</td>
                              <td></td>
                            </tr>

                            <!--<tr>-->
                            <!-- <td style="text-align:left;"></td>-->
                            <!-- <td></td>-->
                            <!-- <td class="current">  </td>-->
                            <!-- <td class="ytd"></td>-->
                            <!--</tr>-->
                            <tr>
                              <td></td><td></td>
                              <td style="border-top: groove;" id="Total_current"></td><td style="border-top: groove;" id="Total_ytd"></td>
                            </tr>
                          </table>
                        </div>

                      </div>
                    </div>
                  </div>

            <?php } elseif($template==2) { ?>
            <div class="col-sm-9">
              <div class="panel panel-default thumbnail">
                <div class="panel-body">
                  <div  id="content">
                    <div class="payTop_details row">

                      <div class="col-md-12">
                        <div class="col-md-4">
                          <table class="top" style="border:none;">
                            <tr style="text-align:center;">
                              <th colspan="2" style="height: 40px;text-align: center;">EMPLOYEE INFO</th>
                            </tr>

                            <tr>
                              <td><strong>NAME : </strong></td>
                              <td></td>
                            </tr>

                            <tr>
                              <td><strong>TITLE</strong> :</td>
                              <td>  </td>
                            </tr>

                            <tr>
                              <td><strong>ID</strong> :</td>
                              <td> </td>
                            </tr>

                            <tr>
                              <td><strong>TIMESHEET ID</strong>:</td>
                              <td>  </td>
                            </tr>
                          </table>
                        </div>

                        <div class="col-md-4">
                          <table class="top" style="border:none;">
                            <tr  style="text-align:center;text-wrap: nowrap;">
                              <th colspan="2" style="height: 40px;text-align: center;">PERSONAL AND CHECK INFO</th>
                            </tr>

                            <tr>
                              <td><strong> NAME : </strong></td>
                              <td></td>
                            </tr>

                            <tr>
                              <td><strong>ID</strong> :</td>
                              <td>  </td>
                            </tr>

                            <tr>
                              <td><strong>Bank Name</strong>:</td>
                              <td>  </td>
                            </tr>

                            <tr>
                              <td><strong>Ref No</strong>:</td>
                              <td> </td>
                            </tr>

                          </table>
                        </div>

                        <div class="col-md-4">
                            <table class="top" style="border:none;">
                              <tr  style="text-align:center;">
                                <th colspan="2" style="height: 40px;text-align: center;">COMPANY INFO</th>
                              </tr>

                              <tr>
                                <td><strong>NAME : </strong></td>
                                <td></td>
                              </tr>

                              <tr>
                                <td><strong>Address</strong> :</td>
                                <td> </td>
                              </tr>

                              <tr>
                                <td><strong>Phone</strong> :</td>
                                <td>  </td>
                              </tr>

                              <tr>
                                <td><strong>Email</strong>:</td>
                                <td>  </td>
                              </tr>
                              
                            </table>
                        </div>
                      </div>
                    </div>
                    <br/>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <table class="top">
                            <tr  style="text-align:center;">
                              <th style="text-align: center;height: 30px;" colspan="2">EARNINGS</th>
                            </tr>
                            <tr><td><strong>DESCRIPTION :</strong></td><td>Salary</td></tr>
                            <tr><td><strong>HRS/ UNITS  :</strong></td><td> </td></tr>
                            <tr><td><strong>RATE  :</strong></td><td> </td></tr>
                            <tr><td><strong>THIS PERIOD($)  :</strong></td>  <td id="total_period"></td></tr>
                            <tr><td><strong>YTD HOURS  :</strong></td> <td></td></tr>
                            <tr><td><strong>YTD($)  :</strong></td><td id="total_ytd"></td></tr>
                          </table>

                          <table class="top">
                            <tr  rowspan="3">
                              <th style="height: 30px;text-align: center;" colspan="3">NET PAY ALLOCATION</th>
                            </tr>

                            <tr>
                              <td style="text-align:left;"><strong>DESCRIPTION</strong></td>
                              <td><strong>THIS PERIOD($)</strong></td>
                              <td><strong>YTD($)</strong></td>
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
                              <td class="net_period" style="font-weight:bold;border-top: groove;"></td>
                              <td class="net_ytd" style="font-weight:bold;border-top: groove;"></td>
                            </tr>
                          </table>
                        </div>

                        <div class="col-md-6">
                          <table class="top">
                            <tr  rowspan="6">
                              <th style="height: 40px;text-align: center;" colspan="4">WITHHOLDINGS</th>
                            </tr>

                            <tr>
                              <td style="font-size:12px;font-weight:bold;">DESCRIPTION</td>
                              <td style="font-size:12px;font-weight:bold;">FILING STATUS</td>
                              <td style="font-size:12px;font-weight:bold;">THIS PERIOD($)</td>
                              <td style="font-size:12px;font-weight:bold;">YTD($)</td>
                            </tr>

                            <tr>
                              <td style="text-align:left;font-weight:bold;"> Social Security</td>
                              <td>S O</td>
                              <td class="current"></td>
                              <td class="ytd"></td>
                            </tr>

                            <tr>
                              <td style="text-align:left;font-weight:bold;">Madicare</td>
                              <td>SMCU O</td>
                              <td class="current"></td>
                              <td class="ytd"></td>
                            </tr>

                            <tr>
                              <td style="text-align:left;font-weight:bold;">Fed Income Tax</td>
                              <td></td>
                              <td class="current"></td>
                              <td class="ytd"></td>
                            </tr>

                            <tr>
                              <td style="text-align:left;font-weight:bold;">Unemployment Tax</td>
                              <td></td>
                              <td class="current"></td>
                              <td class="ytd"></td>
                            </tr>

                            <!--<tr>-->
                            <!--<td style="text-align:left;font-weight:bold;"></td>-->
                            <!--<td></td>-->
                            <!-- <td class="current">  </td>-->
                            <!-- <td class="ytd"></td>-->
                            <!--</tr>-->
                            <tr>
                            <td></td><td></td>
                              <td style="border-top: groove;" id="Total_current"></td><td style="border-top: groove;" id="Total_ytd"></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php } else if($template==3) { ?>
                
              <?php } else if($template==4) { ?>

<style>
  .table td{
    padding:10px;
  }
  table {
    border: none;
    text-align: center;
    table-layout: fixed;
    margin: 0 auto; /* or margin: 0 auto 0 auto */
  }
    
table th {
  color:white;
  background-color: "<?= '#'.$color; ?>";
  padding: 8px 14px;
  text-align: center;
}

#forcolor{
  background-color: "<?= '#'.$color; ?>";
  padding: 8px 14px;
  text-align: center;  
}
   
.btn_upload {
  cursor: pointer;
  display: inline-block;
  overflow: hidden;
  position: relative;
  color: #fff;
  background-color: #2a72d4;
  border: 1px solid #166b8a;
  padding: 5px 10px;
}

.btn_upload:hover,
.btn_upload:focus {
  background-color: #7ca9e6;
}

.yes {
  display: flex;
  align-items: flex-start;
  margin-top: 10px !important;
}

.btn_upload input {
  cursor: pointer;
  height: 100%;
  position: absolute;
  filter: alpha(opacity=1);
  -moz-opacity: 0;
  opacity: 0;
}

.it {
  margin-left: 10px;
  height: 200px;
  width: 800px;
}

.btn-rmv1,
.btn-rmv2,
.btn-rmv3,
.btn-rmv4,
.btn-rmv5 {
  display: none;
}

.rmv {
  cursor: pointer;
  color: #fff;
  border-radius: 30px;
  border: 1px solid #fff;
  display: inline-block;
  /* background: rgba(255, 0, 0, 1); */
  margin: -5px -10px;
}

.rmv:hover {
  /* background: rgba(255, 0, 0, 0.5); */
}
</style>


<div class="payTop_details col-md-9" style="border:1px solid black;">
  <strong style='font-size:10px;margin-left: 7px'>Company Name-Phone Number -Email</strong>

    <table class="table">
      <tr>
      <th style="text-align: justify;background:none;color: black;" >Employee Name:</th>
      <th style="text-align: end;background:none;color: black;width: 310px;" >Employee Number:</th>
      </tr>
  </table>
  <div class="col-md-12"><br/></div>
  <div class="col-md-12" style="float:center;"><div>
    <table width="100%" height='100%' border="1">
      <tr style="background-color: #<?= $color; ?>;">
        <td><strong>Earnings</strong></td>
        <td><strong>Hours</strong></td>
        <td><strong>Amount</strong></td>
        <td><strong>Y-T-D</strong></td>
        <td><strong>Deductions</strong></td>
        <td><strong>Amount</strong></td>
        <td><strong>Y-T-D</strong></td>
      </tr>

      <tr style="background-color: #<?= $color; ?>;">
        <td><strong> Total</strong></td>
        <td><strong> </strong></td>
        <td><strong></strong></td>
        <td><strong> </strong></td>
        <td><strong>Total </strong></td>
        <td><strong></strong></td>
        <td><strong> </strong></td>
      </tr>
    </table>
    <br>
    
    <table class="table" >
      <tr>
        <th style="text-align: justify;background:none;color: black;" >Social Security Num:</th>
        <th style="text-align: end;background:none;color: black;width: 310px;" >Pay Period: </th>
      </tr>
    </table>

    <table class="table" >
      <tr>
      <th style="text-align: justify;background:none;color: black;border: none;" >Chk No:</th>
      <th style="background:none;color: black;border: none;text-align: right;" >Net Pay :<br> <h4><span class="net_ytd" style="border:none;"></h4></th>
    </tr>
  </table>
 
  <div class="yes">
    <img id="ImgPreview" src="" class="preview1" />
    <!-- <input type="button" id="removeImage1" value="x" class="btn-rmv1" style="width:30px;"  /> -->
    <img src="<?= base_url('assets/images/pay.png')  ?>"  class="headshotphoto" style="height:250px;margin-left:450px;" />
  </div>
</div>
</div>

<?php } ?>
</div>
