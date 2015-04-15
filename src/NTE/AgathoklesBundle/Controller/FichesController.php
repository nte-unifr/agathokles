<?php

namespace NTE\AgathoklesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AgathoklesBundle\Entity\Fiches;

/**
 * Fiches controller.
 *
 * @Route("/timbres")
 */
class FichesController extends Controller
{

    /**
     * Lists all Fiches entities.
     *
     * @Route("/", name="timbres")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        # Used to display the active left menu
        $status = "all";

        $em = $this->getDoctrine()->getManager();
        $fichesRepository = $em->getRepository('NTEAgathoklesBundle:Fiches');

        $fiches = $fichesRepository->findAll();
        $fichesQty = count($fiches);

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'fiches'    => $fiches,
            'fichesQty' => $fichesQty,
            'allQty'    => $fichesQty,
            'subtitle'  => 'Tous les timbres amphoriques',
            'status'    => $status,
        );
    }

    /**
     * Lists all Fiches entities that have eponymes.
     *
     * @Route("/eponymes", name="timbres_eponymes")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function eponymesAction()
    {
        # Used to display the active left menu
        $status = "epo";

        $em = $this->getDoctrine()->getManager();
        $fichesRepository = $em->getRepository('NTEAgathoklesBundle:Fiches');
        $criteria = new \Doctrine\Common\Collections\Criteria();

        $criteria->where($criteria->expr()->neq('eponyme', null));
        $fiches = $fichesRepository->matching($criteria);
        $fichesQty = count($fiches);
        $allQty = count($fichesRepository->findAll());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'fiches'    => $fiches,
            'fichesQty' => $fichesQty,
            'allQty'    => $allQty,
            'subtitle'  => 'Tous les timbres comportant un eponyme',
            'status'    => $status,
        );
    }

    /**
     * Lists all Fiches entities that have fabricants.
     *
     * @Route("/fabricants", name="timbres_fabricants")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function fabricantsAction()
    {
        # Used to display the active left menu
        $status = "fab";

        $em = $this->getDoctrine()->getManager();
        $fichesRepository = $em->getRepository('NTEAgathoklesBundle:Fiches');
        $criteria = new \Doctrine\Common\Collections\Criteria();

        $criteria->where($criteria->expr()->neq('fabricant', null));
        $fiches = $fichesRepository->matching($criteria);
        $fichesQty = count($fiches);
        $allQty = count($fichesRepository->findAll());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'fiches'    => $fiches,
            'fichesQty' => $fichesQty,
            'allQty'    => $allQty,
            'subtitle'  => 'Tous les timbres comportant un fabricant',
            'status'    => $status,
        );
    }

    /**
     * Lists all Fiches entities that have eponymes and fabricants.
     *
     * @Route("/binominaux", name="timbres_binominaux")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function binominauxAction()
    {
        # Used to display the active left menu
        $status = "bin";

        $em = $this->getDoctrine()->getManager();
        $fichesRepository = $em->getRepository('NTEAgathoklesBundle:Fiches');
        $criteria = new \Doctrine\Common\Collections\Criteria();

        $criteria->where($criteria->expr()->neq('eponyme', null));
        $criteria->andWhere($criteria->expr()->neq('fabricant', null));
        $fiches = $fichesRepository->matching($criteria);
        $fichesQty = count($fiches);
        $allQty = count($fichesRepository->findAll());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'fiches'    => $fiches,
            'fichesQty' => $fichesQty,
            'allQty'    => $allQty,
            'subtitle'  => 'Tous les timbres comportant un eponyme et un fabricant',
            'status'    => $status,
        );
    }

    /**
     * Lists all Fiches entities that are amphores.
     *
     * @Route("/amphores", name="timbres_amphores")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function amphoresAction()
    {

    }
        # Used to display the active left menu
        $status = "amp";

    /**
     * Lists epo and fab
     *
     * @Route("/list", name="list")
     * @Method("GET")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eponymes = $em->getRepository('NTEAgathoklesBundle:Eponyme')->findAll();

        $fabricants = $em->getRepository('NTEAgathoklesBundle:Fabricant')->findAll();

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'eponymes' => $eponymes,
            'fabricants' => $fabricants,
            'subtitle'  => 'Tous les timbres prenant part aux associations de deux timbres principaux',
        );
    }

    /**
     * Finds and displays a Fiches entity.
     *
     * @Route("/{id}", name="fiches_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAgathoklesBundle:Fiches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fiches entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
