<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\Categorie;

class CategoriesAdmin extends Admin
{
    /**
    * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
    *
    * @return void
    */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Catégorie', array('class' => 'col-md-6'))
                ->add('nom')
                ->add('numero')
                ->setHelps(array(
                    'numero'  => 'utilisé pour le tri dans les listes déroulantes de l\'interface publique (expl.: formulaire de recherche)',
                ))
            ->end()
        ;
    }

    /**
    * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
    *
    * @return void
    */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addidentifier('nom')
            ->add('numero')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
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
            ->add('nom')
            ->add('numero')
        ;
    }

    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,               // display the first page (default = 1)
        '_sort_order' => 'ASC',     // reverse order (default = 'ASC')
        '_sort_by' => 'numero'         // name of the ordered field
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

}
