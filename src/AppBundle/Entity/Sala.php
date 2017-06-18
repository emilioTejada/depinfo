<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserControlBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sala
 *
 * @ORM\Table(name="sala")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SalaRepository")
 */
class Sala
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserControlBundle\Entity\User", inversedBy="salasCreadas")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Assert\NotNull(message="No puede dejar el campo vacio")
     */
    private $author;

    /**
     * @var User[]
     * @ORM\ManyToMany(targetEntity="UserControlBundle\Entity\User", inversedBy="salas")
     *
     */
    private $users;

    /**
     * @var Asignatura
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Asignatura", inversedBy="salas")
     * @ORM\JoinColumn(name="asignatura_id", referencedColumnName="id", nullable=true)
     */
    private $asignatura;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var Sala_tipo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sala_tipo", inversedBy="sala")
     */
    private $sala_tipo;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var Mensaje
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Mensaje", mappedBy="sala",cascade={"persist","remove"})
     */
    private $mensajes;


    public function __construct()
    {
        $this->mensajes = new ArrayCollection();

        $this->users = new ArrayCollection();
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
     * Set author
     *
     * @param \UserControlBundle\Entity\User $author
     * @return Sala
     */
    public function setAuthor(\UserControlBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \UserControlBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return Asignatura
     */
    public function getAsignatura()
    {
        return $this->asignatura;
    }

    /**
     * @param Asignatura $asignatura
     */
    public function setAsignatura($asignatura)
    {
        $this->asignatura = $asignatura;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Sala
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Sala
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param Sala_tipo $sala_tipo
     * @return Sala
     */
    public function setSalatipo($sala_tipo)
    {
        $this->sala_tipo = $sala_tipo;

        return $this;
    }

    /**
     * Get type
     *
     * @return Sala_tipo
     */
    public function getSalatipo()
    {
        return $this->sala_tipo;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Sala
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }


    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Add mensajes
     *
     * @param \AppBundle\Entity\Mensaje $mensajes
     * @return Sala
     */

    public function addMensajes(\AppBundle\Entity\Mensaje $mensajes)
    {
        $this->mensajes[] = $mensajes;

        return $this;
    }

    /**
     * Remove mensajes
     *
     * @param \AppBundle\Entity\Mensaje $mensaje
     */
    public function removeMensaje(\AppBundle\Entity\Mensaje $mensaje)
    {
        $this->mensajes->removeElement($mensaje);
    }

    /**
     * Get mensajes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMensajes()
    {
        return $this->mensajes;
    }

    /**
     * Add mensajes
     *
     * @param \AppBundle\Entity\Mensaje $mensajes
     * @return Sala
     */
    public function addMensaje(\AppBundle\Entity\Mensaje $mensajes)
    {
        $this->mensajes[] = $mensajes;

        return $this;
    }

    /**
     * Add users
     *
     * @return Sala
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        $user->addSala($this);
        return $this;
    }

    /**
     * Remove users
     *
     * @param \UserControlBundle\Entity\User $users
     */
    public function removeUser(\UserControlBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
        $users->removeSala($this);
    }

    /**
     * Get users
     *
     */
    public function getUsers()
    {
        return $this->users;
    }
}
