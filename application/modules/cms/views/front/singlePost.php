
<?php require_once(APPPATH."views/cms/header_1.php"); ?>
	<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->
	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3><?php echo $post->getPostTitle(); ?></h3>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /blue -->


	<!-- *****************************************************************************************************************
	 BLOG CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">

	 		<div class="col-lg-8">
		 		<p>
					<?php
                    if($post->getPhotoPath() != null){
                        $path = $post->getPhotoPath();
                        if(file_exists(FCPATH."uploads/posts/".$path)){?>
                        <img src="<?php echo base_url();?>/uploads/posts/<?php echo $path?>" class="img-responsive">
                        <?php }else{?>
                          <img src="<?php echo base_url(); ?>/uploads/facebook-avatar.jpg" class="img-responsive">
                       <?php }

                    } ?>
				</p>
		 		<h3 class="ctitle"><?php echo $post->getPostTitle(); ?></h3>
		 		<p><csmall>Posted: <?php echo $post->getCreatedAt(); ?></csmall> | <csmall2>By: <?php echo $post->getAuthor(); ?></csmall2></p>
		 		<p align="justify"><?php echo $post->getPostBody(); ?></p>

		 		<!-- <h6>SHARE:</h6>
		 		<p class="share">
		 			<a href="#"><i class="fa fa-twitter"></i></a>
		 			<a href="#"><i class="fa fa-facebook"></i></a>
		 			<a href="#"><i class="fa fa-tumblr"></i></a>
		 			<a href="#"><i class="fa fa-google-plus"></i></a>
		 		</p> -->

			</div><! --/col-lg-8 -->

<?php require_once(APPPATH."modules/cms/views/front/sidebar.php"); ?>
