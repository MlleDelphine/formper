<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Formation", mappedBy="level", cascade={"persist"})
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Requirement", mappedBy="level", cascade={"persist"})
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->requirements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Level
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add formations
     *
     * @param \Formation\FrontBundle\Entity\Formation $formations
     * @return Level
     */
    public function addFormation(\Formation\FrontBundle\Entity\Formation $formations)
    {
        $this->formations[] = $formations;

        return $this;
    }

    /**
     * Remove formations
     *
     * @param \Formation\FrontBundle\Entity\Formation $formations
     */
    public function removeFormation(\Formation\FrontBundle\Entity\Formation $formations)
    {
        $this->formations->removeElement($formations);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormations()
    {
        return $this->formations;
    }

    /**
     * Add requirements
     *
     * @param \Formation\FrontBundle\Entity\Requirement $requirements
     * @return Level
     */
    public function addRequirement(\Formation\FrontBundle\Entity\Requirement $requirements)
    {
        $this->requirements[] = $requirements;

        return $this;
    }

    /**
     * Remove requirements
     *
     * @param \Formation\FrontBundle\Entity\Requirement $requirements
     */
    public function removeRequirement(\Formation\FrontBundle\Entity\Requirement $requirements)
    {
        $this->requirements->removeElement($requirements);
    }

    /**
     * Get requirements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
}
