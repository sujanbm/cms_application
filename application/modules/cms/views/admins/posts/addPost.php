<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Post
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">

       <form action="<?php echo site_url('cms/Posts/addPost');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
           <div class="form-group">
               <label for="postTitle">Post Title</label>
               <input type="text" class="form-control" id="postTitle" name="postTitle" value="<?php echo set_value('postTitle') ?>" required>
               <span><?php echo form_error('postTitle') ?></span>
           </div>
           <!-- <div class="form-group">
               <label for="postBody">Post Description</label>
               <textarea name="postBody" class="form-control" rows="8" cols="80" required><?php echo set_value('postBody') ?></textarea>
               <span><?php echo form_error('postBody') ?></span>
           </div> -->
           <div class="form-group">
               <div class='box box-info'>
                   <div class='box-header'>
                       <label for="postBody">Post Description</label>
                       <div class="pull-right box-tools">
                           <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                           <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                       </div>
                   </div>
                   <div class='box-body pad'>
                           <textarea id="editor1" name="postBody" rows="10" cols="80">
                               <?php echo set_value('postBody') ?>
                           </textarea>
                   </div>
                   <span><?php echo form_error('postBody') ?></span>
               </div>
           </div>
           <div class="form-group">
               <label for="categories">Category</label>
               <select class="form-control" name="categories" value"<?php echo set_value('categories') ?>">
                   <?php if( !empty($categories)) foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->getId(); ?>"> <?php echo $category->getCategoryName(); ?> </option>
                            <?php if ($category->getCategory()->count() >0): ?>

                                <?php foreach ($category->getCategory() as $cat): ?>
                                    <option value="<?php echo $cat->getId(); ?>"> <?php echo " - - " . $cat->getCategoryName(); ?> </option>
                                <?php endforeach; ?>

                            <?php endif; ?>
                    <?php } ?>
               </select>
               <span><?php echo form_error('categories') ?></span>
           </div>
           <div class="form-group">
               <input type="file" name="file" id="file">
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>
   </section><!-- /.content -->

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>
