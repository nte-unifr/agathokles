<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaxoType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TaxoType
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
     * @var TaxoRoot|null the taxoRoot this fiche belongs (if any)
     * @ORM\ManyToOne(targetEntity="TaxoRoot", inversedBy="taxoTypes")
     * @ORM\JoinColumn(name="taxoRoot_id", referencedColumnName="id")
     */
    private $taxoRoot;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="taxoSubtype", mappedBy="taxoType")
     */
    private $taxoSubtypes;


    public function preRemove()
    {
        $this->setTaxoRoot(null);
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
        $this->taxoSubtypes = new ArrayCollection();
    }

    public function __toString() {
        return "".$this->getRank();
    }

    /**
     * Sets a new fiche taxoRoot and cleans the previous one if set
     * @param null|TaxoRoot $taxoRoot
     */
    public function setTaxoRoot($taxoRoot) {
        if ($taxoRoot === null) {
            if ($this->taxoRoot !== null) {
                $this->taxoRoot->getTaxoTypes()->removeElement($this);
            }
            $this->taxoRoot = null;
        } else {
            if (!$taxoRoot instanceof TaxoRoot) {
                throw new InvalidArgumentException('$taxoRoot must be null or instance of TaxoRoot');
            }
            if ($this->taxoRoot !== null) {
                $this->taxoRoot->getTaxoTypes()->removeElement($this);
            }
            $this->taxoRoot = $taxoRoot;
            $taxoRoot->getTaxoTypes()->add($this);
        }
    }

    /**
     * @return TaxoRoot|null
     */
    public function getTaxoRoot() {
        return $this->taxoRoot;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return TaxoType
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
     * @return TaxoType
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
    public function getTaxoSubtypes() {
        return $this->taxoSubtypes;
    }
}
