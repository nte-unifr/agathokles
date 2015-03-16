<?php

namespace NTE\AgathoklesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;


class AdvancedSearchFiches extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NTE\AgathoklesBundle\Entity\Fiches',
            'cascade_validation' => true,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'advancedsearch_fiche_unique_secret_hahaha',
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

#        $builder->add('fiche',       'text', array('required' => false, 'label' => 'Fiche n°'));

        $choices = array_combine(range(-310, -1, 1), range(-310, -1, 1));

        $builder->add('date',   'choice', array(
            'choices' => $choices,
            'empty_data' => -310,
            'label' => 'De'
        ));

        $builder->add('dateto',     'choice', array(
            'choices' => $choices,
            'empty_data' => -1,
            'label' => 'à',
            'mapped'     => false,
        ));

        $builder->add('categorie', 'entity', array(
            'label' => 'Catégorie',
            'class' => 'NTEAgathoklesBundle:Categorie',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.nom', 'ASC');
            },
            'required' => true
        ));

        $builder->add('fabricant', 'entity', array(
            'class' => 'NTEAgathoklesBundle:Fabricant',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.nom', 'ASC');
            },
            'required' => true
        ));

        $builder->add('lieuDeDecouverte', 'entity', array(
            'class' => 'NTEAgathoklesBundle:Lieu',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('m')
                    ->orderBy('m.nom', 'ASC');
            },
            'required' => true
        ));
    }

    public function getName()
    {
        return 'rechercheavancee';
    }
}
