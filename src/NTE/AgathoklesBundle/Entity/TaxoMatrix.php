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
}
