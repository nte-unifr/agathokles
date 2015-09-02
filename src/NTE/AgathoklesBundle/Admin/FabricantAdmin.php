<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FabricantAdmin extends Admin
{
    // LIST FIELDS
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('manualDating', null, array('label' => 'Datation manuelle'))
            ->add('datingStart', null, array('label' => 'Datation début'))
            ->add('datingEnd', null, array('label' => 'Datation fin'))
            ->add('approximative', null, array('label' => 'Circa'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    // LIST FILTERS
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('manualDating', null, array('label' => 'Datation manuelle'))
            ->add('datingStart', null, array('label' => 'Datation début'))
            ->add('datingEnd', null, array('label' => 'Datation fin'))
            ->add('approximative', null, array('label' => 'Circa'))
        ;
    }

    // FORM FIELDS
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('manualDating', null, array('label' => 'Empêcher la datation automatique', 'required' => false))
            ->add('datingStart', null, array('label' => 'Datation début'))
            ->add('datingEnd', null, array('label' => 'Datation fin'))
            ->add('approximative', null, array('label' => 'Circa', 'required' => false))
        ;
    }

    // DEFAULT DATA ORGANISATION
    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,               // display the first page (default = 1)
        '_sort_order' => 'ASC',     // reverse order (default = 'ASC')
        '_sort_by' => 'nom'         // name of the ordered field
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );
}
