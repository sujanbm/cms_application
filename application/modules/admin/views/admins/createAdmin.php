<?php require_once( APPPATH."/views/admins/header.php") ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Admin
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">

           <form action="<?php echo site_url('admin/addAdmin');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
               <div class="form-group">
                   <label for="adminName">Name</label>
                   <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Name of the admin" value="<?php echo set_value('adminName') ?>"required>
                   <span class="help-block margin-b-0"><?php echo form_error('adminName'); ?></span>
               </div>
               <div class="form-group">
                   <label for="adminEmail">Email</label>
                   <input type="email" class="form-control" name="adminEmail" placeholder="example@example.com" value="<?php echo set_value('adminEmail') ?>" required>
                   <span class="help-block margin-b-0"><?php echo form_error('adminEmail'); ?></span>
               </div>
               <div class="form-group">
                   <label for="adminPhone">Phone No.</label>
                   <input type="number" class="form-control" name="adminPhone" placeholder="9876543210" value="<?php echo set_value('adminPhone') ?>" required>
                   <span class="help-block margin-b-0"><?php echo form_error('adminPhone'); ?></span>
               </div>
               <div class="form-group">
                   <label for="adminPassword">Password</label>
                   <input type="password" class="form-control" name="adminPassword" placeholder="password" value="<?php echo set_value('adminPassword') ?>" required>
                   <span class="help-block margin-b-0"><?php echo form_error('adminPassword') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminPasswordConf">Retype Password</label>
                   <input type="password" class="form-control" name="adminPasswordConf" placeholder="password" value="<?php echo set_value('adminPasswordConf') ?>" required>
                   <span class="help-block margin-b-0"><?php echo form_error('adminPasswordConf') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminStatus">Status</label>
                   <select class="form-control" name="adminStatus" value="<?php echo set_value('adminStatus') ?>">
                       <option value="0" selected>InActive</option>
                       <option value="1">Active</option>
                   </select>
                   <span class="help-block margin-b-0"><?php form_error('adminStatus') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminPhoto">Profile Photo</label>
                   <input type="file" class="form-control" name="file" id="file" >
               </div>
               <div class="form-group">
                   <button class="btn btn-success">Save</button>
               </div>
           </form>

       </div>

</section><!-- /.content -->

<?php require_once(APPPATH."/views/admins/footer.php") ?>
