<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class FichesAdmin extends Admin
{
    protected $em;

    // LIST FIELDS
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('eponyme')
            ->add('fabricant')
            ->add('typeNumero', null, array('label' => 'Tx'))
            ->add('matriceNumero', null, array('label' => 'My'))
            ->add('forme')
            ->add('mois')
            ->add('embleme')
            ->add('categorie')
            ->add('public')
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
            ->add('eponyme')
            ->add('fabricant')
            ->add('forme')
            ->add('mois')
            ->add('embleme')
            ->add('categorie')
        ;
    }

    // FORM FIELDS
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Catégorie')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('categorie', null, array('required' => true, 'attr' => array('class' => 'col-md-10 categID fiche-categorie')))
                ->end()
            ->end()
            ->tab('Type')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('forme', null,
                        array(
                            'required' => true,
                            'attr' => array('class' => 'col-md-10 formeID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('fabricant', null,
                        array(
                            'required' => false,
                            'empty_value' => 'Aucun',
                            'attr' => array('class' => 'col-md-10 fabricantID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('fabIdInc', null, array('label' => 'Fabricant (?)', 'attr' => array('class' => 'col-md-2 fabIdIncID')))
                    ->add('eponyme', null,
                        array(
                            'label' => 'Éponyme',
                            'required' => false,
                            'empty_value' => 'Aucun',
                            'attr' => array('class' => 'col-md-10 eponymeID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('epoIdInc', null, array('label' => 'Éponyme (?)', 'attr' => array('class' => 'col-md-2 epoIdIncID')))
                    ->add('mois', null,
                        array(
                            'required' => false,
                            'empty_value' => 'Aucun',
                            'attr' => array('class' => 'col-md-10 moisID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('moisIdInc', null, array('label' => 'Mois (?)', 'attr' => array('class' => 'col-md-2 moisIdIncID')))
                    ->add('autreLegende', null, array('label' => 'Autre légende','attr' => array('class' => 'col-md-10 autreLegendeID')))
                    ->add('embleme', null,
                        array(
                            'required' => false,
                            'empty_value' => 'Aucun',
                            'label' => 'Emblème',
                            'attr' => array('class' => 'col-md-10 emblemeID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('designation', null, array('label' => 'Désignation', 'attr' => array('class' => 'col-md-10 designationID')))
                    ->add('legende', null, array('label' => 'Légende', 'attr' => array('class' => 'col-md-10 legendeID', 'rows' => 7)))
                    ->add('legendeCentrifuge', null, array('label' => 'Légende centrifuge', 'attr' => array('class' => 'col-md-4 legendeCentrifugeID')))
                    ->add('legendeCentripete', null, array('label' => 'Légende centripète', 'attr' => array('class' => 'col-md-4 legendeCentripeteID')))
                    ->add('legendeRetrograde', null, array('label' => 'Légende rétrograde', 'attr' => array('class' => 'col-md-4 legendeRetrogradeID')))
                    ->add('legendeBoustrophedon', null, array('label' => 'Légende boustrophédon', 'attr' => array('class' => 'col-md-4 legendeBoustrophedonID')))
                    ->add('legendeTournante', null, array('label' => 'Légende tournante', 'attr' => array('class' => 'col-md-4 legendeTournanteID')))
                    ->add('legendeMontante', null, array('label' => 'Légende montante', 'attr' => array('class' => 'col-md-4 legendeMontanteID')))
                    ->add('lettreRetrograde', null, array('label' => 'Lettre(s) rétrograde(s)', 'attr' => array('class' => 'col-md-5 lettreRetrogradeID')))
                    ->add('lettreLunaire', null, array('label' => 'Lettre(s) lunaire(s)', 'attr' => array('class' => 'col-md-5 lettreLunaireID')))
                    ->add('particulariteOrthographique', null, array('label' => 'Particularité(s) orthographique(s)', 'attr' => array('class' => 'col-md-10 particulariteOrthographiqueID')))
                    ->add('epi', null, array('label' => 'ἐπί omis', 'attr' => array('class' => 'col-md-4 epiID')))
                    ->add('para', null, array('label' => 'παρά', 'attr' => array('class' => 'col-md-4 paraID')))
                    ->add('iereus', null, array('label' => 'titre (ἰερεύς/ΕΙ)', 'attr' => array('class' => 'col-md-4 iereusID')))
                    ->add('ergastiriarchas', null, array('label' => 'ἐργαστηριάρχας', 'attr' => array('class' => 'col-md-4 ergastiriarchasID')))
                    ->add('metoikos', null, array('label' => 'μέτοικος', 'attr' => array('class' => 'col-md-4 metoikosID')))
                    ->add('meis', null, array('label' => 'μείς', 'attr' => array('class' => 'col-md-4 meisID')))
                    ->add('ete', null, array('label' => 'ἐτῆ', 'attr' => array('class' => 'col-md-10 eteID')))
                    ->add('ethniqueDemotique', null,
                        array(
                            'label' => 'Ethnique / démotique',
                            'empty_value' => 'Aucun',
                            'required' => false,
                            'attr' => array('class' => 'col-md-10 ethniqueDemotiqueID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('position', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'col-md-10 positionID')))
                ->end()
            ->end()
            ->tab('Matrice')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('matriceNumero', null, array('required' => true, 'label' => 'Matrice numéro', 'attr' => array('class' => 'col-md-10 matriceNumeroID')))
                    ->add('cadre', null,
                        array(
                            'empty_value' => 'Aucun',
                            'required' => false,
                            'attr' => array('class' => 'col-md-10 cadreID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('bouton', null, array('attr' => array('class' => 'col-md-4 boutonID')))
                    ->add('grenetis', null, array('label' => 'Grènetis', 'attr' => array('class' => 'col-md-4 grenetisID')))
                    ->add('ombilic', null, array('attr' => array('class' => 'col-md-4 ombilicID')))
                    ->add('separation', null,
                        array(
                            'label' => 'Séparation',
                            'empty_value' => 'Aucun',
                            'required' => false,
                            'attr' => array('class' => 'col-md-10 separationID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                ->end()
            ->end()
            ->tab('Illustrations')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('images', 'sonata_type_collection',
                        array(
                            'label' => 'Illustrations',
                            'attr' => array('class' => 'imagesID'),
                            'by_reference' => false,
                            'required' => false
                        ),
                        array(
                            'edit' => 'inline',
                            'inline' => 'table',
                        )
                    )
                ->end()
            ->end()
            ->tab('Timbres')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('timbres', 'sonata_type_collection',
                         array(
                             'required' => false,
                             'by_reference' => false
                         ),
                         array(
                             'edit' => 'inline',
                             'inline' => 'table',
                             'allow_delete' => true
                         )
                    )
                ->end()
            ->end()
            ->tab('Associations')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('matricePrincipale', 'sonata_type_collection',
                        array(
                            'attr' => array('class' => 'matricePrincipaleID'),
                            'by_reference' => false, 'required' => false
                        ),
                        array(
                            'edit' => 'inline',
                            'inline' => 'table',
                        )
                    )
                    ->add('matriceSecondaire', 'sonata_type_collection',
                        array(
                            'attr' => array('class' => 'matriceSecondaireID'),
                            'by_reference' => false, 'required' => false
                        ),
                        array(
                            'edit' => 'inline',
                            'inline' => 'table',
                        )
                    )
                    ->add('matriceComplementaire', 'sonata_type_collection',
                        array(
                            'attr' => array('class' => 'matriceComplementaireID'),
                            'by_reference' => false, 'required' => false),
                        array(
                            'edit' => 'inline',
                            'inline' => 'table',
                        )
                    )
                ->end()
            ->end()
            ->tab('Publication')
                ->with(' ', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('public')
                ->end()
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
        '_sort_by' => 'fullname' // name of the ordered field
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

    // PRE OPERATIONS

    public function prePersist($fiche)
    {
        $nextTypeNumero = $this->getNextTypeNumero($fiche);
        $fiche->setTypeNumero($nextTypeNumero);

        $this->linkTimbres($fiche);
    }

    public function preUpdate($fiche)
    {
        $rightFullname = $this->getRightFullname($fiche);
        $fiche->setFullname($rightFullname);

        $this->updateFabricantDating($fiche);

        $this->linkTimbres($fiche);
    }

    // OTHER FUNCTIONS

    public function getNextTypeNumero($fiche)
    {
        // Count all occurences of the same eponyme, fabricant, forme, embleme and mois to update TypeNumero accordingly
        $qb = $this->em->createQueryBuilder()
            ->select('f')
            ->from('NTEAgathoklesBundle:Fiches', 'f')
            ->where('f.eponyme = :epo')
            ->andWhere('f.fabricant = :fab')
            ->andWhere('f.forme = :for')
            ->andWhere('f.embleme = :emb')
            ->andWhere('f.mois = :moi')
            ->orderBy( 'f.id', 'ASC' )
            ->setParameter('epo', $fiche->getEponyme())
            ->setParameter('fab', $fiche->getFabricant())
            ->setParameter('for', $fiche->getForme())
            ->setParameter('emb', $fiche->getEmbleme())
            ->setParameter('moi', $fiche->getMois());
        $results = $qb->getQuery()->getResult();
        $resultCount = count($results);
        return $resultCount+1;
    }

    // set a human readable name to fiches
    public function getRightFullname($fiche)
    {
        $spacer = "";
        $epo = "";
        $epoIdInc = "";
        $fab = "";
        $fabIdInc = "";
        if ($fiche->getEponyme() != null) {
            $epo = $fiche->getEponyme()->getNom();
        }
        if ($fiche->getEpoIdInc() != null) {
            $epoIdInc = " (?)";
        }
        if ($fiche->getFabricant() != null) {
            $fab = $fiche->getFabricant()->getNom();
        }
        if ($fiche->getFabIdInc() != null) {
            $fabIdInc = " (?)";
        }
        if ($epo != "" && $fab != "") {
            $spacer = " / ";
        }
        $fullname = $epo.$epoIdInc . $spacer . $fab.$fabIdInc . " - T" . $fiche->getTypeNumero() . " - M" . $fiche->getMatriceNumero();
        return $fullname;
    }

    // update fabricant dating if both fabricant and eponyme set
    public function updateFabricantDating($fiche)
    {
        if ($fiche->hasFabricant() && $fiche->hasEponyme()) {
            $fabricant  = $fiche->getFabricant();
            $eponyme    = $fiche->getEponyme();

            // if Fabricant use manual dating, prevent update
            if (!$fabricant->getManualDating()) {
                $epoDatingStart = $eponyme->getDatingStart();
                $epoDatingEnd = $eponyme->getDatingEnd();

                if ($epoDatingStart > $fabricant->getDatingStart()) {
                    $fabricant->setDatingStart($epoDatingStart);
                    $fabricant->setApproximative($fabricant->getApproximative() ?: $eponyme->getApproximative()); // if getting an approx dating, it's an approx
                }

                if (!$fabricant->hasDatingEnd() || $epoDatingEnd < $fabricant->getDatingEnd()) {
                    $fabricant->setDatingEnd($epoDatingEnd);
                    $fabricant->setApproximative($fabricant->getApproximative() ?: $eponyme->getApproximative()); // if getting an approx dating, it's an approx
                }
            }
        }
    }

    // update each timbres in order to associate to the fiche
    public function linkTimbres($fiche)
    {
        foreach ($fiche->getTimbres() as $timbre) {
            $timbre->setFiche($fiche);
        }
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
}
