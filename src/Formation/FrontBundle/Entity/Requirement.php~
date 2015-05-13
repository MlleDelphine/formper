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
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Formation", inversedBy="requirements")
     * @ORM\JoinColumn(name="formation_id", referencedColumnName="id")
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Technology", inversedBy="requirements")
     * @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     */
    private $technology;

    /**
     * @ORM\ManyToOne(targetEntity="Formation\FrontBundle\Entity\Level", inversedBy="requirements")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     */
    private $level;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
