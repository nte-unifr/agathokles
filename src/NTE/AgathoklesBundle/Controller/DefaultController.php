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

    /**
     * @Route("/recherche")
     */
    public function rechercheAction()
    {
        $fiche = new Fiches();
        $fiches = array();

        $form = $this->createForm( new SearchFiches(), $fiche );

        $request = $this->get( 'request' );

        $resultat = false;

        $session = $this->getRequest()->getSession();

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository( 'NTEAgathoklesBundle:Fiches' );

        if( $session->has('recherche') && 'POST' != $request->getMethod() ) {
            $form->bind($session->get('request'));
            $resultat = true;
            $query = $repository->createQueryBuilder( 'f' );

            if ( count($session->get('recherche')) > 0 ) {
                $query
                    ->where('f.id IN (:ids)')
                        ->setParameter( 'ids',$session->get('recherche') )
                    ->orderBy( 'f.id', 'DESC' );

                $fiches = $query->getQuery()->getResult();

                foreach($fiches as $fiche) {

                    $string = strip_tags($fiche->getCodeType());

                    $retval = $string;

                    $array = explode(" ", $string);

                    if (count($array) <= 20) {
                        $retval = $string;
                    } else {
                        array_splice($array, 20);
                        $retval = implode(" ", $array)." ...";
                    }
                    $fiche->setCodeType($retval);
                }
            }
        }


        if( 'POST' == $request->getMethod() ) {
            // On récupère le repository
            $repository = $this->getDoctrine()
                               ->getManager()
                               ->getRepository( 'NTEAgathoklesBundle:Fiches' );

            //le résultat posté doit être mappé sur l'entité sur lequel le formulaire est basé
            $form->bind($request);

            //de sorte que $data soit un Fiche
            $data = $form->getData();

            if ( $form->isValid() ) {
                $resultat = true;
                $query = $repository->createQueryBuilder( 'f' );

                $query
                    ->andWhere( 'f.public = true' );

                if ( $data->getCodeType() != '' ) {
                    // plusieurs mots clés
                    $keywords = explode(' ', $data->getCodeType());

                    $tmp = print_r(explode('AND', $data->getCodeType()), true);

                    $i = 1;
                    foreach($keywords as $keyword) {
                        $query
                            ->andWhere( 'f.codeType LIKE :codeType_'.$i.' OR f.legende LIKE :legende_'.$i
                                        .' OR f.autreLegende LIKE :autreLegende_'.$i.' OR f.lettreRetrograde LIKE :lettreRetrograde_'.$i
                                        .' OR f.lettreLunaire LIKE :lettreLunaire_'.$i.' OR f.epi LIKE :epi_'.$i
                                        .' OR f.numero LIKE :numero_'.$i.' OR f.referenceBibliographique LIKE :referenceBibliographique_'.$i
                                        .' OR f.date LIKE :date_'.$i.' OR f.remarques LIKE :remarques_'.$i )
                                ->setParameter('codeType_'.$i, '%'.$keyword.'%')
                                ->setParameter('legende_'.$i, '%'.$keyword.'%')
                                ->setParameter('autreLegende_'.$i, '%'.$keyword.'%')
                                ->setParameter('lettreRetrograde_'.$i, '%'.$keyword.'%')
                                ->setParameter('lettreLunaire_'.$i, '%'.$keyword.'%')
                                ->setParameter('epi_'.$i, '%'.$keyword.'%')
                                ->setParameter('numero_'.$i, '%'.$keyword.'%')
                                ->setParameter('referenceBibliographique_'.$i, '%'.$keyword.'%')
                                ->setParameter('date_'.$i, '%'.$keyword.'%')
                                ->setParameter('remarques_'.$i, '%'.$keyword.'%');
                        $i++;
                    }

                }

                if ( $data->getFabricant() != '' ) {
                    $query
                        ->andWhere( 'f.fabricant = :fabricant' )
                            ->setParameter( 'fabricant', $data->getFabricant() );
                }

                if ( $data->getForme() != '' ) {
                    $query
                        ->andWhere( 'f.forme = :forme' )
                            ->setParameter( 'forme', $data->getForme() );
                }

                if ( $data->getEponyme() != '' ) {
                    $query
                        ->andWhere( 'f.eponyme = :eponyme' )
                            ->setParameter( 'eponyme', $data->getEponyme() );
                }

                if ( $data->getMois() != '' ) {
                    $query
                        ->andWhere( 'f.mois = :mois' )
                            ->setParameter( 'mois', $data->getMois() );
                }

                if ( $data->getEmbleme() != '' ) {
                    $query
                        ->andWhere( 'f.embleme = :embleme' )
                            ->setParameter( 'embleme', $data->getEmbleme() );
                }

                if ( $data->getLieuDeDecouverte() != '' ) {
                    // plusieurs mots clés
                    $keywords_lieu = explode(' ', $data->getLieuDeDecouverte());
                    $i = 1;
                    foreach($keywords_region as $keyword) {
                        $query
                            ->andWhere( 'f.lieu LIKE :lieu_'.$i )
                                ->setParameter('lieu_'.$i, '%'.$keyword.'%');
                        $i++;
                    }
                }

                if ( $data->getId() != '' ) {
                    $query
                        ->andWhere( 'f.id = :id' )
                            ->setParameter('id', $data->getId());
                }

                $query
                    ->orderBy( 'f.id', 'ASC' );

                $fiches = $query->getQuery()->getResult();
                $ids = array();
#                $ids = "";

                foreach($fiches as $fiche) {

                    $string = strip_tags($fiche->getId());

                    $retval = $string;

                    $array = explode(" ", $string);

                    if (count($array) <= 20) {
                        $retval = $string;
                    } else {
                        array_splice($array, 20);
                        $retval = implode(" ", $array)." ...";
                    }
                    $fiche->setId($retval);

                    array_push($ids, $fiche->getId());
#                    $ids .= $fiche->getId().", ";
                }

                // pour la navigation dans les recherches
                $session->set('recherche', $ids);
                $session->set('request', $request);
                $session->set('derniere_recherche', 'normale');
#                $session->set('rechercheavancee_ids', null);
#                $session->set('rechercheavancee_data', null);
#                $session->set('request_avancee', null);
            }
        }

        // pour afficher le nombre total de fiches publiques
        $nb_fiches = count($repository->createQueryBuilder('f')
                               ->where('f.public = 1')
                               ->getQuery()->getResult());

        return $this->render( 'NTEAgathoklesBundle:Fiches:recherche_form.html.twig', array(
            'titre' => 'Effectuer une recherche',
            'form' => $form->createView(),
            'resultat' => $resultat,
            'fiches' => $fiches,
            'nb_fiches' => $nb_fiches,
            'nav_type' => 'n',
        ));
    }

    /**
     * @Route("/fiche/liste/{page}")
     * @Template()
     */
    public function ficheListeAction( $page = 1 )
    {
        $session = $this->getRequest()->getSession();

        $pager = null;
        $max_page = 20;
        $ids = array();

        $em = $this->getDoctrine()->getManager();

        $resultat = true;
        $query = $em->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' )
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

        return array('titre'     => 'Liste des timbres amphoriques',
                     'nb_fiches' => count($ids),
                     'fiches'    => $fiches,
                     'pager'     => $pager,
                     'page'      => $page);
    }

    /**
     * @Route("/fiche/{id}")
     * @Template()
     */
    public function ficheAction( Fiches $fiche, Request $request )
    {
        $prev = false;
        $next = false;
        $recherche = false;

        if($fiche->getPublic() !== true) {
            throw $this->createNotFoundException('Cette fiche n\'est pas publique !');
        }

        $orm = $this->getDoctrine()
                        ->getManager();

        //On récupère les fiches similaires.
        $query = $orm->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' )
                        ->where('1 = 1');

        if ( $fiche->getCategorie() != null ) {
            $query
                ->andWhere( 'f.categorie = :cat' )
                    ->setParameter( 'cat',  $fiche->getCategorie()->getId() );
        }
        $query
            ->andWhere( 'f.public = true' )
            ->andWhere( 'f.id != :id' )
                ->setParameter( 'id',  $fiche->getId() )
            ->setMaxResults(25);

        $similaires = $query->getQuery()->getResult();

        // navigation dans la recherche
        $fiches_recherche = null;
        $session = $this->getRequest()->getSession();

        if ( $session->has('recherche') || $session->has('rechercheavancee_ids') || 'liste' == $request->get('form')) {
            if ( 'a' == $request->get('form') ) {
                $recherche = $session->get('rechercheavancee_ids');
            } else {
                $recherche = $session->get('recherche');
            }

            if ( !empty($recherche) ) {

                $index = array_search($fiche->getId(), $recherche);
                $prev = $index > 0 ? $recherche[$index - 1] : false;
                $next = $index < count($recherche)-1 ? $recherche[$index + 1] : false;

                // carousel recherche
                $repository = $this->getDoctrine()
                                   ->getManager()
                                   ->getRepository( 'NTEAgathoklesBundle:Fiches' );
                $query = $repository->createQueryBuilder( 'f' );

                $query
                    ->where('f.id IN (:ids)')
                        ->setParameter( 'ids', $session->get('recherche') )
                    ->orderBy( 'f.id', 'DESC' )
                    ->setMaxResults(25);

                $fiches_recherche = $query->getQuery()->getResult();
            }

            if ('liste' == $request->get('form')) {

            }
        }

        $emailform = $this->createFormBuilder()
            ->add('email', 'email')
            ->add('message2', 'textarea', array('attr' => array('style' => 'display: none;')))
            ->add('envoyer', 'submit')
            ->getForm();

        $emailform->handleRequest($request);
        $alert = false;
        if( 'POST' == $request->getMethod() ) {
            if ($emailform->isValid()) {
                $data = $emailform->getData();
                $titles = json_decode($data['message2'], true);
                unset($titles['__jstorage_meta']); // entrée de jStorage

                $content = $this->renderView('NTEAgathoklesBundle:Default:email.html.twig', array('titles' => $titles));

                $message = \Swift_Message::newInstance()
                    ->setSubject('Sélection de fiches Agathokles')
                    ->setFrom($data['email'])
                    ->setTo($data['email']);

#                // on remplace les images hébergées par une version embarquée
#                foreach ($titles as $title) {
##                    $embed = $message->embed(\Swift_Image::fromPath($title['image']));
##                    $content = str_replace($title['image'], $message->embed(\Swift_Image::fromPath($title['image'])), $content);
#                    // retrouver le chemin local à partir de l'URL de l'image
#                    $image = explode('agathokles/', $title['image']);
#                    $path = explode("src/NTE/AgathoklesBundle/Controller",__DIR__);
#                    $embed = $message->embed(\Swift_Image::fromPath($path[0].$image[1]));
#                    $content = str_replace($title['image'], $message->embed(\Swift_Image::fromPath($path[0].$image[1])), $content);
#                }

                $message
                    ->addPart($content, 'text/html')
                ;

                $this->get('mailer')->send($message);
                $alert = 'L\'e-mail a été envoyé à '. $data['email'].'.';
            }
        }

        return array(
            'titre' => $fiche->getCodeType(),
            'fiche' => $fiche,
            'similaires' => $similaires,
            'c' => count($fiche->getfichesassociees()),
            'prev' => $prev,
            'next' => $next,
            'recherche' => $recherche,
            'recherche_from' => $request->query->get('from'),
            'fiches_recherche' => $fiches_recherche,
            'emailform'  => $emailform->createView(),
            'alert' => $alert,
            'derniere_recherche' => $session->get('derniere_recherche'),
            'nav_type' => $request->get('form'),
            'page' => $request->get('page'),
        );
    }

    /**
     * @Route("/allfiches")
     * @Template()
     */
    public function allFicheAction()
    {
        $output = '';

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' )
                     ->orderBy( 'f.id', 'ASC' );
        $fiches = $query->getQuery()->getResult();

        foreach( $fiches as $fiche ) {
            $output .= $fiche->getId() . ', titre : ' . $fiche->getCodeType() . '<br />';
        }

        $response = new Response('<html><body><h1>Importation données CSV : </h1>'.$output.'</body></html>');

        $response->setMaxAge(60);
        $response->setSharedMaxAge(60);

        return $response;
    }

    /**
     * @Route("/print_panier", name="print_panier")
     * @Template()
     */
    public function printpanierAction( Request $request )
    {
        $titles = "";
        if( 'POST' == $request->getMethod() ) {
            $data = $request->request->all();
            $titles = json_decode($data['form']['message'], true);
            unset($titles['__jstorage_meta']); // entrée de jStorage
            return $this->render(
                'NTEAgathoklesBundle:Default:printpanier.html.twig',
                array('titre' => 'Imprimer le panier',
                      'titles' => $titles)
            );
        }
        return array(
            'titre' => 'Imprimer le panier',
            'titles' => $titles,
        );
    }

    /**
     * @Route("/print/{id}")
     * @Template()
     */
    public function printAction( Fiches $fiche )
    {


        if($fiche->getPublic() !== true) {
            throw $this->createNotFoundException('Cette fiche n\'est pas publique !');
        }

        $orm = $this->getDoctrine()
                        ->getManager();

        //On récupère les fiches similaires.
        $query = $orm->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' );

        $query
            ->where( 'f.categorie = :cat' )
                ->setParameter( 'cat',  $fiche->getCategorie()->getId() )
            ->andWhere( 'f.public = true' )
            ->andWhere( 'f.id != :id' )
                ->setParameter( 'id',  $fiche->getId() );

        $similaires = $query->getQuery()->getResult();

        return array(
            'titre' => $fiche->getCodeType(),
            'fiche' => $fiche,
            'similaires' => $similaires,
            'c' => count($fiche->getfichesassociees()),
        );
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->find( '3' );
        return $this->render('NTEAgathoklesBundle:Default:page.html.twig',
            array(
                'titre' => 'Contact',
                'page'  => $page,
            )
        );
    }

    /**
     * @Route("/faq")
     * @Template()
     */
    public function faqAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->find( '2' );
        return $this->render('NTEAgathoklesBundle:Default:page.html.twig',
            array(
                'titre' => 'FAQ',
                'page'  => $page,
            )
        );
    }

    /**
     * @Route("/credits")
     * @Template()
     */
    public function creditsAction()
    {
        $page = $this->getDoctrine()
                        ->getManager()->getRepository( 'NTEAgathoklesBundle:Pages' )->find( '4' );
        return $this->render('NTEAgathoklesBundle:Default:page.html.twig',
            array(
                'titre' => 'Crédits',
                'page'  => $page,
            )
        );
    }



    /**
     * @Route("/email")
     * @Template()
     */
    public function emailAction()
    {
        $defaultData = array('email' => 'Entrez l\'adresse e-mail du destinataire.');
        $emailform = $this->createFormBuilder($defaultData)
            ->add('email', 'email')
            ->add('message', 'textarea')
            ->getForm();

        $emailform->handleRequest($request);

        if ($emailform->isValid()) {
            $data = $form->getData();
        }

        return array(
            'titre' => 'Formulaire d\'envoi',
            'form'  => $emailform->createView()
        );
    }

    /**
     * @Route("/panier")
     * @Template()
     */
    public function panierAction()
    {
        return $this->render('NTEAgathoklesBundle:Default:panier.html.twig',
            array(
                'titre' => 'Panier',
            )
        );
    }


