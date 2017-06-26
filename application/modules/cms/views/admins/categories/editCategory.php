<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Categories
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">


           <form action="<?php echo site_url('cms/Categories/updateCategory')?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
               <div class="form-group">
                   <label for="categoryName">Category Name</label>
                   <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $cat->getCategoryName(); ?>" required>
                   <span><?php echo form_error('categoryName') ?></span>
               </div>
               <?php if ($cat->getSubCategory() != null){ ?>
                   <div class="form-group">
                       <label for="subCategoryId">Parent Category</label>
                       <select class="form-control" name="subCategoryId" value"">
                           <option value="">Null</option>
                           <?php if( !empty($categories)) foreach ($categories as $c) { ?>
                                <option value="<?php echo $c->getId(); ?>" <?php if($c->getId() == $cat->getSubCategory()->getId()) echo "selected"; ?>> <?php echo $c->getCategoryName(); ?> </option>
                            <?php } ?>
                       </select>
                   </div>
               <?php } ?>

               <div class="form-group">
                   <button class="btn btn-success">Save</button>
               </div>
                <input type="hidden" name="id" value="<?php echo $cat->getId(); ?>">
           </form>


       </div>
       </section><!-- /.content -->

    <?php require_once(APPPATH. '/views/admins/footer.php'); ?>
