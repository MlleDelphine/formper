<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Technology
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\TechnologyRepository")
 */
class Technology
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
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToMany(targetEntity="Formation\FrontBundle\Entity\Teacher", mappedBy="technologies")
     */
    private $teachers;

    /**
     * @ORM\ManyToMany(targetEntity="Formation\FrontBundle\Entity\Formation", mappedBy="technologies")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Requirement", mappedBy="technology", cascade={"remove", "persist"})
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
     * @return Technology
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
     * Set created
     *
     * @param \DateTime $created
     * @return Technology
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \Datetime();
    }


    public function __toString()
    {
        return (string)$this->getName();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Technology
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
     * Add teachers
     *
     * @param \Formation\FrontBundle\Entity\Teacher $teachers
     * @return Technology
     */
    public function addTeacher(\Formation\FrontBundle\Entity\Teacher $teachers)
    {
        $this->teachers[] = $teachers;

        return $this;
    }

    /**
     * Remove teachers
     *
     * @param \Formation\FrontBundle\Entity\Teacher $teachers
     */
    public function removeTeacher(\Formation\FrontBundle\Entity\Teacher $teachers)
    {
        $this->teachers->removeElement($teachers);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Add formations
     *
     * @param \Formation\FrontBundle\Entity\Formation $formations
     * @return Technology
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
     * @return Technology
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
