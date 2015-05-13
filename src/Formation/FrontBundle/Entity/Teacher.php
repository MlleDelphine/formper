<?php

namespace Formation\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Teacher
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Formation\FrontBundle\Entity\Repository\TeacherRepository")
 */
class Teacher
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
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @Gedmo\Slug(fields={"lastName"}, separator="-", updatable=true, unique=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @ORM\ManyToMany(targetEntity="Formation\FrontBundle\Entity\Technology", inversedBy="teachers")
     * @ORM\JoinTable(name="teacher_technologies")
     */
    private $technologies;

    /**
     * @ORM\OneToMany(targetEntity="Formation\FrontBundle\Entity\Formation", mappedBy="teacher", cascade={"persist"})
     */
    private $formations;

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
     * Set lastName
     *
     * @param string $lastName
     * @return Teacher
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Teacher
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return Teacher
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Teacher
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
     * @return Teacher
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
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
        $this->technologies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \Datetime();
    }

    public function __toString()
    {
        return (string)$this->getFirstName().' '.$this->getLastName();
    }


    /**
     * Set slug
     *
     * @param string $slug
     * @return Teacher
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
     * Add technologies
     *
     * @param \Formation\FrontBundle\Entity\Technology $technologies
     * @return Teacher
     */
    public function addTechnology(\Formation\FrontBundle\Entity\Technology $technologies)
    {
        $this->technologies[] = $technologies;
        // On lie le prof à la techno /!\ que de ce côté là !
        $technologies->addTeacher($this);

        // Et si notre relation était facultative (nullable=true, ce qui n'est pas notre cas ici attention) :
        //  $technologies->setTeacher(null);

        return $this;
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
     * Add formations
     *
     * @param \Formation\FrontBundle\Entity\Formation $formations
     * @return Teacher
     */
    public function addFormation(\Formation\FrontBundle\Entity\Formation $formations)
    {
        $this->formations[] = $formations;
        $formations->setTeacher($this);

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
}
