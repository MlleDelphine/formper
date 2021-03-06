<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SessionDate
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\SessionDateRepository")
 */
class SessionDate
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
     * @ORM\Column(name="date_start", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date")
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_start", type="time")
     */
    private $timeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_end", type="time")
     */
    private $timeEnd;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Session", inversedBy="sessionDates")
     */
    private $session;



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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return SessionDate
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return SessionDate
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     * @return SessionDate
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime 
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeEnd
     *
     * @param \DateTime $timeEnd
     * @return SessionDate
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    /**
     * Get timeEnd
     *
     * @return \DateTime 
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set session
     *
     * @param \Formation\FrontBundle\Entity\Session $session
     * @return SessionDate
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
}