//*********************** Recherche avancée *********************************//
    /**
     * @Route("/rechercheavancee", name="rechercheavancee")
     */
    public function advancedSearchAction()
    {
        $session = $this->getRequest()->getSession();

        $fiche = new Fiches();
        $fiches = array();

        $form = $this->createForm( new AdvancedSearchFiches(), $fiche );
        $request = $this->get( 'request' );

        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Categorie')
            ->findBy(array(), array('numero' => 'asc'));

        $fabricants = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Fabricant')
            ->findBy(array(), array('nom' => 'asc'));

        $lieux = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Lieu')
            ->findBy(array(), array('nom' => 'asc'));

        $emblemes = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Embleme')
            ->findBy(array(), array('nom' => 'asc'));

        $eponymes = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Eponyme')
            ->findBy(array(), array('nom' => 'asc'));

        $mois = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Mois')
            ->findBy(array(), array('numero' => 'asc'));

        $formes = $this->getDoctrine()
            ->getManager()
            ->getRepository('NTEAgathoklesBundle:Forme')
            ->findBy(array(), array('nom' => 'asc'));

        $session = $this->getRequest()->getSession();
        $request = $this->get( 'request' );

        // On récupère le repository
        $repository = $this->getDoctrine()->getManager()->getRepository( 'NTEAgathoklesBundle:Fiches' );

        if( $session->has('rechercheavancee_ids') && 'POST' != $request->getMethod() ) {
            $form->bind($session->get('request_avancee'));
            $resultat = true;
            $query = $repository->createQueryBuilder( 'f' );

            if ( count($session->get('rechercheavancee_ids')) > 0 ) {
                $query
                    ->where('f.id IN (:ids)')
                        ->setParameter( 'ids',$session->get('rechercheavancee_ids') )
                    ->andWhere( 'f.public = true' )
                    ->orderBy( 'f.id', 'DESC' );

                $fiches = $query->getQuery()->getResult();
            }
        }

        if( 'POST' == $request->getMethod() ) {

            //le résultat posté doit être mappé sur l'entité sur lequel le formulaire est basé
            $form->bind($request);

            $qb = $repository->createQueryBuilder('f');

            // $qb->setMaxResults(25);

            $data = array();

            /*
            à partir de _POST, on créé un tableau comme ceci :
            Array (
                [0] => Array
                        [field] => fiche
                        [value] => "AS329B2"

                [1] => Array
                        [field] => logic
                        [value] => "Ou"

                [2] => Array
                        [field] => categorie2
                        [value] => "lalala"

                [3] => Array
                        [field] => logic
                        [value] => "Et"

                [4] => Array
                        [field] => "monument"
                        [value] => "UNIVERSITÉ"
                ...
            */
                foreach($_POST as $field => $value) {
                    $field = substr($field, 0, strpos($field, '_'));
                    if(!empty($field) && !empty($value)) {
                        $data[] = array('field' => $field, 'value' => $value);
                    }
                }
#            print_r('<pre>');
#            print_r($data);
#            print_r('</pre>');

            $qb->andWhere( 'f.public = true' );

            /*
            1. Si c'est pas un champ de logique, on construit le SQL nécessaire
            2. On choisit la logique à appliquer
            */
            for($i = 0; $i < count($data); $i++) {
                $field = $data[$i]['field'];
                $value = $data[$i]['value'];

                if($i === 0) {
                    $logic_to_apply = "Et";
                } else {
                    $logic_to_apply = $data[$i-1]['value'];
                }

                switch($field) {
                    case 'logic':
                        continue;
                        break;
                    case 'categorie':
                    case 'fabricant':
                    case 'lieuDeDecouverte':
                    case 'embleme':
                    case 'eponyme':
                    case 'mois':
                    case 'forme':
                    case 'id':
                        if ( 'Sauf' === $logic_to_apply) {
                            $op = '!=';
                        } else {
                            $op = '=';
                        }
                        break;
                    default:
                        if ( 'Sauf' === $logic_to_apply) {
                            $op = 'NOT LIKE';
                        } else {
                            $op = 'LIKE';
                        }
                        $value = '%'.$value.'%';
                        break;
                }

                $field = 'f.'.$field;
                switch($logic_to_apply) {
                    case 'Ou':
                        $qb->orWhere($field.' '.$op.' :value_'.$i)
                            ->setParameter('value_'.$i, $value);
                        break;
                    case 'Et':
                        $qb->andWhere($field.' '.$op.' :value_'.$i)
                            ->setParameter('value_'.$i, $value);
                        break;
                    case 'Sauf':
                        $qb->andWhere($field.' '.$op.' :value_'.$i)
                            ->setParameter('value_'.$i, $value);
                        break;
                }

            }

            $qb->orderBy( 'f.id', 'DESC' );

#            $query = $qb->getDql();
#            print_r($query);

            $fiches = $qb->getQuery()->getResult();
            $ids = array();

            foreach($fiches as $fiche) {
                array_push($ids, $fiche->getId());
            }

            // pour la mémoriation de la recherche avancée
#            $session->set('recherche', null);
#            $session->set('request', null);
            $session->set('request_avancee', $request);
            $session->set('rechercheavancee_ids', $ids);
            $session->set('rechercheavancee_data', $data);
            $session->set('derniere_recherche', 'avancee');
        }

        return $this->render( 'NTEAgathoklesBundle:Default:rechercheavancee.html.twig', array(
            'titre' => 'Effectuer une recherche',
            'form' => $form->createView(),
            'categories' => $categories,
            'fabricants' => $fabricants,
            'lieux' => $lieux,
            'emblemes' => $emblemes,
            'eponymes' => $eponymes,
            'mois' => $mois,
            'formes' => $formes,
            'rechercheavancee_data' => $session->get('rechercheavancee_data'),
            'fiches' => $fiches,
            'nav_type' => 'a',
            ));
    }
