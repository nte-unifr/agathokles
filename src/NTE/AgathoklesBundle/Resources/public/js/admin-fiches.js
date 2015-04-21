$( document ).ready(function() {
    if ( $( ".fiche-categorie" ).length ) {
        changeCateg($(".fiche-categorie option:selected").val());
        $(".fiche-categorie").change(function() {
            changeCateg(this.value);
        });
    }
});

function changeCateg( categ ) {
    var PRINCIPAL = 1;
    var SECONDAIRE = 2;
    var COMPLEMENTAIRE = 3;

    if( PRINCIPAL == categ ) {
        $(".fabricantID").parents(".form-group").show();
        $(".eponymeID").parents(".form-group").show();
        $(".moisID").parents(".form-group").show();
        $(".fabIdIncID").parents(".form-group").show();
        $(".epoIdIncID").parents(".form-group").show();
        $(".moisIdIncID").parents(".form-group").show();
        $(".autreLegendeID").parents(".form-group").show();
        $(".formeID").parents(".form-group").show();
        $(".emblemeID").parents(".form-group").show();
        $(".designationID").parents(".form-group").hide();

        $(".positionID").parents(".form-group").hide();
        $(".cadreID").parents(".form-group").show();
        $(".boutonID").parents(".form-group").show();
        $(".grenetisID").parents(".form-group").show();
        $(".ombilicID").parents(".form-group").show();
        $(".separationID").parents(".form-group").show();

        $(".legendeTournanteID").parents(".form-group").show();
        $(".legendeRetrogradeID").parents(".form-group").show();
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
    if( SECONDAIRE == categ ) {
        $(".fabricantID").parents(".form-group").hide();
        $(".eponymeID").parents(".form-group").hide();
        $(".moisID").parents(".form-group").hide();
        $(".fabIdIncID").parents(".form-group").hide();
        $(".epoIdIncID").parents(".form-group").hide();
        $(".moisIdIncID").parents(".form-group").hide();
        $(".autreLegendeID").parents(".form-group").hide();
        $(".formeID").parents(".form-group").show();
        $(".designationID").parents(".form-group").show();

        $(".cadreID").parents(".form-group").hide();
        $(".boutonID").parents(".form-group").hide();
        $(".grenetisID").parents(".form-group").hide();
        $(".ombilicID").parents(".form-group").hide();
        $(".separationID").parents(".form-group").hide();

        $(".legendeTournanteID").parents(".form-group").hide();
        $(".legendeRetrogradeID").parents(".form-group").hide();
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
    if( COMPLEMENTAIRE == categ ) {
        changeCateg(SECONDAIRE);
        $(".emblemeID").parents(".form-group").hide();
        $(".positionID").parents(".form-group").hide();
        $(".designationID").parents(".form-group").hide();
    }
}
