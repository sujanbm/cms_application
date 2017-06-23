<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS</title>

    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>/assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('cms'); ?>">Home</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                    <?php foreach ($categories as $category): ?>
                        <?php if ($category->getCategory()->count() < 1) { ?>
                            <li class="nav-item">
                              <a class="nav-link" href="<?php echo site_url('cms/category/') . $category->getId() ?>"> <?php echo $category->getCategoryName() ?> <span class="sr-only"></span></a>
                            </li>
                        <?php }else{ ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php echo $category->getCategoryName(); ?>
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php foreach ($category->getCategory() as $c): ?>
                                    <li><a class="dropdown-item" href="<?php echo site_url('cms/category/') . $c->getId() ?>"><?php echo $c->getCategoryName();?></a></li>
                                <?php endforeach; ?>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo site_url('cms/category/') . $category->getId() ?>"> <?php echo $category->getCategoryName(); ?></a></li>
                            </ul>
                          </li>
                            <?php } ?>
                    <?php endforeach; ?>
                </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>


<!--





  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo site_url('cms/posts'); ?>">Posts</a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo site_url('cms/posts/createPost/') ?>">Create Post <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('cms/categories/createCategory/') ?>">Create Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('cms/categories/') ?>">All Categories</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php foreach ($categories as $category): ?>
                <a class="dropdown-item" href="<?php echo site_url('cms/categories/posts/') . $category->getId() ?>"><?php echo $category->getCategoryName();?></a>
            <?php endforeach; ?>
        </div>
      </li>
      </ul>
    </div>
  </nav> -->
  <div class="container">
      <?php if ($this->session->flashdata('errorMessage')){
          ?> <div class="alert alert-warning">
              <strong><?php echo $this->session->flashdata('errorMessage');?></strong>
          </div><?php
      }
      if ($this->session->flashdata('deleteMessage')) {
          ?> <div class="alert alert-danger">
              <strong><?php echo $this->session->flashdata('deleteMessage');?></strong>
          </div><?php
      }
      if ($this->session->flashdata('message')) {
          ?><div class="alert alert-success">
              <strong><?php echo $this->session->flashdata('message');?></strong>
            </div><?php
      }
          ?>
