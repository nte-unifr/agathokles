<?php

namespace NTE\AgathoklesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
//use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Sonata\AdminBundle\Security\Acl\Permission\MaskBuilder;

use NTE\AgathoklesBundle\Entity\Fiches;
use NTE\AgathoklesBundle\Form\SearchFiches;
use NTE\AgathoklesBundle\Form\AdvancedSearchFiches;

use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lieux = $em->getRepository( 'NTEAgathoklesBundle:Lieu' )->createQueryBuilder('l')
                    ->getQuery()->getResult();

        $nb_fiches = count($em->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder('f')
                              ->where('f.public = 1')
                              ->getQuery()->getResult());

        $page = $em->getRepository( 'NTEAgathoklesBundle:Pages' )->find( '1' );

        return array('titre'     => 'Page d\'accueil',
                     'nb_fiches' => $nb_fiches,
                     'lieux'     => $lieux,
                     'page'      => $page);
    }
}
