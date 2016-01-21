<?php

namespace NTE\AgathoklesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
