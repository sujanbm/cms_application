<?php require_once(APPPATH."modules/cms/views/header.php"); ?>
<h3>Categories</h3>
<hr>
<br>
  <div class="row">
   <table class="table table-bordered">
       <tr>
           <th>Categories</th>
           <th>Actions</th>

       </tr>
       <?php foreach ($list as $category): ?>
           <tr>
               <td><?php echo $category['categoryName']; ?></td>
               <td>
                    <a href="<?php echo site_url('cms/categories/posts/') . $category['id'] ?>"><button type="button" class="btn btn-alert">Posts</button></a>
                    <a href="<?php echo site_url('cms/categories/editCategory/') . $category['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url('cms/categories/deleteCategory/') . $category['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table>
  </div>

<?php require_once(APPPATH."modules/cms/views/footer.php") ?>
