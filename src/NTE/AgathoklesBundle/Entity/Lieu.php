<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NTE\AgathoklesBundle\Entity\Lieu
 *
 * @ORM\Table(name="Lieu")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="LieuRepository");
 */
class Lieu
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
     * @var string $lng
     *
     * @ORM\Column(name="lng", type="string", length=50, nullable=true)
     */
    private $lng;

    /**
     * @var string $lat
     *
     * @ORM\Column(name="lat", type="string", length=50, nullable=true)
     */
    private $lat;

    /**
     * @ORM\OneToMany(targetEntity="Fiches", mappedBy="lieuDeDecouverte")
     */
    protected $fiches;

    /**
     * @ORM\OneToMany(targetEntity="Timbre", mappedBy="lieu")
     */
    protected $timbres;



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
     * @return Lieu
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
    * Override toString() method to return the name of the Lieu
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
     * @return Lieu
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
     * @return Lieu
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
     * Set lng
     *
     * @param string $lng
     * @return Lieu
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set lat
     *
     * @param string $lat
     * @return Lieu
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Add timbres
     *
     * @param \NTE\AgathoklesBundle\Entity\Timbre $timbres
     * @return Lieu
     */
    public function addTimbre(\NTE\AgathoklesBundle\Entity\Timbre $timbres)
    {
        $this->timbres[] = $timbres;

        return $this;
    }

    /**
     * Remove timbres
     *
     * @param \NTE\AgathoklesBundle\Entity\Timbre $timbres
     */
    public function removeTimbre(\NTE\AgathoklesBundle\Entity\Timbre $timbres)
    {
        $this->timbres->removeElement($timbres);
    }

    /**
     * Get timbres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTimbres()
    {
        return $this->timbres;
    }
}
