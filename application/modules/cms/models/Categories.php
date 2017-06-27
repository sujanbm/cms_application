<?php

  namespace cms\models;
  use Doctrine\ORM\Mapping as ORM;
  use Doctrine\Common\Collections\ArrayCollection;
  use cms\models\Posts;

  /**
  * Categories
  *
  * @ORM\Table(name="categories")
  * @ORM\Entity(repositoryClass="cms\models\Repository\CategoriesRepository")
  */

  class Categories{

    /**
    * @var integer $id
    *
    * @ORM\Column(name="id", type="integer", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */

    private $id;

    /**
    * @var string $categoryName
    *
    * @ORM\Column(name="categoryName", type="string", length=50, nullable=false)
    */

    private $categoryName;

    /**
     *
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="subCategory")
     */
    private $category;

    /**
    *
    *@ORM\ManyToOne(targetEntity="Categories", inversedBy="category")
    *@ORM\JoinColumn(name="subCategoryId", referencedColumnName="id", nullable=true)
    */
    private $subCategory;


    // /**
    // * @var boolean $status
    // *
    // * @ORM\Column(name="status", type="boolean", nullable=false)
    // */
    //
    // private $status;

    /**
     * One Category has Many Posts.
     * @ORM\OneToMany(targetEntity="Posts", mappedBy="categories")
     */

    private $posts;

    public function __construct() {

        $this->posts = new ArrayCollection();
        $this->category = new ArrayCollection();

    }

    public function getId(){

      return $this->id;

    }

    public function setCategoryName($name){

      $this->categoryName = $name;

    }

    public function getCategoryName(){

      return $this->categoryName;

    }

    public function setSubCategory($id){

        $this->subCategory = $id;

    }

    public function getSubCategory(){

        return $this->subCategory;
    }

    // public function setPosts($id){
    //
    //   $this->posts = $id;
    //
    // }

    public function getPosts(){

      return $this->posts;

    }

    public function getCategory(){

        return $this->category;

    }

  }


 ?>
