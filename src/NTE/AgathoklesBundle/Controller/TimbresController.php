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
 * @Route("/map")
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

        return array(
            'titre'     => 'Carte des timbres',
            'timbres'   => $timbres,
        );
    }

}
