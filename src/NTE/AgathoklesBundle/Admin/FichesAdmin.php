<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FichesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('codeType')
            ->add('categorie')
            ->add('eponyme')
            ->add('mois')
            ->add('autreLegende')
            ->add('codeMatrice')
            ->add('legende')
            ->add('bouton')
            ->add('grenetis')
            ->add('ombilic')
            ->add('legendeTournante')
            ->add('lettreRetrograde')
            ->add('lettreLunaire')
            ->add('epi')
            ->add('para')
            ->add('iereus')
            ->add('metoikos')
            ->add('meis')
            ->add('ete')
            ->add('particulariteOrthographique')
            ->add('retrogravure')
            ->add('numero')
            ->add('referenceBibliographique')
            ->add('date')
            ->add('remarques')
            ->add('public')
            ->add('publication')
            ->add('creation_date')
            ->add('modification_date')
            ->add('montrer_auteur')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('codeType')
            ->add('mois')
            ->add('autreLegende')
            ->add('codeMatrice')
            ->add('legende')
            ->add('public')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Généralités')
#                ->with('Fiche', array('class' => 'col-md-6'))
#                    ->add('id')
#                ->end()
                ->with('Catégorie', array('class' => 'col-md-12'))
                    ->add('categorie', null, array('attr' => array('onChange' => 'changeCateg(this.value)', 'class' => 'categID')))
                ->end()
                ->with('Type', array('class' => 'col-md-6'))
                    ->add('codeType', null, array('attr' => array('class' => 'codeTypeID'), 'read_only' => true))
                    ->add('codeTypeNonId', null, array('label' => 'Code Type Non Identifié', 'attr' => array('class' => 'codeTypeNonIdID')))
                    ->add('fabricant', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'fabricantID')))
                    ->add('eponyme', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'eponymeID')))
                    ->add('mois', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'empty_value' => 'Aucun', 'attr' => array('class' => 'moisID')))
                    ->add('autreLegende', null, array('attr' => array('class' => 'autreLegendeID')))
                    ->add('forme', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'formeID')))
                    ->add('embleme', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'emblemeID')))
                ->end()
                ->with('Matrice', array('class' => 'col-md-6'))
                    ->add('codeMatrice', null, array('attr' => array('class' => 'codeMatriceID'), 'read_only' => true))
                    ->add('legende', null, array('attr' => array('class' => 'legendeID', 'rows' => 7)))
                    ->add('position', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'positionID')))
                    ->add('images', 'sonata_type_collection', array('label' => 'Illustrations', 'attr' => array('class' => 'imagesID'),
                                                                               'by_reference' => false, 'required' => false),
                                                                               array(
                                                                                   'edit' => 'inline',
                                                                                   'inline' => 'table',
                                                                               )
                    )
                    ->add('cadre', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'cadreID')))
                    ->add('bouton', null, array('attr' => array('class' => 'col-md-3 boutonID')))
                    ->add('grenetis', null, array('attr' => array('class' => 'col-md-3 grenetisID')))
                    ->add('ombilic', null, array('attr' => array('class' => 'col-md-6 ombilicID')))
                    ->add('separation', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'separationID')))
                    ->add('legendeTournante', null, array('attr' => array('class' => 'legendeTournanteID')))
                    ->add('lettreRetrograde', null, array('attr' => array('class' => 'lettreRetrogradeID')))
                    ->add('lettreLunaire', null, array('attr' => array('class' => 'lettreLunaireID')))
                    ->add('epi', null, array('label' => 'ἐπί omis', 'attr' => array('class' => 'col-md-3 epiID')))
                    ->add('para', null, array('label' => 'παρὰ', 'attr' => array('class' => 'col-md-3 paraID')))
                    ->add('iereus', null, array('label' => 'titre (ἰερεύς/ΕΙ)', 'attr' => array('class' => 'col-md-6 iereusID')))
                    ->add('metoikos', null, array('label' => 'μέτοικος', 'attr' => array('class' => 'col-md-3 metoikosID')))
                    ->add('meis', null, array('label' => 'μείς', 'attr' => array('class' => 'col-md-9 meisID')))
                    ->add('ete', null, array('label' => 'ἐτῆ', 'attr' => array('class' => 'eteID')))
                    ->add('ethniqueDemotique', 'sonata_type_model', array('empty_value' => 'Aucun', 'required' => false, 'attr' => array('class' => 'ethniqueDemotiqueID')))
                    ->add('particulariteOrthographique', null, array('attr' => array('class' => 'particulariteOrthographiqueID')))
                    ->add('retrogravure', null, array('attr' => array('class' => 'retrogravureID')))
                ->end()
                ->setHelps(array(
                    'codeMatrice'  => 'Repris de Code Type.',
                    'codeType'  => 'Si la case <strong>Code Type Non Identifé</strong> ci-dessous est laissée vide, le <strong>Code Type</strong> est généré automatiquement sur la base des champs suivants : <strong>Fabricant, Eponyme, Mois, Autre Légende,  Forme  et Emblème</strong>.',
                    'categorie' => 'Le choix de la catégorie va afficher ou masquer des champs.
                                    <script type="text/javascript">
                                        function changeCateg( categ ) {
                                            if( 1 == categ ) {
                                                $(".fabricantID").parents(".form-group").show();
                                                $(".eponymeID").parents(".form-group").show();
                                                $(".moisID").parents(".form-group").show();
                                                $(".autreLegendeID").parents(".form-group").show();
                                                $(".formeID").parents(".form-group").show();
                                                $(".emblemeID").parents(".form-group").show();

                                                $(".positionID").parents(".form-group").show();
                                                $(".cadreID").parents(".form-group").show();
                                                $(".boutonID").parents(".form-group").show();
                                                $(".grenetisID").parents(".form-group").show();
                                                $(".ombilicID").parents(".form-group").show();
                                                $(".separationID").parents(".form-group").show();

                                                $(".legendeTournanteID").parents(".form-group").show();
                                                $(".lettreRetrogradeID").parents(".form-group").show();
                                                $(".lettreLunaireID").parents(".form-group").show();

                                                $(".particulariteOrthographiqueID").parents(".form-group").show();
                                                $(".retrogravureID").parents(".form-group").show();

                                                $(".epiID").parents(".form-group").show();
                                                $(".paraID").parents(".form-group").show();
                                                $(".iereusID").parents(".form-group").show();
                                                $(".metoikosID").parents(".form-group").show();
                                                $(".meisID").parents(".form-group").show();
                                                $(".eteID").parents(".form-group").show();
                                                $(".ethniqueDemotiqueID").parents(".form-group").show();

                                                $(".dateID").parents(".col-md-6").show();
                                            }
                                            if( 2 == categ ) {
                                                $(".fabricantID").parents(".form-group").hide();
                                                $(".eponymeID").parents(".form-group").hide();
                                                $(".moisID").parents(".form-group").hide();
                                                $(".autreLegendeID").parents(".form-group").hide();
                                                $(".formeID").parents(".form-group").hide();

                                                $(".cadreID").parents(".form-group").hide();
                                                $(".boutonID").parents(".form-group").hide();
                                                $(".grenetisID").parents(".form-group").hide();
                                                $(".ombilicID").parents(".form-group").hide();
                                                $(".separationID").parents(".form-group").hide();

                                                $(".legendeTournanteID").parents(".form-group").hide();
                                                $(".lettreRetrogradeID").parents(".form-group").hide();
                                                $(".lettreLunaireID").parents(".form-group").hide();

                                                $(".particulariteOrthographiqueID").parents(".form-group").hide();
                                                $(".retrogravureID").parents(".form-group").hide();

                                                $(".epiID").parents(".form-group").hide();
                                                $(".paraID").parents(".form-group").hide();
                                                $(".iereusID").parents(".form-group").hide();
                                                $(".metoikosID").parents(".form-group").hide();
                                                $(".meisID").parents(".form-group").hide();
                                                $(".eteID").parents(".form-group").hide();
                                                $(".ethniqueDemotiqueID").parents(".form-group").hide();

                                                $(".dateID").parents(".col-md-6").hide();

                                                $(".emblemeID").parents(".form-group").show();
                                                $(".positionID").parents(".form-group").show();
                                            }
                                            if( 3 == categ ) {
                                                changeCateg(2);
                                                $(".emblemeID").parents(".form-group").hide();
                                                $(".positionID").parents(".form-group").hide();
                                            }
                                        }
                                        $( document ).ready(function() {
                                            changeCateg( $(".categID option:selected").val() );
                                            //alert( "categ text = " + $(".categID option:selected").text() );
                                        });
                                    </script>
                                    ',
                ))
            ->end()
            ->tab('Divers')
                ->with('Timbre', array('class' => 'col-md-6'))
                    ->add('numero', null, array('attr' => array('class' => 'numeroID')))
                    ->add('referenceBibliographique', null, array('attr' => array('class' => 'referenceBibliographiqueID')))
                    ->add('lieuDeDecouverte', null, array('attr' => array('class' => 'lieuDeDecouverteID')))
                ->end()
                ->with('Date', array('class' => 'col-md-6'))
                    ->add('date', null, array('read_only' => true, 'attr' => array('class' => 'dateID')))
                ->end()
                ->with('Remarques', array('class' => 'col-md-6'))
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
                ->with('Divers', array('class' => 'col-md-6'))
                    ->add('public')
                    ->add('publication')
                    ->add('montrer_auteur')
                ->end()
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Fiche', array('class' => 'col-md-6'))
                ->add('id')
            ->end()
            ->with('Catégorie', array('class' => 'col-md-6'))
                ->add('categorie')
            ->end()
            ->with('Type', array('class' => 'col-md-6'))
                ->add('codeType')
                ->add('fabricant')
                ->add('eponyme')
                ->add('mois')
                ->add('autreLegende')
                ->add('forme')
                ->add('embleme')
            ->end()
            ->with('Matrice', array('class' => 'col-md-6'))
                ->add('codeMatrice')
                ->add('legende', 'html')
                ->add('bouton')
                ->add('grenetis')
                ->add('ombilic')
                ->add('legendeTournante')
                ->add('lettreRetrograde')
                ->add('lettreLunaire')
                ->add('epi')
                ->add('para')
                ->add('iereus')
                ->add('metoikos')
                ->add('meis')
                ->add('ete')
                ->add('particulariteOrthographique')
                ->add('retrogravure')
            ->end()
            ->with('Timbres', array('class' => 'col-md-6'))
                ->add('numero')
                ->add('referenceBibliographique')
                ->add('lieuDeDecouverte')
            ->end()
            ->with('Association', array('class' => 'col-md-6'))
            ->end()
            ->with('Date', array('class' => 'col-md-6'))
                ->add('date')
            ->end()
            ->with('Remarques', array('class' => 'col-md-6'))
                ->add('remarques', 'html')
            ->end()
            ->with('Divers', array('class' => 'col-md-6'))
                ->add('public')
                ->add('publication')
                ->add('montrer_auteur')
                ->add('creation_date')
                ->add('modification_date')
            ->end()
        ;
    }
}
