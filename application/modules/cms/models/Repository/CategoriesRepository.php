<?php

    namespace cms\models\Repository;

    use Doctrine\ORM\EntityRepository;
    use cms\models\Categories;

    class CategoriesRepository extends EntityRepository {


        public function getAllCategories(){

                $categories = $this->getEntityManager()->getRepository('cms\models\Categories')->findBy(array('subCategory' => null ));
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
                return $cat;
            }else{
                redirect(site_url('cms/categories'));
            }

        }

        public function updateCategory($post){

            $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($post['id']);
            if ($category != null){
                $category->setCategoryName($post['categoryName']);
                $category->setSubCategory($this->getEntityManager()->getRepository('cms\models\Categories')->find($post['subCategoryId']));
                $this->getEntityManager()->flush();
            }
            return true;


        }

        public function getPostsByCategory($id){

            $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($id);
            if ($category != null){
                $posts = $category->getPosts();
                if ($posts->count() > 0){
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
                return $p;
                }else{
                    return $posts;
                }
            }else{
                redirect(site_url('cms/categories'));
            }

        }

        public function getPosts($id){
            $query = $this->getEntityManager()->createQuery("SELECT c FROM cms\models\Categories c WHERE (c.id = :id OR c.subCategory = :id)");
            $query->setParameter('id', $id);
            $result = $query->getResult();
            if ($result != null){
                foreach($result as $r){
                    $posts = $r->getPosts();
                    if ($posts->count() > 0){
                        foreach($posts as $post){
                                $c['id'] = $post->getId();
                                $c['categoryName'] = $r->getCategoryName();
                                $c['photoPath'] = $post->getPhotoPath();
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
                    }
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

        public function getPostsFromCategory($id, $per_page = null, $page = null){
            // $query = $this->getEntityManager()->createQuery("SELECT c FROM cms\models\Categories c WHERE (c.id = :id OR c.subCategory = :id)");
            // $query = $this->getEntityManager()->createQuery("
            //     SELECT p FROM cms\models\Posts p
            //     JOIN cms\models\Categories c WHERE (c.id = p.categories)
            //     LEFT JOIN cms\models\Categories cp WHERE (cp.id = c.subCategory)
            //     WHERE (c.id = :id or cp.id = :id)
            // ");
            // $query->setParameters(array(
            //     'id' => $id,
            // ));
            // $query->setMaxResults($per_page);
            // $query->setFirstResult($page);
            //
            // $result = $query->getResult();

            $qb = $this->getEntityManager()->createQueryBuilder();
            $qb ->  select('p')
                ->  from('cms\models\Posts', 'p')
                ->  leftjoin('cms\models\Categories', 'c', 'WITH', 'c.id = p.categories')
                ->  leftJoin('cms\models\Categories', 'cp', 'WITH', 'cp.id = c.subCategory')
                ->  where($qb->expr()->orX('c.id = :id', 'cp.id = :id') )
                ->  setFirstResult($page)
                ->  setMaxResults($per_page)
                // -> where('c.id = :id')
                ->  setParameter('id', $id);

                // echo $qb->getQuery()->getSQL();

            $result = $qb->getQuery()->getResult();

            if ($result != null){
                // foreach($result as $r){
                //     $posts = $r->getPosts();
                //     if ($posts->count() > 0){
                //         foreach($posts as $post){
                //             $p[] = $post;
                //         }
                //     }
                // }
                // return $p;
                return $result;
            }else{
                redirect(site_url('cms/categories/'));
            }
        }




        //
        // public function deleteCategory($id){
        //
        //     $category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($id);
        //     if ($category != null){
        //         if ($category->getPosts()->count() > 0){
        //             // $this->session->set_flashdata('errorMessage', 'The Category ' . $category->getCategoryName() . ' contains Posts and cannot be deleted');
        //             return false;
        //     }else{
        //         // $this->session->set_flashdata('deleteMessage', 'The Category '. $category->getCategoryName() .' has been deleted');
        //         $this->getEntityManager()->remove($category);
        //         $this->getEntityManager()->flush();
        //
        //         return true;
        //     }
        // }
        // }

    }


?>
