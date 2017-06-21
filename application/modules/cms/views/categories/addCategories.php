<?php require_once(APPPATH. 'modules/cms/views/header.php'); ?>
<h1>Create Category</h1>
<br>
<div class="row">

       <form action="<?php echo site_url('cms/Categories/addCategory');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
           <div class="form-group">
               <label for="categoryName">Category Name</label>
               <input type="text" class="form-control" id="categoryName" name="categoryName" required>
           </div>
           <div class="form-group">
               <label for="subCategoryId"></label>
               <select class="form-control" name="subCategoryId" value"">
                   <option value="">Null</option>
                   <?php if( !empty($categories)) foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->getId(); ?>"> <?php echo $category->getCategoryName(); ?> </option>
                            <?php if ($category->getCategory()->count() >0): ?>

                                <?php foreach ($category->getCategory() as $cat): ?>
                                    <option value="<?php echo $cat->getId(); ?>"> <?php echo " - - " . $cat->getCategoryName(); ?> </option>
                                <?php endforeach; ?>

                            <?php endif; ?>
                    <?php } ?>
<!--
                    <?php
                        foreach($list as $category){ ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['categoryName']; ?></option>
                                <?php if($category['sub'] !=  null) foreach($category['sub'] as $subs){ ?>
                                    <option value="<?php echo $subs['id']; ?>"><?php echo $subs['categoryName'] ;?></option>
                                <?php }?>
                        <?php }
                    ?> -->
               </select>
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>

<?php require_once(APPPATH. 'modules/cms/views/footer.php'); ?>
