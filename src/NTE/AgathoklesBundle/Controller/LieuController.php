<?php

namespace NTE\AgathoklesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AgathoklesBundle\Entity\Lieu;

/**
 * Lieu controller.
 *
 * @Route("/lieu")
 */
class LieuController extends Controller
{

    /**
     * Finds and displays a Lieu entity.
     *
     * @Route("/{id}", name="lieu_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAgathoklesBundle:Lieu')->find($id);

        $query = $em->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' )
                     ->where('f.lieuDeDecouverte = :lieu_id')
                         ->setParameter( 'lieu_id',  $id )
                     ->orderBy( 'f.id', 'ASC' );
        $all_fiches = $query->select('f.id')->getQuery()->getArrayResult();
        $ids = array_map('current', $all_fiches);

        $session = $this->getRequest()->getSession();
        $session->set('recherche', $ids);
        $session->set('derniere_recherche', 'lieu');

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lieu entity.');
        }

        $titre = $entity->getNom();

        return array(
            'titre'     => $titre,
            'entity'      => $entity,
        );
    }
}
