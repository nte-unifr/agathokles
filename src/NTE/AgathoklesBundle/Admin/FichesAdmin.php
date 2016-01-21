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
            ->tab('Analyse')
                ->with('TYPE', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('forme', null,
                        array(
                            'required' => true,
                            'attr' => array('class' => 'col-md-10 formeID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.rank', 'ASC'); }
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
                    ->add('embleme', null,
                        array(
                            'required' => false,
                            'empty_value' => 'Aucun',
                            'label' => 'Emblème',
                            'attr' => array('class' => 'col-md-10 emblemeID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('legende', null, array('label' => 'Légende', 'attr' => array('class' => 'col-md-10 legendeID', 'rows' => 3)))
                    ->add('ethniqueDemotique', null,
                        array(
                            'label' => 'Ethnique / démotique',
                            'empty_value' => 'Aucun',
                            'required' => false,
                            'attr' => array('class' => 'col-md-3 ethniqueDemotiqueID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('metoikos', null, array('label' => 'μέτοικος', 'attr' => array('class' => 'col-md-3 metoikosID')))
                    ->add('engenis', null, array('label' => 'ἐγγενής', 'attr' => array('class' => 'col-md-3 engenisID')))
                    ->add('ergastiriarchas', null, array('label' => 'ἐργαστηριάρχας', 'attr' => array('class' => 'col-md-10 ergastiriarchasID')))
                    ->add('para', null, array('label' => 'παρά', 'attr' => array('class' => 'col-md-3 paraID')))
                    ->add('nominatifFabricant', null, array('label' => 'Nominatif (F)', 'attr' => array('class' => 'col-md-3 nominatifFabricantID')))
                    ->add('ei', null, array('label' => 'EI', 'attr' => array('class' => 'col-md-10 eiID')))
                    ->add('epi', null, array('label' => 'ἐπί omis', 'attr' => array('class' => 'col-md-3 epiID')))
                    ->add('iereus', null, array('label' => 'ἰερεύς', 'attr' => array('class' => 'col-md-3 iereusID')))
                    ->add('nominatifEponyme', null, array('label' => 'Nominatif (É)', 'attr' => array('class' => 'col-md-3 nominatifEponymeID')))
                    ->add('patronyme', null, array('label' => 'Patronyme', 'attr' => array('class' => 'col-md-3 patronymeID')))
                    ->add('meis', null, array('label' => 'μείς', 'attr' => array('class' => 'col-md-10 meisID')))
                    ->add('different', null, array('label' => 'Différent','attr' => array('class' => 'col-md-3 differentID')))
                    ->add('ete', null, array('label' => 'ἐτῆ', 'attr' => array('class' => 'col-md-3 eteID')))
                    ->add('remarquesType', null, array('label' => 'Remarques', 'attr' => array('class' => 'col-md-10 remarquesTypeID', 'rows' => 3)))
                ->end()
                ->with('MATRICE', array('class' => 'col-md-12 sonata-box-rewrite'))
                    ->add('matriceNumero', null, array('required' => true, 'label' => 'Matrice numéro', 'attr' => array('class' => 'col-md-5 matriceNumeroID')))
                    ->add('regravure', null, array('required' => false, 'label' => 'Regravure', 'attr' => array('class' => 'col-md-5 regravureID')))
                    ->add('cadre', null,
                        array(
                            'empty_value' => 'Aucun',
                            'required' => false,
                            'attr' => array('class' => 'col-md-10 cadreID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.rank', 'ASC'); }
                        )
                    )
                    ->add('bouton', null, array('attr' => array('class' => 'col-md-3 boutonID')))
                    ->add('ombilic', null, array('attr' => array('class' => 'col-md-3 ombilicID')))
                    ->add('grenetis', null, array('label' => 'Grènetis', 'attr' => array('class' => 'col-md-3 grenetisID')))
                    ->add('separation', null,
                        array(
                            'label' => 'Séparation',
                            'empty_value' => 'Aucun',
                            'required' => false,
                            'attr' => array('class' => 'col-md-10 separationID'),
                            'query_builder' => function(\Doctrine\ORM\EntityRepository $rep) { return $rep->createQueryBuilder('u')->orderBy('u.nom', 'ASC'); }
                        )
                    )
                    ->add('legendeCentrifuge', null, array('label' => 'Légende centrifuge', 'attr' => array('class' => 'col-md-3 legendeCentrifugeID')))
                    ->add('legendeCentripete', null, array('label' => 'Légende centripète', 'attr' => array('class' => 'col-md-3 legendeCentripeteID')))
                    ->add('legendeRetrograde', null, array('label' => 'Légende rétrograde', 'attr' => array('class' => 'col-md-4 legendeRetrogradeID')))
                    ->add('legendeBoustrophedon', null, array('label' => 'Légende boustrophédon', 'attr' => array('class' => 'col-md-3 legendeBoustrophedonID')))
                    ->add('legendeTournante', null, array('label' => 'Légende tournante', 'attr' => array('class' => 'col-md-3 legendeTournanteID')))
                    ->add('legendeMontante', null, array('label' => 'Légende montante', 'attr' => array('class' => 'col-md-4 legendeMontanteID')))
                    ->add('lettreRetrograde', null, array('label' => 'Lettre(s) rétrograde(s)', 'attr' => array('class' => 'col-md-3 lettreRetrogradeID')))
                    ->add('lettreLunaire', null, array('label' => 'Lettre(s) lunaire(s)', 'attr' => array('class' => 'col-md-3 lettreLunaireID')))
                    ->add('lettreRenversee', null, array('label' => 'Lettre(s) renversée(s)', 'attr' => array('class' => 'col-md-3 lettreRenverseeID')))
                    ->add('particulariteOrthographique', null, array('label' => 'Particularité(s) orthographique(s)', 'attr' => array('class' => 'col-md-10 particulariteOrthographiqueID')))
                    ->add('remarquesMatrice', null, array('label' => 'Remarques', 'attr' => array('class' => 'col-md-10 remarquesMatriceID', 'rows' => 3)))
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
                    ->add('remarquesAssociations', null, array('label' => 'Remarques', 'attr' => array('class' => 'col-md-10 remarquesAssociationsID', 'rows' => 3)))
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

    // default values when new instance is created via admin
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $instance->setPublic(true);

        return $instance;
    }
}
