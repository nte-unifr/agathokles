<?php

namespace NTE\AgathoklesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use NTE\AgathoklesBundle\Entity\Lieu;

class LieuxAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('lat')
            ->add('lng')
            ->add('fiches')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Lieu', array('class' => 'col-md-12'))
                ->add('nom')
                ->add('lat', null, array('read_only' => false, 'attr' => array('class' => 'latID')))
                ->add('lng', null, array('read_only' => false, 'attr' => array('class' => 'lngID')))
                ->setHelps(array(
                    'nom' => "Utilisez la carte ci-dessous pour définir l'emplacement géographique du lieu.<div id=\"map\"></div>

                                <script type=\"text/javascript\">
                                    var lat;
                                    var lng;
                                    var marker;

                                    var map = L.map('map', {attributionControl: true}).setView([37.05, 7.16], 5);
                                    map.setMaxBounds([[59.689926, -9.239258], [25.363882, 46.538086]]);

                                    L.tileLayer('/agathokles/bundles/nteagathokles/maps/{z}/{x}/{y}.png', {
                                        maxZoom: 8,
                                        minZoom: 5,
                                        attribution: 'Carte: OpenStreetMap MapQuest',
                                    }).addTo(map);

                                    function onMapClick(e) {
                                        if ( null == marker ) {
                                            $('.latID').val(e.latlng['lat']);
                                            $('.lngID').val(e.latlng['lng']);

                                            marker = new L.marker(e.latlng, {draggable:'true'});
                                            marker.on('dragend', function(event){
                                                    var marker = event.target;
                                                    var position = marker.getLatLng();
                                                    $('.latID').val(position['lat']);
                                                    $('.lngID').val(position['lng']);
                                                    //alert(position);
                                            });
                                            map.addLayer(marker);
                                        }
                                    }

                                    map.on('click', onMapClick);

                                    $( document ).ready(function() {
                                        lat = $('.latID').val();
                                        lng = $('.lngID').val();
                                        //alert( 'lat = ' + lat + ' et lng = ' + lng );

                                        if ( '' != lat && '' != lng ) {
                                            //alert(lat + ' et ' + lng);
                                            marker = L.marker([lat, lng], {draggable:'true'}).addTo(map);
                                            var position = marker.getLatLng();
                                            marker.on('dragend', function(event){
                                                    var marker = event.target;
                                                    var position = marker.getLatLng();
                                                    //alert(position);
                                                    $('.latID').val(position['lat']);
                                                    $('.lngID').val(position['lng']);
                                            });
                                            var position = marker.getLatLng();
                                            map.setView([position['lat'], position['lng']], 5);
                                        }
                                    });
                                </script>
                                    ",
                ))
#            ->add('fiches')
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addidentifier('nom')
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
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
        ;
    }

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

}
