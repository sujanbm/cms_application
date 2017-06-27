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
                              <a class="nav-link" href="<?php echo site_url('cms/category/') . $category->getId()?>"> <?php echo $category->getCategoryName() ?> <span class="sr-only"></span></a>
                            </li>
                        <?php }else{ ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php echo $category->getCategoryName(); ?>
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php foreach ($category->getCategory() as $c): ?>
                                    <li><a class="dropdown-item" href="<?php echo site_url('cms/category/') . $c->getId()?>"><?php echo $c->getCategoryName();?></a></li>
                                <?php endforeach; ?>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo site_url('cms/category/') . $category->getId()?>"> <?php echo $category->getCategoryName(); ?></a></li>
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

  <div class="container">
