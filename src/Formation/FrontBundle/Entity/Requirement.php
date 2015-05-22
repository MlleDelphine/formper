<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Requirement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\RequirementRepository")
 */
class Requirement
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
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Formation", inversedBy="requirements", cascade={"persist"})
     * @ORM\JoinColumn(name="formation_id", referencedColumnName="id")
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Technology", inversedBy="requirements", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     */
    private $technology;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Level", inversedBy="requirements", cascade={"persist"})
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $level;


    public function __toString()
    {
        return (string)$this->getFormation()->getName(). ' - '.$this->getLevel()->getName();
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
     * Set formation
     *
     * @param \Formation\FrontBundle\Entity\Formation $formation
     * @return Requirement
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
     * Set technology
     *
     * @param \Formation\FrontBundle\Entity\Technology $technology
     * @return Requirement
     */
    public function setTechnology(\Formation\FrontBundle\Entity\Technology $technology = null)
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * Get technology
     *
     * @return \Formation\FrontBundle\Entity\Technology 
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Set level
     *
     * @param \Formation\FrontBundle\Entity\Level $level
     * @return Requirement
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
}
