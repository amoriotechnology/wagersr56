<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <body bgcolor="#A0A0A0" vlink="blue" link="blue"   >
<div id="download"  >
<div class="a4-size"  id="one"  >
      <div class="f927-img1"  >
        <img src="<?php echo base_url()  ?>assets/images/f927_1.jpg"  width="100%"   />
     </div>
      <div class="fein">
        <input type="text"  value="<?php echo $get_cominfo[0]["Federal_Pin_Number"];?>"  />
      </div>
      <div class="business-name">
        <input type="text" value="<?php echo $get_cominfo[0]['company_name'];?>" />
      </div>
      <div class="yr">
        <input type="text" value="<?php 
                  if ($quarter == 'Q1') {
                      echo '1';
                  } elseif ($quarter == 'Q2') {
                      echo '2';
                  } elseif ($quarter == 'Q3') {
                      echo '3';
                  } elseif ($quarter == 'Q4') {
                      echo '4';
                  } else {
                       echo 'Unknown';
                  }
              ?> / <?php echo date('Y'); ?>" />
      </div>
      <?php
if ($quarter == 'Q1') {
$quarter_end_date = date('m-d-Y', strtotime('last day of March'));
} elseif ($quarter == 'Q2') {
$quarter_end_date = date('m-d-Y', strtotime('last day of June'));
} elseif ($quarter == 'Q3') {
$quarter_end_date = date('m-d-Y', strtotime('last day of September'));
} elseif ($quarter == 'Q4') {
$quarter_end_date = date('m-d-Y', strtotime('last day of December'));
} else {
$quarter_end_date = 'Unknown';
}
?>
      <div class="quater-ending-date">
        <input type="text" value="<?php echo $quarter_end_date; ?>" />
      </div>
      <div class="Date-fleid">
        <input type="text" value="" />
      </div>
      <?php
$quarter_end_dates = [
    'Q1' => 'last day of March',
    'Q2' => 'last day of June',
    'Q3' => 'last day of September',
    'Q4' => 'last day of December'
];
if (isset($quarter) && array_key_exists($quarter, $quarter_end_dates)) {
    $quarter_end_date = new DateTime($quarter_end_dates[$quarter]);
    $return_due_date = $quarter_end_date->modify('+30 days')->format('m-d-Y');
} else {
}
?>
      <div class="return-due">
        <input type="text" value="<?php echo $return_due_date; ?>" />
      </div>
      <?php
if ($quarter == 'Q1') {
    $quarter_end_date = date('Y-m-d', strtotime('last day of March'));
    $return_due_date = date('Y-m-d', strtotime('+45 days', strtotime($quarter_end_date)));
} elseif ($quarter == 'Q2') {
    $quarter_end_date = date('Y-m-d', strtotime('last day of June'));
    $return_due_date = date('Y-m-d', strtotime('+45 days', strtotime($quarter_end_date)));
} elseif ($quarter == 'Q3') {
    $quarter_end_date = date('Y-m-d', strtotime('last day of September'));
    $return_due_date = date('Y-m-d', strtotime('+45 days', strtotime($quarter_end_date)));
} elseif ($quarter == 'Q4') {
    $quarter_end_date = date('Y-m-d', strtotime('last day of December'));
    $return_due_date = date('Y-m-d', strtotime('+45 days', strtotime($quarter_end_date)));
} else {
    $quarter_end_date = 'Unknown';
    $return_due_date = 'Unknown';
}
$total_overall = 0;

foreach ($info_for_nj as $amount) {
    $total_overall += $amount['OverallTotal'];
}
?>
<div class="git-mon1">
        <input type="text" value="$<?php echo round($quarterData[0]['amount'],2); ?>" />
</div>
      <div class="git-mon2">
 <input type="text" value="$<?php echo round($quarterData[1]['amount'],2); ?>" />
    </div>
      <div class="git-mon3">
   <input type="text" value="$<?php echo round($quarterData[2]['amount'],2); ?>" />
      </div>
      <div class="e1">
        <input type="text" value="$<?php echo  round( $total_overall , 2 );   ?>" />
      </div>
      <div class="e2">
        <input type="text" value="$<?php echo round($quarterData[0]['amount']+$quarterData[1]['amount']+$quarterData[2]['amount']  ,2); ?>" />
      </div>
      <div class="e3">
        <input type="text" value="$0" />
      </div>
      <div class="e3a">
        <input type="text" value="$0" />
      </div>
      <div class="e4">
        <input type="text" value="$0" />
      </div>
      <div class="e5">
        <input type="text" value="$0" />
      </div>
      <div class="e5a">
        <input type="text" value="$0" />
      </div>
      <div class="e6">
        <input type="text" value="$0" />
      </div>
      <div class="e7">
     <?php
