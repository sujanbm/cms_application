<?php require_once(APPPATH."views/cms/header.php"); ?>
<h3>Posts</h3>
<hr>
<br>
    <div class="container">

      <?php foreach ($list as $post): ?>

          <div class="jumbotron">
              <h2><?php echo $post->getPostTitle(); ?></h2>
              <hr>
              <h4><?php echo $post->getCategories()->getCategoryName() ?></h4>
              <h6 class="pull-right"><?php echo "Created At: ". $post->getCreatedAt() ?></h6>
              <br>
              <?php
              if($post->getPhotoPath() != null){
                  $path = $post->getPhotoPath();
                  if(file_exists(FCPATH."uploads/posts/".$path)){?>
                  <img src="<?php echo base_url();?>/uploads/posts/<?php echo $path?>" class="img-responsive img-rounded" width="100%" height="auto" alt="">
                  <?php }else{?>
                    <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" alt="">
                 <?php }
              }?>

              <p align="justify"><?php echo $post->getPostBody() ?></p>
              <br>
              <?php if ($post->getUpdatedAt() != null): ?>
                  <h6><?php echo "Updated At: ". $post->getUpdatedAt()->format('Y-m-d H:i:s') ?></h6>
              <?php endif; ?>
        </div>

      <?php endforeach; ?>
      <?php echo $links ?>
  </div>

<?php require_once(APPPATH."views/cms/footer.php") ?>
