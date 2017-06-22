<?php

  namespace admin\models;
  use Doctrine\ORM\Mapping as ORM;

  /**
  *Admin
  *
  *@ORM\Table(name="admins")
  *@ORM\Entity(repositoryClass="admin\models\Repository\AdminRepository")
  */

  class Admin{

    /**
    * @var integer $id
    *
    * @ORM\Column(name="id", type="integer", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */

    private $id;

    /**
    * @var string $adminName
    *
    * @ORM\Column(name="adminName", type="string", length=80, nullable=false)
    */

    private $adminName;

    /**
    * @var string $adminEmail
    *
    * @ORM\Column(name="adminEmail", type="string", nullable=false, length=255)
    */

    private $adminEmail;

    /**
    * @var string $adminPassword
    *
    * @ORM\Column(name="adminPassword", type="string", nullable=false, length=255)
    */

    private $adminPassword;

    /**
    * @var string $adminPhoto
    *
    * @ORM\Column(name="adminPhoto", type="string", length=255, nullable=true)
    */

    private $adminPhoto;

    /**
    * @var boolean $adminStatus
    *
    * @ORM\Column(name="adminStatus", type="boolean", nullable=false)
    */

    private $adminStatus;

    /**
    * @var bigint $adminPhone
    *
    * @ORM\Column(name="adminPhone", type="bigint", nullable=false)
    */

    private $adminPhone;


    public function getId(){

        return $this->id;

    }

    public function setAdminName($name){

        $this->adminName = $name;

    }

    public function getAdminName(){

        return $this->adminName;

    }

    public function setAdminEmail($email){

        $this->adminEmail = $email;

    }

    public function getAdminEmail(){

        return $this->adminEmail;

    }

    public function setAdminPassword($password){

        $this->adminPassword = $password;

    }

    public function getAdminPassword(){

        return $this->adminPassword;

    }

    public function setAdminPhoto($photo){

        $this->adminPhoto = $photo;

    }

    public function getAdminPhoto(){

        return $this->adminPhoto;

    }

    public function setAdminStatus($status){

        $this->adminStatus = $status;

    }

    public function getAdminStatus(){

        return $this->adminStatus;

    }

    public function setAdminPhone($phone){

        $this->adminPhone = $phone;

    }

    public function getAdminPhone(){

        return $this->adminPhone;

    }

  }

 ?>
