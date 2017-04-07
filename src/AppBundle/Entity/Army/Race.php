<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race.
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\RaceRepository")
 */
class Race
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", unique=true)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\Army", mappedBy="race")
     */
    private $armies;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\Figurine", mappedBy="race")
     */
    private $figurines;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Race
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get armies
     *
     * @return mixed
     */
    public function getArmies()
    {
        return $this->armies;
    }

    /**
     * Set armies
     *
     * @param mixed $armies
     *
     * @return $this
     */
    public function setArmies($armies)
    {
        $this->armies = $armies;

        return $this;
    }

    /**
     * Get figurines
     *
     * @return mixed
     */
    public function getFigurines()
    {
        return $this->figurines;
    }

    /**
     * Set figurines
     *
     * @param mixed $figurines
     *
     * @return $this
     */
    public function setFigurines($figurines)
    {
        $this->figurines = $figurines;

        return $this;
    }


}
