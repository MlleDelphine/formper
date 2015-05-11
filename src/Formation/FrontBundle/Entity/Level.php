<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Level
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\LevelRepository")
 */
class Level
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"}, separator="-", updatable=true, unique=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Formation", mappedBy="teacher", cascade={"persist"})
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Requirement", mappedBy="level", cascade={"persist"}, onDelete="SET NULL")
     */
    private $requirements;



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
     * @return Level
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
}
