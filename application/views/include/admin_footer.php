<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
?>
<footer class="main-footer">
    <i><span style="font-style: normal;" > 2024 © Copyright : Amorio Technologies </span></i>
    <input type ="hidden" name="csrf_test_name" id="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>">
    <input type ="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
</footer>
<style>
  div.dt-button-collection{
    width: 270px !important;
}
   #files-area{
 
   margin: 0 auto;
   }
   .file-block{
   border-radius: 10px;
   background-color: #38469f;
   margin: 5px;
   color: #fff;
   display: inline-flex;
   padding: 4px 10px 4px 4px;
   }
   .file-delete{
   display: flex;
   width: 24px;
   color: initial;
   background-color: #38469f;
   font-size: large;
   justify-content: center;
   margin-right: 3px;
   cursor: pointer;
   color: #fff;
   }
   span.name{
   position: relative;
   top: 2px;
   }
   .btn-primary {
   color: #fff;
   background-color: #38469f !important;
   border-color: #38469f !important;
   }
   a:active{
    color: #fff !important;
   }

   a:hover{
    color: #000 !important;
   }

   a:focus{
    color: #fff !important;
   }

 

    .toast-success {
        background-color: #006400 !important; 
        color: white !important;
        opacity: 0;
        animation: fadeIn 1s forwards; 
    }

    @keyframes fadeIn {
        from {
            opacity: 0; 
        }
        to {
            opacity: 1; 
        }
    }

    .toast.toast-warning {
        background-color: #ffc107 !important; 
        color: black !important;
        opacity: 0;
        animation: fadeIn 1s forwards; 
    }


.daterangepicker td.in-range {
  background: #0044cc;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  color: #fff;
}
.daterangepicker td.active, .daterangepicker td.active:hover {
  background-color: #0044cc;
  background-image: -moz-linear-gradient(top, #0044cc, #0044cc);
  background-image: -ms-linear-gradient(top, #0044cc, #0044cc);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0044cc), to(#0044cc));
  background-image: -webkit-linear-gradient(top, #0044cc, #0044cc);
  background-image: -o-linear-gradient(top, #0044cc, #0044cc);
  background-image: linear-gradient(top, #0044cc, #0044cc);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0044cc', endColorstr='#0044cc', GradientType=0);
  border-color: #0044cc #0044cc #0044cc;
  border-color: #0044cc;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  color: #fff;
  text-shadow: 0 -1px 0 #0044cc;
}
.btnclr{
    background-color:<?php echo $setting_detail[0]['button_color']; ?>;
    color: white;
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
    background-image: -webkit-linear-gradient(top, #eeeeee, white 25px);
    background-image: -moz-linear-gradient(top, #eeeeee, white 25px);
    background-image: -o-linear-gradient(top, #eeeeee, white 25px);
    background-image: linear-gradient(to bottom, #eeeeee, white 25px);
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
  background: #eceeef;
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
  background: #38469f;
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
  background-image: -webkit-linear-gradient(top, white 40%, #f0f0f0);
  background-image: -moz-linear-gradient(top, white 40%, #f0f0f0);
  background-image: -o-linear-gradient(top, white 40%, #f0f0f0);
  background-image: linear-gradient(to bottom, white 40%, #f0f0f0);
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
  background: #f9f9f9;
  border-radius: 6px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
  background-image: -webkit-linear-gradient(top, #eeeeee, white);
  background-image: -moz-linear-gradient(top, #eeeeee, white);
  background-image: -o-linear-gradient(top, #eeeeee, white);
  background-image: linear-gradient(to bottom, #eeeeee, white);
}
.switch-input:checked ~ .switch-handle {
  left: 85px;
  box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-green > .switch-input:checked ~ .switch-label {
  background: #4fb845;
}
.table {
    width: 100%; 
    table-layout: fixed; 
}
.table th,
.table td {
    width: auto; 
    /*border: 1px solid #ccc;*/
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
.select2-selection{
    display :none;
}

th{
    height:30px;
    text-align:center;
}
td{
    text-align:center;
}
.end,.start,.timeSum {
    background-color: inherit; 
}

.mt-4 {
    margin-top: 3rem;
}
.m-3 {
    margin: 2rem;
}

table.table.table-hover.table-borderless td {
   border: 0;
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
   position:relative;
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
   width: 120px;
  }
}

tr.noBorder td {
   border: 0;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
   border-top:none;
}

table.table.table-hover.table-borderless td {
   border: 0;
}
.select2{
   display:none;
}

.error{
    color: red;
}

.panel-heading{
    background-color: #fff;
}
.modal-backdrop {
        backdrop-filter: blur(1px);
    }
    @keyframes skeleton-loading {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: calc(200px + 100%) 0;
    }
}
.skeleton-loader {
    width: 100%;
    height: 20px;
    background: linear-gradient(90deg, #F0F0F0 25%, #E0E0E0 50%, #F0F0F0 75%);
    background-size: 200px 100%;
    animation: skeleton-loading 1.5s infinite;
}
</style>


<?php 
   $modaldata['bootstrap_modals'] = array('notifications');
   $this->load->view('include/bootstrap_modal', $modaldata);
?>


<script type="text/javascript">
   const dt = new DataTransfer(); 
   
   $('span.file-delete').click(function(){
           let name = $(this).next('span.name').text();
           $(this).parent().remove();
           for(let i = 0; i < dt.items.length; i++){
              
               if(name === dt.items[i].getAsFile().name){
                  
                   dt.items.remove(i);
                   continue;
               }
           }
          
           document.getElementById('attachment').files = dt.files;
       });


// Sidebar Toggle class add
$(document).ready(function () {
    $(".sidebar-toggle").click(function () {
        $("body").toggleClass("sidebar-collapse");
    });
});

</script>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/css.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/timesheet/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/timesheet/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/timesheet/jquery-ui.css">

<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/datatables/buttons.colVis.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/datatables/buttons.print.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/js/select2.min.js"></script>

<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/js/timesheet/moment.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/js/number-to-words.js"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url(); ?>assets/js/timesheet/daterangepicker.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jspdf.debug.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/html2pdf.bundle.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jspdf/html2canvas.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jspdf/jspdf.umd.min.js"></script>
