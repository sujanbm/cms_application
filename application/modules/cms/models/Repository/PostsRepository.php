<?php

namespace cms\models\Repository;
use Doctrine\ORM\EntityRepository;
use cms\models\Posts;

class PostsRepository extends EntityRepository {

    public function getAllPosts(){

            $posts = $this->getEntityManager()->getRepository('cms\models\Posts')->findBy(array(), array('createdAt'=>'DESC'));
            foreach ($posts as $post) {
              $p['id'] = $post->getId();
              $p['postTitle'] = $post->getPostTitle();
              $p['postBody'] = $post->getPostBody();
              $p['createdAt'] = $post->getCreatedAt();
              $p['photoPath'] = $post->getPhotoPath();
              if($post->getUpdatedAt() != null){
                $p['updatedAt'] = $post->getUpdatedAt()->format('Y-m-d H:i:s');
            }else {
                $p['updatedAt'] = $post->getUpdatedAt();
            }
              $p['categoryName'] = $post->getCategories()->getCategoryName();
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

    public function updatePost($p, $path){

        $post = $this->getEntityManager()->getRepository('cms\models\Posts')->find($p['id']);

        if($post != null){
            $post->setPostTitle($p['postTitle']);
            $post->setPostBody($p['postBody']);
            $post->setPhotoPath($path);
            $post->setUpdatedAt();
            $post->setCategories($this->getEntityManager()->getRepository('cms\models\Categories')->find($p['categories']));
            $this->getEntityManager()->flush();
            return true;
        }
    }

        public function fetch_users($limit, $start){



                $post = $this->getEntityManager()->getRepository('cms\models\Posts')->findBy(array(), array('createdAt'=>'DESC'), $limit, $start);
                if($post != null){
                    return $post;
                }
                else{
                    return false;

                }
        }




}


 ?>
