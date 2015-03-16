<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FichesComplementaires
 *
 * @ORM\Table(name="fichesComplementaires")
 * @ORM\Entity
 */
class FichesComplementaires
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Fiches", cascade={"detach"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fiche_id", referencedColumnName="id")
     * })
     */
    private $fiche;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Fiches", cascade={"detach"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fiche_complementaire_id", referencedColumnName="id")
     * })
     */
    private $ficheComplementaire;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"detach"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     * })
     */
    private $media;


    public function __toString()
	{
	    return $this->id."";
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
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return BotaniqueFichierTaxon
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set fiche
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fiche
     * @return FichesComplementaires
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
     * Set ficheComplementaire
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $ficheComplementaire
     * @return FichesComplementaires
     */
    public function setFicheComplementaire(\NTE\AgathoklesBundle\Entity\Fiches $ficheComplementaire = null)
    {
        $this->ficheComplementaire = $ficheComplementaire;

        return $this;
    }

    /**
     * Get ficheComplementaire
     *
     * @return \NTE\AgathoklesBundle\Entity\Fiches 
     */
    public function getFicheComplementaire()
    {
        return $this->ficheComplementaire;
    }
}
