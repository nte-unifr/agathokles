<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NTE\AgathoklesBundle\Entity\Forme
 *
 * @ORM\Table(name="Forme")
 * @ORM\Entity
 */
class Forme
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
     * @ORM\OneToMany(targetEntity="Fiches", mappedBy="forme")
     */
    protected $fiches;

    /**
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    protected $rank;

    /**
     * @var string $abr
     *
     * @ORM\Column(name="abr", type="string", length=50, nullable=true)
     */
    private $abr;

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
     * @return Forme
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
    * Override toString() method to return the name of the Forme
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
     * @return Forme
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
     * @return Forme
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
     * Set rank
     *
     * @param integer $rank
     * @return Forme
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set abr
     *
     * @param string $abr
     * @return Forme
     */
    public function setAbr($abr)
    {
        $this->abr = $abr;

        return $this;
    }

    /**
     * Get abr
     *
     * @return string 
     */
    public function getAbr()
    {
        return $this->abr;
    }
}
