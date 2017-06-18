<?php require_once(APPPATH. 'modules/cms/views/header.php'); ?>
<h1>Create Post</h1>
<br>
<div class="row">

       <form action="<?php echo site_url('cms/Posts/addPost');?>" class="form" role="form" method="post" enctype="multipart/form-data" id = "FormId">
           <div class="form-group">
               <label for="postTitle">Post Title</label>
               <input type="text" class="form-control" id="postTitle" name="postTitle" required>
           </div>
           <div class="form-group">
               <label for="postBody">Post Description</label>
               <input type="textarea" class="form-control" id="postBody" name="postBody" required>
           </div>
           <div class="form-group">
               <label for="categories">Category</label>
               <select class="selectpicker" name="categories" value"">
                   <option value="1">Sports</option>
                   <option value="2">Finance</option>
                   <!-- <?php if( !empty($categories)) foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->id; ?>"> <?php echo $category->categoryName; ?> </option>
                    <?php } ?> -->
               </select>
           </div>
           <div class="form-group">
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>

<?php require_once(APPPATH. 'modules/cms/views/footer.php'); ?>
