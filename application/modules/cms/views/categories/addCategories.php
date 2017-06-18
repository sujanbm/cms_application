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
               <button class="btn btn-success">Save</button>
           </div>
       </form>
   </div>

<?php require_once(APPPATH. 'modules/cms/views/footer.php'); ?>
