<?php require_once(APPPATH."views/cms/header.php"); ?>
<h3>Posts</h3>
<hr>
<br>
    <div class="container">
    <!-- <a href="<?php echo site_url('cms/posts/createPost/') ?>"><button type="button" class="btn btn-success">Create Post</button></a> -->
      <?php foreach ($list as $post): ?>

          <div class="jumbotron">
              <h2><?php echo $post['postTitle']; ?></h2>
              <hr>
              <h4><?php echo $post['categoryName'] ?></h4>
              <h6 class="pull-right"><?php echo "Created At: ". $post['createdAt'] ?></h6>
              <br>
              <?php
              if($post['photoPath'] != null){
                  $path = $post['photoPath'];
                  if(file_exists(FCPATH."uploads/posts/".$path)){?>
                  <img src="<?php echo base_url();?>/uploads/posts/<?php echo $post['photoPath']?>" class="img-responsive img-rounded" width="100%" height="auto" alt="">
                  <?php }else{?>
                    <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" alt="">
                 <?php }
              }?>

              <p align="justify"><?php echo $post['postBody'] ?></p>
              <br>
              <?php if ($post['updatedAt']!=null): ?>
                  <h6><?php echo "Updated At: ". $post['updatedAt'] ?></h6>
              <?php endif; ?>
        </div>

      <?php endforeach; ?>

<!--
   <table class="table table-bordered">
       <tr>
           <th>Title</th>
           <th>Body</th>
           <th>Category</th>
           <th>Created At</th>
           <th>Updated At</th>
           <th>Actions</th>

       </tr>
       <?php foreach ($list as $post): ?>
           <tr>
               <td><?php echo $post['postTitle']; ?></td>
               <td><?php echo $post['postBody']; ?></td>
               <td><?php echo $post['categories'] ?></td>
               <td><?php echo $post['createdAt']?></td>
               <td><?php echo $post['updatedAt']?></td>
               <td>
                    <a href="<?php echo site_url('cms/posts/editPost/') . $post['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url('cms/posts/deletePost/') . $post['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table> -->
  </div>

<?php require_once(APPPATH."views/cms/footer.php") ?>
