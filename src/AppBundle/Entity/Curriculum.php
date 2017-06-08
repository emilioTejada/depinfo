<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserControlBundle\Entity\User;

/**
 * CURRICULUM
 *
 * @ORM\Table(name="curriculum")
 * @ORM\Entity()
 */
class Curriculum
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
     * @var TituloFP[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TituloFP", inversedBy="curriculum")
     */
    private $titulosFP;

    /**
     * @var TituloFP
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TituloFP", mappedBy="currentcurriculum")
     */
    private $currentFP;

    /**
     * @var int
     *
     * @ORM\Column(name="currentcourse", type="integer")
     */
    private $currentcourse;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="UserControlBundle\Entity\User", mappedBy="curriculum")
     */
    private $user;

    /**
     * Curriculum constructor.
     */
    public function __construct()
    {
        $this->titulosFP = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return TituloFP[]
     */
    public function getTitulosFP(): array
    {
        return $this->titulosFP;
    }

    /**
     * @param TituloFP[] $titulosFP
     */
    public function setTitulosFP(array $titulosFP)
    {
        $this->titulosFP = $titulosFP;
    }

    /**
     * @return TituloFP
     */
    public function getCurrentFP(): TituloFP
    {
        return $this->currentFP;
    }

    /**
     * @param TituloFP $currentFP
     */
    public function setCurrentFP(TituloFP $currentFP)
    {
        $this->currentFP = $currentFP;
    }

    /**
     * @return int
     */
    public function getCurrentcourse()
    {
        return $this->currentcourse;
    }

    /**
     * @param int $currentcourse
     */
    public function setCurrentcourse(int $currentcourse)
    {
        $this->currentcourse = $currentcourse;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }




}