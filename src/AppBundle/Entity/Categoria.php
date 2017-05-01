<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity()
 */
class Categoria
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
     * @var Noticia
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Noticia", mappedBy="categoria")
     */
    private $noticia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->noticia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Categoria
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
     * Add noticia
     *
     * @param \AppBundle\Entity\Noticia $noticia
     * @return Categoria
     */
    public function addNoticium(\AppBundle\Entity\Noticia $noticia)
    {
        $this->noticia[] = $noticia;

        return $this;
    }

    /**
     * Remove noticia
     *
     * @param \AppBundle\Entity\Noticia $noticia
     */
    public function removeNoticium(\AppBundle\Entity\Noticia $noticia)
    {
        $this->noticia->removeElement($noticia);
    }

    /**
     * Get noticia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticia()
    {
        return $this->noticia;
    }


    function __toString()
    {
        return $this->getName();
    }

}
