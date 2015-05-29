<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\SessionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Session
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
     * @var integer
     *
     * @ORM\Column(name="places", type="integer")
     */
    private $places;

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
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Formation", inversedBy="sessions")
     */
    private $formation;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Subscription", mappedBy="session", cascade={"persist"})
     */
    private $subscriptions;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\SessionStatus", inversedBy="sessions", cascade={"persist"})
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\SessionDate", mappedBy="session", cascade={"persist", "remove"})
     */
    private $sessionDates;

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
     * @return Session
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
     * Set places
     *
     * @param integer $places
     * @return Session
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return integer 
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Session
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Session
     *
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdated(new \Datetime());
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subscriptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionDates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \DateTime();
    }


    public function __toString()
    {
        return (string)$this->getName();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Session
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
     * Set formation
     *
     * @param \Formation\FrontBundle\Entity\Formation $formation
     * @return Session
     */
    public function setFormation(\Formation\FrontBundle\Entity\Formation $formation = null)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \Formation\FrontBundle\Entity\Formation 
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Add subscriptions
     *
     * @param \Formation\FrontBundle\Entity\Subscription $subscriptions
     * @return Session
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

    /**
     * Set status
     *
     * @param \Formation\FrontBundle\Entity\SessionStatus $status
     * @return Session
     */
    public function setStatus(\Formation\FrontBundle\Entity\SessionStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Formation\FrontBundle\Entity\SessionStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add sessionDates
     *
     * @param \Formation\FrontBundle\Entity\SessionDate $sessionDates
     * @return Session
     */
    public function addSessionDate(\Formation\FrontBundle\Entity\SessionDate $sessionDates)
    {
        $sessionDates->setSession($this);
        $this->sessionDates[] = $sessionDates;

        return $this;
    }

    /**
     * Remove sessionDates
     *
     * @param \Formation\FrontBundle\Entity\SessionDate $sessionDates
     */
    public function removeSessionDate(\Formation\FrontBundle\Entity\SessionDate $sessionDates)
    {
        $this->sessionDates->removeElement($sessionDates);
    }

    /**
     * Get sessionDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSessionDates()
    {
        return $this->sessionDates;
    }
}
