<?php

namespace NTE\AgathoklesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AgathoklesBundle\Entity\Pages;

/**
 * Page controller.
 *
 * @Route("/page")
 */
class PagesController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->findOneByHandle( 'contact' );
        return $this->render('NTEAgathoklesBundle:Page:show.html.twig',
            array(
                'titre' => 'Contact',
                'page'  => $page,
            )
        );
    }

    /**
     * @Route("/faq", name="faq")
     * @Template()
     */
    public function faqAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->findOneByHandle( 'faq' );
        return $this->render('NTEAgathoklesBundle:Page:show.html.twig',
            array(
                'titre' => 'FAQ',
                'page'  => $page,
            )
        );
    }

    /**
     * @Route("/credits", name="credits")
     * @Template()
     */
    public function creditsAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->findOneByHandle( 'credits' );
        return $this->render('NTEAgathoklesBundle:Page:show.html.twig',
            array(
                'titre' => 'Crédits',
                'page'  => $page,
            )
        );
    }

    /**
     * @Route("/sources", name="sources")
     * @Template()
     */
    public function sourcesAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->findOneByHandle( 'sources' );
        return $this->render('NTEAgathoklesBundle:Page:show.html.twig',
            array(
                'titre' => 'Sources',
                'page'  => $page,
            )
        );
    }
}
