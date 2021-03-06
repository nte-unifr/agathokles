<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\Eponyme;

class EponymesAdmin extends Admin
{
    // LIST FIELDS
    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
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
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('datingStart', null, array('label' => 'Datation début'))
            ->add('datingEnd', null, array('label' => 'Datation fin'))
            ->add('approximative', null, array('label' => 'Circa'))
        ;
    }

    // FORM FIELDS
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Eponyme')
                ->add('nom')
                ->add('datingStart', null, array('label' => 'Datation début'))
                ->add('datingEnd', null, array('label' => 'Datation fin'))
                ->add('approximative', null, array('label' => 'Circa', 'required' => false))
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
        '_sort_by' => 'nom'         // name of the ordered field
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

    // PRE OPERATIONS

    public function preUpdate($eponyme)
    {
        // Don't allow only one dating to be set
        if (!$eponyme->hasDatingStart()) {
            $eponyme->setDatingStart($eponyme->getDatingEnd());
        }
        if (!$eponyme->hasDatingEnd()) {
            $eponyme->setDatingEnd($eponyme->getDatingStart());
        }

        // datingEnd can't be larger than datingStart, it's BC
        if ($eponyme->getDatingEnd() > $eponyme->getDatingStart()) {
            $eponyme->setDatingEnd($eponyme->getDatingStart());
            $this->getRequest()->getSession()->getFlashBag()->add("warning", "Datation fin ne peut pas être supérieur à datation début.");
        }
    }

}
