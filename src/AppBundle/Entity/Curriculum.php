<?php


namespace AppBundle\Entity;

use AppBundle\Repository\CicloRepository;
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
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TituloFP", mappedBy="curriculum", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $tituloFp;

    /**
     * @var Ciclo
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclo", inversedBy="curriculum", cascade={"persist"})
     * @ORM\JoinColumn(name="ciclo_id", referencedColumnName="id", nullable=true)
     */
    private $currentCiclo;

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
        $this->tituloFp =new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getTituloFp()
    {
        return $this->tituloFp;
    }

    /**
     * @param TituloFP[] $tituloFp
     */
    public function setTituloFp(array $tituloFp)
    {
        $this->tituloFp = $tituloFp;
    }


    /**
     * Remove titulo
     *
     * @param TituloFP $titulo
     */
    public function removeUser(TituloFP $titulo)
    {
        $this->tituloFp->removeElement($titulo);
        $titulo->removeCurriculum($this);
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
    public function setCurrentcourse($currentcourse)
    {
        $this->currentcourse = $currentcourse;
    }

    /**
     * @return Ciclo
     */
    public function getCurrentCiclo()
    {
        return $this->currentCiclo;
    }

    /**
     * @param Ciclo $currentCiclo
     */
    public function setCurrentCiclo(Ciclo $currentCiclo = null)
    {
        $this->currentCiclo = $currentCiclo;
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


    /**
     * Add Titulo_fp
     *
     * @param \AppBundle\Entity\TituloFP $titulo
     * @return Curriculum
     */

    public function addTituloFp(\AppBundle\Entity\TituloFP $titulo)
    {
        $this->tituloFp[] = $titulo;
        $titulo->addCurriculum($this);

        return $this;
    }

    /**
     * Remove mensajes
     *
     * @param \AppBundle\Entity\Mensaje $mensaje
     */
    public function removeTituloFp(\AppBundle\Entity\TituloFP $titulo)
    {
        $this->tituloFp->removeElement($titulo);
    }



}