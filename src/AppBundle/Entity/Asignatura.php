<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ASIGNATURA
 *
 * @ORM\Table(name="asignatura")
 * @ORM\Entity()
 */
class Asignatura
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
     * @var int
     *
     * @ORM\Column(type="string", length=255)
     */
    private $curso;

    /**
     * @var Ciclo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclo", inversedBy="asignatura")
     */
    private $ciclo;

    /**
     * @var Sala
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sala", mappedBy="asignatura",cascade={"persist","remove"})
     *
     */
    private $salas;

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
     * @return Asignatura
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
     * @return Asignatura
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
     * Set curso
     *
     * @param string $curso
     * @return Asignatura
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return string
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set ciclo
     *
     * @param \AppBundle\Entity\Ciclo $ciclo
     * @return Asignatura
     */
    public function setCiclo(\AppBundle\Entity\Ciclo $ciclo = null)
    {
        $this->ciclo = $ciclo;

        return $this;
    }

    /**
     * Get ciclo
     *
     * @return \AppBundle\Entity\Ciclo
     */
    public function getCiclo()
    {
        return $this->ciclo;
    }

    /**
     * @return Sala
     */
    public function getSalas()
    {
        return $this->salas;
    }

    /**
     * @param Sala $salas
     */
    public function setSalas(Sala $salas)
    {
        $this->salas = $salas;
    }



}