//*********************** Recherche avancée *********************************//





    /**
     * @Route("/effacer_requete", name="effacer_requete")
     * @Template()
     */
    public function effacerRequeteAction()
    {
        $session = $this->getRequest()->getSession();
            // pour la mémoriation de la recherche avancée
            $session->set('recherche', null);
            $session->set('request', null);
            return $this->rechercheAction();
    }



//     /**
//      * Migration des ACLs !
//      * @Route("/test")
//      * @Template()
//      */
//     public function testAction()
//     {
//         // php app/console init:acl
//         // php app/console sonata:admin:setup-acl

//         $aclProvider = $this->container->get('security.acl.provider');
//         $securityContext = $this->container->get('security.context');


//         //We allow members of ROLE_ADMIN to be OWNERS of any object of the following classes :
//         $admin_permissions_on = array('\Fiches', '\Materiau', '\Periode', '\Categorie', '\User');

//         foreach($admin_permissions_on as $class) {
//             $sid = new RoleSecurityIdentity('ROLE_ADMIN');

//             $objectIdentity = new ObjectIdentity('class', 'NTE\AgathoklesBundle\Entity'.$class);
//             $acl = $aclProvider->createAcl($objectIdentity); //used for creation

//             $acl->insertClassAce($sid, MaskBuilder::MASK_OWNER);

