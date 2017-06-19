<?php require_once(APPPATH."modules/cms/views/header.php"); ?>
<h3>Posts</h3>
<hr>
<br>
    <div class="container">
    <!-- <a href="<?php echo site_url('cms/posts/createPost/') ?>"><button type="button" class="btn btn-success">Create Post</button></a> -->
      <?php foreach ($list as $post): ?>
<!--
          <div class="col-sm-4 col-md-6">
            <div class="thumbnail">
              <div class="caption">
                <h3><?php echo $post['postTitle']; ?></h3>
                <hr>
                <h6><?php echo $post['categories'] ?></h6>
                <small ><?php echo "Created At: ". $post['createdAt'] ?></small>
                <hr>
                <p><?php echo $post['postBody'] ?></p>
                <small><?php echo "Updated At: ". $post['updatedAt'] ?></small>
                <p>
                    <a href="<?php echo site_url('cms/posts/editPost/') . $post['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url('cms/posts/deletePost/') . $post['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
                </p>
              </div>
            </div>
          </div> -->

          <div class="jumbotron">
              <h3><?php echo $post['postTitle']; ?></h3>
              <hr>
              <h6><?php echo $post['categories'] ?></h6>
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

<!--
   <table class="table table-bordered">
       <tr>
           <th>Title</th>
           <th>Body</th>
           <th>Category</th>
           <th>Created At</th>
           <th>Updated At</th>
           <th>Actions</th>

       </tr>
       <?php foreach ($list as $post): ?>
           <tr>
               <td><?php echo $post['postTitle']; ?></td>
               <td><?php echo $post['postBody']; ?></td>
               <td><?php echo $post['categories'] ?></td>
               <td><?php echo $post['createdAt']?></td>
               <td><?php echo $post['updatedAt']?></td>
               <td>
                    <a href="<?php echo site_url('cms/posts/editPost/') . $post['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo site_url('cms/posts/deletePost/') . $post['id']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Are you sure want to delete');">Delete</button></a>
               </td>

           </tr>
       <?php endforeach; ?>
   </table> -->
  </div>

<?php require_once(APPPATH."modules/cms/views/footer.php") ?>
