<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sala_tipo
 *
 * @ORM\Table(name="sala_tipo")
 * @ORM\Entity()
 */
class Sala_tipo
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
     * @return int
     */

    /**
     * @var Sala
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sala", mappedBy="sala_tipo")
     *
     */
    private $sala;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sala = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Sala
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * @param Sala $sala
     */
    public function setSala($sala)
    {
        $this->sala = $sala;
    }


}