//             $aclProvider->updateAcl($acl);
//         }
//         //End allow admins


//         // And then we set every Fiche to its respective OWNER user
//         $orm = $this->getDoctrine()
//                         ->getManager();

//         //on récupère tous les Users
//         $users = $orm->getRepository( 'NTEAgathoklesBundle:User' )->findAll();

//         $i = 0;
//         $outa = array();

//         foreach($users as $user) {
//             if(!is_object($user)) continue;
//             $out = array();
//             //On récupère les fiches de cet auteur
//             $query = $orm->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' );

//             $query
//                 ->where( 'f.auteur = :auteurid' )
//                     ->setParameter(':auteurid', $user->getId())
//                     ;

//             $fiches = $query->getQuery()->getResult();


//             $aclProvider = $this->container->get('security.acl.provider');

//             $securityContext = $this->container->get('security.context');
//             //$thisuser = $securityContext->getToken()->getUser();
//             $securityIdentity = UserSecurityIdentity::fromAccount($user);
//             $out['txt'] = $securityIdentity." has now : \n";
//             foreach($fiches as $fiche) {
//                 $objectIdentity = ObjectIdentity::fromDomainObject($fiche);
//                 $acl = $aclProvider->createAcl($objectIdentity); //used for creation

//                 $out['txt'] = $objectIdentity."\tMask:\t".(MaskBuilder::MASK_OWNER)."\t\n";
//                 //$out['o'][] = $acl->getClassAces();
//                 //add ACL owner to owner to fiche
//                 $acl->insertObjectAce($securityIdentity, (MaskBuilder::MASK_OWNER));
//                 $aclProvider->updateAcl($acl);
//             }
//             $outa[$i++] = $out;
//         }

