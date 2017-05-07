<?php

namespace UserControlBundle\Entity;

use AppBundle\Entity\Mensaje;
use AppBundle\Entity\Sala;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\Noticia;
use AppBundle\Entity\Matricula;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserControlBundle\Repository\UsuarioRepository")
 * @UniqueEntity(fields="username", message="Nombre ya en uso")
 * @UniqueEntity(fields="email", message="Email ya en uso")
 *
 */
class User implements AdvancedUserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", nullable=false, length=50, unique=true)
     */
    // este es el campo mas importante, sobre el se hace la autenticacion de symfony, no tocar
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=150)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", unique=true, nullable=false, length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="string", nullable=true, length=255)
     */
    private $information;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserControlBundle\Entity\Rol", inversedBy="user")
     */
    private $rol;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable = true;

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
//
//    /**
//     * @var Sala
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sala", mappedBy="author",cascade={"persist","remove"})
//     */
//    private $salasCreadas;

    /**
     * @var Mensaje
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Mensaje", mappedBy="user",cascade={"persist","remove"})
     */
    private $mensaje;

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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get nick
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set name
     *
     * @param string $name
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
     * Set email
     *
     * @param string $email
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
     * Set information
     *
     * @param string $information
     * @return User
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set rol
     *
     * @param string $rol
     * @return User
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string 
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return User
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }


    /**
     * Add salasCreadas
     *
     * @param \AppBundle\Entity\Sala $salas
     * @return User
     */

    public function addSalasCreadas(\AppBundle\Entity\Sala $salas)
    {
        $this->salasCreadas[] = $salas;

        return $this;
    }

    /**
     * Remove salasCreadas
     *
     * @param \AppBundle\Entity\Sala $sala
     */
    public function removeSala(\AppBundle\Entity\Sala $sala)
    {
        $this->salasCreadas->removeElement($sala);
    }

    /**
     * Get salasCreadas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSalasCreadas()
    {
        return $this->salasCreadas;
    }

    /**
     * Add mensaje
     *
     * @param \AppBundle\Entity\Mensaje $mensaje
     * @return User
     */

    public function addMensaje(\AppBundle\Entity\Mensaje $mensaje)
    {
        $this->mensaje[] = $mensaje;

        return $this;
    }

    /**
     * Remove mensaje
     *
     * @param \AppBundle\Entity\Mensaje $mensaje
     */
    public function removeMensaje(\AppBundle\Entity\Mensaje $mensaje)
    {
        $this->mensaje->removeElement($mensaje);
    }

    /**
     * Get mensaje
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMensaje()
    {
        return $this->mensaje;
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


    public function __construct()
    {
//        $this->salasCreadas = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->mensaje = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->noticia = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->matricula = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        // TODO: Implement isAccountNonExpired() method.
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        // TODO: Implement isAccountNonLocked() method.
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        // TODO: Implement isCredentialsNonExpired() method.
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array($this->rol);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
