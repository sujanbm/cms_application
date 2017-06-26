<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Categories
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">
   <!-- <a href="<?php echo site_url('cms/categories/createCategory/') ?>"><button type="button" class="btn btn-success">Create Category</button></a> -->
   <table class="table table-bordered">
       <tr>
           <th>Categories</th>
           <th>Actions</th>

       </tr>
       <?php foreach ($list as $category): ?>
           <tr>
               <td><?php echo $category->getCategoryName(); ?></td>
               <td>
                    <a href="<?php echo site_url('cms/categories/posts/') . $category->getId() . '/page'?>"><button type="button" class="btn btn-primary">View Posts</button></a>
                    <?php if ($category->getCategory()->count() > 0) { ?>
                        <a href="<?php echo site_url('cms/categories/subCategories/') . $category->getId() ?>"><button type="button" class="btn btn-primary">View Sub Categories</button></a>
                    <?php }else{ ?>
                        <a><button type="button" class="btn .disabled">View Sub Categories</button></a>
                    <?php } ?>
                    <a href="<?php echo site_url('cms/categories/editCategory/') . $category->getId() ?>"><button type="button" class="btn btn-danger">Edit</button></a>
                    <a href="<?php echo site_url('cms/categories/deleteCategory/') . $category->getId() ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table>
</div>
</section><!-- /.content -->

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>
