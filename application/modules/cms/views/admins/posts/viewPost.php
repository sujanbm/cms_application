<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Posts
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    <!-- <a href="<?php echo site_url('cms/posts/createPost/') ?>"><button type="button" class="btn btn-success">Create Post</button></a> -->
         <table class="table table-bordered table-hover ">
             <tr>
                 <th>Title</th>
                 <th>Category</th>
                 <th>Created At</th>
                 <th>Updated At</th>
                 <th>Actions</th>

             </tr>
             <?php foreach ($posts as $post): ?>
                 <tr>
                     <td><?php echo $post->getPostTitle(); ?></td>
                     <td><?php echo $post->getCategories()->getCategoryName(); ?></td>
                     <td><?php echo $post->getCreatedAt();?></td>
                     <td>
                        <?php if($post->getUpdatedAt() != null){
                           echo $post->getUpdatedAt()->format('Y-m-d H:i:s');
                       }else {
                           echo $post->getUpdatedAt();
                       } ?>
                     </td>
                     <td>
                          <a href="<?php echo site_url('cms/posts/editPost/') . $post->getId() ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                          <a href="<?php echo site_url('cms/posts/viewPost/') . $post->getId() ?>"><button type="button" class="btn btn-success">View</button></a>
                          <a href="<?php echo site_url('cms/posts/deletePost/') . $post->getId() ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
                     </td>

                 </tr>
             <?php endforeach; ?>
         </table>



</div>
</section><!-- /.content -->

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>



<!-- <?php foreach ($posts as $post){ ?>

    <div class="jumbotron">
        <h3><?php echo $post['postTitle']; ?></h3>
        <hr>
        <h6><?php echo $post['categoryName'] ?></h6>
        <small ><?php echo "Created At: ". $post['createdAt'] ?></small>
        <hr>
        <?php
        if($post['photoPath'] != null){
            $path = $post['photoPath'];
            if(file_exists(FCPATH."uploads/".$path)){?>
            <img src="<?php echo base_url();?>/uploads/<?php echo $post['photoPath']?>" class="img-responsive img-rounded" width="100%" height="auto" alt="">
            <?php }else{?>
              <img src="http://gazettereview.com/wp-content/uploads/2016/03/facebook-avatar.jpg" alt="">
           <?php }
        }?>

        <p align="justify"><?php echo $post['postBody'] ?></p>
        <small><?php echo "Updated At: ". $post['updatedAt'] ?></small>
        <p>
            <a href="<?php echo site_url('cms/posts/editPost/') . $post['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
            <a href="<?php echo site_url('cms/posts/deletePost/') . $post['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
        </p>
  </div>

<?php } ?> -->
