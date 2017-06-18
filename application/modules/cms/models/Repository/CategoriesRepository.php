<?php

    namespace cms\models\Repository;

    use Doctrine\ORM\EntityRepository;
    use cms\models\Categories;

    class CategoriesRepository extends EntityRepository {


        public function getAllCategories(){

            try {
                $categories = $this->getEntityManager()->getRepository('cms\models\Categories')->findAll();

                }
                catch(\Exception $err){

                    die($err->getMessage());
                }
                if ($categories != null){

                    foreach ($categories as $category) {
                      $cat['id'] = ($category->getId());
                      $cat['categoryName'] = ($category->getCategoryName());
                      $cate[] = $cat;
                    }
                    return $cate;

                }else{
                    return $categories;
                }

        }



    }


?>
