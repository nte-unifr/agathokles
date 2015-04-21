<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
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
                ->with('Catégorie', array('class' => 'col-md-12'))
                    ->add('categorie', null, array('required' => true, 'attr' => array('class' => 'categID fiche-categorie')))
                ->end()
            ->end()
            ->tab('Type')
                ->with('Type', array('class' => 'col-md-6'))
                    ->add('forme', 'sonata_type_model', array('required' => true, 'attr' => array('class' => 'formeID')))
                    ->add('fabricant', 'sonata_type_model', array('required' => false, 'empty_value' => 'Aucun', 'attr' => array('class' => 'fabricantID')))
                    ->add('eponyme', 'sonata_type_model', array('required' => false, 'empty_value' => 'Aucun', 'attr' => array('class' => 'eponymeID')))
                    ->add('mois', 'sonata_type_model', array('required' => false, 'empty_value' => 'Aucun', 'attr' => array('class' => 'moisID')))
                    ->add('fabIdInc', null, array('label' => 'Fabricant (?)', 'attr' => array('class' => 'col-md-3 fabIdIncID')))
                    ->add('epoIdInc', null, array('label' => 'Eponyme (?)', 'attr' => array('class' => 'col-md-3 epoIdIncID')))
                    ->add('moisIdInc', null, array('label' => 'Mois (?)', 'attr' => array('class' => 'col-md-4 moisIdIncID')))
                    ->add('autreLegende', null, array('attr' => array('class' => 'autreLegendeID')))
                    ->add('embleme', 'sonata_type_model', array('required' => false, 'empty_value' => 'Aucun', 'label' => 'Emblème', 'attr' => array('class' => 'emblemeID')))
                    ->add('designation', null, array('label' => 'Désignation', 'attr' => array('class' => 'designationID')))
                ->end()
                ->with('', array('class' => 'col-md-6'))
                    ->add('legende', null, array('attr' => array('class' => 'legendeID', 'rows' => 7)))
                    ->add('images', 'sonata_type_collection', array('label' => 'Illustrations', 'attr' => array('class' => 'imagesID'), 'by_reference' => false, 'required' => false), array('edit' => 'inline', 'inline' => 'table',))
                    ->add('epi', null, array('label' => 'ἐπί omis', 'attr' => array('class' => 'col-md-3 epiID')))
                    ->add('para', null, array('label' => 'παρὰ', 'attr' => array('class' => 'col-md-3 paraID')))
                    ->add('iereus', null, array('label' => 'titre (ἰερεύς/ΕΙ)', 'attr' => array('class' => 'col-md-6 iereusID')))
                    ->add('metoikos', null, array('label' => 'μέτοικος', 'attr' => array('class' => 'col-md-3 metoikosID')))
                    ->add('meis', null, array('label' => 'μείς', 'attr' => array('class' => 'col-md-9 meisID')))
                    ->add('ete', null, array('label' => 'ἐτῆ', 'attr' => array('class' => 'eteID')))
                    ->add('ethniqueDemotique', 'sonata_type_model', array('label' => 'Ethnique / démotique', 'empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'ethniqueDemotiqueID')))
                    ->add('position', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'positionID')))
                ->end()
                ->setHelps(array(
                    'categorie' => 'Le choix de la catégorie va afficher ou masquer des champs.',
                ))
            ->end()
            ->tab('Matrice')
                ->with('Matrice', array('class' => 'col-md-6'))
                    ->add('matriceNumero', null, array('required' => true, 'label' => 'Matrice numéro (My)'))
                    ->add('cadre', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'cadreID')))
                    ->add('bouton', null, array('attr' => array('class' => 'col-md-3 boutonID')))
                    ->add('grenetis', null, array('attr' => array('class' => 'col-md-3 grenetisID')))
                    ->add('ombilic', null, array('attr' => array('class' => 'col-md-6 ombilicID')))
                    ->add('separation', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'separationID')))
                ->end()
                ->with('', array('class' => 'col-md-6'))
                    ->add('legendeTournante', null, array('label' => 'Légende tournante', 'attr' => array('class' => 'legendeTournanteID')))
                    ->add('legendeRetrograde', null, array('label' => 'Légende rétrograde', 'attr' => array('class' => 'legendeRetrogradeID')))
                    ->add('lettreLunaire', null, array('label' => 'Lettre lunaire', 'attr' => array('class' => 'lettreLunaireID')))
                    ->add('particulariteOrthographique', null, array('label' => 'Particularités orthographiques', 'attr' => array('class' => 'particulariteOrthographiqueID')))
                    ->add('retrogravure', null, array('label' => 'Rétrogravure', 'attr' => array('class' => 'retrogravureID')))
                ->end()
            ->end()
            ->tab('Timbre')
                ->with('Timbre', array('class' => 'col-md-6'))
                    ->add('numero', null, array('label' => 'Numéro', 'attr' => array('class' => 'numeroID')))
                    ->add('referenceBibliographique', null, array('label' => 'Référence', 'attr' => array('class' => 'referenceBibliographiqueID')))
                    ->add('lieuDeDecouverte', null, array('label' => 'Lieu', 'attr' => array('class' => 'lieuDeDecouverteID')))
                ->end()
                ->with('', array('class' => 'col-md-6'))
                    ->add('remarques', null, array('attr' => array('class' => 'ckeditor remarquesID')))
                ->end()
            ->end()
            ->tab('Associations')
                ->with('Associations', array('class' => 'col-md-12'))
                    ->add('matricePrincipale', 'sonata_type_collection', array('attr' => array('class' => 'matricePrincipaleID'),
                                                                               'by_reference' => false, 'required' => false),
                                                                               array(
                                                                                   'edit' => 'inline',
                                                                                   'inline' => 'table',
                                                                               )
                    )
                    ->add('matriceSecondaire', 'sonata_type_collection', array('attr' => array('class' => 'matriceSecondaireID'),
                                                                               'by_reference' => false, 'required' => false),
                                                                               array(
                                                                                   'edit' => 'inline',
                                                                                   'inline' => 'table',
                                                                               )
                    )
                    ->add('matriceComplementaire', 'sonata_type_collection', array('attr' => array('class' => 'matriceComplementaireID'),
                                                                               'by_reference' => false, 'required' => false),
                                                                               array(
                                                                                   'edit' => 'inline',
                                                                                   'inline' => 'table',
                                                                               )
                    )
                ->end()
            ->end()
            ->tab('Publication')
                ->with('Publication', array('class' => 'col-md-12'))
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
        '_sort_by' => 'designation' // name of the ordered field
        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

    // PRE OPERATIONS

    public function prePersist($fiche)
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
        $fiche->setTypeNumero($resultCount+1);
    }

    public function preUpdate($fiche)
    {
        // Set fullname to sort fiches
        $spacer = "";
        $epo = "";
        $fab = "";
        if ($fiche->getEponyme() != null) {
            $epo = $fiche->getEponyme()->getNom();
        }
        if ($fiche->getFabricant() != null) {
            $fab = $fiche->getFabricant()->getNom();
        }
        if ($epo != "" && $fab != "") {
            $spacer = " / ";
        }
        $fullname = $epo . $spacer . $fab . " - T" . $fiche->getTypeNumero() . " - M" . $fiche->getMatriceNumero();
        $fiche->setFullname($fullname);
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
}
