<?php require_once( APPPATH."/views/admins/header.php") ?>

<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>
        Admins
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <table class="table table-bordered">
        <tr>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Roles</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($admins as $admin): ?>
            <tr>
                <td width="180" height="180"> <?php
                      if($admin->getAdminPhoto() != null){
                                  $path = $admin->getAdminPhoto();
                                  if(file_exists(FCPATH."uploads/admins/".$path)){?>
                                  <img src="<?php echo base_url();?>/uploads/admins/<?php echo $path?>" class="img-responsive img-rounded" width = "auto" height="auto" alt="">
                                  <?php }else{?>
                                    <img src="http://gazettereview.com/wp-content/uploads/2016/03/facebook-avatar.jpg" class="img-responsive img-rounded" width="auto" height="auto" alt="">
                                 <?php }
                        }else{?>
                          <img src="http://gazettereview.com/wp-content/uploads/2016/03/facebook-avatar.jpg" class="img-responsive img-rounded"  width = "auto" height="auto" alt="">
                       <?php }?>
                </td>
                <td><?php echo $admin->getAdminName(); ?></td>
                <td><?php echo $admin->getAdminEmail(); ?></td>
                <td><?php echo $admin->getAdminPhone(); ?></td>
                <td><?php if($admin->getAdminStatus()){?> <span class="badge bg-green">Active</span><?php }else{ ?> <span class="badge bg-red">Inactive</span> <?php  } ?></td>
                <td><?php echo $admin->getRole()->getRoleName(); ?></td>
                <td>
                    <a href="<?php echo site_url('admin/editAdmin/') . $admin->getId(); ?>"><button type="button" class="btn btn-primary btn-flat">Edit</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</section><!-- /.content -->

<?php require_once( APPPATH."/views/admins/footer.php") ?>
