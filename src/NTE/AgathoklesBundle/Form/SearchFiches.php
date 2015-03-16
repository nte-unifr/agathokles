<?php

namespace NTE\AgathoklesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

//use Doctrine\ORM;
//use NTE\AgathoklesBundle\Entity;
//use Doctrine\ORM\EntityRepository;

class SearchFiches extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NTE\AgathoklesBundle\Entity\Fiches',
            'cascade_validation' => true,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'search_agathokles_unique_secret_hahaha',
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('codeType',      'text', array(
            'required' => false,
            'label' => 'Titre'
        ));


        $dropdown_opts = array(
            'empty_value' => '----------- Choisissez une option -----------',
            'empty_data'  => null,
            'required' => false
        );

        $dates = array_combine(range(-310, -1, 1), range(-310, -1, 1));
        $builder->add('date', 'choice', array(
            'choices' => $dates,
            'empty_data' => -310,
            'label' => 'De'
        ));
        $builder->add('dateto', 'choice', array(
            'choices'    => $dates,
            'empty_data' => -1,
            'label'      => 'à',
            'mapped'     => false
        ));

        $builder->add('fabricant', null, array_merge($dropdown_opts));
        $builder->add('eponyme', null, array_merge($dropdown_opts));
        $builder->add('mois', null, array_merge($dropdown_opts));
        $builder->add('embleme', null, array_merge($dropdown_opts));
        $builder->add('forme', null, array_merge($dropdown_opts));
    }

    public function getName()
    {
        return 'recherche_fiches';
    }
}
