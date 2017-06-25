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

             <?php foreach ($list as $post): ?>

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

         <?php echo $links; ?>


</div>
</section><!-- /.content -->

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>
