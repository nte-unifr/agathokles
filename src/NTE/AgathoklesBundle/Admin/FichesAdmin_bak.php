<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\AdminBundle\Route\RouteCollection;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

//In order to use service for prePersist and preUpdate
use Symfony\Component\DependencyInjection\ContainerInterface;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\Fiches;
use NTE\AgathoklesBundle\Entity\Verrou as Verrou;

class FichesAdmin extends Admin
{

    protected $securityContext;

    public function __construct($code, $class, $baseControllerName, ContainerInterface $container)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->container = $container;
    }


    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit2':

                $id = $this->request->get('id');
                $user = (string)$this->container->get('security.context')->getToken()->getUser()->getUsername();
                $now = new \DateTime('now');
                $then = new \DateTime('+600 seconds');

                // définit et récupère des attributs de session
                $session = $this->request->getSession();
                $em = $this->container->get('doctrine.orm.entity_manager');
                $verrous = $em->getRepository('NTEAgathoklesBundle:Verrou')->findBy(array('objet' => 'taxon', 'objet_id' => $id));

                $lock = false;
                foreach($verrous as $verrou) {
                    if (($verrou->getEcheance() > $now) && ($verrou->getUtilisateur() != $user)) {
#                        $session->getFlashBag()->add('sonata_flash_error', 'ATTENTION!!! Cet enregistrement a été édité par une autre personne il y a moins de 10 minutes!');
                        return 'NTEAgathoklesBundle::lock.html.twig';
                        break;
                    }
                    // nettoyage des vieux verrous
                    if(($verrou->getEcheance() < $now)){
                        $em->remove($verrou);
                    }
                }
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
                ->add('id')
            ->end()
            ->with('Contenu')
                ->add('titre')
                ->add('public')
                ->add('publication')
                ->add('description')
                ->add('datefrom')
                ->add('dateto')
                ->add('dimensions')
                ->add('provenance')
                ->add('region', null, array('label' => 'Lieu de conservation'))
                ->add('source')
                ->add('bibliographie')
                ->add('image', null, array('template' => 'NTEAgathoklesBundle::media.html.twig'))
                ->add('images', null, array('label' => 'Images annexes', 'template' => 'NTEAgathoklesBundle::media_many.html.twig'))
            ->end()
            ->with('Critères')
                ->add('materiau')
                ->add('categorie')
                ->add('periode')
            ->end()
            ->with('Autres')
                ->add('auteur')
                ->add('editeur')
                ->add('creation_date')
                ->add('modification_date')
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $id = $this->request->get('id');
        $lock = false;
        $restriction = false;

        $em = $this->container->get('doctrine.orm.entity_manager');

        // définit et récupère des attributs de session
        $session = $this->request->getSession();

        // on test si on est pas dans un 'create'
        if ($id) {
            $record = $em->getRepository('NTEAgathoklesBundle:Fiches')->find($id);
            // test sécurité si pas rôle admin
            if ( !($this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN')
                ||
                $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR'))
                && $record->getAuteur()->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
                ) {
                    $restriction = true;
            }

            if ( !$restriction ) {
#                $user = (string)$this->container->get('security.context')->getToken()->getUser()->getUsername();
$user= "";
                $now = new \DateTime('now');
                $then = new \DateTime('+600 seconds');

                $verrous = $em->getRepository('NTEAgathoklesBundle:Verrou')->findBy(array('objet' => 'taxon', 'objet_id' => $id));

                foreach($verrous as $verrou) {
        #            echo "<pre>";
        #            echo var_dump($verrou);
        #            echo "</pre>";
                    if (($verrou->getEcheance() > $now) && ($verrou->getUtilisateur() != $user)) {
                        $lock = true;
                    }
                    // nettoyage des vieux verrous
                    if(($verrou->getEcheance() < $now)){
                        $em->remove($verrou);
                    }
                }
            }
        }

#        if( (count($session_data) >= 2) && ($session_data[1] !== $user) && ($session_data[0] > $now->format('Y-m-d H:i:s')) ){
        if( $lock || $restriction ){

            if ($lock) {
                $session->getFlashBag()->add('sonata_flash_error', 'ATTENTION!!! Cet enregistrement a été édité par une autre personne il y a moins de 10 minutes!');
            }
            if ($restriction) {
#                $session->getFlashBag()->add('sonata_flash_error', 'ATTENTION!!! Vous n\'avez les droits pour accéder à cet enregistrement.');
                throw new AccessDeniedHttpException('Accès restreint à l\'auteur de la fiche ou aux admin');
            }

        } else { // jusque là test pour verrou/mutex

            if ($id) {
                // *********************** nouveau Verrou dans la BDD
                $new_verrou = new Verrou;
                $new_verrou->setObjet('taxon');
                $new_verrou->setObjetId($id);
                $new_verrou->setEcheance($then);
                $new_verrou->setUtilisateur($user);
                $em->persist($new_verrou);
                $em->flush();
                // ***********************
            }
            $formMapper
                ->with('General', array('class' => 'col-md-6'))
                    ->add('titre');

            if(
                $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN')
                ||
                $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR')
                ) {
                    $formMapper->add('public', null, array('required' => false))
                               ->add('publication', null, array('required' => false));
            }
            $formMapper
                    ->add('description', null, array('attr' => array('class' => 'ckeditor', 'id' => 'descr_id')))

#                    ->add('description', 'sonata_formatter_type', array(
#                        'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
#                        'format_field'   => 'descriptionFormatter',
#                        'source_field'   => 'rawDescription',
#                        'source_field_options'      => array(
#                            'attr' => array('class' => 'span5', 'rows' => 20)
#                        ),
#                        'target_field'   => 'description',
#                        'listener'       => true,
#                    ))

                    ->add('datefrom')
                    ->add('dateto')
                    ->add('dimensions')
                    ->add('provenance')
                    ->add('region', null, array('label' => 'Lieu de conservation'))
                    ->add('source', null, array('attr' => array('class' => 'ckeditor')))
                    ->add('bibliographie', null, array('attr' => array('class' => 'ckeditor')));
            if(
                $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN')
                ||
                $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR')
                ) {
                    $formMapper
                        ->add('auteur')
                        ->add('montrer_auteur', null, array('required' => false));
            }
            $formMapper
                ->end()
                ->with('Critères', array('class' => 'col-md-3'))
                    ->add('materiau')
                    ->add('categorie')
                    ->add('periode')
                ->end()
                ->with('Fiches associées', array('class' => 'col-md-3'))
                    ->add('fichesassociees', null, array('required' => false, 'label' => 'Fiches'))
                    // Les helpers s'affichent dans le formulaire de création d'une nouvelle fiche
                ->setHelps(array(
                    'titre' => 'Nom / Titre de la fiche',
                    'description' => 'Description de l\'objet',
                    'fichesassociees' => 'Sélection multiple avec shift+clic',
                    'public' => 'Seules les fiches portant le symbole <i class="icon-ok-circle"></i> sont accessibles',
                    'publication' => 'Pour que l\'auteur puisse resoumettre la fiche, décocher l\'option.'
                ))
                ->end()
                ->with('Medias', array('class' => 'col-md-6'))
                    ->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'default', 'provider'=>'sonata.media.provider.image')))
                    ->add('images','sonata_type_collection', array('label' => 'Images annexes', 'by_reference' => false, 'required' => false), array(
                            'edit' => 'inline',
                            'inline' => 'table',
                        ))
                    ->add('fichiers', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'default', 'provider'=>'sonata.media.provider.file')))
                ->end()
            ;
        } // fin du else (session/verrou)
    }

    // restriction des records de la vue en liste en fonction des droits d'accès
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        //if is logged admin, show all data
        if ( !($this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN') || $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR')) ) {
            //for other users, show only data, which belongs to them
            $auteur = $this->container->get('security.context')->getToken()->getUser();

            $query
                ->andWhere($query->getRootAlias().'.auteur=:auteur')
                ->setParameter('auteur', $auteur)
            ;
        }

        return $query;
    }



    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('publication', $this->getRouterIdParameter() . '/publication');
    }



