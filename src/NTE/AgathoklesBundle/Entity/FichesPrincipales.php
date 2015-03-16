<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FichesPrincipales
 *
 * @ORM\Table(name="fichesPrincipales")
 * @ORM\Entity
 */
class FichesPrincipales
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
     *   @ORM\JoinColumn(name="fiche_principale_id", referencedColumnName="id")
     * })
     */
    private $fichePrincipale;

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
     * @return FichesPrincipales
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
     * Set fichePrincipale
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fichePrincipale
     * @return FichesPrincipales
     */
    public function setFichePrincipale(\NTE\AgathoklesBundle\Entity\Fiches $fichePrincipale = null)
    {
        $this->fichePrincipale = $fichePrincipale;

        return $this;
    }

    /**
     * Get fichePrincipale
     *
     * @return \NTE\AgathoklesBundle\Entity\Fiches 
     */
    public function getFichePrincipale()
    {
        return $this->fichePrincipale;
    }
}
