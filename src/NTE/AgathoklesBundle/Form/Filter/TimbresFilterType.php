<?php

namespace NTE\AgathoklesBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Embed filter type.
 */
class TimbresFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lieu', 'filter_entity', array(
            "class"         => "NTEAgathoklesBundle:Lieu",
            "query_builder" => function(EntityRepository $repository) {
                return $repository->createQueryBuilder('u')->orderBy('u.nom', 'ASC');
            },
            "empty_value"   => "Tous"
        ));
    }

    public function getName()
    {
        return 'timbres_filter';
    }
}
