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
        $status = array("all" => true, "epo" => false, "fab" => false, "bin" => false, "amp" => false);

        $em = $this->getDoctrine()->getManager();
        $fichesRepository = $em->getRepository('NTEAgathoklesBundle:Fiches');

        $fiches = $fichesRepository->findAll();
        $fichesQty = count($fiches);

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'fiches'    => $fiches,
            'fichesQty' => $fichesQty,
            'allQty'    => $fichesQty,
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
        $status = array("all" => false, "epo" => true, "fab" => false, "bin" => false, "amp" => false);

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
        $status = array("all" => false, "epo" => false, "fab" => true, "bin" => false, "amp" => false);

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
        $status = array("all" => false, "epo" => false, "fab" => false, "bin" => true, "amp" => false);

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
        $status = array("all" => false, "epo" => false, "fab" => false, "bin" => true, "amp" => false);

    }

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
