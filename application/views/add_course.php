<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Course</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <form method="post">
                <input type="hidden" name="iCourseId" id="iCourseId" value="<?=!empty($course["iCourseId"])?$course["iCourseId"]:NULL?>">
                <div class="row">
                    <div class="col-xl-6 form-group">
                        <label for="vCourse">Course Name</label>
                        <input type="text" name="vCourse" id="vCourse" placeholder="Course Name" class="form-control" value="<?=!empty($course["vCourse"])?$course["vCourse"]:set_value('vCourse');?>">
                        <?php 
                            echo form_error('vCourse','<span class="error" id="vCourse-server-error">', '</span>'); 
                        ?>
                    </div>
                    <div class="col-xl-6 form-group">
                        <label for="vProfessorName">Professor Name</label>
                        <input type="text" name="vProfessorName" placeholder="Professor Name" class="form-control" value="<?=!empty($course["vProfessorName"])?$course["vProfessorName"]:set_value('vProfessorName');?>">
                        <?php 
                            echo form_error('vProfessorName','<span class="error" id="vProfessorName-server-error">', '</span>');
                        ?>
                    </div>
                    <div class="col-xl-6 form-group">
                        <label for="tDescription">Description</label>
                        <textarea type="text" name="tDescription" placeholder="Description" class="form-control">
                            <?=!empty($course["tDescription"])?$course["tDescription"]:set_value('tDescription');?>
                        </textarea>
                        <?php 
                            echo form_error('tDescription','<span class="error" id="tDescription-server-error">', '</span>');
                        ?>
                    </div>
                    <div class="col-xl-4 form-group" style="padding-top: 25px;">
                        <input type="submit" value="Save" class="btn btn-success" />
                        <a class="btn" href="<?=base_url()?>admin/course">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>