<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOLID - Bootstrap 3 Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet">
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('cms/front'); ?>">CMS</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('cms/front'); ?>">Home</a></li>
            <li><a href="<?php echo site_url('cms/front/posts') ?>">Posts</a></li>
            <?php foreach ($categories as $category): ?>
                <?php if ($category->getCategory()->count() > 0) {?>
                    <li class="dropdown active">
                      <a href="<?php echo site_url('cms/front/category/') . $category->getId(); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category->getCategoryName(); ?> <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <?php foreach ($category->getCategory() as $sub): ?>
                              <li><a href="<?php echo site_url('cms/front/category/') . $sub->getId(); ?>"><?php echo $sub->getCategoryName(); ?></a></li>
                          <?php endforeach; ?>
                          <li role="separator" class="divider"></li>
                          <li><a href="<?php echo site_url('cms/front/category/') . $category->getId(); ?>"> <?php echo $category->getCategoryName(); ?></a></li>
                      </ul>
                    </li>
                <?php }else{ ?>
                    <li><a href="<?php echo site_url('cms/front/category/') . $category->getId(); ?>"><?php echo $category->getCategoryName(); ?></a></li>
               <?php } ?>
            <?php endforeach; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
