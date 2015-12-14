<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\Timbre;

class TimbreAdmin extends Admin
{
    // FORM FIELDS
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Timbre', array('class' => 'col-md-12'))
                ->add('reference', null, array('label' => 'Référence'))
                ->add('lieu', null, array('required' => true))
                ->add('contexte')
                ->add('remarques')
            ->end()
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
        '_sort_by' => 'lieu'         // name of the ordered field
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

}
