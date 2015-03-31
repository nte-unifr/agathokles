$(document).ready(function() {

    $("#toggle").click(function () {
        $("#panier").toggle();
    });

});

function addToBasket(id) {
    var url = document.URL;
    var title = document.getElementById("title").innerHTML;
    var image = '';
    var image_thumb = '';
    var image_ppt = '';
    var image_originale = '';
    if ( null != document.getElementById("image_principale") ) {
        image = document.getElementById("image_principale").src;
    }
    if ( null != document.getElementById("image_thumb") ) {
        image_thumb = document.getElementById("image_thumb").src;
    }
    if ( null != document.getElementById("img_ppt") ) {
        image_ppt = document.getElementById("img_ppt").href;
    }
    if ( null != document.getElementById("img_original") ) {
        image_originale = document.getElementById("img_original").href;
    }

    var images = [];
    for(var i = 1; i < 10; i++) {
        elt = $('#gallery_img_'+i);
        if ( elt.length ) {
            images[i] = [elt.attr('data-image'), elt.attr('data-zoom-image'), $('#gallery_thumb_'+i).attr('src')];
        }
    }

    var legende = document.getElementById("legende").innerHTML;
    var date = document.getElementById("date").innerHTML;
    var data = {"url": url, "title": title, "image": image, "legende": legende, "image": image, "image_originale": image_originale, "images": images, "date": date};
    $.jStorage.set(id, data);
    displayBasket();
}

function emptyBasket() {
    var conf = confirm("Êtes-vous sur·e de vouloir effacer le panier ?");
    if (conf) {
        $.jStorage.flush();
        document.getElementById("panier-body").innerHTML = "<div class=\"selection\"><ul>Aucune sélection pour l'instant</ul></div>";
    }
}

function removeItem(id) {
    var conf = confirm("Êtes-vous sur·e de vouloir supprimer cette fiche du panier ?");
    if (conf) {
        $.jStorage.deleteKey(id);
        displayBasket();
        var url = location.pathname.split("/");
        var id = url[url.length -1];
        if (!$.jStorage.get(id)) {
            $("#memory").show();
            $("#no-memory").hide();
        }
    }
}

function displayBasket() {
    var index = $.jStorage.index();
    var content = "<div class=\"selection\"><ul>";
    var selection = "";
    for(i=0;i<index.length;i++) {
        var title = $.jStorage.get(index[i]);
        selection += '<li><a href="'+title['url']+'">'+title['title']+'</a> <a href="#" onclick="removeItem('+index[i]+');"><img src="../bundles/nteagathokles/images/icons/delete.png" alt="Supprimer"></a></li>';
    }
    selection += "</ul><br />"+'<div class="row"><div class="col-md-4 offset2"><button type="button" class="btn btn-primary" onclick="javascript:emptyBasket()">Effacer le panier</a></button></div>';
    if(index.length > 0) {
        content += selection;
    } else {
        content += "Aucune sélection pour l'instant</ul>";
    }
    content_mail = localStorage.getItem('jStorage');
    // version imprimable
    content += '</div>';
    content += "</div>";
    document.getElementById("panier-body").innerHTML = content;
    document.getElementById("form_message").innerHTML = content_mail;
    document.getElementById("form_message2").innerHTML = content_mail;

    var url = location.pathname.split("/");
    var id = url[url.length -1];
    if ($.jStorage.get(id)) {
        $("#memory").hide();
        $("#no-memory").show();
    }
}

function displayList() {
    var index = $.jStorage.index();
    var content = "<h1>Liste de selection</h1>";
    for(i=0;i<index.length;i++) {
        var obj = $.jStorage.get(index[i]);
        image = obj['image'];
        image_originale = obj['image_originale'];
        images = obj['images'];
        content += "<hr />\
                <div class=\"row\"><div class=\"col-md-7\">\
                    <img src=\""+image+"\" id=\"image_principale"+i+"\" data-zoom-image=\""+image_originale+"\" with=\"100%\" class=\"img-thumbnail\" />\
                    <p>\
                        <br>\
                        <a href=\""+image+"\" onclick=\"popwindow('"+image+"', 'image_principale');return false;\" class=\"btn btn-xs btn-primary\" id=\"img_ppt"+i+"\"><span class=\"glyphicon glyphicon-download-alt\" aria-hidden=\"true\"></span> PPT</a>\
                        &nbsp;\
                        <a href=\""+image_originale+"\" onclick=\"popwindow('"+image_originale+"', 'image_principale');return false;\" class=\"btn btn-xs btn-primary\" id=\"img_original"+i+"\"><span class=\"glyphicon glyphicon-download-alt\" aria-hidden=\"true\"></span> Original</a>\
                    </p>\
                </div>\
                <div class=\"col-md-5\">\
                    <h4><a href=\""+obj['url']+"\">"+obj['title']+"</a></h4><p><dt>Légende</dt></p><pre class=\"bg-primary\"><strong>"+obj['legende']+"</strong></pre>\
                        ";
        content += "<div id=\"gallery"+i+"\">";
        for(j=0;j<images.length;j++) {
            if ( null != images[j] ){
                content += "<a class=\"elevatezoom-gallery active\" data-zoom-image=\""+images[j][1]+"\" data-image=\""+images[j][0]+"\" href=\"#\" onclick=\"change_img('"+images[j][0]+"', '"+images[j][1]+"', "+i+");\"><img src=\""+images[j][2]+"\" height=\"50\"></a>";
            }
        }
        content += "</div>\
                    <script>\
                        $('#image_principale"+i+"').elevateZoom({ gallery : 'gallery"+i+"', galleryActiveClass: 'active', cursor: 'crosshair', zoomWindowFadeIn: 500, zoomWindowFadeOut: 750, zoomWindowPosition: 5, responsive: true, scrollZoom : true,\
                        });\
                    </script>\
                    </div>\
                </div>\
        ";
    }

    document.write(content+'<div style="height: 400px;"></div>');
}

function sendMail() {
    var body = 'Votre sélection Agathokles:%0D%0A%0D%0A';
    var index = $.jStorage.index();
    for(i=0;i<index.length;i++) {
        var title = $.jStorage.get(index[i]);
        body += title['title']+'%0D%0A'+title['url']+'%0D%0A%0D%0A';
    }
    var link = "mailto:"
             + "?subject=Votre sélection Agathokles"
             + "&body=" + body
    ;
    window.location.href = link;
}
