<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Subscription
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\SubscriptionRepository")
 */
class Subscription
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
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Formation", inversedBy="subscriptions", cascade={"persist"})
     * @ORM\JoinColumn(name="formation_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Session", inversedBy="subscriptions", cascade={"persist"})
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\SubscriptionStatus", inversedBy="subscriptions", cascade={"persist"})
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\UserBundle\Entity\User", inversedBy="subscriptions", cascade={"persist"})
     */
    private $user;



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
     * Set created
     *
     * @param \DateTime $created
     * @return Subscription
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
     * Set formation
     *
     * @param \Formation\FrontBundle\Entity\Formation $formation
     * @return Subscription
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
     * Set session
     *
     * @param \Formation\FrontBundle\Entity\Session $session
     * @return Subscription
     */
    public function setSession(\Formation\FrontBundle\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \Formation\FrontBundle\Entity\Session 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set status
     *
     * @param \Formation\FrontBundle\Entity\SubscriptionStatus $status
     * @return Subscription
     */
    public function setStatus(\Formation\FrontBundle\Entity\SubscriptionStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Formation\FrontBundle\Entity\SubscriptionStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \Formation\UserBundle\Entity\User $user
     * @return Subscription
     */
    public function setUser(\Formation\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Formation\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
