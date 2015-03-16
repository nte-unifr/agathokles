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
 * @Route("/fiches")
 */
class FichesController extends Controller
{

    /**
     * Lists all Fiches entities.
     *
     * @Route("/", name="fiches")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
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
