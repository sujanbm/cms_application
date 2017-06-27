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
            'rules' =>  'trim|required|valid_email|callback_check'
            // 'rules' =>  'trim|required|valid_email'
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
        array(
            'field' =>  'role',
            'label' =>  'Admin Role',
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
        ),
        array(
            'field' =>  'role',
            'label' =>  'Admin Role',
            'rules' =>  'required'
        ),
    ),
);
