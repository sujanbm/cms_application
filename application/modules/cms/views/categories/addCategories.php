<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Categories
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">


       <form action="<?php echo site_url('cms/Categories/addCategory');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
           <div class="form-group">
               <label for="categoryName">Category Name</label>
               <input type="text" class="form-control" id="categoryName" name="categoryName" required>
           </div>
           <div class="form-group">
               <label for="subCategoryId">Parent Category</label>
               <select class="form-control" name="subCategoryId" value"">
                   <option value="">Null</option>
                   <?php if( !empty($categories)) foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->getId(); ?>"> <?php echo $category->getCategoryName(); ?> </option>
                    <?php } ?>

               </select>
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>
   </section><!-- /.content -->

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>
