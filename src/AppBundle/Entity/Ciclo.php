<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CICLO
 *
 * @ORM\Table(name="ciclo")
 * @ORM\Entity()
 */
class Ciclo
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $plan;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $familia;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $grado;


    /**
     * @var Asignatura
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Asignatura", mappedBy="ciclo")
     *
     */
    private $asignatura;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TituloFP", mappedBy="ciclo")
     */
    private $titulofp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->asignatura = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Ciclo
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
     * Set description
     *
     * @param string $description
     * @return Ciclo
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
     * Add asignatura
     *
     * @param \AppBundle\Entity\Asignatura $asignatura
     * @return Ciclo
     */
    public function addAsignatura(\AppBundle\Entity\Asignatura $asignatura)
    {
        $this->asignatura[] = $asignatura;

        return $this;
    }

    /**
     * Remove asignatura
     *
     * @param \AppBundle\Entity\Asignatura $asignatura
     */
    public function removeAsignatura(\AppBundle\Entity\Asignatura $asignatura)
    {
        $this->asignatura->removeElement($asignatura);
    }

    /**
     * Get asignatura
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAsignatura()
    {
        return $this->asignatura;
    }

    /**
     * @return mixed
     */
    public function getTitulofp()
    {
        return $this->titulofp;
    }

    /**
     * @param mixed $titulofp
     */
    public function setTitulofp($titulofp)
    {
        $this->titulofp = $titulofp;
    }

    /**
     * @return string
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @param string $plan
     */
    public function setPlan(string $plan)
    {
        $this->plan = $plan;
    }

    /**
     * @return string
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * @param string $familia
     */
    public function setFamilia(string $familia)
    {
        $this->familia = $familia;
    }

    /**
     * @return string
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * @param string $grado
     */
    public function setGrado(string $grado)
    {
        $this->grado = $grado;
    }





}
