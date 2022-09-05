<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Students</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <form method="post">
                <input type="hidden" name="iUserId" id="iUserId" value="<?=!empty($user["iUserId"])?$user["iUserId"]:NULL?>">
                <div class="row">
                    <div class="col-xl-4 form-group">
                        <label for="vName">Student Name</label>
                        <input type="text" name="vName" id="vName" placeholder="Student Name" class="form-control" value="<?=!empty($user["vName"])?$user["vName"]:set_value('vName');?>">
                        <?php 
                            echo form_error('vName','<span class="error" id="vName-server-error">', '</span>'); 
                        ?>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label for="vEmail">Student Email Address</label>
                        <input type="text" name="vEmail" placeholder="Student Email Address" class="form-control" value="<?=!empty($user["vEmail"])?$user["vEmail"]:set_value('vEmail');?>">
                        <?php 
                            echo form_error('vEmail','<span class="error" id="vEmail-server-error">', '</span>');
                        ?>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label for="phone_number">Student Phone Number</label>
                        <input type="text" name="phone_number" placeholder="Student Phone Number" class="form-control" value="<?=!empty($user["vPhoneNumber"])?$user["vPhoneNumber"]:set_value('phone_number');?>">
                        <?php 
                            echo form_error('phone_number','<span class="error" id="phone_number-server-error">', '</span>');
                        ?>
                    </div>
                    <div class="col-xl-4 form-group">
                        <label for="course">course</label>

                        <select multiple name="course[]" class="form-control select2">
                            <?php foreach ($course_arr as $key => $value): ?>    
                                <option value="<?=$value["iCourseId"];?>" <?php if(!empty($user_course) && in_array($value["iCourseId"],$user_course)):?>selected<?php elseif(!empty($_POST['course']) && in_array($value["iCourseId"], $_POST['course'])):?>selected<?php endif;?>><?=$value["vCourse"];?></option>
                            <?php endforeach ?>
                        </select>
                        <?php 
                            echo form_error('course','<span class="error" id="course-server-error">', '</span>');
                        ?>
                    </div>
                    <div class="col-xl-4 form-group" style="padding-top: 25px;">
                        <input type="submit" value="Save" class="btn btn-success" />
                        <a class="btn" href="<?=base_url()?>admin/users">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>