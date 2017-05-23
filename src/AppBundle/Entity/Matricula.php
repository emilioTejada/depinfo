<?php
/**
 * Created by IntelliJ IDEA.
 * User: develop
 * Date: 1/05/17
 * Time: 17:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserControlBundle\Entity\User;


/**
 * Matricula
 *
 * @ORM\Table(name="matricula")
 * @ORM\Entity()
 */
class Matricula
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
     * @var int
     * @ORM\Column(type="integer")
     */
    private $year;


    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserControlBundle\Entity\User", inversedBy="matricula");
     */
    private $user;

    /**
     * @var
     */
    private $asignatura;


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
     * Set year
     *
     * @param integer $year
     * @return Matricula
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
     * Set user
     *
     * @param User, inversedBy=matricula
     * @return Matricula
     */
    public function setUser($user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User, inversedBy=matricula
     */
    public function getUser()
    {
        return $this->user;
    }
}
