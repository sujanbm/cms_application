<?php require_once(APPPATH. 'modules/cms/views/header.php'); ?>
    <h1>Edit Category</h1>
    <br>
    <div class="row">

           <form action="<?php echo site_url('cms/Categories/updateCategory')?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
               <div class="form-group">
                   <label for="categoryName">Category Name</label>
                   <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $cat->getCategoryName(); ?>" required>
               </div>
               <?php if ($cat->getSubCategory() != null){ ?>
                   <div class="form-group">
                       <label for="subCategoryId"></label>
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

<?php require_once(APPPATH. 'modules/cms/views/footer.php'); ?>
