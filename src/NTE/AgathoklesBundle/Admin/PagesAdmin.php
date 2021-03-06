<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\Pages;

class PagesAdmin extends Admin
{
    // LIST FIELDS
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title', null, array('label' => 'Titre'))
            ->add('introduction', 'html')
            ->add('text', 'html', array('label' => 'Texte'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
           ))
        ;
    }

    // LIST FILTERS
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('title', null, array('label' => 'Titre'))
            ->add('introduction')
            ->add('text', null, array('label' => 'Texte'))
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
#            ->with('Titre / introduction', array('class' => 'col-md-6'))
                ->add('title', null, array('label' => 'Titre'))
                ->add('introduction', null, array('attr' => array('class' => 'ckeditor')))
#            ->end()
#            ->with('Texte', array('class' => 'col-md-6'))
                ->add('text', null, array('label' => 'Texte', 'attr' => array('class' => 'ckeditor')))
                ->add('handle', null, array('label' => 'URL'))
#            ->end()
        ;
    }

    // DEFAULT DATA ORGANISATION
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }

    /**

    * {@inheritdoc}

    */

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('introduction', 'html')
            ->add('text', 'html')
            ->end()
        ;
    }
}
