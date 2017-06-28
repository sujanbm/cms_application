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
                            }
						 ?>
                        </p>
                        <a href="<?php echo site_url('cms/front/singlePost/') . $post->getId(); ?>"><h3 class="ctitle"><?php echo $post->getPostTitle(); ?></h3></a>
                        <p><csmall>Posted: <?php echo $post->getCreatedAt(); ?></csmall> | <csmall2>By: <?php echo $post->getAuthor(); ?></csmall2></p>
                        <p align="justify"><?php echo substr($post->getPostBody(),0,255) .  " ...";?></p>
                        <p><a href="<?php echo site_url('cms/front/singlePost/') . $post->getId(); ?>">[Read More]</a></p>
                        <div class="hline"></div>

                        <div class="spacing"></div>
                <?php endforeach; ?>
                <?php echo $links; ?>
			</div>

<?php require_once(APPPATH."modules/cms/views/front/sidebar.php"); ?>
