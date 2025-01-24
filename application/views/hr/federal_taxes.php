<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/toastr.min.css" />
<script src="<?php echo base_url()?>assets/js/toastr.min.js"></script>
<?php  error_reporting(1); ?>

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url(); ?>assets/images/taxes.png"  class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      
      <div class="header-title">
         <div class="logo-holder logo-9"><h1>Tax Ranges</h1></div>
 
       <small></small>
         <ol class="breadcrumb" style="border: 3px solid #d7d4d6;">
         <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li><a href="#">Taxes</a></li>
            <li class="active" style="color:orange">Tax Ranges</li>
         </ol>
      </div>
   </section>

 
   <section class="content">
      <?php
      $message = $this->session->userdata('message');
      $error_message = $this->session->userdata('error_message');

      if (isset($message) || isset($error_message)) { ?>
          <script type="text/javascript">
              <?php if (isset($message)) { ?>
                  toastr.success("<?php echo $message; ?>", "Success", { closeButton: false });
              <?php $this->session->unset_userdata('message'); } ?>

              <?php if (isset($error_message)) { ?>
                  toastr.error("<?php echo $message; ?>", "Error", { closeButton: false });
              <?php $this->session->unset_userdata('error_message'); } ?>
          </script>
      <?php } ?>
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <button class="btnclr btn" style="margin-left: 20px !important;" data-toggle="modal" data-target="#allForms"><i class="fa fa-wpforms" aria-hidden="true"></i> Forms</button>
                  </div>
               </div>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">Federal Taxes</h3>
                     <div class="col-sm-9 text-right">
                        
                     </div>
                     <br>

                     <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag" >
                           <div class="panel-body">
                              <div class="table-responsive" >
                                 <form action="<?php echo base_url(); ?>Chrm/add_taxes_detail" method="post">
                                  <table class="table table-hover table-bordered" cellspacing="0" width="100%" id="">
                                       <thead>
                                          <tr style="height:25px;">
                                             <th class='btnclr' style="width: 170px;"><?php echo display('sl') ?></th>
                                             <th class='btnclr' class="text-center">Tax Name</th>
                                             <th class='btnclr' class="text-center">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr role="row" class="odd">
                                             <td tabindex="0"  style="text-align: center;">1</td>
                                             <td class="text-start align-middle">Federal Income Tax</td>
                                             <td>
                                                <a href="<?php echo base_url('Chrm/add_taxes_detail').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>"  class="btn btnclr btn-sm federal_tax" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add Taxes Detail"><i class="fa fa-window-restore"  aria-hidden="true"></i></a>
                                                <input type="hidden" name="tax" id="federal_tax" value="Federal Income tax">
                                             </td>
                                          </tr>
                                          <tr role="row" class="odd">
                                             <td tabindex="0" style="text-align: center;" >2</td>
                                             <td class="text-start align-middle">Social Security</td>
                                             <td>
                                                <a href="<?php echo base_url('Chrm/socialsecurity_detail').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>"  class="btn btnclr btn-sm social_security" id="social_security" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add Taxes Detail"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                                <input type="hidden" name="tax" id="social_security" value="Social Security">
                                             </td>
                                          </tr>
                                          <tr role="row" class="odd">
                                             <td tabindex="0" style="text-align: center;" >3</td>
                                             <td class="text-start align-middle">Medicare</td>
                                             <td>
                                                <a href="<?php echo base_url('Chrm/medicare_detail').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>"  class="btn btnclr btn-sm medicare" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add Taxes Detail"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                             </td>
                                          </tr>
                                          <tr role="row" class="odd">
                                             <td tabindex="0" style="text-align: center;" >4</td>
                                             <td class="text-start align-middle">Federal Unemployment</td>
                                             <td>
                                                <a href="<?php echo base_url('Chrm/federalunemployment_detail').'?id='.urlencode($_GET['id']).'&admin_id='.urlencode($_GET['admin_id']); ?>"  class="btn btnclr btn-sm federal_unemployment" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add Taxes Detail"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <input type="hidden" id="total_invoice" value="<?php echo $total_invoice;?>" name="">
                        <input type="hidden" id="currency" value="{currency}" name="">
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- date between search -->
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">State Taxes</h3>
                     <div class="col-sm-9 text-right">
                        <a href="#" data-toggle="modal" data-target="#add_states"   class="btnclr btn"> Add States </a>
                        <a href="#" data-toggle="modal" data-target="#add_state_tax"   class="btnclr btn">Add New State Tax </a>
                     </div>

                     <div class="col-sm-12 mt-4">
                        <div class="panel panel-bd lobidrag">
                           <div class="panel-body">
                           <div class="table-responsive" >
                              <?php 
                                 echo "<table border='0' class='table table-striped' cellspacing='0' cellpadding='0' style='table-layout:fixed;
                                 border-collapse:collapse;'>
                                 <thead style='height:25px;'  >
                                    <th   class='btnclr'  style='text-align:center;border: 1px solid #d7d4d6; width: 170px;'>".display('sl')."</th>
                                    <th  class='btnclr' style='text-align:center;border: 1px solid #d7d4d6; '>State Name</th>
                                    <th  class='btnclr'  style=' text-align: center;border: 1px solid #d7d4d6; '>   State Taxes</th>                           
                                 </thead><tbody>";
                                 $k = 1;
                                 for ($i = 0; $i < sizeof($states_list); $i++) {
                                    $splt = explode(",", $states_list[$i]['tax']);
                                    $j = 1;
                           
                                    echo "<tr style='border: 1px solid #d7d4d6;    background: white;' >
                                    <td style='text-align:center;border: 1px solid #d7d4d6;    background: white;' >".$k."</td>
                                    <td class='state_name' style='text-align:center;font-weight:bold;border: 1px solid #d7d4d6; background: white;' rowspan='".$j."'>". $states_list[$i]['state']."</td>
                                    <td>
                                    <table>";
                           
                                    foreach ($splt as $sp) {
                                       if (!empty($sp) && $sp !== ',') {
                                        $sp_url = str_replace(" ", " ", $sp);
                                        echo "<tr>
                                                <td style='display:none; border: 1px solid #d7d4d6; background: white;' class='state_name'>" . $states_list[$i]['state'] . "</td>
                                                <td style='width:450px; text-align: center;' class='tax_value'>" . $sp . "</td>
                                                <td>
                                                    <a href='" . base_url('Chrm/add_state_taxes_detail?id=' . urlencode($_GET['id']) . '&admin_id=' . urlencode($_GET['admin_id']) . '&tax=' . urlencode($states_list[$i]['state']) . "-" . urlencode($sp_url)) . "' 
                                                       class='btn btnclr btn-sm' 
                                                       data-toggle='tooltip' 
                                                       data-placement='left'  
                                                       data-original-title='Add Taxes Detail'>
                                                       <i class='fa fa-window-restore' aria-hidden='true'></i>
                                                    </a>
                                                    <a class='delete_item btn btnclr btn-sm' onclick='return confirm('Are you sure you want to delete this?');'>
                                                        <i class='fa fa-trash' aria-hidden='true'></i>
                                                    </a>
                                                </td>
                                              </tr>";
                                    }else {
                                          echo "<tr><td style='display:none ;border: 1px solid #d7d4d6;    background: white;' class='state_name'>". $states_list[$i]['state']."</td><td style='width:485px;' style='display:none'>&nbsp</td> <td>  
                                          <a class='delete_item btn btnclr btn-sm' onclick='return confirm('Are you sure you want to delete this?');'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr></td>";
                                          break;
                                       }
                                    }
                                    echo "</table></tr>";
                                    $j++; $k++;
                                 }
                                 echo "</table>";
                                 ?>
                              </div>
                           </div>
                        </div>
                        <input type="hidden" id="total_invoice" value="<?php echo $total_invoice;?>" name="">
                        <input type="hidden" id="currency" value="{currency}" name="">
                     </div>

                  </div>
               </div>
            </div>
         </div>
        
      </div> 

   <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">City Taxes</h3>
                     <div class="col-sm-9 text-right">
                        <a href="#" data-toggle="modal" data-target="#add_city_info"   class="btnclr btn"> Add City </a>
                        <a href="#" data-toggle="modal" data-target="#add_city_tax"   class="btnclr btn">Add City Tax </a>
                     </div>

                     <div class="col-sm-12 mt-4">
                        <div class="panel panel-bd lobidrag">
                           <div class="panel-body" >
                              <div class="table-responsive" >
                                 <?php 
                                    echo "<table border='0' class='table table-striped' cellspacing='0' cellpadding='0' style='table-layout:fixed;
                                    border-collapse:collapse;'>
                                    <thead style='height:25px;'>
                                    <th class='btnclr' style='text-align:center; border: 1px solid #d7d4d6; width: 170px;  '>".display('sl')."</th>
                                    <th class='btnclr' style='text-align:center; border: 1px solid #d7d4d6; '>City Name</th>
                                    <th class='btnclr'  style='  text-align: center; border: 1px solid #d7d4d6; '>City Taxes</th>
                                    </thead><tbody>";
                                       $k=1;
                                       for($i=0; $i < sizeof($city_list); $i++) {
                                       $splt=explode(",",$city_list[$i]['tax']);
                                       $j=1;
                                    
                                       echo "<tr style='border: 1px solid #d7d4d6;background: white;'><td style='text-align:center;border: 1px solid #d7d4d6;background: white;' >".$k."</td><td class='citystate_name' style='text-align:center;font-weight:bold;border: 1px solid #d7d4d6;background: white;' rowspan='".$j."'>". $city_list[$i]['state']."</td> <td><table>";

                                       foreach($splt as $sp){
                                             
                                          if(!empty($sp) && $sp !==','){
                                             $sp_url= str_replace(" "," ",$sp);
                                             echo "<tr ><td style='display:none;' class='citystate_name'>". $city_list[$i]['state']."</td><td style='width:450px;text-align: center;' class='citytax_value'>".$sp."</td> <td>  
                                            
                                             <a href=".base_url('Chrm/add_citydetails?id=' . urlencode($_GET['id']) . '&admin_id=' . urlencode($_GET['admin_id']) . '&taxtype=' .'citytax'. '&tax=' . urlencode($city_list[$i]['state']) . "-" . urlencode($sp_url))." class='btn btnclr btn-sm' data-toggle='tooltip' data-placement='left'  data-original-title='Add Taxes Detail'><i class='fa fa-window-restore' aria-hidden='true'></i></a>
                                             <a class='delete_item_city btn btnclr btn-sm' onclick='return confirm('Are you sure you want to delete this?');'><i class='fa fa-trash' aria-hidden='true'></i></a>     </td></tr></td>";
                                          } else {
                                             echo "<tr><td style='display:none' class='citystate_name'>". $city_list[$i]['state']."</td><td style='width:485px;' style='display:none'>&nbsp</td> <td>  
                                             <a class='delete_item_city btn btnclr btn-sm' onclick='return confirm('Are you sure you want to delete this?');'><i class='fa fa-trash' aria-hidden='true'></i></a>     </td></tr></td>";
                                             break;
                                          }
                                       }
                                       echo "</table></tr>";
                                                   
                                       $j++;$k++;
                                       }
                                       echo "</table>"; ?>
                              </div>
                           </div>
                        </div>
                        <input type="hidden" id="total_invoice" value="<?php echo $total_invoice;?>" name="">
                        <input type="hidden" id="currency" value="{currency}" name="">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #D7D4D6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">County  Taxes</h3>
                     <div class="col-sm-9 text-right">
                        <!-- <a href="#" data-toggle="modal" data-target="#add_city" class="btnclr btn"> Add City </a> -->
                        <a href="#" data-toggle="modal" data-target="#add_county_info"   class="btnclr btn"> Add County </a>
                        <a href="#" data-toggle="modal" data-target="#add_county_tax"   class="btnclr btn">Add County Tax </a>
                     </div>
                     <div class="col-sm-12 mt-4">
                        <div class="panel panel-bd lobidrag">
                           <div class="panel-body" >
                           <!-- style="overflow-y: auto;height:500px;" -->
                              <div class="table-responsive" >
                                 <?php
                                    echo "<table border='0' class='table table-striped' cellspacing='0' cellpadding='0' style='table-layout:fixed;
                                    border-collapse:collapse;'>
                                    <thead style='height:25px;'>
                                       <th class='btnclr' style='text-align:center;border: 1px solid #D7D4D6;width: 170px;'>".display('sl')."</th>
                                       <th class='btnclr' style='text-align:center;border: 1px solid #D7D4D6;'>County Name</th>
                                       <th class='btnclr'  style=' text-align: center;border: 1px solid #D7D4D6;'>County Taxes</th>
                                    </thead><tbody>";
                                    $k=1;
                                    for($i=0; $i < sizeof($county_list); $i++) {
                                       // echo $states_list[$i];
                                       $splt=explode(",",$county_list[$i]['tax']);
                                       $j=1;
                                       echo "<tr style='border: 1px solid #D7D4D6;background: white;' ><td style='text-align:center;' >".$k."</td><td class='county_name' style='text-align:center;font-weight:bold;border: 1px solid #D7D4D6;background: white;' rowspan='".$j."'>". $county_list[$i]['state']."</td> <td><table>";
                                       foreach($splt as $sp){
                                          if(!empty($sp) && $sp !==','){
                                             $sp_url= str_replace(" "," ",$sp);
                                             echo "<tr><td style='display:none' class='county_name'>". $county_list[$i]['state']."</td><td style='width:450px;text-align:center;' class='countytax_value'>".$sp."</td> 

                                             <td><a  href=".base_url('Chrm/add_countydetails?id=' . urlencode($_GET['id']) . '&admin_id=' . urlencode($_GET['admin_id']) . '&taxtype=' .'countytax'. '&tax=' . urlencode($county_list[$i]['state']) . "-" . urlencode($sp_url))." class='btn btnclr btn-sm' data-toggle='tooltip' data-placement='left'  data-original-title='Add Taxes Detail'><i class='fa fa-window-restore' aria-hidden='true'></i></a>
                                                <a  class='delete_itemcounty btn btnclr btn-sm' onclick='return confirm('Are you sure you want to delete this?');'><i class='fa fa-trash' aria-hidden='true'></i></a>     </td></tr></td>";
                                          } else {
                                             echo "<tr><td style='display:none' class='county_name'>". $county_list[$i]['state']."</td><td style='width:485px;' style='display:none'>&nbsp</td> <td>
                                             <a   class='delete_itemcounty btn btnclr btn-sm' onclick='return confirm('Are you sure you want to delete this?');'><i class='fa fa-trash' aria-hidden='true'></i></a>     </td></tr></td>";
                                             break;
                                          }
                                       }
                                       echo "</table></tr>";
                                       $j++;$k++;
                                    }
                                    echo "</table>"; ?>
                              </div>
                           </div>
                        </div>
                        <input type="hidden" id="total_invoice" value="<?php echo $total_invoice;?>" name="">
                        <input type="hidden" id="currency" value="{currency}" name="">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br><br>
   </section>  

