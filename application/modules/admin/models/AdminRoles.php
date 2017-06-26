<?php

    namespace admin\models;
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\Common\Collections\ArrayCollection;

    /**
    * AdminRoles
    *
    * @ORM\Table(name="adminRoles")
    * @ORM\Entity(repositoryClass="admin\models\Repository\AdminRolesRepository")
    */

    class AdminRoles{

        /**
        * @var integer $id
        *
        * @ORM\Column(name="id", type="integer", nullable=false)
        * @ORM\Id
        * @ORM\GeneratedValue(strategy="IDENTITY")
        */

        private $id;

        /**
        * @var string $roleName
        *
        * @ORM\Column(name="roleName", type="string", length=80, nullable=false)
        */

        private $roleName;

        /**
        * One AdminRole has many Admins
        * @ORM\OneToMany(targetEntity="Admin", mappedBy="role")
        *
        */

        private $admins;


        public function __construct(){

            $this->admins = new ArrayCollection();

        }

        public function getId(){

            return $this->id;

        }

        public function setRoleName($role){

            $this->roleName = $role;

        }

        public function getRoleName(){

            return $this->roleName;

        }

    }



 ?>
