<?php require_once(APPPATH. '/views/admins/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Post
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="">

       <form action="<?php echo site_url('cms/Posts/updatePost');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
           <div class="form-group">
               <label for="postTitle">Post Title</label>
               <input type="text" class="form-control" id="postTitle" name="postTitle" value="<?php echo $post->getPostTitle(); ?>" required>
           </div>
           <div class="form-group">
               <label for="postBody">Post Description</label>
               <textarea name="postBody" class="form-control" rows="8" cols="80" ><?php echo $post->getPostBody();?></textarea>
           </div>
           <div class="form-group">
               <label for="categories">Category</label>
               <select class="form-control" name="categories" value"">
                   <?php if( !empty($categories)) foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->getId(); ?>" <?php if($category->getId() == $post->getCategories()->getId()) echo "selected" ?> > <?php echo $category->getCategoryName(); ?> </option>
                            <?php if ($category->getCategory()->count() >0): ?>

                                <?php foreach ($category->getCategory() as $cat): ?>
                                    <option value="<?php echo $cat->getId(); ?>" <?php if($cat->getId() == $post->getCategories()->getId()) echo "selected" ?>> <?php echo " - - " . $cat->getCategoryName(); ?> </option>
                                <?php endforeach; ?>

                            <?php endif; ?>
                    <?php } ?>

               </select>
           </div>
           <div class="form-group">
               <input type="file" name="file" id="file">
           </div>
           <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>
   </section>

<?php require_once(APPPATH. '/views/admins/footer.php'); ?>
