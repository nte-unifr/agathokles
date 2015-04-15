<?php
namespace NTE\AgathoklesBundle\Form\Filter;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;

use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FichesFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fabricant', 'filter_entity', [ "class" => "NTEAgathoklesBundle:Fabricant", "empty_value" => "Tous" ]);
        $builder->add('eponyme', 'filter_entity', [ "class" => "NTEAgathoklesBundle:Eponyme", "empty_value" => "Tous" ]);
        $builder->add('forme', 'filter_entity', [ "class" => "NTEAgathoklesBundle:Forme", "empty_value" => "Tous" ]);
        $builder->add('mois', 'filter_entity', [ "class" => "NTEAgathoklesBundle:Mois", "empty_value" => "Tous" ]);
        $builder->add('embleme', 'filter_entity', [ "class" => "NTEAgathoklesBundle:Embleme", "empty_value" => "Tous" ]);
        $builder->add('categorie', 'filter_entity', [ "class" => "NTEAgathoklesBundle:Categorie", "empty_value" => "Tous" ]);
    }

    public function getName()
    {
        return 'filter_fiches';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}
