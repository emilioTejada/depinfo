<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserControlBundle\Entity\User;

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
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * @Assert\NotNull(message="No puede dejar el campo vacio")
     */
    private $author;

    /**
     * @var int
     *
     * @ORM\Column(name="idAsignatura", type="integer", nullable=true)
     */
    private $idAsignatura;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=40)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var Mensaje
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Mensaje", mappedBy="sala",cascade={"persist","remove"})
     * @Assert\NotNull(message="No puede dejar el campo vacio")
     */
    private $mensajes;


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
     * Set idAsignatura
     *
     * @param integer $idAsignatura
     * @return Sala
     */
    public function setIdAsignatura($idAsignatura)
    {
        $this->idAsignatura = $idAsignatura;

        return $this;
    }

    /**
     * Get idAsignatura
     *
     * @return integer
     */
    public function getIdAsignatura()
    {
        return $this->idAsignatura;
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
     * @param string $type
     * @return Sala
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
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

    public function __construct()
    {
        $this->mensajes = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