if ($quarter == 'Q1') {
    echo '<input type="text" value="' . $month['month_1_total_count'] . '" />';
} elseif ($quarter == 'Q2') {
    echo '<input type="text" value="' . $month['month_1_total_count'] . '" />';
} elseif ($quarter == 'Q3') {
    echo '<input type="text" value="' . $month['month_1_total_count'] . '" />';
} else {
    echo '<input type="text" value="' . $month['month_1_total_count'] . '" />';
}
?>
      </div>
      <div class="e7b">
         <?php
if ($quarter == 'Q1') {
    echo '<input type="text" value="' . $month['month_2_total_count'] . '" />';
} elseif ($quarter == 'Q2') {
    echo '<input type="text" value="' . $month['month_2_total_count'] . '" />';
} elseif ($quarter == 'Q3') {
    echo '<input type="text" value="' . $month['month_2_total_count'] . '" />';
} else {
    echo '<input type="text" value="' . $month['month_2_total_count'] . '" />';
}
?>
      </div>
      <div class="e7c">
        <?php
if ($quarter == 'Q1') {
    echo '<input type="text" value="' . $month['month_3_total_count'] . '" />';
} elseif ($quarter == 'Q2') {
    echo '<input type="text" value="' . $month['month_3_total_count'] . '" />';
} elseif ($quarter == 'Q3') {
    echo '<input type="text" value="' . $month['month_3_total_count'] . '" />';
} else {
    echo '<input type="text" value="' . $month['month_3_total_count'] . '" />';
}
?>
    </div>
    </div>
    <div class="page-2"  id="two"  >
      <div class="f927-img2"  >
         <img src="<?php echo base_url()  ?>assets/images/f927_2.jpg"  width="100%"   />
      </div>
      <div class="e8">
        <input type="text" value="$<?php echo  round($total_overall ,2);  ?>" />
      </div>
      <div class="e9">
        <input type="text" value="$0" />
      </div>
      <div class="e10">
        <input type="text" value="$<?php echo  round($total_overall  ,2); ?>" />
      </div>
      <div class="e11">
        <input type="text" value="$<?php echo  round($total_overall  ,2); ?>" />
      </div>
      <div class="e12">
        <input type="text" value="$<?php echo  round($total_overall  ,2); ?>" />
      </div>
    <?php
if(isset($total_overall)  ) {
    $overallTotal = floatval($total_overall);
    $saleOverallTotal = floatval($info_info_for_salescommssion_data[0]['SaleOverallTotal']);
    if(is_numeric($overallTotal)  ) {
     $ulandwf = $overallTotal * 0.038250;
        $formattedValue = number_format($ulandwf, 2); 
        echo "$formattedValue";
    } else {
    }
} else {
}
?>
      <div class="e13">
        <input type="text" value="$<?php echo round($ulandwf,2); ?>" />
      </div>
<?php
if(isset($total_overall)  ) {
    $overallTotal = floatval($total_overall);
    $saleOverallTotal = floatval($info_info_for_salescommssion_data[0]['SaleOverallTotal']);
    if(is_numeric($overallTotal)  ) {
        $ulandwf2 =  $overallTotal   * 0.005;
        $formattedValue = number_format($ulandwf2, 2); 
        echo "$formattedValue";
    } else {
    }
} else {
}
?>
      <div class="e14">
        <input type="text" value="$<?php echo round($ulandwf2,2); ?>" />
      </div>
<?php
if(isset($total_overall)  ) {
    $overallTotal = floatval($total_overall);
    $saleOverallTotal = floatval($info_info_for_salescommssion_data[0]['SaleOverallTotal']);
    if(is_numeric($overallTotal)  ) {
        $ulandwf3 = $overallTotal  * 0.000900;
        $formattedValue = number_format($ulandwf3, 2);
        echo "$formattedValue";
    } else {
    }
} else {
}
?>
      <div class="e15">
        <input type="text" value="$<?php echo round($ulandwf3,2); ?>" />
      </div>
      <?php
