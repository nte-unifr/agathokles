<?php

namespace NTE\AgathoklesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AgathoklesBundle\Entity\Fiches;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpFoundation\Request;
use NTE\AgathoklesBundle\Form\Filter\FichesFilterType;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Fiches controller.
 *
 * @Route("/timbres")
 */
class FichesController extends Controller
{
    const MAX_ITEMS_PER_PAGE = 12;

    /**
     * Lists all Fiches entities.
     *
     * @Route("/", name="timbres")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        # Used to display the active left menu and back from fiche view
        $request->getSession()->set('timbres_subset', "all");
        # Filter form
        $form = $this->get('form.factory')->create(new FichesFilterType());

        // initialize a query builder
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fiches', 'f')
            ->where('f.public = true')
            ->orderBy( 'f.designation', 'ASC' );

        // if filters have been set
        if ($this->get('request')->query->has($form->getName())) {
            // bind values from the request
            $form->submit($this->get('request')->query->get($form->getName()));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
        }

        // set the params in session to use in fiche view
        $request->getSession()->set('timbres_params', $request->query->all());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'subtitle'  => 'Tous les timbres amphoriques',
            'pager'     => $this->setPager($qb, self::MAX_ITEMS_PER_PAGE, $request),
            'all'       => $this->findAllCounted(),
            'form'      => $form->createView(),
        );
    }

    /**
     * Lists all Fiches entities that have eponymes.
     *
     * @Route("/eponymes", name="timbres_eponymes")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function eponymesAction(Request $request)
    {
        # Used to display the active left menu and back from fiche view
        $request->getSession()->set('timbres_subset', "epo");
        # Filter form
        $form = $this->get('form.factory')->create(new FichesFilterType());

        // initialize a query builder
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fiches', 'f')
            ->where('f.public = true')
            ->andWhere('f.eponyme is not NULL')
            ->orderBy( 'f.designation', 'ASC' );

        // if filters have been set
        if ($this->get('request')->query->has($form->getName())) {
            // bind values from the request
            $form->submit($this->get('request')->query->get($form->getName()));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
        }

        // set the params in session to use in fiche view
        $request->getSession()->set('timbres_params', $request->query->all());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'subtitle'  => 'Tous les timbres comportant un eponyme',
            'pager'     => $this->setPager($qb, self::MAX_ITEMS_PER_PAGE, $request),
            'all'       => $this->findAllCounted(),
            'form'      => $form->createView(),
        );
    }

    /**
     * Lists all Fiches entities that have fabricants.
     *
     * @Route("/fabricants", name="timbres_fabricants")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function fabricantsAction(Request $request)
    {
        # Used to display the active left menu and back from fiche view
        $request->getSession()->set('timbres_subset', "fab");
        # Filter form
        $form = $this->get('form.factory')->create(new FichesFilterType());

        // initialize a query builder
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fiches', 'f')
            ->where('f.public = true')
            ->andWhere('f.fabricant is not NULL')
            ->orderBy( 'f.designation', 'ASC' );

        // if filters have been set
        if ($this->get('request')->query->has($form->getName())) {
            // bind values from the request
            $form->submit($this->get('request')->query->get($form->getName()));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
        }

        // set the params in session to use in fiche view
        $request->getSession()->set('timbres_params', $request->query->all());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'subtitle'  => 'Tous les timbres comportant un fabricant',
            'pager'     => $this->setPager($qb, self::MAX_ITEMS_PER_PAGE, $request),
            'all'       => $this->findAllCounted(),
            'form'      => $form->createView(),
        );
    }

    /**
     * Lists all Fiches entities that have eponymes and fabricants.
     *
     * @Route("/binominaux", name="timbres_binominaux")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function binominauxAction(Request $request)
    {
        # Used to display the active left menu and back from fiche view
        $request->getSession()->set('timbres_subset', "bin");
        # Filter form
        $form = $this->get('form.factory')->create(new FichesFilterType());

        // initialize a query builder
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fiches', 'f')
            ->where('f.public = true')
            ->andWhere('f.eponyme is not NULL')
            ->andWhere('f.fabricant is not NULL')
            ->orderBy( 'f.designation', 'ASC' );

        // if filters have been set
        if ($this->get('request')->query->has($form->getName())) {
            // bind values from the request
            $form->submit($this->get('request')->query->get($form->getName()));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
        }

        // set the params in session to use in fiche view
        $request->getSession()->set('timbres_params', $request->query->all());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'subtitle'  => 'Tous les timbres comportant un eponyme et un fabricant',
            'pager'     => $this->setPager($qb, self::MAX_ITEMS_PER_PAGE, $request),
            'all'       => $this->findAllCounted(),
            'form'      => $form->createView(),
        );
    }

    /**
     * Lists all Fiches entities that are amphores.
     *
     * @Route("/amphores", name="timbres_amphores")
     * @Method("GET")
     * @Template("NTEAgathoklesBundle:Fiches:index.html.twig")
     */
    public function amphoresAction(Request $request)
    {
        # Used to display the active left menu and back from fiche view
        $request->getSession()->set('timbres_subset', "amp");
        # Filter form
        $form = $this->get('form.factory')->create(new FichesFilterType());
        # Array to stock the ids of fiches to display
        $allIds = array();

        $em = $this->getDoctrine()->getManager();
        $fichesRepository = $em->getRepository('NTEAgathoklesBundle:Fiches');

        $fichesPrincipales = $em->getRepository('NTEAgathoklesBundle:FichesPrincipales')->findAll();
        $fichesSecondaires = $em->getRepository('NTEAgathoklesBundle:FichesSecondaires')->findAll();
        $fichesComplementaires = $em->getRepository('NTEAgathoklesBundle:FichesComplementaires')->findAll();

        // Get all fiches from matrice principale (wrongly named fiche principale)
        foreach($fichesPrincipales as $fichePrincipale) {
            $ficheId = $fichePrincipale->getFiche();
            $fichePrincipaleId = $fichePrincipale->getFichePrincipale();

            // Add the fiches only if both are primary, category 1
            if($fichesRepository->find($ficheId)->isPrimary() && $fichesRepository->find($fichePrincipaleId)->isPrimary()) {
                $allIds[] = $ficheId;
                $allIds[] = $fichePrincipaleId;
            }
        }

        // Get all fiches from matrice secondaire (wrongly named fiche secondaire)
        foreach($fichesSecondaires as $ficheSecondaire) {
            $ficheId = $ficheSecondaire->getFiche();
            $ficheSecondaireId = $ficheSecondaire->getFicheSecondaire();

            // Add the fiches only if both are primary, category 1
            if($fichesRepository->find($ficheId)->isPrimary() && $fichesRepository->find($ficheSecondaireId)->isPrimary()) {
                $allIds[] = $ficheId;
                $allIds[] = $ficheSecondaireId;
            }
        }

        // Get all fiches from matrice complementaire (wrongly named fiche complementaire)
        foreach($fichesComplementaires as $ficheComplementaire) {
            $ficheId = $ficheComplementaire->getFiche();
            $ficheComplementaireId = $ficheComplementaire->getFicheComplementaire();

            // Add the fiches only if both are primary, category 1
            if($fichesRepository->find($ficheId)->isPrimary() && $fichesRepository->find($ficheComplementaireId)->isPrimary()) {
                $allIds[] = $ficheId;
                $allIds[] = $ficheComplementaireId;
            }
        }

        // Remove duplicates
        $uniqIds = array_unique($allIds);

        // initialize a query builder
        $qb = $em->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fiches', 'f')
            ->where('f.public = true')
            ->andWhere('f.id IN (:ids)')
            ->orderBy( 'f.designation', 'ASC' )
            ->setParameter('ids', $uniqIds);

        // if filters have been set
        if ($this->get('request')->query->has($form->getName())) {
            // bind values from the request
            $form->submit($this->get('request')->query->get($form->getName()));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
        }

        // set the params in session to use in fiche view
        $request->getSession()->set('timbres_params', $request->query->all());

        return array(
            'titre'     => 'Liste des timbres amphoriques',
            'subtitle'  => 'Tous les timbres prenant part aux associations de deux timbres principaux',
            'pager'     => $this->setPager($qb, self::MAX_ITEMS_PER_PAGE, $request),
            'all'       => $this->findAllCounted(),
            'form'      => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fiches entity.
     *
     * @Route("/{id}", name="timbre")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAgathoklesBundle:Fiches')->find($id);

        // if fiche is null or not public, 404
        if (!$entity or !$entity->getPublic()) {
            throw $this->createNotFoundException('Unable to find Fiches entity.');
        }

        return array(
            'titre'     => $entity->__toString(),
            'fiche'     => $entity,
        );
    }

    /**
     * Count all fiches
     *
     * @return int
     */
    public function findAllCounted()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->createQuery('SELECT COUNT(f.id) FROM NTEAgathoklesBundle:Fiches f WHERE f.public = true')
            ->getSingleScalarResult();
    }

    /**
     * Set the pager
     *
     */
    public function setPager($qb, $maxPerPage, $request)
    {
        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pagerfanta->setMaxPerPage($maxPerPage);

        $page = $request->get('page', 1);
        try {
			$pagerfanta->setCurrentPage($page);
		} catch(NotValidCurrentPageException $e) {
			throw new NotFoundHttpException();
		}

        return $pagerfanta;
    }
}
