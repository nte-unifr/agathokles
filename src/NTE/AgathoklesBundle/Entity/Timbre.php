<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timbre
 *
 * @ORM\Table(name="timbre")
 * @ORM\Entity
 */
class Timbre
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
     * @var string $reference
     *
     * @ORM\Column(name="reference", type="string", nullable=true)
     */
    private $reference;

    /**
     * @var Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lieu_id", referencedColumnName="id")
     * })
     */
    private $lieu;

    /**
     * @var string $contexte
     *
     * @ORM\Column(name="contexte", type="text", nullable=true)
     */
    private $contexte;

    /**
     * @var string $remarques
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @ORM\ManyToOne(targetEntity="Fiches", inversedBy="timbres")
     * @ORM\JoinColumn(name="fiche_id", referencedColumnName="id")
     */
    protected $fiche;


    /**
    * Override toString() method to return the name of the Cadre
    * @return string name
    */
    public function __toString()
    {
        return (string)$this->id;
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
     * Set reference
     *
     * @param string $reference
     * @return Timbre
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return Timbre
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set lieu
     *
     * @param \NTE\AgathoklesBundle\Entity\Lieu $lieu
     * @return Timbre
     */
    public function setLieu(\NTE\AgathoklesBundle\Entity\Lieu $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \NTE\AgathoklesBundle\Entity\Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set fiche
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fiche
     * @return Timbre
     */
    public function setFiche(\NTE\AgathoklesBundle\Entity\Fiches $fiche = null)
    {
        $this->fiche = $fiche;

        return $this;
    }

    /**
     * Get fiche
     *
     * @return \NTE\AgathoklesBundle\Entity\Fiches
     */
    public function getFiche()
    {
        return $this->fiche;
    }

    /**
     * Set contexte
     *
     * @param string $contexte
     * @return Timbre
     */
    public function setContexte($contexte)
    {
        $this->contexte = $contexte;

        return $this;
    }

    /**
     * Get contexte
     *
     * @return string 
     */
    public function getContexte()
    {
        return $this->contexte;
    }
}
