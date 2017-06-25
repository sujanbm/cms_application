<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $post->getPostTitle(); ?>
    </h1>
    <small><?php echo "Created At: ".$post->getCreatedAt(); ?></small>
    <?php if ($post->getUpdatedAt() != null): ?>
        <small class='pull-right'><?php echo "Updated At: ".$post->getUpdatedAt()->format('Y m d h:i:s'); ?></small>
    <?php endif; ?>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="thumbnail">
            <?php
            if($post->getPhotoPath() != null){
                $path = $post->getPhotoPath();
                if(file_exists(FCPATH."uploads/posts/".$path)){?>
                <img src="<?php echo base_url();?>/uploads/posts/<?php echo $path?>" class="img-responsive img-rounded" width="800" height="auto" alt="">
                <?php }else{?>
                  <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" class="img-responsive img-rounded" width="800" height="auto" alt="">
               <?php }
           }else{ ?>
               <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" class="img-responsive img-rounded" width="800" height="auto" alt="">
         <?php  }?>
          <div class="caption">

            <p align="justify"><?php echo $post->getPostBody(); ?></p>
            <p><a href="<?php echo site_url('cms/posts/editPost/').$post->getId(); ?>" class="btn btn-primary" role="button">Edit Post</a>
               <a href="<?php echo site_url('cms/posts/deletePost/') . $post->getId() ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure want to delete');">Delete Post</a>
           </p>
          </div>
        </div>
    </div>
</section><!-- /.content -->

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>
