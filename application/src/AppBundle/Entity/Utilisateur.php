<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
     /**
     * @var AppBundle:Role
     *
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="ext_role_id", referencedColumnName="id")
     */
    private $role;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Get role
     * 
     * @return AppBundle:Role
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Set role
     * 
     * @param AppBundle:Role $role
     */
    public function setRole($role) {
        $this->role = $role;
    }
    
    public function eraseCredentials() {
        
    }

    /**
     * Return a string array containing the role list
     * 
     * @return string[]
     */
    public function getRoles() {
        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository('AppBundle:Role')->findAll();
        
        $roles_string = [];
        foreach($roles as $role) {
            $roles_string[] = $role->getLabel();
        }
        
        return $roles_string;
    }

    public function getSalt() {
        
    }
}

