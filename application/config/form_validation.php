<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'admin/create' => array(
        array(
            'field' =>  'adminName',
            'label' =>  'Name',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'adminEmail',
            'label' =>  'Email',
            'rules' =>  'trim|required|valid_email'
        ),
        array(
            'field' =>  'adminPassword',
            'label' =>  'Password',
            'rules' =>  'trim|required|min_length[8]'
        ),
        array(
            'field' =>  'adminPasswordConf',
            'label' =>  'Retype Password',
            'rules' =>  'trim|required|matches[adminPassword]'
        ),
        array(
            'field' =>  'adminPhone',
            'label' =>  'Phone No.',
            'rules' =>  'required|trim|min_length[7]'
        ),
        array(
            'field' =>  'adminStatus',
            'label' =>  'Status',
            'rules' =>  'required'
        ),
    ),
    'admin/update' => array(
        array(
            'field' =>  'adminName',
            'label' =>  'Name',
            'rules' =>  'required'
        ),
        array(
            'field' =>  'adminEmail',
            'label' =>  'Email',
            'rules' =>  'trim|required|valid_email'
        ),
        array(
            'field' =>  'adminPhone',
            'label' =>  'Phone No.',
            'rules' =>  'trim|required|min_length[7]'
        ),
        array(
            'field' =>  'adminStatus',
            'label' =>  'Status',
            'rules' =>  'required'
        )
    ),
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
