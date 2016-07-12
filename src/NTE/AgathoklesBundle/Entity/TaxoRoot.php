<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaxoRoot
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TaxoRoot
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
     * @var Collection
     * @ORM\OneToMany(targetEntity="taxoType", mappedBy="taxoRoot")
     */
    private $taxoTypes;


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
        $this->taxoTypes = new ArrayCollection();
    }

    public function __toString() {
        return "".$this->getRank();
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return TaxoRoot
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
     * @return Collection
     */
    public function getTaxoTypes() {
        return $this->taxoTypes;
    }
}
