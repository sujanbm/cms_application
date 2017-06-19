<?php require_once(APPPATH."modules/cms/views/header.php"); ?>
<h3>Posts</h3>
<hr>
<br>
  <div class="row">
   <table class="table table-bordered">
       <tr>
           <th>Category</th>
           <th>Title</th>
           <th>Body</th>
           <th>Created At</th>
           <th>Updated At</th>
           <th>Actions</th>

       </tr>
       <?php foreach ($list as $post): ?>
           <tr>
               <td><?php echo $post['categoryName'];?></td>
               <td><?php echo $post['postTitle']; ?></td>
               <td><?php echo $post['postBody']; ?></td>
               <td><?php echo $post['createdAt']?></td>
               <td><?php echo $post['updatedAt']?></td>
               <td>
                    <a href="<?php echo site_url('cms/posts/editPost/') . $post['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url('cms/posts/deletePost/') . $post['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table>
  </div>

<?php require_once(APPPATH."modules/cms/views/footer.php") ?>
