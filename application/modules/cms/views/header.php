<html>
<head>
    <title>CMS</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>
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
  </nav>
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
