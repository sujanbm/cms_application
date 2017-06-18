<?php

  namespace cms\models;
  use Doctrine\ORM\Mapping as ORM;

  /**
  *Posts
  *
  *@ORM\Table(name="posts")
  *@ORM\Entity(repositoryClass="cms\models\Repository\PostsRepository")
  */

  class Posts{

    /**
    * @var integer $id
    *
    * @ORM\Column(name="id", type="integer", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */

    private $id;

    /**
    * @var string $postTitle
    *
    * @ORM\Column(name="postTitle", type="string", length=80, nullable=false)
    */

    private $postTitle;

    /**
    * @var string $postBody
    *
    * @ORM\Column(name="postBody", type="string", length=255, nullable=false)
    */

    private $postBody;

    /**
    * @var datetime $createdAt
    *
    * @ORM\Column(name="createdAt", type="datetime")
    */

    private $createdAt;

    /**
    * @var datetime $updatedAt
    *
    * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
    */

    private $updatedAt;

    /**
   * Many Posts have One Category.
   * @ORM\ManyToOne(targetEntity="Categories", inversedBy="posts")
   * @ORM\JoinColumn(name="categoriesId", referencedColumnName="id", nullable=false)
   */
    private $categories;

    public function getId(){

      return $this->id;

    }

    public function getPostTitle(){

      return $this->postTitle;

    }

    public function setPostTitle($postTitle){

      $this->postTitle = $postTitle;

    }

    public function getPostBody(){

      return $this->postBody;

    }

    public function setPostBody($postBody){

      $this->postBody = $postBody;

    }

    public function getCreatedAt(){

      return $this->createdAt;

    }

    public function setCreatedAt(){

      date_default_timezone_set('Asia/Kathmandu');
      $this->createdAt = date('m/d/Y h:i:s a', time());

    }

    public function getUpdatedAt(){

      return $this->updatedAt;

    }

    public function setUpdatedAt(){

      date_default_timezone_set('Asia/Kathmandu');
      $this->updatedAt = date('m/d/Y h:i:s a', time());
    }

    public function getCategories(){

      return $this->categories;

    }

    public function setCategories($categories){

      $this->categories = $categories;

    }

  }

 ?>
