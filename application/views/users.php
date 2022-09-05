<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Students</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <a href="<?=base_url();?>admin/add_student" class="btn btn-success mb-4" style="float: right;">Add New</a>
            <div class="table-responsive">
                <table id="DataTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Sr.No</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone Number</td>
                            <td>Courses</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)): ?>
                            <?php foreach ($users as $key => $value): ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$value["vName"];?></td>
                                    <td><?=$value["vEmail"];?></td>
                                    <td><?=$value["vPhoneNumber"];?></td>
                                    <td><?=$value["vCourse"];?></td>
                                    <td>
                                        <a href="<?=base_url();?>admin/add_student/<?=$value["iUserId"];?>">Edit</a> | 
                                        <a href="<?=base_url();?>admin/delete_student/<?=$value["iUserId"];?>">Delete</a>
                                    </td>
                                </tr>    
                            <?php endforeach ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>