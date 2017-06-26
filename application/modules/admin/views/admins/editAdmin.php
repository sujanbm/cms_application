<?php require_once( APPPATH."/views/admins/header.php") ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit: <?php echo " ".$admin->getAdminName();?>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">

           <form action="<?php echo site_url('admin/updateAdmin');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
               <div class="form-group">
                   <label for="adminName">Name</label>
                   <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Name of the admin" value="<?php if(!empty($admin)) echo $admin->getAdminName(); ?>" required>
                   <span><?php echo form_error('adminName') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminEmail">Email</label>
                   <input type="email" class="form-control" name="adminEmail" placeholder="example@example.com" value="<?php if(!empty($admin)) echo $admin->getAdminEmail(); ?>" required>
                   <span><?php echo form_error('adminEmail') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminPhone">Phone No.</label>
                   <input type="number" class="form-control" name="adminPhone" placeholder="9876543210" value="<?php if(!empty($admin)) echo $admin->getAdminPhone(); ?>" required>
                   <span><?php echo form_error('adminPhone') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminStatus">Status</label>
                   <select class="form-control" name="adminStatus">
                       <option value="0" <?php if(!empty($admin)) { if($admin->getAdminStatus() == 0) echo "selected"; } ?> >InActive</option>
                       <option value="1" <?php if(!empty($admin)) { if($admin->getAdminStatus() == 1) echo "selected"; } ?>>Active</option>
                   </select>
                   <span><?php echo form_error('adminStatus') ?></span>
               </div>
               <div class="form-group">
                   <label for="adminPhoto">Profile Photo</label>
                   <?php if(!empty($admin))
                        if($admin->getAdminPhoto() != null){
                                    $path = $admin->getAdminPhoto();
                                    if(file_exists(FCPATH."uploads/admins/".$path)){?>
                                    <img src="<?php echo base_url();?>/uploads/admins/<?php echo $path?>" class="img-responsive img-rounded" width = "180" height="auto" alt="">
                                    <?php }else{?>
                                      <img src="http://gazettereview.com/wp-content/uploads/2016/03/facebook-avatar.jpg" class="img-responsive img-rounded" width="180" height="auto" alt="">
                                   <?php }
                               }?>
                   <input type="file" class="form-control" name="file" id="file">
               </div>
               <input type="hidden" name="id" value="<?php if(!empty($admin)) echo $admin->getId(); ?>">
               <div class="form-group">
                   <button class="btn btn-success">Save</button>
               </div>
           </form>

       </div>

</section><!-- /.content -->

<?php require_once( APPPATH."/views/admins/footer.php") ?>