if (isset($ulandwf) && isset($ulandwf2) && isset($ulandwf3)) {
    $sum = $ulandwf + $ulandwf2 + $ulandwf3;
} else {
}
?> 
      <div class="e16">
        <input type="text" value="$0" />
      </div>
      <div class="e16a">
        <input type="text" value="$0" />
      </div>
      <div class="e17">
        <input type="text" value="$<?php echo round($sum,2); ?>" />
      </div>
      <div class="e18">
        <input type="text" value="$0" />
      </div>
      <div class="e19">
        <input type="text" value="$0" />
      </div>
      <div class="e20">
        <input type="text" value="$0" />
      </div>
      <div class="e20a">
        <input type="text" value="$<?php echo round($quarterData[0]['amount']+$quarterData[1]['amount']+$quarterData[2]['amount']  ,2); ?>" />
      </div>
      <div class="e20b">
        <input type="text" value="$ <?php echo round($sum,2); ?>" />
      </div>
      <div class="e20c">
        <input type="text" value="$ <?php echo round(($quarterData[0]['amount']+$quarterData[1]['amount']+$quarterData[2]['amount'])+$sum,2); ?>" />
      </div>
      <div class="e21a">
        <input type="text" value="$0" />
      </div>
      <div class="e21b">
        <input type="text" value="$0" />
      </div>
      <div class="e21c">
        <input type="text" value="$0" />
      </div>
      <img src="<?php echo base_url()  ?>assets/images/f927_3.png" style="position:absolute;top:850px;left:105px;"     />
    </div>
  </body>
  <style>
    .a4-size,
    .page-2 {
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
    .f927-img1 {
      position: relative;
    }
    .f927-img2 {
      position: relative;
    }
    .fein {
      position: absolute;
      top: 201px;
      left: 238px;
    }
    .business-name {
      position: absolute;
      top: 233px;
      left: 238px;
    }
    .yr {
      position: absolute;
      top: 201px;
      left: 569px;
    }
    .quater-ending-date {
      position: absolute;
      top: 279px;
      left: 236px;
    }
    .Date-fleid {
      position: absolute;
      top: 300px;
      left: 229px;
    }
    .return-due {
      position: absolute;
      top: 280px;
      left: 570px;
    }
    .git-mon1 {
      position: absolute;
      top: 488px;
      left: 391px;
    }
    .git-mon2 {
      position: absolute;
      top: 488px;
      left: 522px;
    }
    .git-mon3 {
      position: absolute;
      top: 488px;
      left: 644px;
    }
    .e1 {
      position: absolute;
      top: 630px;
      left: 393px;
    }
    .e2 {
      position: absolute;
      top: 663px;
      left: 393px;
    }
    .e3 {
      position: absolute;
      top: 695px;
      left: 393px;
    }
    .e3a {
      position: absolute;
      top: 694px;
      left: 636px;
    }
    .e4 {
      position: absolute;
      top: 726px;
      left: 393px;
    }
    .e5 {
      position: absolute;
      top: 764px;
      left: 393px;
    }
    .e5a {
      position: absolute;
      top: 762px;
      left: 636px;
    }
    .e6 {
      position: absolute;
      top: 796px;
      left: 393px;
    }
    .e7 {
      position: absolute;
      top: 1000px;
      left: 393px;
    }
    .e7b {
      position: absolute;
      top: 1000px;
      left: 525px;
    }
    .e7c {
      position: absolute;
      top: 1000px;
      left: 648px;
    }
    .e8 {
      position: absolute;
      top: 111px;
      left: 393px;
    }
    .e9 {
      position: absolute;
      top: 142px;
      left: 393px;
    }
    .e10 {
      position: absolute;
      top: 175px;
      left: 393px;
    }
    .e11 {
      position: absolute;
       top: 208px;
      left: 393px;
    }
    .e12 {
      position: absolute;
       top: 239px;
      left: 393px;
    }
    .e13 {
      position: absolute;
       top: 273px;
      left: 393px;
    }
    .e14 {
      position: absolute;
       top: 305px;
      left: 393px;
    }
    .e15 {
      position: absolute;
       top: 337px;
      left: 393px;
    }
    .e16 {
      position: absolute;
      top: 370px;
      left: 393px;
    }
    .e16a {
      position: absolute;
      top: 371px;
    left: 642px;
    }
    .e17 {
      position: absolute;
      top: 401px;
      left: 393px;
    }
    .e18 {
      position: absolute;
      top: 434px;
      left: 393px;
    }
    .e19 {
      position: absolute;
      top: 522px;
    left: 650px;
    }
    .e20 {
      position: absolute;
      top: 575px;
    left: 653px;
    }
    .e20a {
      position: absolute;
      top: 770px;
    left: 328px;
    }
    .e20b {
      position: absolute;
      top: 770px;
    left: 480px ;
    }
    .e20c {
      position: absolute;
      top: 770px;
    left: 634px;
    }
    .e21a {
      position: absolute;
      top: 799px;
    left: 328px;
    }
    .e21b {
      position: absolute;
      top: 799px;
      left: 480px ;
    }
    .e21c {
      position: absolute;
      top: 799px;
      left: 634px;
    }
  </style>
</html>
</div>
<?php
  $modaldata['bootstrap_modals'] = array('generatedownload');
  $this->load->view('include/bootstrap_modal', $modaldata);
?>
</div>
<script>
$(document).ready(function() {
    downloadPagesAsPDF();
});
async function downloadPagesAsPDF() {
  $('#generatedownload').modal('show');
  const elements = [
    document.getElementById('one'),
    document.getElementById('two'),
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
        pdf.save(`NJ927_${formattedDateTime}.pdf`);
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('An error occurred while generating the PDF. Please try again.');
        $('#generatedownload').modal('hide');
    }
}
</script>