#    # Override to add actions like delete, etc...
#    public function getBatchActions()
#    {
#        // retrieve the default (currently only the delete action) actions
#        $actions = parent::getBatchActions();

#        // check user permissions
#        if( !($this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN') || $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR')) )
#        {
#            // define calculate action
#            $actions['publication']= array ('label' => 'Demande de publication', 'ask_confirmation'  => true );

#        }

#        return $actions;
#    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $actions = array(
                        'actions' => array(
                            'edit' => array(),
                            'delete' => array(),
                        )
                );
        if ( !($this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN') || $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR')) ) {
            $actions['actions']['request_publication'] = array('template' => 'NTEAgathoklesBundle:Admin:list__action_request_publication.html.twig');
        }

        $listMapper
            ->add('id')
            ->add('public', null, array(
                'editable' => $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_ADMIN') || $this->isGranted('ROLE_AGATHOKLES_FICHES_ADMIN_FICHES_EDITOR'),
                'template' => 'NTEAgathoklesBundle:Fiches:crudpublic.html.twig'
            ))
            ->addIdentifier('titre')
            ->add('creation_date', null, array('label' => 'Création'))
            ->add('auteur', null, array('label' => 'Créateur'))
            ->add('modification_date', null, array('label' => 'Mise à jour'))
            ->add('editeur', null, array('label' => 'Éditeur'))
            ->add('image', 'sonata_type_model', array('template' => 'NTEAgathoklesBundle:Fiches:crudimage.html.twig'))
            ->add('_action', 'actions', $actions)
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('id')
                ->add('public')
                ->add('publication')
                ->add('titre')
                ->add('description')
                ->add('datefrom')
                ->add('dateto')
                ->add('provenance')
                ->add('region', null, array('label' => 'Lieu de conservation'))
                ->add('bibliographie')
                ->add('image')
                ->add('materiau')
                ->add('categorie')
                ->add('periode')
                ->add('auteur')
                ->add('editeur')
                ->add('creation_date')
                ->add('modification_date')
        ;
    }


    public function prePersist($fiche)
    {
#        $user = $this->container->get('security.context')->getToken()->getUser();
#        $fiche->setAuteur($user);
    }

    public function preUpdate($fiche)
    {
#        $user = $this->container->get('security.context')->getToken()->getUser();
#        $fiche->setEditeur($user);
    }

}
