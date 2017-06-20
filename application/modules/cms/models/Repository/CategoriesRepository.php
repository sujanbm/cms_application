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


        public function getCategoryById($id){

            $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($id);
            if ($category != null){
                $cat['id'] = $category->getId();
                $cat['categoryName'] = $category->getCategoryName();
            }else{
                echo "Category Not Found";
                die();
            }
            return $cat;

        }

        public function updateCategory($post){

            $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($post['id']);
            if ($category != null){
                $category->setCategoryName($post['categoryName']);
                $this->getEntityManager()->flush();
            }
            return true;


        }

        public function getPostsByCategory($id){

            $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($id);
            if ($category != null){
                $posts = $category->getPosts();
                foreach($posts as $post){
                    $c['id'] = $post->getId();
                    $c['categoryName'] = $category->getCategoryName();

                    $c['postTitle'] = $post->getPostTitle();
                    $c['postBody'] = $post->getPostBody();
                    $c['createdAt'] = $post->getCreatedAt();
                    if($post->getUpdatedAt() != null){
                      $c['updatedAt'] = $post->getUpdatedAt()->format('Y-m-d H:i:s');
                  }else {
                      $c['updatedAt'] = $post->getUpdatedAt();
                  }
                    $p[] = $c;
                }
                if (!empty($p)){
                return $p;
                }else{
                    return $posts;
                }
            }else{
                redirect(site_url('cms/categories'));
            }

        }

        public function deleteCategory($id){

            $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($id);
            if ($category != null){
                $posts = $category->getPosts();
                foreach($posts as $post){
                    $c['id'] = $post->getId();
                    $p[] = $c;
                }
                if (!empty($p)){
                    return false;
            }else{
                // $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($id);
                $this->getEntityManager()->remove($category);
                $this->getEntityManager()->flush();
                return true;
            }
        }
        }

    }


?>
