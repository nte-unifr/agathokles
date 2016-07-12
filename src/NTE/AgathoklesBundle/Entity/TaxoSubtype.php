<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaxoSubtype
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TaxoSubtype
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
     * @ORM\Column(name="thash", type="string", nullable=false)
     */
    private $hash;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank = 0;

    /**
     * @var TaxoType|null the taxoType this fiche belongs (if any)
     * @ORM\ManyToOne(targetEntity="TaxoType", inversedBy="taxoSubtypes")
     * @ORM\JoinColumn(name="taxoType_id", referencedColumnName="id")
     */
    private $taxoType;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Fiches", mappedBy="taxoSubtype")
     */
    private $fiches;


    public function preRemove()
    {
        $this->setTaxoType(null);
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
     *
     */
    public function __construct() {
        $this->fiches = new ArrayCollection();
    }

    public function __toString() {
        return "".$this->getRank();
    }

    /**
     * Sets a new fiche taxoType and cleans the previous one if set
     * @param null|TaxoType $taxoType
     */
    public function setTaxoType($taxoType) {
        if($taxoType === null) {
            if($this->taxoType !== null) {
                $this->taxoType->getTaxoSubtypes()->removeElement($this);
            }
            $this->taxoType = null;
        } else {
            if(!$taxoType instanceof TaxoType) {
                throw new InvalidArgumentException('$taxoType must be null or instance of TaxoType');
            }
            if($this->taxoType !== null) {
                $this->taxoType->getTaxoSubtypes()->removeElement($this);
            }
            $this->taxoType = $taxoType;
            $taxoType->getTaxoSubtypes()->add($this);
        }
    }

    /**
     * @return TaxoType|null
     */
    public function getTaxoType() {
        return $this->taxoType;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return TaxoSubtype
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return TaxoSubtype
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
     * @return Collection
     */
    public function getFiches() {
        return $this->fiches;
    }
}
