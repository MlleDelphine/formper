<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Formation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\FormationRepository")
 */
class Formation
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
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="long_description", type="text")
     */
    private $longDescription;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @Gedmo\Slug(fields={"name"}, separator="-", updatable=true, unique=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", options={"default" = 0})
     */
    private $published;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Teacher", inversedBy="formations", cascade={"persist"})
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Level", inversedBy="formations", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Session", mappedBy="formation", cascade={"remove", "persist"})
     */
    private $sessions;

    /**
     * @ORM\ManyToMany(targetEntity="Formation\FrontBundle\Entity\Technology", inversedBy="formations", cascade={"persist"})
     * @ORM\JoinTable(name="formations_technologies")
     */
    private $technologies;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Requirement", mappedBy="formation", cascade={"remove", "persist"})
     */
    private $requirements;

    /**
     * @ORM\OneToMany(targetEntity="Formation\MediaBundle\Entity\Media", mappedBy="formation", cascade={"all"})
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Subscription", mappedBy="formation", cascade={"persist"} )
     */
    private $subscriptions;


    public function __toString()
    {
        return (string)$this->getName();
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
     * @return Formation
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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Formation
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return Formation
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Formation
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Formation
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
     * Set teacher
     *
     * @param \Formation\FrontBundle\Entity\Teacher $teacher
     * @return Formation
     */
    public function setTeacher(\Formation\FrontBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \Formation\FrontBundle\Entity\Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->technologies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->requirements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subscriptions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Formation
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set level
     *
     * @param \Formation\FrontBundle\Entity\Level $level
     * @return Formation
     */
    public function setLevel(\Formation\FrontBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \Formation\FrontBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Add sessions
     *
     * @param \Formation\FrontBundle\Entity\Session $sessions
     * @return Formation
     */
    public function addSession(\Formation\FrontBundle\Entity\Session $sessions)
    {
        $sessions->setFormation($this);
        $this->sessions[] = $sessions;

        return $this;
    }

    /**
     * Remove sessions
     *
     * @param \Formation\FrontBundle\Entity\Session $sessions
     */
    public function removeSession(\Formation\FrontBundle\Entity\Session $sessions)
    {
        $this->sessions->removeElement($sessions);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Add technologies
     *
     * @param \Formation\FrontBundle\Entity\Technology $technologies
     * @return Formation
     */
    public function addTechnology(\Formation\FrontBundle\Entity\Technology $technologies)
    {
        $this->technologies[] = $technologies;

        return $this;
    }

    /**
     * Set technologies
     *
     * @param \Formation\FrontBundle\Entity\Technology $technologies
     * @return Formation
     */
    public function setTechnologies(ArrayCollection $technologies)
    {
        foreach ($technologies as $technology) {
            $technology->addFormation($this);
        }

        $this->technologies = $technologies;
    }

    /**
     * Remove technologies
     *
     * @param \Formation\FrontBundle\Entity\Technology $technologies
     */
    public function removeTechnology(\Formation\FrontBundle\Entity\Technology $technologies)
    {
        $this->technologies->removeElement($technologies);
    }

    /**
     * Get technologies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTechnologies()
    {
        return $this->technologies;
    }

    /**
     * Add requirements
     *
     * @param \Formation\FrontBundle\Entity\Requirement $requirements
     * @return Formation
     */
    public function addRequirement(\Formation\FrontBundle\Entity\Requirement $requirements)
    {
        $requirements->setFormation($this);
        $this->requirements[] = $requirements;

        return $this;
    }

    /**
     * Set requirements
     *
     * @param \Formation\FrontBundle\Entity\Requirement $requirements
     * @return Formation
     */
    public function setRequirements(ArrayCollection $requirements)
    {
        foreach ($requirements as $requirement) {
            $requirement->setFormation($this);
        }

        $this->requirements = $requirements;
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

    /**
     * Add documents
     *
     * @param \Formation\MediaBundle\Entity\Media $documents
     * @return Formation
     */
    public function addDocument(\Formation\MediaBundle\Entity\Media $documents)
    {
        $this->documents[] = $documents;

        return $this;
    }

    /**
     * Remove documents
     *
     * @param \Formation\MediaBundle\Entity\Media $documents
     */
    public function removeDocument(\Formation\MediaBundle\Entity\Media $documents)
    {
        $this->documents->removeElement($documents);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Add subscriptions
     *
     * @param \Formation\FrontBundle\Entity\Subscription $subscriptions
     * @return Formation
     */
    public function addSubscription(\Formation\FrontBundle\Entity\Subscription $subscriptions)
    {
        $this->subscriptions[] = $subscriptions;

        return $this;
    }

    /**
     * Remove subscriptions
     *
     * @param \Formation\FrontBundle\Entity\Subscription $subscriptions
     */
    public function removeSubscription(\Formation\FrontBundle\Entity\Subscription $subscriptions)
    {
        $this->subscriptions->removeElement($subscriptions);
    }

    /**
     * Get subscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }
}
