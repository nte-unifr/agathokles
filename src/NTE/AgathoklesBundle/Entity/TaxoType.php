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
     * @var Collection
     * @ORM\OneToMany(targetEntity="taxoSubtype", mappedBy="taxoType")
     */
    private $taxoSubtypes;


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
