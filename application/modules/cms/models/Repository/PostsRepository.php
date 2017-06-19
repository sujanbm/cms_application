<?php

namespace cms\models\Repository;
use Doctrine\ORM\EntityRepository;
use cms\models\Posts;

class PostsRepository extends EntityRepository {

    public function getAllPosts(){

            $posts = $this->getEntityManager()->getRepository('cms\models\Posts')->findAll();
            foreach ($posts as $post) {
              $p['id'] = $post->getId();
              $p['postTitle'] = $post->getPostTitle();
              $p['postBody'] = $post->getPostBody();
              $p['createdAt'] = $post->getCreatedAt();
              if($post->getUpdatedAt() != null){
                $p['updatedAt'] = $post->getUpdatedAt()->format('Y-m-d H:i:s');
            }else {
                $p['updatedAt'] = $post->getUpdatedAt();
            }
              $p['categories'] = $post->getCategories()->getCategoryName();
              $p['categoriesId'] = $post->getCategories()->getId();
              $pos[] = $p;
            }
            if(!empty($pos)){
            return $pos;

            }else{
                return $posts;
            }

    }

    public function getPostById($id){

        $post = $this->getEntityManager()->getRepository('cms\models\Posts')->find($id);

        if ($post != null){
            $p['id'] = $post->getId();
            $p['postTitle'] = $post->getPostTitle();
            $p['postBody'] = $post->getPostBody();
            $p['categoriesId'] = $post->getCategories()->getId();
            return $p;
        }else{
            redirect(site_url('cms/posts'));
        }
    }

    public function updatePost($p){

        $post = $this->getEntityManager()->getRepository('cms\models\Posts')->find($p['id']);

        if($post != null){
            $post->setPostTitle($p['postTitle']);
            $post->setPostBody($p['postBody']);
            $post->setUpdatedAt();
            $post->setCategories($this->getEntityManager()->getRepository('cms\models\Categories')->find($p['categories']));
            $this->getEntityManager()->flush();
            return true;
        }


    }


}


 ?>
