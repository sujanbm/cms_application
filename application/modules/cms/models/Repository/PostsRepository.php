<?php

namespace cms\models\Repository;
use Doctrine\ORM\EntityRepository;
use cms\models\Posts;

class PostsRepository extends EntityRepository {

    public function getAllPosts(){

        try {
            $posts = $this->getEntityManager()->getRepository('cms\models\Posts')->findAll();

            }
            catch(\Exception $err){

                die($err->getMessage());
            }
            if ($posts != null){

                foreach ($posts as $post) {
                  $p['id'] = $post->getId();
                  $p['postTitle'] = $post->getPostTitle();
                  $p['postBody'] = $post->getPostBody();
                  $p['createdAt'] = $post->getCreatedAt();
                  $p['updatedAt'] = $post->getUpdatedAt();
                  $p['categories'] = $post->getCategories()->getCategoryName();
                  $p['categoriesId'] = $post->getCategories()->getId();
                  $pos[] = $p;
                }
                return $pos;

            }else{
                return $posts;
            }

    }


}


 ?>
