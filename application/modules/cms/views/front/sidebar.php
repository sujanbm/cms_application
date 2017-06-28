


	 		<div class="col-lg-4">
		 		<!-- <h4>Search</h4>
		 		<div class="hline"></div>
		 			<p>
		 				<br/>
		 				<input type="text" class="form-control" placeholder="Search something">
		 			</p>

		 		<div class="spacing"></div> -->

		 		<h4>Categories</h4>
		 		<div class="hline"></div>
                <?php foreach ($categories as $category): ?>
                    <p><a href="<?php echo site_url('cms/front/category/') . $category->getId(); ?>"><i class="fa fa-angle-right"></i> <?php echo $category->getCategoryName(); ?></a> <span class="badge badge-theme pull-right"><?php echo $category->getPosts()->count(); ?></span></p>
                <?php endforeach; ?>

		 		<div class="spacing"></div>

		 		<h4>Recent Posts</h4>

		 		<div class="hline"></div>
					<ul class="popular-posts">
                        <?php foreach ($posts as $post): ?>
                            <li>
                                <?php
                                if($post->getPhotoPath() != null){
                                    $path = $post->getPhotoPath();
                                    if(file_exists(FCPATH."uploads/posts/".$path)){?>
                                    <a href="<?php echo site_url('cms/front/singlePost/') . $post->getId();  ?>"><img src="<?php echo base_url();?>/uploads/posts/<?php echo $path?>" alt="Popular Post" height="70px" width="70px"></a>
                                    <?php }else{?>
                                      <a href="<?php echo site_url('cms/front/singlePost/') . $post->getId();  ?>"><img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" alt="Popular Post" height="70px" width="70px"></a>
                                   <?php }
                                }else{?>
                                  <a href="<?php echo site_url('cms/front/singlePost/') . $post->getId();  ?>"><img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" alt="Popular Post" height="70px" width="70px"></a>
                               <?php } ?>
                                <p><a href="<?php echo site_url('cms/front/singlePost/') . $post->getId();  ?>"><?php echo $post->getPostTitle(); ?></a></p>
                                <em>Posted on <?php echo $post->getCreatedAt(); ?></em>
                            </li>
                        <?php endforeach; ?>
		            </ul>

		 		<div class="spacing"></div>
	 		</div>
	 	</div>
	 </div>
     <!-- <script>
     function truncateText(selector, maxLength) {
        var element = document.querySelector(selector),
            truncated = element.innerText;

        if (truncated.length > maxLength) {
            truncated = truncated.substr(0,maxLength) + '...';
        }
        return truncated;
        }

        document.querySelector('p').innerText = truncateText('p', 107);
     </script> -->

<?php require_once(APPPATH."views/cms/footer_1.php"); ?>