</div>


<?php 
   $modaldata['bootstrap_modals'] = array('add_states', 'add_state_tax', 'add_city_info', 'add_city_tax', 'add_county_info', 'add_county_tax', 'allForms');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>

<script type="text/javascript">
   var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
   var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
   $('.checkbox_id').click(function() {
       var tax_name=$(this).closest('tr').find('.checkbox_id').val();
       var data = {
         value:tax_name
        };
      data[csrfName] = csrfHash;
      $.ajax({
         type:'POST',
         data: data,
         dataType:"json",
         url:'<?php echo base_url();?>Chrm/add_taxname_data',
         success: function(result, statut) {
         }
     });
   });
   $(document).ready(function(){
   $('[type="checkbox"]').change(function(){
     if(this.checked){
        $('[type="checkbox"]').not(this).prop('checked', false);
     }
   });
   });
   
   
   $(document).ready(function(){
     $(".federal_tax").click(function(){
       var tax = $(this).closest('tr').find('#federal_tax').val();
       $.ajax({
           type: "POST",
           url: '<?php echo base_url(); ?>Chrm/add_taxes_detail',
              
           data: {<?php echo $this->security->get_csrf_token_name();?>: csrfHash,tax:tax},
           success:function(data)
           {    
                location.reload(); 
           },
           error: function (){ }
       })
     });



       $(".delete_item").click(function(){
         if (confirm("Are you sure you want to delete this item?")) {
            var tax = $(this).closest('tr').find('td.tax_value').text();
            var state = $(this).closest('tr').find('td.state_name').text();
             $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Chrm/delete_tax",
                data: {
                    <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash(); ?>',  
                    tax: tax,
                    state: state
                },
                success: function(data) {    
                  toastr.success("Successfully Deleted", "Success", { 
                       closeButton: false,
                       timeOut: 1000
                  });

                  setTimeout(function() {
                     location.reload();
                  }, 1000);
                },
                error: function () {
                  toastr.error("Failed", "Error", { 
                     closeButton: false,
                     timeOut: 1000
                  });
                }
            });

         }

     });
   });


   var csrfName = $('.txt_csrfname').attr('name');
   var csrfHash = $('.txt_csrfname').val();
   $(document).ready(function(){
       $("#ADD_CITY").click(function(event){
         event.preventDefault();
         var city = $('#city_tax').val();
         $.ajax({
           type:"POST",
           url:"<?php echo base_url(); ?>Chrm/addCity",
           data: {[csrfName]: csrfHash, city:city},
           dataType:"json",
           success:function(response){
             swal({
               title: 'City saved successfully',
               icon: 'success',
               button: {
                  text: "Continue",
                  value: true,
                  visible: true,
                  className: "btn btn-primary"
               }
            }).then(function(isConfirm) {
               location.reload();
            });
           },
           error: function(xhr, status, error) {
           }
         });
       });
       $('.invoice_edit').click(function() {
         $('.city_button').hide();
        var row = $(this).closest('tr');
        row.find('.city-value').hide();
        row.find('.city-edit').show();
        row.find('.invoice_edit').hide();
        row.find('.invoice_save').show();
      });
      $('.invoice_save').click(function() {
        var row = $(this).closest('tr');
        var cityId = row.find('.city_ids').val();
        var newCity = row.find('.city-edit').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Chrm/editCity",
            data: {[csrfName]: csrfHash, city_id: cityId, new_city: newCity },
            dataType:"json",
            success: function(response) {
               console.log(response);
                row.find('.city-value').text(newCity).show();
                row.find('.city-edit').hide();
                row.find('.invoice_edit').show();
                row.find('.invoice_save').hide();
                $('.city_button').show();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
      });
     });


   function deleteCity(cityId) {
      $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>Chrm/deleteCity",
         data: {[csrfName]: csrfHash, cityId: cityId},
         dataType:"json",
         success: function(response) {
            toastr.success("Successfully Deleted", "Success", { 
               closeButton: false,
               timeOut: 1000
            });

            setTimeout(function() {
               location.reload();
            }, 1000);
         },
         error: function(xhr, status, error) {
            toastr.error(error, "Error", { 
               closeButton: false,
               timeOut: 1000
            });
         }
      })
  }
   


  $(".delete_item_city").click(function () {
    var citytax = $(this).closest('tr').find('td.citytax_value').text();
    var city = $(this).closest('tr').find('td.citystate_name').text();

    if (confirm("Are you sure you want to delete this?")) {
        var dataString = {
            citytax: citytax,
            city: city,
            <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>'
        };

        $.ajax({
            type: "POST",
            url: '<?= base_url(); ?>Chrm/citydelete_tax',
            data: dataString,
            success: function (data) {
               toastr.success("Successfully Deleted", "Success", { 
               closeButton: false,
               timeOut: 1000
            });

               setTimeout(function() {
                  location.reload();
               }, 1000);
            },
            error: function (error) {
                  toastr.error(error, "Error", { 
                  closeButton: false,
                  timeOut: 1000
               });
            }
        });
    }
});




$(".delete_itemcounty").click(function () {
    var countytax = $(this).closest('tr').find('td.countytax_value').text();
    var county = $(this).closest('tr').find('td.county_name').text();
   if (confirm("Are you sure you want to delete this?")) {
    var dataString = {
      countytax: countytax,
      county: county,
        <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>'
    };

    $.ajax({
        type: "POST",
        url: '<?= base_url(); ?>Chrm/countydelete_tax',
        data: dataString,
        success: function (data) {
            toastr.success("Successfully Deleted", "Success", { 
               closeButton: false,
               timeOut: 1000
            });

            setTimeout(function() {
               location.reload();
            }, 1000);
        },
        error: function () {
            toastr.error(error, "Error", { 
               closeButton: false,
               timeOut: 1000
            });
        }
    });
   }
});



function downloadPDF() {
    var pdfPath = '<?php echo base_url('assets/payrollform/fw3/fw3.pdf') ?>';
    var downloadLink = document.createElement('a');
    downloadLink.href = pdfPath;
    downloadLink.download = 'W3form.pdf';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

</script>