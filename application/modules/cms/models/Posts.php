<?php

  namespace cms\models;
  use Doctrine\ORM\Mapping as ORM;
  use cms\models\Categories;

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

      return $this->createdAt->format('Y-m-d H:i:s');

    }

    public function setCreatedAt(){

      $this->createdAt = new \DateTime();

    }

    public function getUpdatedAt(){

      return $this->updatedAt;

    }

    public function setUpdatedAt(){

      $this->createdAt = new \DateTime();
    }

    public function getCategories(){

        return $this->categories;
    }


    public function setCategories(Categories $categories){

      $this->categories = $categories;

    }

  }

 ?>
