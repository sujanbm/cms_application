<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'post/create' => array(
        array(
            'field' =>  'postTitle',
            'label' =>  'Post Title',
            'rules' =>  'required|min_length[8]|max_length[55]'
        ),
        array(
            'field' =>  'postBody',
            'label' =>  'Post Description',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'categories',
            'label' =>  'Category',
            'rules' =>  'required'
        )
    ),
    'post/update'   =>  array(
        array(
            'field' =>  'postTitle',
            'label' =>  'Post Title',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'postBody',
            'label' =>  'Post Description',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'categories',
            'label' =>  'Category',
            'rules' =>  'required'
        )
    ),
    'category/create'   =>  array(
        array(
            'field' =>  'categoryName',
            'label' =>  'Category Name',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'subCategoryId',
            'label' =>  'Parent Category',
            'rules' =>  ''
        )
    ),
    'category/update'   =>  array(
        array(
            'field' =>  'categoryName',
            'label' =>  'Category Name',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'subCategoryId',
            'label' =>  'Parent Category',
            'rules' =>  ''
        )
    )
);
