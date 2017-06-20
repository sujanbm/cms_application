<?php require_once(APPPATH."modules/cms/views/header.php"); ?>
<h3>Categories</h3>
<hr>
<br>
  <div class="row">
   <!-- <a href="<?php echo site_url('cms/categories/createCategory/') ?>"><button type="button" class="btn btn-success">Create Category</button></a> -->
   <table class="table table-bordered">
       <tr>
           <th>Categories</th>
           <th>Actions</th>

       </tr>
       <?php foreach ($list as $category): ?>
           <tr>
               <td><?php echo $category['categoryName']; ?></td>
               <td>
                    <a href="<?php echo site_url('cms/categories/posts/') . $category['id'] ?>"><button type="button" class="btn btn-primary">View Posts</button></a>
                    <a href="<?php echo site_url('cms/categories/subCategories/') . $category['id'] ?>"><button type="button" class="btn btn-primary">View Sub Categories</button></a>
                    <a href="<?php echo site_url('cms/categories/editCategory/') . $category['id'] ?>"><button type="button" class="btn btn-danger">Edit</button></a>
                    <a href="<?php echo site_url('cms/categories/deleteCategory/') . $category['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table>
  </div>

<?php require_once(APPPATH."modules/cms/views/footer.php") ?>
