<?php require_once(APPPATH."modules/cms/views/header.php"); ?>
<h3>Posts</h3>
<hr>
<br>
  <div class="container">
       <?php foreach ($list as $post): ?>

         <div class="jumbotron">
             <h3><?php echo $post['postTitle']; ?></h3>
             <hr>
             <h6><?php echo $post['categoryName'] ?></h6>
             <small ><?php echo "Created At: ". $post['createdAt'] ?></small>
             <hr>
             <p><?php echo $post['postBody'] ?></p>
             <small><?php echo "Updated At: ". $post['updatedAt'] ?></small>
             <p>
                 <a href="<?php echo site_url('cms/posts/editPost/') . $post['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                 <a href="<?php echo site_url('cms/posts/deletePost/') . $post['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
             </p>
       </div>

     <?php endforeach; ?>
   </table>
  </div>

<?php require_once(APPPATH."modules/cms/views/footer.php") ?>
