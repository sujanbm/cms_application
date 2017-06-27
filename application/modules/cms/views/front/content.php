<?php require_once(APPPATH."views/cms/header_1.php"); ?>

	<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->
	<div id="blue">
	    <div class="container">
			<div class="row">
                <?php if ($catName == null){ ?>
                    <h3>Post List.</h3>
                <?php } else { ?>
                    <h3><?php echo $catName ?></h3>
                <?php } ?>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /blue -->


	<!-- *****************************************************************************************************************
	 BLOG CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">


	 		<div class="col-lg-8">
                <?php foreach ($list as $post): ?>

                        <p>
                            <?php
                            if($post->getPhotoPath() != null){
                                $path = $post->getPhotoPath();
                                if(file_exists(FCPATH."uploads/posts/".$path)){?>
                                <img src="<?php echo base_url();?>/uploads/posts/<?php echo $path?>" class="img-responsive">
                                <?php }else{?>
                                  <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" class="img-responsive">
                               <?php }
                            }else{?>
                              <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" class="img-responsive">
                           <?php } ?>
                        </p>
                        <a href=""><h3 class="ctitle"><?php echo $post->getPostTitle(); ?></h3></a>
                        <p><csmall>Posted: <?php echo $post->getCreatedAt(); ?></csmall> | <csmall2>By: <?php echo $post->getAuthor(); ?></csmall2></p>
                        <p><?php echo $post->getPostBody(); ?></p>
                        <p><a href="">[Read More]</a></p>
                        <div class="hline"></div>

                        <div class="spacing"></div>
                <?php endforeach; ?>
                <?php echo $links; ?>
			</div>



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
                    <p><a href="#"><i class="fa fa-angle-right"></i> <?php echo $category->getCategoryName(); ?></a> <span class="badge badge-theme pull-right"><?php echo $category->getPosts()->count(); ?></span></p>
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
                                    <a href=""><img src="<?php echo base_url();?>/uploads/posts/<?php echo $path?>" alt="Popular Post" height="70px" width="70px"></a>
                                    <?php }else{?>
                                      <a href=""><img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" alt="Popular Post" height="70px" width="70px"></a>
                                   <?php }
                                }else{?>
                                  <a href=""><img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" alt="Popular Post" height="70px" width="70px"></a>
                               <?php } ?>
                                <p><a href="#"><?php echo $post->getPostTitle(); ?></a></p>
                                <em>Posted on <?php echo $post->getCreatedAt(); ?></em>
                            </li>
                        <?php endforeach; ?>
		            </ul>

		 		<div class="spacing"></div>
	 		</div>
	 	</div>
	 </div>

<?php require_once(APPPATH."views/cms/footer_1.php"); ?>
