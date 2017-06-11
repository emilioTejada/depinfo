<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * TITULOFP
 *
 * @ORM\Table(name="titulofp")
 * @ORM\Entity()
 */

class TituloFP
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
     * @var Ciclo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclo", inversedBy="titulofp",cascade={"persist","remove"})
     */
    private $ciclo;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="string", length=500)
     *
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;


    /**
     * @var Curriculum
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curriculum", inversedBy="tituloFp",cascade={"persist","remove"})
     */
    private $curriculum;

//    /**
//     * @var Curriculum[]
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curriculum", inversedBy="currentFP")
//     */
//    private $currentcurriculum;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }

//    /**
//     * @param Curriculum[] $curriculum
//     */
//    public function setCurriculum(array $curriculum)
//    {
//        $this->curriculum = $curriculum;
//    }

    /**
     * @return Ciclo
     */
    public function getCiclo()
    {
        return $this->ciclo;
    }

    /**
     * @param Ciclo $ciclo
     */
    public function setCiclo(Ciclo $ciclo)
    {
        $this->ciclo = $ciclo;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Add Curriculum
     *
     * @return TituloFP
     */
    public function addCurriculum($curriculum)
    {
        $this->curriculum = $curriculum;

        return $this;
    }

    /**
     * Remove curriculum
     *
     * @param Curriculum $curriculum
     */
    public function removeCurriculum(Curriculum $curriculum)
    {
        $this->curriculum->removeElement($curriculum);
    }
}