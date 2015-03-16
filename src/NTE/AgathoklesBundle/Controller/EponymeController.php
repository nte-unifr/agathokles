<?php

namespace NTE\AgathoklesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AgathoklesBundle\Entity\Eponyme;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Eponyme controller.
 *
 * @Route("/eponyme")
 */
class EponymeController extends Controller
{

    /**
     * Lists all Eponyme entities.
     *
     * @Route("/", name="eponyme")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAgathoklesBundle:Eponyme')->findAll();

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'entities'  => $entities,
        );
    }

    /**
     * Finds and displays a Eponyme entity.
     *
     * @Route("/{id}/{page}", name="eponyme_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id, $page = 1 )
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAgathoklesBundle:Eponyme')->find($id);

        $fiches = $em->getRepository('NTEAgathoklesBundle:Fiches')->findByEponyme($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eponyme entity.');
        }

        $session = $this->getRequest()->getSession();

        $pager = null;
        $max_page = 20;
        $ids = array();

        $em = $this->getDoctrine()->getManager();

        $resultat = true;
        $query = $em->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' )
                     ->where('f.eponyme = :id')
                        ->setParameter( 'id', $id )
                     ->orderBy( 'f.id', 'ASC' );

        $all_fiches = $query->select('f.id')->getQuery()->getArrayResult();

        $ids = array_map('current', $all_fiches);

        $query->select('f'); # pour avoir les objets, et pas seulement les id
        $query->setFirstResult( ($page - 1) * $max_page )
              ->setMaxResults( $max_page );
        $fiches = $query->getQuery()->getResult();
        $session->set('recherche', $ids);
        $session->set('derniere_recherche', 'liste');
        $data = array();

        # pager
        $adapter  = new DoctrineORMAdapter($query);
        $pager    = new PagerFanta($adapter);
        $pager->setMaxPerPage( $max_page );
        try {
            $pager->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'entity'    => $entity,
            'fiches'    => $fiches,
            'nb_fiches' => count($ids),
            'fiches'    => $fiches,
            'pager'     => $pager,
            'page'      => $page,
        );
    }
}
