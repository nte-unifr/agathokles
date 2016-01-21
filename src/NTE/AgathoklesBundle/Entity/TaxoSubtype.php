<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="TaxoType")
     */
    private $taxoType;


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
     * Set taxoType
     *
     * @param \NTE\AgathoklesBundle\Entity\TaxoType $taxoType
     * @return TaxoSubtype
     */
    public function setTaxoType(\NTE\AgathoklesBundle\Entity\TaxoType $taxoType = null)
    {
        $this->taxoType = $taxoType;

        return $this;
    }

    /**
     * Get taxoType
     *
     * @return \NTE\AgathoklesBundle\Entity\TaxoType 
     */
    public function getTaxoType()
    {
        return $this->taxoType;
    }
}
