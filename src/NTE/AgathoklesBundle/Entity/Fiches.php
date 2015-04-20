<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string $autreLegende
     *
     * @ORM\Column(name="autreLegende", type="string", length=255, nullable=true)
     */
    private $autreLegende;

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
     * @var string $lettreRetrograde
     *
     * @ORM\Column(name="lettreRetrograde", type="string", nullable=true)
     */
    private $lettreRetrograde;

    /**
     * @var string $lettreLunaire
     *
     * @ORM\Column(name="lettreLunaire", type="string", nullable=true)
     */
    private $lettreLunaire;

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
     * @var boolean $metoikos
     *
     * @ORM\Column(name="metoikos", type="boolean", nullable=true)
     */
    private $metoikos = false;

    /**
     * @var boolean $meis
     *
     * @ORM\Column(name="meis", type="boolean", nullable=true)
     */
    private $meis = false;

    /**
     * @var string $ete
     *
     * @ORM\Column(name="ete", type="string", nullable=true)
     */
    private $ete;

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
     * @var boolean $retrogravure
     *
     * @ORM\Column(name="retrogravure", type="boolean", nullable=true)
     */
    private $retrogravure = false;

    /**
     * @var integer $numero
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var string $referenceBibliographique
     *
     * @ORM\Column(name="referenceBibliographique", type="string", nullable=true)
     */
    private $referenceBibliographique;

    /**
     * @var Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lieu_id", referencedColumnName="id")
     * })
     */
    private $lieuDeDecouverte;

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
     * @var string $date
     *
     * @ORM\Column(name="date", type="string", nullable=true)
     */
    private $date;

    /**
     * @var string $remarques
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;



    /**
     * @var boolean $public
     *
     * @ORM\Column(name="public", type="boolean", nullable=true)
     */
    private $public = false;

    /**
     * @var boolean $publication
     *
     * @ORM\Column(name="publication", type="boolean", nullable=true)
     */
    private $publication = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modification_date;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $image;

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
     * @var boolean $montrer_auteur
     *
     * @ORM\Column(name="montrer_auteur", type="boolean", nullable=true)
     */
    private $montrer_auteur = false;

    /**
     * @var integer $typeNumero
     *
     * @ORM\Column(name="typeNumero", type="integer")
     */
    private $typeNumero;

    /**
     * @var integer $matriceNumero
     *
     * @ORM\Column(name="matriceNumero", type="integer")
     */
    private $matriceNumero;

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

    public function __toString()
    {
        $eponyme = "";
        if ($this->getEponyme() != null) {
            $eponyme = $this->getEponyme()->getNom() . " / ";
        }

        $fabricant = "";
        if ($this->getFabricant() != null) {
            $fabricant = $this->getFabricant()->getNom();
        }

        return $eponyme . $fabricant . " - T" . $this->getTypeNumero() . " - M" . $this->getMatriceNumero();
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
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add images
     *
     * @param \NTE\AgathoklesBundle\Entity\FichesImages $images
     * @return Fiches
     */
    public function addImage(\NTE\AgathoklesBundle\Entity\FichesImages $images)
    {
        $images->setFiche($this); # pour la collection dans le formulaire
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
     * Set montrer_auteur
     *
     * @param boolean $montrerAuteur
     * @return Fiches
     */
    public function setMontrerAuteur($montrerAuteur)
    {
        $this->montrer_auteur = $montrerAuteur;

        return $this;
    }

    /**
     * Get montrer_auteur
     *
     * @return boolean
     */
    public function getMontrerAuteur()
    {
        return $this->montrer_auteur;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Fiches
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean
     */
    public function getPublication()
    {
        return $this->publication;
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
     * Set retrogravure
     *
     * @param boolean $retrogravure
     * @return Fiches
     */
    public function setRetrogravure($retrogravure)
    {
        $this->retrogravure = $retrogravure;

        return $this;
    }

    /**
     * Get retrogravure
     *
     * @return boolean
     */
    public function getRetrogravure()
    {
        return $this->retrogravure;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Fiches
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set referenceBibliographique
     *
     * @param string $referenceBibliographique
     * @return Fiches
     */
    public function setReferenceBibliographique($referenceBibliographique)
    {
        $this->referenceBibliographique = $referenceBibliographique;

        return $this;
    }

    /**
     * Get referenceBibliographique
     *
     * @return string
     */
    public function getReferenceBibliographique()
    {
        return $this->referenceBibliographique;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Fiches
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return Fiches
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
     * Set lieuDeDecouverte
     *
     * @param \NTE\AgathoklesBundle\Entity\Lieu $lieuDeDecouverte
     * @return Fiches
     */
    public function setLieuDeDecouverte(\NTE\AgathoklesBundle\Entity\Lieu $lieuDeDecouverte = null)
    {
        $this->lieuDeDecouverte = $lieuDeDecouverte;

        return $this;
    }

    /**
     * Get lieuDeDecouverte
     *
     * @return \NTE\AgathoklesBundle\Entity\Lieu
     */
    public function getLieuDeDecouverte()
    {
        return $this->lieuDeDecouverte;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return Fiches
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
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
     * Set autreLegende
     *
     * @param string $autreLegende
     * @return Fiches
     */
    public function setAutreLegende($autreLegende)
    {
        $this->autreLegende = $autreLegende;

        return $this;
    }

    /**
     * Get autreLegende
     *
     * @return string
     */
    public function getAutreLegende()
    {
        return $this->autreLegende;
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
     * Set ete
     *
     * @param boolean $ete
     * @return Fiches
     */
    public function setEte($ete)
    {
        $this->ete = $ete;

        return $this;
    }

    /**
     * Get ete
     *
     * @return boolean
     */
    public function getEte()
    {
        return $this->ete;
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
     * Set typeNumero
     *
     * @param integer $typeNumero
     * @return Fiches
     */
    public function setTypeNumero($typeNumero)
    {
        $this->typeNumero = $typeNumero;

        return $this;
    }

    /**
     * Get typeNumero
     *
     * @return integer
     */
    public function getTypeNumero()
    {
        return $this->typeNumero;
    }

    /**
     * Set matriceNumero
     *
     * @param integer $matriceNumero
     * @return Fiches
     */
    public function setMatriceNumero($matriceNumero)
    {
        $this->matriceNumero = $matriceNumero;

        return $this;
    }

    /**
     * Get matriceNumero
     *
     * @return integer
     */
    public function getMatriceNumero()
    {
        return $this->matriceNumero;
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
}
