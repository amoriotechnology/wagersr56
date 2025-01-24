<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css')?>" />
<script src="<?php echo base_url('assets/js/toastr.min.js')?>" ></script>
<style>
    .select2 {
        display:none;
    }

    .btnclr{
       background-color:<?php echo $setting_detail[0]['button_color']; ?>;
       color: white;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo ('Edit Admin User') ?></h1>
            <small></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active" style="color:orange;"><?php echo ('title Admin User') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
        ?>
        <div class="alert alert-info alert-dismissable" style="background-color:#38469f;color:white;font-weight:bold;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message ?>                    
        </div>
        <?php 
            $this->session->unset_userdata('message');
            }
            $error_message = $this->session->userdata('error_message');
            if (isset($error_message)) {
        ?>
        <div class="alert alert-danger alert-dismissable" style="background-color:#38469f;color:white;font-weight:bold;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>                    
        </div>
        <?php 
            $this->session->unset_userdata('error_message');
            }
        ?>

        <div class="row">
            <div class="col-sm-12">
                <?php if($this->permission1->method('manage_user','read')->access()){?>
                  <a href="<?php echo base_url('User/manage_user?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>"   style="color:white;" class="btnclr btn"><i class="ti-align-justify"> </i> Manage User </a>
                <?php }?>
            </div>
        </div>


        <div class='row'> 
                    
        </div>
        <!-- New user -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading" style="height: 50px;">
                        <div class="panel-title">
                            <a style="float:right;color:white;" href="<?php echo base_url('User/manage_user?id='.$_GET['id'].'&admin_id='.$_GET['admin_id']); ?>" class="btnclr btn  m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo ('Manage User')?> </a>
                        </div>
                        <div class="panel-title">
                        </div>
                    </div>
                    <div class="panel-body">
                        <form id="editInsertForm" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo ('Employee Name') ?><i class="text-danger"> *</i></label>
                                        <select name="employee_name" id="employee_name" class="form-control" style="border: 2px solid #D7D4D6;" tabindex="3">
                                            <option value="">Select Employee Name</option>
                                            <?php foreach($get_employee_data as $pt) { ?>
                                                <option value="<?php echo $pt['id'] . ' ' . $pt['first_name'] . ' ' . $pt['last_name']; ?>"
                                                    <?php echo ($userList[0]['employee_id'] == $pt['id']) ? 'selected' : ''; ?>>
                                                    <?php echo $pt['first_name'] . ' ' . $pt['last_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo display('Phone') ?><i class="text-danger"> *</i></label>
                                        <input type="number" name="phone" class="form-control" required value="<?= $userList[0]['phone']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>">
                                        <input type="hidden" name="admin_id" value="<?php echo $_GET['admin_id']; ?>">
                                        <input type="hidden" name="first_name" value="<?= $userList[0]['first_name']; ?>">
                                        <input type="hidden" name="last_name" value="<?= $userList[0]['last_name']; ?>">
                                        <input type="hidden" name="edit_id" value="<?= $_GET['user_id']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo display('Email') ?><i class="text-danger"> *</i></label>
                                        <input type="email" name="email" class="form-control" required value="<?= $userList[0]['email_id']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo display('Gender') ?><i class="text-danger"> *</i></label>
                                        <select class="form-control" name="gender" required>
                                            <option value=""><?php echo display('Select Gender')?></option>
                                            <option value="male" <?php if($userList[0]['gender'] == 'male'){echo 'selected';}?>>Male</option>
                                            <option value="female" <?php if($userList[0]['gender'] == 'female'){echo 'selected';}?>>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                   <div class="form-group">
                                        <label><?php echo display('DOB') ?><i class="text-danger"> *</i></label>
                                        <input type="date" name="dob" class="form-control" required value="<?= $userList[0]['date_of_birth']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                   <div class="form-group">
                                        <label>Username<i class="text-danger"> *</i></label>
                                        <input type="text" name="username" class="form-control" required value="<?= $userList[0]['username']; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group mt-2">
                                <label></label>
                                <input type="submit"  style="color:white;" value="Save" class="btnclr btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit user end -->


<script type="text/javascript">

var csrfName = '<?= $this->security->get_csrf_token_name();?>';
var csrfHash = '<?= $this->security->get_csrf_hash();?>';

$(document).ready(function () {
   $("#editInsertForm").validate({
        rules: {
            employee_name: "required",
            phone: "required",
            email: "required",
            gender: "required",
            dob: "required",
            username: "required",
            password: "required",
        },
        messages: {
            employee_name: "Employee name is required",
            phone: "Phone is required",
            email: "Email is required",
            gender: "Gender is required",
            dob: "DOB is required",
            username: "Username is required",
            password: "Password is required"
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            var formData = new FormData(form);
            formData.append(csrfName, csrfHash);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>User/updateUsers",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                  console.log(response, "response");
                    if (response.status == 1) {
                        toastr.success(response.msg, "Success", {
                           closeButton: false,
                           timeOut: 1000
                        });
                        setTimeout(function () {
                           window.location.href = "<?= base_url('User/manage_user?id='); ?>" +
                                "<?= $_GET['id']; ?>" +
                                "&admin_id=" + "<?= $_GET['admin_id']; ?>";
                        }, 1000);
                    } else {
                        toastr.error(response.msg, "Error", {
                           closeButton: false,
                           timeOut: 3000
                        });
                    }
                },
                error: function(xhr, status, error) {
                  var errorMsg = xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : "An error occurred.";
                  toastr.error(errorMsg, "Error", {
                     closeButton: false,
                     timeOut: 1000
                  });
               }
            });
        }
    });
});
</script>