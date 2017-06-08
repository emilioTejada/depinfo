<?php
/**
 * Created by IntelliJ IDEA.
 * User: develop
 * Date: 7/06/17
 * Time: 9:55
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=500)
     */
    private $description;


    /**
     * @var Curriculum[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Curriculum", mappedBy="titulosFP")
     */
    private $curriculum;

    /**
     * @var Curriculum[]
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curriculum", inversedBy="currentFP")
     */
    private $currentcurriculum;

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
     * @return Curriculum[]
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }

    /**
     * @param Curriculum[] $curriculum
     */
    public function setCurriculum(array $curriculum)
    {
        $this->curriculum = $curriculum;
    }

    /**
     * @return Curriculum[]
     */
    public function getCurrentcurriculum()
    {
        return $this->currentcurriculum;
    }

    /**
     * @param Curriculum[] $currentcurriculum
     */
    public function setCurrentcurriculum(array $currentcurriculum)
    {
        $this->currentcurriculum = $currentcurriculum;
    }


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


}