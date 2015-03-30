<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\FichesSecondaires;

class FichesSecondairesAdmin extends Admin
{
    // LIST FIELDS
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('fiche')
            ->add('media', 'sonata_type_model', array('template' => 'NTEAgathoklesBundle:Fiches:crudimage.html.twig'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
           ))
        ;
    }

    // FORM FIELDS
    /**
     * Create and Edit
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
#            ->add('fiche')
            ->add('ficheSecondaire')
            ->add('media', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'default', 'provider'=>'sonata.media.provider.image')))
            ->end()
        ;
    }

    // SHOW FIELDS
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fiche')
            ->add('ficheSecondaire')
            ->add('media', 'sonata_type_model', array('template' => 'NTEAgathoklesBundle:Fiches:crudimage.html.twig'))
            ->end()
        ;
    }
}
