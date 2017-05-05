<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Matricula;
use AppBundle\Entity\Noticia;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity()
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $nick;

    /**
     * @var string
     */
    private $bio;

    /**
     * @var string
     *
     */
    private $active;

    /**
     * @var string
     */
    private $image;

    /**
     * @var Noticia
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Noticia", mappedBy="user")
     */
    private $noticia;

    /**
     * @var Matricula
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Matricula", mappedBy="user")
     */
    private $matricula;



    public function getUsername(){
        return $this->email;
    }
    public function getSalt(){
        return null;
    }
    public function getRoles(){
        return array('ROLE_USER','ROLE_ADMIN');
    }
    public function eraseCredentials(){
        
    }
    public function __toString(){
        return $this->name;
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
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
     * Set nick
     *
     * @param string $nick
     *
     * @return User
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get nick
     *
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set active
     *
     * @param string $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->noticia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->matricula = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add noticia
     *
     * @param \AppBundle\Entity\Noticia $noticia
     * @return User
     */
    public function addNoticium(\AppBundle\Entity\Noticia $noticia)
    {
        $this->noticia[] = $noticia;

        return $this;
    }

    /**
     * Remove noticia
     *
     * @param \AppBundle\Entity\Noticia $noticia
     */
    public function removeNoticium(\AppBundle\Entity\Noticia $noticia)
    {
        $this->noticia->removeElement($noticia);
    }

    /**
     * Get noticia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticia()
    {
        return $this->noticia;
    }

    /**
     * Add matricula
     *
     * @param \AppBundle\Entity\Matricula $matricula
     * @return User
     */
    public function addMatricula(\AppBundle\Entity\Matricula $matricula)
    {
        $this->matricula[] = $matricula;

        return $this;
    }

    /**
     * Remove matricula
     *
     * @param \AppBundle\Entity\Matricula $matricula
     */
    public function removeMatricula(\AppBundle\Entity\Matricula $matricula)
    {
        $this->matricula->removeElement($matricula);
    }

    /**
     * Get matricula
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }




}
