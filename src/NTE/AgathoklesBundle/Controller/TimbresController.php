<?php

namespace NTE\AgathoklesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AgathoklesBundle\Entity\Lieu;

/**
 * Timbres controller.
 *
 * @Route("/")
 */
class TimbresController extends Controller
{
    /**
     * Display all timbres on a map.
     *
     * @Route("/", name="map")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        // initialize a query builder
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('t')
            ->from('NTEAgathoklesBundle:Timbre', 't')
            ->orderBy( 't.id', 'ASC' );
        $timbres = $qb->getQuery()->getResult();

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fabricant', 'f')
            ->orderBy('f.nom', 'ASC');
        $fabricants = $qb->getQuery()->getResult();

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('e')
            ->from('NTEAgathoklesBundle:Eponyme', 'e')
            ->orderBy('e.nom', 'ASC');
        $eponymes = $qb->getQuery()->getResult();

        return array(
            'titre'         => 'Carte des timbres',
            'timbres'       => $timbres,
            'fabricants'    => $fabricants,
            'eponymes'      => $eponymes
        );
    }

}
