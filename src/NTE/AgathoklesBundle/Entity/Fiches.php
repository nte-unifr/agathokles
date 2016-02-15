<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * NTE\AgathoklesBundle\Entity\Fiches
 *
 * @ORM\Table(name="fiches")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Fiches
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
     * @var string $fullname
     *
     * @ORM\Column(name="fullname", type="string", nullable=true)
     */
    private $fullname;

    /**
     * @var Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * })
     */
    private $categorie;

    /**
     * @var Fabricant
     *
     * @ORM\ManyToOne(targetEntity="Fabricant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fabricant_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $fabricant;

    /**
     * @var Eponyme
     *
     * @ORM\ManyToOne(targetEntity="Eponyme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eponyme_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $eponyme;

    /**
     * @var Mois
     *
     * @ORM\ManyToOne(targetEntity="Mois")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mois_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $mois;

    /**
     * @var Forme
     *
     * @ORM\ManyToOne(targetEntity="Forme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="forme_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $forme;

    /**
     * @var Embleme
     *
     * @ORM\ManyToOne(targetEntity="Embleme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="embleme_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $embleme;

    /**
     * @var string $designation
     *
     * @ORM\Column(name="designation", type="string", nullable=true)
     */
    private $designation;

    /**
     * @var string $legende
     *
     * @ORM\Column(name="legende", type="text", nullable=true)
     */
    private $legende;

    /**
     * @var Position
     *
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="position_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="FichesImages", mappedBy="fiche", cascade={"persist"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @var Cadre
     *
     * @ORM\ManyToOne(targetEntity="Cadre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cadre_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $cadre;

    /**
     * @var boolean $bouton
     *
     * @ORM\Column(name="bouton", type="boolean", nullable=true)
     */
    private $bouton = false;

    /**
     * @var boolean $grenetis
     *
     * @ORM\Column(name="grenetis", type="boolean", nullable=true)
     */
    private $grenetis = false;

    /**
     * @var boolean $ombilic
     *
     * @ORM\Column(name="ombilic", type="boolean", nullable=true)
     */
    private $ombilic = false;

    /**
     * @var Separation
     *
     * @ORM\ManyToOne(targetEntity="Separation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="separation_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $separation;

    /**
     * @var boolean $legendeTournante
     *
     * @ORM\Column(name="legendeTournante", type="boolean", nullable=true)
     */
    private $legendeTournante = false;

    /**
     * @var boolean $legendeRetrograde
     *
     * @ORM\Column(name="legendeRetrograde", type="boolean", nullable=true)
     */
    private $legendeRetrograde = false;

    /**
     * @var boolean $legendeCentrifuge
     *
     * @ORM\Column(name="legendeCentrifuge", type="boolean", nullable=true)
     */
    private $legendeCentrifuge = false;

    /**
     * @var boolean $legendeCentripete
     *
     * @ORM\Column(name="legendeCentripete", type="boolean", nullable=true)
     */
    private $legendeCentripete = false;

    /**
     * @var boolean $legendeBoustrophedon
     *
     * @ORM\Column(name="legendeBoustrophedon", type="boolean", nullable=true)
     */
    private $legendeBoustrophedon = false;

    /**
     * @var boolean $legendeMontante
     *
     * @ORM\Column(name="legendeMontante", type="boolean", nullable=true)
     */
    private $legendeMontante = false;

    /**
     * @var string $lettreLunaire
     *
     * @ORM\Column(name="lettreLunaire", type="string", nullable=true)
     */
    private $lettreLunaire;

    /**
     * @var string $lettreRetrograde
     *
     * @ORM\Column(name="lettreRetrograde", type="string", nullable=true)
     */
    private $lettreRetrograde;

    /**
     * @var string $lettreRenversee
     *
     * @ORM\Column(name="lettreRenversee", type="string", nullable=true)
     */
    private $lettreRenversee;

    /**
     * @var boolean $epi
     *
     * @ORM\Column(name="epi", type="boolean", nullable=true)
     */
    private $epi = false;

    /**
     * @var boolean $para
     *
     * @ORM\Column(name="para", type="boolean", nullable=true)
     */
    private $para = false;

    /**
     * @var boolean $iereus
     *
     * @ORM\Column(name="iereus", type="boolean", nullable=true)
     */
    private $iereus = false;

    /**
     * @var boolean $ergastiriarchas
     *
     * @ORM\Column(name="ergastiriarchas", type="boolean", nullable = true)
     */
    private $ergastiriarchas = false;

    /**
     * @var boolean $metoikos
     *
     * @ORM\Column(name="metoikos", type="boolean", nullable=true)
     */
    private $metoikos = false;

    /**
     * @var boolean $engenis
     *
     * @ORM\Column(name="engenis", type="boolean", nullable=true)
     */
    private $engenis = false;

    /**
     * @var boolean $meis
     *
     * @ORM\Column(name="meis", type="boolean", nullable=true)
     */
    private $meis = false;

    /**
     * @var boolean $regravure
     *
     * @ORM\Column(name="regravure", type="boolean")
     */
    private $regravure = false;

    /**
     * @var EthniqueDemotique
     *
     * @ORM\ManyToOne(targetEntity="EthniqueDemotique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ethniqueDemotique_id", referencedColumnName="id")
     * })
     */
    private $ethniqueDemotique;

    /**
     * @var string $particulariteOrthographique
     *
     * @ORM\Column(name="particulariteOrthographique", type="string", nullable=true)
     */
    private $particulariteOrthographique;

    /**
     * @ORM\OneToMany(targetEntity="FichesPrincipales", mappedBy="fiche", cascade={"persist"}, orphanRemoval=true)
     */
    private $matricePrincipale;

    /**
     * @ORM\OneToMany(targetEntity="FichesSecondaires", mappedBy="fiche", cascade={"persist"}, orphanRemoval=true)
     */
    private $matriceSecondaire;

    /**
     * @ORM\OneToMany(targetEntity="FichesComplementaires", mappedBy="fiche", cascade={"persist"}, orphanRemoval=true)
     */
    private $matriceComplementaire;

    /**
     * @var boolean $public
     *
     * @ORM\Column(name="public", type="boolean", nullable=true)
     */
    private $public = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modification_date;

    /**
     * @var Fichiers
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $fichiers;

    /**
     * @var Fichesassociees
     *
     * @ORM\ManyToMany(targetEntity="Fiches")
     * @ORM\JoinTable(name="fichesAssociees",
     *      joinColumns={@ORM\JoinColumn(name="id_fiche", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_fiche_associee", referencedColumnName="id")}
     * )
     */
    private $fichesassociees;

    /**
     * @var Auteur
     *
     * @ORM\ManyToOne(targetEntity="NTE\AgathoklesBundle\Entity\User")
     */
    private $auteur;

    /**
     * @var Editeur
     *
     * @ORM\ManyToOne(targetEntity="NTE\AgathoklesBundle\Entity\User")
     */
    private $editeur;

    /**
     * @var boolean $fabIdInc
     *
     * @ORM\Column(name="fabIdInc", type="boolean", nullable=true)
     */
    private $fabIdInc = false;

    /**
     * @var boolean $epoIdInc
     *
     * @ORM\Column(name="epoIdInc", type="boolean", nullable=true)
     */
    private $epoIdInc = false;

    /**
     * @var boolean $moisIdInc
     *
     * @ORM\Column(name="moisIdInc", type="boolean", nullable=true)
     */
    private $moisIdInc = false;

    /**
     * @var string $remarquesType
     *
     * @ORM\Column(name="remarquesType", type="text", nullable=true)
     */
    private $remarquesType;

    /**
     * @var string $remarquesMatrice
     *
     * @ORM\Column(name="remarquesMatrice", type="text", nullable=true)
     */
    private $remarquesMatrice;

    /**
     * @var string $remarquesAssociations
     *
     * @ORM\Column(name="remarquesAssociations", type="text", nullable=true)
     */
    private $remarquesAssociations;

    /**
     * @var string $nominatifFabricant
     *
     * @ORM\Column(name="nominatifFabricant", type="boolean", nullable=true)
     */
    private $nominatifFabricant;

    /**
     * @var boolean $nominatifEponyme
     *
     * @ORM\Column(name="nominatifEponyme", type="boolean", nullable=true)
     */
    private $nominatifEponyme;

    /**
     * @var boolean $ei
     *
     * @ORM\Column(name="ei", type="boolean", nullable=true)
     */
    private $ei;

    /**
     * @var boolean $patronyme
     *
     * @ORM\Column(name="patronyme", type="boolean", nullable=true)
     */
    private $patronyme;

    /**
     * @ORM\OneToMany(targetEntity="Timbre", mappedBy="fiche", cascade={"persist"}, orphanRemoval=true)
     */
    protected $timbres;

    /**
     * @ORM\ManyToOne(targetEntity="Different")
     */
    private $different;

    /**
     * @ORM\ManyToOne(targetEntity="ete")
     */
    private $ete;

    /**
     * @var TaxoSubtype|null the taxoSubtype this fiche belongs (if any)
     * @ORM\ManyToOne(targetEntity="TaxoSubtype", inversedBy="fiches")
     * @ORM\JoinColumn(name="taxoSubtype_id", referencedColumnName="id")
     */
    private $taxoSubtype;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank = 0;

    public function __toString()
    {
        $delimiter = " - ";
        $fab = $epo = $mois = $taxoType = $taxoSubtype = "";

        if ($this->fabricant) {
            $fab = $this->fabricant.$delimiter;
        }
        if ($this->eponyme) {
            $epo = $this->eponyme.$delimiter;
        }
        if ($this->mois) {
            $mois = $this->mois.$delimiter;
        }
        if ($this->taxoSubtype) {
            $taxoSubtype = "S".$this->taxoSubtype.$delimiter;
            if ($this->taxoSubtype->getTaxoType()) {
                $taxoType = "T".$this->taxoSubtype->getTaxoType().$delimiter;
            }
        }
        $rank = "M".$this->rank.$delimiter;

        $result = $fab.$epo.$mois.$taxoType.$taxoSubtype.$rank;
        if (substr($result, -3) == " - ") {
            $result = substr($result, 0, -3);
        }

        return $result;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->creation_date = $this->modification_date = new \DateTime('now');
        //See also FichesListener.php
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->modification_date = new \DateTime('now');
        //See also FichesListener.php
    }

    public function preRemove()
    {
        $this->setTaxoSubtype(null);
    }


    /**
     * Set fichesassociees
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fichesassociees
     * @return Fiches
     */
    public function setFichesassociees(\NTE\AgathoklesBundle\Entity\Fiches $fichesassociees = null)
    {
        $this->fichesassociees = $fichesassociees;

        return $this;
    }

    /**
     * Get fichesassociees
     *
     * @return \NTE\AgathoklesBundle\Entity\Fiches
     */
    public function getFichesassociees()
    {
        return $this->fichesassociees;
    }

    /**
     * Add fichesassociees
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fichesassociees
     * @return Fiches
     */
    public function addFichesassociee(\NTE\AgathoklesBundle\Entity\Fiches $fichesassociees)
    {
        $this->fichesassociees[] = $fichesassociees;

        return $this;
    }

    /**
     * Remove fichesassociees
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $fichesassociees
     */
    public function removeFichesassociee(\NTE\AgathoklesBundle\Entity\Fiches $fichesassociees)
    {
        $this->fichesassociees->removeElement($fichesassociees);
    }

    /**
     * Set creation_date
     *
     * @param \DateTime $creationDate
     * @return Fiches
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;

        return $this;
    }

    /**
     * Get creation_date
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Set modification_date
     *
     * @param \DateTime $modificationDate
     * @return Fiches
     */
    public function setModificationDate($modificationDate)
    {
        $this->modification_date = $modificationDate;

        return $this;
    }

    /**
     * Get modification_date
     *
     * @return \DateTime
     */
    public function getModificationDate()
    {
        return $this->modification_date;
    }

    /**
     * Set auteur
     *
     * @param \NTE\AgathoklesBundle\Entity\User $auteur
     * @return Fiches
     */
    public function setAuteur(\NTE\AgathoklesBundle\Entity\User $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \NTE\AgathoklesBundle\Entity\User
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set editeur
     *
     * @param \NTE\AgathoklesBundle\Entity\User $editeur
     * @return Fiches
     */
    public function setEditeur(\NTE\AgathoklesBundle\Entity\User $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return \NTE\AgathoklesBundle\Entity\User
     */
    public function getEditeur()
    {
        return $this->editeur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fichesassociees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new ArrayCollection();
        $this->timbres = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @return Fiches
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set fullname
     *
     * @param string $fullname
     * @return Fiches
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set mois
     *
     * @param string $mois
     * @return Fiches
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set legende
     *
     * @param string $legende
     * @return Fiches
     */
    public function setLegende($legende)
    {
        $this->legende = $legende;

        return $this;
    }

    /**
     * Get legende
     *
     * @return string
     */
    public function getLegende()
    {
        return $this->legende;
    }

    /**
     * Set bouton
     *
     * @param boolean $bouton
     * @return Fiches
     */
    public function setBouton($bouton)
    {
        $this->bouton = $bouton;

        return $this;
    }

    /**
     * Get bouton
     *
     * @return boolean
     */
    public function getBouton()
    {
        return $this->bouton;
    }

    /**
     * Set grenetis
     *
     * @param boolean $grenetis
     * @return Fiches
     */
    public function setGrenetis($grenetis)
    {
        $this->grenetis = $grenetis;

        return $this;
    }

    /**
     * Get grenetis
     *
     * @return boolean
     */
    public function getGrenetis()
    {
        return $this->grenetis;
    }

    /**
     * Set ombilic
     *
     * @param boolean $ombilic
     * @return Fiches
     */
    public function setOmbilic($ombilic)
    {
        $this->ombilic = $ombilic;

        return $this;
    }

    /**
     * Get ombilic
     *
     * @return boolean
     */
    public function getOmbilic()
    {
        return $this->ombilic;
    }

    /**
     * Set legendeTournante
     *
     * @param boolean $legendeTournante
     * @return Fiches
     */
    public function setLegendeTournante($legendeTournante)
    {
        $this->legendeTournante = $legendeTournante;

        return $this;
    }

    /**
     * Get legendeTournante
     *
     * @return boolean
     */
    public function getLegendeTournante()
    {
        return $this->legendeTournante;
    }

    /**
     * Set legendeRetrograde
     *
     * @param string $legendeRetrograde
     * @return Fiches
     */
    public function setLegendeRetrograde($legendeRetrograde)
    {
        $this->legendeRetrograde = $legendeRetrograde;

        return $this;
    }

    /**
     * Get legendeRetrograde
     *
     * @return string
     */
    public function getLegendeRetrograde()
    {
        return $this->legendeRetrograde;
    }

    /**
     * Set lettreLunaire
     *
     * @param string $lettreLunaire
     * @return Fiches
     */
    public function setLettreLunaire($lettreLunaire)
    {
        $this->lettreLunaire = $lettreLunaire;

        return $this;
    }

    /**
     * Get lettreLunaire
     *
     * @return string
     */
    public function getLettreLunaire()
    {
        return $this->lettreLunaire;
    }

    /**
     * Set particulariteOrthographique
     *
     * @param string $particulariteOrthographique
     * @return Fiches
     */
    public function setParticulariteOrthographique($particulariteOrthographique)
    {
        $this->particulariteOrthographique = $particulariteOrthographique;

        return $this;
    }

    /**
     * Get particulariteOrthographique
     *
     * @return string
     */
    public function getParticulariteOrthographique()
    {
        return $this->particulariteOrthographique;
    }

    /**
     * Set public
     *
     * @param boolean $public
     * @return Fiches
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set categorie
     *
     * @param \NTE\AgathoklesBundle\Entity\Categorie $categorie
     * @return Fiches
     */
    public function setCategorie(\NTE\AgathoklesBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \NTE\AgathoklesBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set fabricant
     *
     * @param \NTE\AgathoklesBundle\Entity\Fabricant $fabricant
     * @return Fiches
     */
    public function setFabricant(\NTE\AgathoklesBundle\Entity\Fabricant $fabricant = null)
    {
        $this->fabricant = $fabricant;

        return $this;
    }

    /**
     * Get fabricant
     *
     * @return \NTE\AgathoklesBundle\Entity\Fabricant
     */
    public function getFabricant()
    {
        return $this->fabricant;
    }

    /**
     * Has fabricant
     *
     * @return boolean
     */
    public function hasFabricant()
    {
        return $this->fabricant != null;
    }

    /**
     * Set eponyme
     *
     * @param \NTE\AgathoklesBundle\Entity\Eponyme $eponyme
     * @return Fiches
     */
    public function setEponyme(\NTE\AgathoklesBundle\Entity\Eponyme $eponyme = null)
    {
        $this->eponyme = $eponyme;

        return $this;
    }

    /**
     * Get eponyme
     *
     * @return \NTE\AgathoklesBundle\Entity\Eponyme
     */
    public function getEponyme()
    {
        return $this->eponyme;
    }

    /**
     * Has eponyme
     *
     * @return boolean
     */
    public function hasEponyme()
    {
        return $this->eponyme != null;
    }

    /**
     * Set forme
     *
     * @param \NTE\AgathoklesBundle\Entity\Forme $forme
     * @return Fiches
     */
    public function setForme(\NTE\AgathoklesBundle\Entity\Forme $forme = null)
    {
        $this->forme = $forme;

        return $this;
    }

    /**
     * Get forme
     *
     * @return \NTE\AgathoklesBundle\Entity\Forme
     */
    public function getForme()
    {
        return $this->forme;
    }

    /**
     * Set embleme
     *
     * @param \NTE\AgathoklesBundle\Entity\Embleme $embleme
     * @return Fiches
     */
    public function setEmbleme(\NTE\AgathoklesBundle\Entity\Embleme $embleme = null)
    {
        $this->embleme = $embleme;

        return $this;
    }

    /**
     * Get embleme
     *
     * @return \NTE\AgathoklesBundle\Entity\Embleme
     */
    public function getEmbleme()
    {
        return $this->embleme;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Fiches
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set position
     *
     * @param \NTE\AgathoklesBundle\Entity\Position $position
     * @return Fiches
     */
    public function setPosition(\NTE\AgathoklesBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \NTE\AgathoklesBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set cadre
     *
     * @param \NTE\AgathoklesBundle\Entity\Cadre $cadre
     * @return Fiches
     */
    public function setCadre(\NTE\AgathoklesBundle\Entity\Cadre $cadre = null)
    {
        $this->cadre = $cadre;

        return $this;
    }

    /**
     * Get cadre
     *
     * @return \NTE\AgathoklesBundle\Entity\Cadre
     */
    public function getCadre()
    {
        return $this->cadre;
    }

    /**
     * Set separation
     *
     * @param \NTE\AgathoklesBundle\Entity\Separation $separation
     * @return Fiches
     */
    public function setSeparation(\NTE\AgathoklesBundle\Entity\Separation $separation = null)
    {
        $this->separation = $separation;

        return $this;
    }

    /**
     * Get separation
     *
     * @return \NTE\AgathoklesBundle\Entity\Separation
     */
    public function getSeparation()
    {
        return $this->separation;
    }

    /**
     * Set fichiers
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $fichiers
     * @return Fiches
     */
    public function setFichiers(\Application\Sonata\MediaBundle\Entity\Media $fichiers = null)
    {
        $this->fichiers = $fichiers;

        return $this;
    }

    /**
     * Get fichiers
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFichiers()
    {
        return $this->fichiers;
    }

    /**
     * Set epi
     *
     * @param boolean $epi
     * @return Fiches
     */
    public function setEpi($epi)
    {
        $this->epi = $epi;

        return $this;
    }

    /**
     * Get epi
     *
     * @return boolean
     */
    public function getEpi()
    {
        return $this->epi;
    }

    /**
     * Set para
     *
     * @param boolean $para
     * @return Fiches
     */
    public function setPara($para)
    {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return boolean
     */
    public function getPara()
    {
        return $this->para;
    }

    /**
     * Set iereus
     *
     * @param boolean $iereus
     * @return Fiches
     */
    public function setIereus($iereus)
    {
        $this->iereus = $iereus;

        return $this;
    }

    /**
     * Get iereus
     *
     * @return boolean
     */
    public function getIereus()
    {
        return $this->iereus;
    }

    /**
     * Set metoikos
     *
     * @param boolean $metoikos
     * @return Fiches
     */
    public function setMetoikos($metoikos)
    {
        $this->metoikos = $metoikos;

        return $this;
    }

    /**
     * Get metoikos
     *
     * @return boolean
     */
    public function getMetoikos()
    {
        return $this->metoikos;
    }

    /**
     * Set meis
     *
     * @param boolean $meis
     * @return Fiches
     */
    public function setMeis($meis)
    {
        $this->meis = $meis;

        return $this;
    }

    /**
     * Get meis
     *
     * @return boolean
     */
    public function getMeis()
    {
        return $this->meis;
    }

    /**
     * Set matricePrincipale
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesPrincipales $matricePrincipale
     * @return Fiches
     */
    public function setMatricePrincipale(\NTE\AgathoklesBundle\Entity\FichesPrincipales $matricePrincipale = null)
    {
        $this->matricePrincipale = $matricePrincipale;

        return $this;
    }

    /**
     * Set matriceSecondaire
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesSecondaires $matriceSecondaire
     * @return Fiches
     */
    public function setMatriceSecondaire(\NTE\AgathoklesBundle\Entity\FichesSecondaires $matriceSecondaire = null)
    {
        $this->matriceSecondaire = $matriceSecondaire;

        return $this;
    }

    /**
     * Set matriceComplementaire
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesComplementaires $matriceComplementaire
     * @return Fiches
     */
    public function setMatriceComplementaire(\NTE\AgathoklesBundle\Entity\FichesComplementaires $matriceComplementaire = null)
    {
        $this->matriceComplementaire = $matriceComplementaire;

        return $this;
    }

    /**
     * Set ethniqueDemotique
     *
     * @param \NTE\AgathoklesBundle\Entity\EthniqueDemotique $ethniqueDemotique
     * @return Fiches
     */
    public function setEthniqueDemotique(\NTE\AgathoklesBundle\Entity\EthniqueDemotique $ethniqueDemotique = null)
    {
        $this->ethniqueDemotique = $ethniqueDemotique;

        return $this;
    }

    /**
     * Get ethniqueDemotique
     *
     * @return \NTE\AgathoklesBundle\Entity\EthniqueDemotique
     */
    public function getEthniqueDemotique()
    {
        return $this->ethniqueDemotique;
    }

    /**
     * Add matricePrincipale
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesPrincipales $matricePrincipale
     * @return Fiches
     */
    public function addMatricePrincipale(\NTE\AgathoklesBundle\Entity\FichesPrincipales $matricePrincipale)
    {
        $matricePrincipale->setFiche($this); # pour la collection
        $this->matricePrincipale[] = $matricePrincipale;

        return $this;
    }

    /**
     * Remove matricePrincipale
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesPrincipales $matricePrincipale
     */
    public function removeMatricePrincipale(\NTE\AgathoklesBundle\Entity\FichesPrincipales $matricePrincipale)
    {
        $this->matricePrincipale->removeElement($matricePrincipale);
    }

    /**
     * Get matricePrincipale
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatricePrincipale()
    {
        return $this->matricePrincipale;
    }

    /**
     * Add matriceSecondaire
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $matriceSecondaire
     * @return Fiches
     */
    public function addMatriceSecondaire(\NTE\AgathoklesBundle\Entity\FichesSecondaires $matriceSecondaire)
    {
        $matriceSecondaire->setFiche($this); # pour la collection
        $this->matriceSecondaire[] = $matriceSecondaire;

        return $this;
    }

    /**
     * Remove matriceSecondaire
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $matriceSecondaire
     */
    public function removeMatriceSecondaire(\NTE\AgathoklesBundle\Entity\FichesSecondaires $matriceSecondaire)
    {
        $this->matriceSecondaire->removeElement($matriceSecondaire);
    }

    /**
     * Get matriceSecondaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatriceSecondaire()
    {
        return $this->matriceSecondaire;
    }

    /**
     * Add matriceComplementaire
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $matriceComplementaire
     * @return Fiches
     */
    public function addMatriceComplementaire(\NTE\AgathoklesBundle\Entity\FichesComplementaires $matriceComplementaire)
    {
        $matriceComplementaire->setFiche($this); # pour la collection
        $this->matriceComplementaire[] = $matriceComplementaire;

        return $this;
    }

    /**
     * Remove matriceComplementaire
     *
     * @param \NTE\AgathoklesBundle\Entity\Fiches $matriceComplementaire
     */
    public function removeMatriceComplementaire(\NTE\AgathoklesBundle\Entity\FichesComplementaires $matriceComplementaire)
    {
        $this->matriceComplementaire->removeElement($matriceComplementaire);
    }

    /**
     * Get matriceComplementaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatriceComplementaire()
    {
        return $this->matriceComplementaire;
    }

    /**
     * Set fabIdInc
     *
     * @param boolean $fabIdInc
     * @return Fiches
     */
    public function setFabIdInc($fabIdInc)
    {
        $this->fabIdInc = $fabIdInc;

        return $this;
    }

    /**
     * Get fabIdInc
     *
     * @return boolean
     */
    public function getFabIdInc()
    {
        return $this->fabIdInc;
    }

    /**
     * Set epoIdInc
     *
     * @param boolean $epoIdInc
     * @return Fiches
     */
    public function setEpoIdInc($epoIdInc)
    {
        $this->epoIdInc = $epoIdInc;

        return $this;
    }

    /**
     * Get epoIdInc
     *
     * @return boolean
     */
    public function getEpoIdInc()
    {
        return $this->epoIdInc;
    }

    /**
     * Set moisIdInc
     *
     * @param boolean $moisIdInc
     * @return Fiches
     */
    public function setMoisIdInc($moisIdInc)
    {
        $this->moisIdInc = $moisIdInc;

        return $this;
    }

    /**
     * Get moisIdInc
     *
     * @return boolean
     */
    public function getMoisIdInc()
    {
        return $this->moisIdInc;
    }

    /**
     * Check if is primary
     *
     * @return boolean
     */
    public function isPrimary()
    {
        return $this->getCategorie()->getId() == 1;
    }

    /**
     * Add timbres
     *
     * @param \NTE\AgathoklesBundle\Entity\Timbre $timbres
     * @return Fiches
     */
    public function addTimbre(\NTE\AgathoklesBundle\Entity\Timbre $timbre)
    {
        $this->timbres[] = $timbre;
        $timbre->setFiche($this);

        return $this;
    }

    /**
     * Remove timbres
     *
     * @param \NTE\AgathoklesBundle\Entity\Timbre $timbres
     */
    public function removeTimbre(\NTE\AgathoklesBundle\Entity\Timbre $timbre)
    {
        $this->timbres->removeElement($timbre);
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

    /**
     * Get startDate
     *
     * @return integer
     */
    public function getDatingStart()
    {
        $fabricant = $this->getFabricant();
        $fabDatingStart = null;
        $eponyme = $this->getEponyme();
        $epoDatingStart = null;

        if ($fabricant != null) {
            $fabDatingStart = $this->getFabricant()->getDatingStart();
        }
        if ($eponyme != null) {
            $epoDatingStart = $this->getEponyme()->getDatingStart();
        }

        if ($fabDatingStart != null && $epoDatingStart == null) {
            return $fabDatingStart;
        }
        else if ($fabDatingStart == null && $epoDatingStart != null) {
            return $epoDatingStart;
        }
        else if ($fabDatingStart != null && $epoDatingStart != null) {
            return ($fabDatingStart < $epoDatingStart) ? $fabDatingStart : $epoDatingStart;
        }
        else {
            return null;
        }
    }

    /**
     * Get endDate
     *
     * @return integer
     */
    public function getDatingEnd()
    {
        $fabricant = $this->getFabricant();
        $fabDatingEnd = null;
        $eponyme = $this->getEponyme();
        $epoDatingEnd = null;

        if($fabricant != null) {
            $fabDatingEnd = $fabricant->getDatingEnd();
        }
        if($eponyme != null) {
            $epoDatingEnd = $eponyme->getDatingEnd();
        }

        if ($fabDatingEnd != null && $epoDatingEnd == null) {
            return $fabDatingEnd;
        }
        else if ($fabDatingEnd == null && $epoDatingEnd != null) {
            return $epoDatingEnd;
        }
        else if ($fabDatingEnd != null && $epoDatingEnd != null) {
            return ($fabDatingEnd < $epoDatingEnd) ? $fabDatingEnd : $epoDatingEnd;
        }
        else {
            return null;
        }
    }

    /**
     * Is Circa
     *
     * @return boolean
     */
    public function isCirca()
    {
        $fabricant = $this->getFabricant();
        $eponyme = $this->getEponyme();

        if ($fabricant != null && $eponyme != null) {
            return $fabricant->getApproximative() || $eponyme->getApproximative();
        }
        else if ($fabricant != null && $eponyme == null) {
            return $fabricant->getApproximative();
        }
        else if ($fabricant == null && $eponyme != null) {
            return $eponyme->getApproximative();
        }
    }

    /**
     * Set ergastiriarchas
     *
     * @param boolean $ergastiriarchas
     * @return Fiches
     */
    public function setErgastiriarchas($ergastiriarchas)
    {
        $this->ergastiriarchas = $ergastiriarchas;

        return $this;
    }

    /**
     * Get ergastiriarchas
     *
     * @return boolean
     */
    public function getErgastiriarchas()
    {
        return $this->ergastiriarchas;
    }

    /**
     * Set legendeCentrifuge
     *
     * @param boolean $legendeCentrifuge
     * @return Fiches
     */
    public function setLegendeCentrifuge($legendeCentrifuge)
    {
        $this->legendeCentrifuge = $legendeCentrifuge;

        return $this;
    }

    /**
     * Get legendeCentrifuge
     *
     * @return boolean
     */
    public function getLegendeCentrifuge()
    {
        return $this->legendeCentrifuge;
    }

    /**
     * Set legendeCentripete
     *
     * @param boolean $legendeCentripete
     * @return Fiches
     */
    public function setLegendeCentripete($legendeCentripete)
    {
        $this->legendeCentripete = $legendeCentripete;

        return $this;
    }

    /**
     * Get legendeCentripete
     *
     * @return boolean
     */
    public function getLegendeCentripete()
    {
        return $this->legendeCentripete;
    }

    /**
     * Set legendeBoustrophedon
     *
     * @param boolean $legendeBoustrophedon
     * @return Fiches
     */
    public function setLegendeBoustrophedon($legendeBoustrophedon)
    {
        $this->legendeBoustrophedon = $legendeBoustrophedon;

        return $this;
    }

    /**
     * Get legendeBoustrophedon
     *
     * @return boolean
     */
    public function getLegendeBoustrophedon()
    {
        return $this->legendeBoustrophedon;
    }

    /**
     * Set legendeMontante
     *
     * @param boolean $legendeMontante
     * @return Fiches
     */
    public function setLegendeMontante($legendeMontante)
    {
        $this->legendeMontante = $legendeMontante;

        return $this;
    }

    /**
     * Get legendeMontante
     *
     * @return boolean
     */
    public function getLegendeMontante()
    {
        return $this->legendeMontante;
    }

    /**
     * Set lettreRetrograde
     *
     * @param string $lettreRetrograde
     * @return Fiches
     */
    public function setLettreRetrograde($lettreRetrograde)
    {
        $this->lettreRetrograde = $lettreRetrograde;

        return $this;
    }

    /**
     * Get lettreRetrograde
     *
     * @return string
     */
    public function getLettreRetrograde()
    {
        return $this->lettreRetrograde;
    }

    /**
     * Get Fabricant's id
     * if null, return 0
     * @return integer
     */
    public function getFabricantId()
    {
        $fabricant = $this->fabricant;
        if ($fabricant != null) {
            return $fabricant->getId();
        }
        else {
            return 0;
        }
    }

    /**
     * Get Eponyme's id
     * if null, return 0
     * @return integer
     */
    public function getEponymeId()
    {
        $eponyme = $this->eponyme;
        if ($eponyme != null) {
            return $eponyme->getId();
        }
        else {
            return 0;
        }
    }

    /**
     * Set lettreRenversee
     *
     * @param string $lettreRenversee
     * @return Fiches
     */
    public function setLettreRenversee($lettreRenversee)
    {
        $this->lettreRenversee = $lettreRenversee;

        return $this;
    }

    /**
     * Get lettreRenversee
     *
     * @return string
     */
    public function getLettreRenversee()
    {
        return $this->lettreRenversee;
    }

    /**
     * Set regravure
     *
     * @param boolean $regravure
     * @return Fiches
     */
    public function setRegravure($regravure)
    {
        $this->regravure = $regravure;

        return $this;
    }

    /**
     * Get regravure
     *
     * @return boolean
     */
    public function getRegravure()
    {
        return $this->regravure;
    }

    /**
     * Set engenis
     *
     * @param boolean $engenis
     * @return Fiches
     */
    public function setEngenis($engenis)
    {
        $this->engenis = $engenis;

        return $this;
    }

    /**
     * Get engenis
     *
     * @return boolean
     */
    public function getEngenis()
    {
        return $this->engenis;
    }

    /**
     * Set remarquesType
     *
     * @param string $remarquesType
     * @return Fiches
     */
    public function setRemarquesType($remarquesType)
    {
        $this->remarquesType = $remarquesType;

        return $this;
    }

    /**
     * Get remarquesType
     *
     * @return string
     */
    public function getRemarquesType()
    {
        return $this->remarquesType;
    }

    /**
     * Set remarquesMatrice
     *
     * @param string $remarquesMatrice
     * @return Fiches
     */
    public function setRemarquesMatrice($remarquesMatrice)
    {
        $this->remarquesMatrice = $remarquesMatrice;

        return $this;
    }

    /**
     * Get remarquesMatrice
     *
     * @return string
     */
    public function getRemarquesMatrice()
    {
        return $this->remarquesMatrice;
    }

    /**
     * Set remarquesAssociations
     *
     * @param string $remarquesAssociations
     * @return Fiches
     */
    public function setRemarquesAssociations($remarquesAssociations)
    {
        $this->remarquesAssociations = $remarquesAssociations;

        return $this;
    }

    /**
     * Get remarquesAssociations
     *
     * @return string
     */
    public function getRemarquesAssociations()
    {
        return $this->remarquesAssociations;
    }

    /**
     * Add images
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesImages $images
     * @return Fiches
     */
    public function addImage(\NTE\AgathoklesBundle\Entity\FichesImages $images)
    {
        $images->setFiche($this);
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesImages $images
     */
    public function removeImage(\NTE\AgathoklesBundle\Entity\FichesImages $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set nominatifFabricant
     *
     * @param boolean $nominatifFabricant
     * @return Fiches
     */
    public function setNominatifFabricant($nominatifFabricant)
    {
        $this->nominatifFabricant = $nominatifFabricant;

        return $this;
    }

    /**
     * Get nominatifFabricant
     *
     * @return boolean
     */
    public function getNominatifFabricant()
    {
        return $this->nominatifFabricant;
    }

    /**
     * Set nominatifEponyme
     *
     * @param boolean $nominatifEponyme
     * @return Fiches
     */
    public function setNominatifEponyme($nominatifEponyme)
    {
        $this->nominatifEponyme = $nominatifEponyme;

        return $this;
    }

    /**
     * Get nominatifEponyme
     *
     * @return boolean
     */
    public function getNominatifEponyme()
    {
        return $this->nominatifEponyme;
    }

    /**
     * Set ei
     *
     * @param boolean $ei
     * @return Fiches
     */
    public function setEi($ei)
    {
        $this->ei = $ei;

        return $this;
    }

    /**
     * Get ei
     *
     * @return boolean
     */
    public function getEi()
    {
        return $this->ei;
    }

    /**
     * Set patronyme
     *
     * @param boolean $patronyme
     * @return Fiches
     */
    public function setPatronyme($patronyme)
    {
        $this->patronyme = $patronyme;

        return $this;
    }

    /**
     * Get patronyme
     *
     * @return boolean
     */
    public function getPatronyme()
    {
        return $this->patronyme;
    }

    public function getTaxoSubtypeKey()
    {
        $separator = "";
        $key = "".
        $this->boolVal($this->para).$separator.
        $this->boolVal($this->nominatifFabricant).$separator.
        $this->boolVal($this->epi).$separator.
        $this->boolVal($this->iereus).$separator.
        $this->boolVal($this->nominatifEponyme).$separator.
        $this->boolVal($this->patronyme).$separator.
        $this->boolVal($this->meis);
        return md5($key);
    }

    /**
     * Set different
     *
     * @param \NTE\AgathoklesBundle\Entity\Different $different
     * @return Fiches
     */
    public function setDifferent(\NTE\AgathoklesBundle\Entity\Different $different = null)
    {
        $this->different = $different;

        return $this;
    }

    /**
     * Get different
     *
     * @return \NTE\AgathoklesBundle\Entity\Different
     */
    public function getDifferent()
    {
        return $this->different;
    }

    /**
     * Set ete
     *
     * @param \NTE\AgathoklesBundle\Entity\ete $ete
     * @return Fiches
     */
    public function setEte(\NTE\AgathoklesBundle\Entity\ete $ete = null)
    {
        $this->ete = $ete;

        return $this;
    }

    /**
     * Get ete
     *
     * @return \NTE\AgathoklesBundle\Entity\ete
     */
    public function getEte()
    {
        return $this->ete;
    }

    /**
     * Sets a new fiche taxoSubtype and cleans the previous one if set
     * @param null|TaxoSubtype $taxoSubtype
     */
    public function setTaxoSubtype($taxoSubtype) {
        if($taxoSubtype === null) {
            if($this->taxoSubtype !== null) {
                $this->taxoSubtype->getFiches()->removeElement($this);
            }
            $this->taxoSubtype = null;
        } else {
            if(!$taxoSubtype instanceof TaxoSubtype) {
                throw new InvalidArgumentException('$taxoSubtype must be null or instance of TaxoSubtype');
            }
            if($this->taxoSubtype !== null) {
                $this->taxoSubtype->getFiches()->removeElement($this);
            }
            $this->taxoSubtype = $taxoSubtype;
            $taxoSubtype->getFiches()->add($this);
        }
    }

    /**
     * @return TaxoSubtype|null
     */
    public function getTaxoSubtype() {
        return $this->taxoSubtype;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return Fiches
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
     * HELPERS
     */

    public function boolVal($value)
    {
        return $value ? "1" : "0";
    }

    public function calcTaxoTypeHash()
    {
        $separator = "";
        $fab = $mois = $embleme = $eponyme = $forme = $ethniqueDemotique = $different = $ete = 0;
        if ($this->getFabricant() instanceof Fabricant) {
            $fab = $this->getFabricant()->getId();
        }
        if ($this->getEponyme() instanceof Eponyme) {
            $eponyme = $this->getEponyme()->getId();
        }
        if ($this->getMois() instanceof Mois) {
            $mois = $this->getMois()->getId();
        }
        if ($this->getEmbleme() instanceof Embleme) {
            $embleme = $this->getEmbleme()->getId();
        }
        if ($this->getForme() instanceof Forme) {
            $forme = $this->getForme()->getId();
        }
        if ($this->getEthniqueDemotique() instanceof EthniqueDemotique) {
            $ethniqueDemotique = $this->getEthniqueDemotique()->getId();
        }
        if ($this->getDifferent() instanceof Different) {
            $different = $this->getDifferent()->getId();
        }
        if ($this->getEte() instanceof Ete) {
            $ete = $this->getEte()->getId();
        }
        $hash = "".
            $fab.$separator.
            $ethniqueDemotique.$separator.
            $this->boolVal($this->metoikos).$separator.
            $this->boolVal($this->engenis).$separator.
            $this->boolVal($this->ergastiriarchas).$separator.
            $eponyme.$separator.
            $this->boolVal($this->ei).$separator.
            $mois.$separator.
            $different.$separator.
            $ete.$separator.
            $embleme.$separator.
            $forme;
        return md5($hash);
    }

    public function calcTaxoSubtypeHash()
    {
        $separator = "";
        $hash = "".
            $this->boolVal($this->para).$separator.
            $this->boolVal($this->nominatifFabricant).$separator.
            $this->boolVal($this->epi).$separator.
            $this->boolVal($this->iereus).$separator.
            $this->boolVal($this->nominatifEponyme).$separator.
            $this->boolVal($this->patronyme).$separator.
            $this->boolVal($this->meis);
        return md5($hash);
    }
}
