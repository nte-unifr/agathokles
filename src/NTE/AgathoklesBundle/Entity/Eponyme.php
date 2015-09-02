<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NTE\AgathoklesBundle\Entity\Eponyme
 *
 * @ORM\Table(name="Eponyme")
 * @ORM\Entity
 */
class Eponyme
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var integer $datingStart
     *
     * @ORM\Column(name="dating_start", type="integer", length=4, nullable=true)
     */
    private $datingStart;

    /**
     * @var integer $datingEnd
     *
     * @ORM\Column(name="dating_end", type="integer", length=4, nullable=true)
     */
    private $datingEnd;

    /**
     * @var boolean $approximative
     *
     * @ORM\Column(name="approximative", type="boolean")
     */
    private $approximative;

    /**
     * @ORM\OneToMany(targetEntity="Fiches", mappedBy="eponyme")
     */
    protected $fiches;



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
     * Set nom
     *
     * @param string $nom
     * @return Eponyme
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
    * Override toString() method to return the name of the Eponyme
    * @return string name
    */
    public function __toString()
    {
        return (string)$this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fiches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fiches
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fiches
     * @return Eponyme
     */
    public function addFiche(\NTE\AgathoklesBundle\Entity\Fiches $fiches)
    {
        $this->fiches[] = $fiches;

        return $this;
    }

    /**
     * Remove fiches
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fiches
     */
    public function removeFiche(\NTE\AgathoklesBundle\Entity\Fiches $fiches)
    {
        $this->fiches->removeElement($fiches);
    }

    /**
     * Get fiches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiches()
    {
        return $this->fiches;
    }

    /**
     * Add fiches
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fiches
     * @return Eponyme
     */
    public function addFich(\NTE\AgathoklesBundle\Entity\Fiches $fiches)
    {
        $this->fiches[] = $fiches;

        return $this;
    }

    /**
     * Remove fiches
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fiches
     */
    public function removeFich(\NTE\AgathoklesBundle\Entity\Fiches $fiches)
    {
        $this->fiches->removeElement($fiches);
    }

    /**
     * Set datingStart
     *
     * @param integer $datingStart
     * @return Eponyme
     */
    public function setDatingStart($datingStart)
    {
        $this->datingStart = $datingStart;

        return $this;
    }

    /**
     * Get datingStart
     *
     * @return integer
     */
    public function getDatingStart()
    {
        return $this->datingStart;
    }

    /**
     * Has datingStart
     *
     * @return boolean
     */
    public function hasDatingStart()
    {
        return $this->datingStart != null;
    }

    /**
     * Set datingEnd
     *
     * @param integer $datingEnd
     * @return Eponyme
     */
    public function setDatingEnd($datingEnd)
    {
        $this->datingEnd = $datingEnd;

        return $this;
    }

    /**
     * Get datingEnd
     *
     * @return integer
     */
    public function getDatingEnd()
    {
        return $this->datingEnd;
    }

    /**
     * Has datingEnd
     *
     * @return boolean
     */
    public function hasDatingEnd()
    {
        return $this->datingEnd != null;
    }

    /**
     * Set approximative
     *
     * @param boolean $approximative
     * @return Eponyme
     */
    public function setApproximative($approximative)
    {
        $this->approximative = $approximative;

        return $this;
    }

    /**
     * Get approximative
     *
     * @return boolean
     */
    public function getApproximative()
    {
        return $this->approximative;
    }
}