//         return array(
//             'titre' => 'Test',
//             'out' => $out
//             );
//     }
// }

//     public function testAction()
//     {
//         // creating the ACL
//         $orm = $this->getDoctrine()
//                         ->getManager();

//         //on récupère tous les Users
//         $users = $orm->getRepository( 'NTEAgathoklesBundle:User' )->findAll();

//         $i = 0;
//         $outa = array();

//         foreach($users as $user) {
//             if(!is_object($user)) continue;
//             $out = array();
//             //On récupère les fiches de cet auteur
//             $query = $orm->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' );

//             $query
//                 ->where( 'f.auteur = :auteurid' )
//                     ->setParameter(':auteurid', $user->getId())
//                     ;

//             $fiches = $query->getQuery()->getResult();


//             $aclProvider = $this->container->get('security.acl.provider');

//             $securityContext = $this->container->get('security.context');
//             //$thisuser = $securityContext->getToken()->getUser();
//             $securityIdentity = UserSecurityIdentity::fromAccount($user);
//             $out['txt'] = $securityIdentity." has now : \n";
//             foreach($fiches as $fiche) {
//                 $objectIdentity = ObjectIdentity::fromDomainObject($fiche);
//                 $acl = $aclProvider->createAcl($objectIdentity); //used for creation

//                 $out['txt'] = $objectIdentity."\tMask:\t".(MaskBuilder::MASK_OWNER)."\t\n";
//                 //$out['o'][] = $acl->getClassAces();
//                 //add ACL owner to owner to fiche
//                 $acl->insertObjectAce($securityIdentity, (MaskBuilder::MASK_OWNER));
//                 $aclProvider->updateAcl($acl);
//             }
//             $outa[$i++] = $out;
//         }

