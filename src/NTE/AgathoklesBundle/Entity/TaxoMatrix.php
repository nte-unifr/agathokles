<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaxoMatrix
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TaxoMatrix
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
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="TaxoSubtype")
     */
    private $taxoSubtype;


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
     * Set taxoSubtype
     *
     * @param \NTE\AgathoklesBundle\Entity\TaxoSubtype $taxoSubtype
     * @return TaxoMatrix
     */
    public function setTaxoSubtype(\NTE\AgathoklesBundle\Entity\TaxoSubtype $taxoSubtype = null)
    {
        $this->taxoSubtype = $taxoSubtype;

        return $this;
    }

    /**
     * Get taxoSubtype
     *
     * @return \NTE\AgathoklesBundle\Entity\TaxoSubtype
     */
    public function getTaxoSubtype()
    {
        return $this->taxoSubtype;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return TaxoMatrix
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
}