//         return array(
//             'titre' => 'Test',
//             'out' => $outa
//             );
//     }
//
//     public function testAction()
//     {
//         // creating the ACL
//         $orm = $this->getDoctrine()
//                         ->getManager();

//         //on récupère tous les Users
//         $users = $orm->getRepository( 'NTEAgathoklesBundle:User' )->findAll();

//         $i = 0;
//         $outa = array();

//         foreach($users as $user) {
//             if(!is_object($user)) continue;
//             $out = array();
//             //On récupère les fiches de cet auteur
//             $query = $orm->getRepository( 'NTEAgathoklesBundle:Fiches' )->createQueryBuilder( 'f' );

//             $query
//                 ->where( 'f.auteur = :auteurid' )
//                     ->setParameter(':auteurid', $user->getId())
//                     ;

//             $fiches = $query->getQuery()->getResult();


//             $aclProvider = $this->container->get('security.acl.provider');

//             $securityContext = $this->container->get('security.context');
//             //$thisuser = $securityContext->getToken()->getUser();
//             $securityIdentity = UserSecurityIdentity::fromAccount($user);
//             $out['txt'] = $securityIdentity." has now : \n";
//             foreach($fiches as $fiche) {
//                 $objectIdentity = ObjectIdentity::fromDomainObject($fiche);
//                 $acl = $aclProvider->createAcl($objectIdentity); //used for ObjectField

//                 //ACL should deny to owner fiche.public modification, so only give VIEW, LIST
//                 $builder = new MaskBuilder();
//                 $builder
//                     ->add('EDIT')
//                 ;

//                 $mask = $builder->get(); // int(29)
//                 $out['txt'] = $objectIdentity."\tMask:\t".($mask)."\t\n";
//                 $acl->insertObjectFieldAce('public', $securityIdentity, MaskBuilder::MASK_OWNER);
//                 //$acl->updateObjectFieldAce(0, 'public', $mask);
//                 $aclProvider->updateAcl($acl);
//             }
//             $outa[$i++] = $out;
//         }

//         return array(
//             'titre' => 'Test',
//             'out' => $outa
//             );
//     }
// }
/*
SELECT *, ace.mask as acemask
FROM            `acl_entries` as ace
    INNER JOIN      `acl_object_identities` as oi
    ON              ace.object_identity_id = oi.id
    INNER JOIN      `acl_classes` as c
    ON              c.id = oi.class_id
    INNER JOIN      `acl_security_identities` as si
    ON              si.id = ace.security_identity_id
WHERE           oi.`object_identifier` = 293 OR oi.`object_identifier` = 205
*/
}
