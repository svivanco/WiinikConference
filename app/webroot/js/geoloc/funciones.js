/**
* Archivo de funciones particulares para el proyecto
*/

//Variables globales
 var markerArray = [];  //Arreglo de marcadores para una ruta (usado en funciones para rutas en un panel)
 var infowindowArray = []; //Arreglo de Ventanas de informacion  (usado en funciones para rutas en un panel)   
 var markersRutasIds = new Array();//Markers de varias rutas
 var markersRutasMMIds = new Array(); //Markers de varios mapas
 var infowindowRutasArray = new Array(); //Arreglo de infowindow de los markersRutasIds
 var infowindowRutasMMArray = new Array(); //Arreglo de infowindow de los de  markersRutasMMIds
// Ciudades disponibles para la ubacion en google en las notificaciones
 var ciudadesBuscar = ['CHETUMAL','BACALAR','JOS\xc9 MAR\xcdA MORELOS','JOSE MARIA MORELOS','TULUM','PUERTO MORELOS','ALFREDO V. BONFIL','CANC\xdaN','CANCUN','PLAYA DEL CARMEN','COZUMEL','FELIPE CARRILLO PUERTO','KANTUNILK\xcdN','CALDERITAS','HOLBOX','CHUNHUHUB','TIHOSUCO']; 

/**
 * Muestra o oculta un marker basado en el id del actuario
 */
 function show_hide_marker(actuario_id){
       //ocultar/mostrar los puntos de la ruta
         for (var i=0; i<markersRutasIds.length; i++) {
           if (markersRutasIds[i] != undefined){
               if(markersRutasIds[i].actuario_id==actuario_id){
                  //  markersRutasIds[i].setVisible(!markersRutasIds[i].getVisible());
                  markersRutasIds[i].setVisible(true); 
               }else{
                     markersRutasIds[i].setVisible(false);
               }
             // $("#consola").append(markersRutasIds[i].actuario_id+', ');
          }
        }
         return false;
 }  
  
/**
* Agregar un marcador para una ruta dada
*/
    function setMarkersRuta(map,id,position,title,icon,shadow,content,actuario_id){
                var index = markers.length;
               if (markersRutasIds[id] != undefined){
                  markersRutasIds[id].setIcon(icon);//Actualizamos el icono  
                  markersRutasIds[id].setTitle(title);//Actualizamos  el titulo  
                  google.maps.event.clearListeners( markersRutasIds[id], 'click');  //removemos el listener      
                  
               }else{                           
                  markersRutasIds[id] = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: icon,
                    shadow: shadow,
                    title:title
                  });
                 markersRutasIds[id].actuario_id = actuario_id;   
                }
                 if(content != ''){
                         //var 
                         infowindow = new google.maps.InfoWindow({  content: content    });
                            infowindowRutasArray[id] = infowindow;
                         google.maps.event.addListener(markersRutasIds[id], 'click', function() {                            
                            infowindowRutasArray[id].open(map,markersRutasIds[id]);
                        });
                  }                   
                
    }
/**
* Agregar un marcadorpara la ruta dada en multiples mapas
* map es un arreglo de mapas dados para poner el mismo punto
*/
    function setMarkersRutaMultiMap(map,mapName,id,position,title,icon,shadow,content,actuario_id){
                var index = markers.length;
               if (markersRutasMMIds[mapName][id] != undefined){
                  markersRutasMMIds[mapName][id].setIcon(icon);//Actualizamos el icono  
                  markersRutasMMIds[mapName][id].setTitle(title);//Actualizamos  el titulo  
                  google.maps.event.clearListeners( markersRutasIds[id], 'click');  //removemos el listener      
                  
               }else{                           
                  markersRutasMMIds[mapName][id] = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: icon,
                    shadow: shadow,
                    title:title
                  });
                 markersRutasMMIds[mapName][id].actuario_id = actuario_id;   
                }
                 if(content != ''){
                         //var 
                         infowindow = new google.maps.InfoWindow({  content: content    });
                            infowindowRutasMMArray[id] = infowindow;
                         google.maps.event.addListener(markersRutasMMIds[mapName][id], 'click', function() {                            
                            infowindowRutasMMArray[id].open(map,markersRutasMMIds[mapName][id]);
                        });
                  }                   
                
    } 
 /**
 * Desplegar la burbuja de informacion del marker   
 */
  function showInfoMarkersRuta(id){     
         infowindowRutasArray[id].open(map_canvas,  markersRutasIds[id]);
  }     
  
/**************************************************************************************************************************************************+
* FUNCIONES PARA VER LAS RUTAS EN UN PANEL  
*/

/**
 * Funcion  que dibuja el manel en el id dado
 * CurrentDiretions es el response de un DiectionService.route
 * panel es un objeto que cotine como atributos : LatInicio,LongInicio, nombreInicio, imgInicio,imgFinal, nombreFinal
 * id es el id del  objeto a actualizar
 */
  function panel(currentDirections,panel,id){
       var mystr = '<table border="0" cellspacing="5" cellpadding="0">';
                mystr += '<tr><td><div class="od_ruta"><table border="0" cellspacing="5" cellpadding="0"><tr onclick=muestraod('+panel.LatInicio+','+panel.LongInicio+')><td width="43px"><img src="http://google-maps-icons.googlecode.com/files/home.png" border="0" width="22px" height="22px" /></td>';
                mystr += '<td>'+panel.nombreInicio+'</td></tr></table></div></td></tr>'; 
                mystr += '<tr><td><div align="right">Recorrido total: ' + currentDirections.routes[0].legs[0].distance.text + ' - aproximadamente ' + currentDirections.routes[0].legs[0].duration.text + '</div></td></tr>';
                
                mystr += '<tr><td><div class="fondo_tabla_direcciones"><table class="tabla_direcciones" border="0" cellspacing="2" cellpadding="2">';
                
                for (var i = 0; i < currentDirections.routes[0].legs[0].steps.length; i++) {
                  mystr += '<tr onclick=muestranodo('+i+','+currentDirections.routes[0].legs[0].steps[i].start_point.lat()+','+currentDirections.routes[0].legs[0].steps[i].start_point.lng()+')><td width="14px">' + (i+1) + '. </td><td>' + currentDirections.routes[0].legs[0].steps[i].instructions + '</td><td width="38px"><strong>' + currentDirections.routes[0].legs[0].steps[i].distance.text + '</strong></td></tr>';
                //  mystr += '<tr ><td width="14px">' + (i+1) + '. </td><td>' + currentDirections.routes[0].legs[0].steps[i].instructions + '</td><td width="38px"><strong>' + currentDirections.routes[0].legs[0].steps[i].distance.text + '</strong></td></tr>';
                }
                mystr += '</table></div></td></tr>';

                mystr += '<tr><td><div class="od_ruta"><table border="0" cellspacing="5" cellpadding="0"><tr onclick=muestraod('+currentDirections.routes[0].legs[0].end_location.lat()+','+currentDirections.routes[0].legs[0].end_location.lng()+')><td width="43px"><img src="'+panel.imgFinal+'" border="0" width="22px" height="22px" /></td><td>'+panel.nombreFinal+'</td></tr></table></div></td></tr></table>';
    $("#"+id).html(mystr);  
    
           for (var i = 0; i < currentDirections.routes[0].legs[0].steps.length; i++)
            {
                var marker = new google.maps.Marker({
                    position: currentDirections.routes[0].legs[0].steps[i].start_point,
                    map: map_canvas,
                    //icon: iconos_ruta.informacion,
                    //shadow: iconos_ruta.informacion_sombra
                });
                markerArray[i] = marker;
                attachInstructionText(marker, currentDirections.routes[0].legs[0].steps[i].instructions,i,currentDirections.routes[0].legs[0].end_location);
            }        
  }


/**
* muestra un nodo al hacer clic sobre el TD
*/
 function muestranodo(id,y,x)
{   
    for (i = 0; i < infowindowArray.length; i++) {
            infowindowArray[i].close();
    }
   // map_canvas.clearMarkers();
    infowindowArray[id].open(map_canvas, markerArray[id]);
        map_canvas.setCenter(new google.maps.LatLng(y, x));
        map_canvas.setZoom(18);
        
}

/**
* Muestra la posicion del punto final/inicial al hacer  clic sobre un td
*/
function muestraod(y,x)
{
  
    for (i = 0; i < infowindowArray.length; i++) {
             infowindowArray[i].close();
    }
        map_canvas.setCenter(new google.maps.LatLng(y, x));
        map_canvas.setZoom(18);
    
}

/**
* Agrega una ventana de informacion para cada marker
*/
function attachInstructionText(marker, text,num_marcador,pos_final) {

      // Create the infowindow with two DIV placeholders
      // One for a text string, the other for the StreetView panorama.
      
      
      var content = document.createElement("DIV");
      var title = document.createElement("DIV");
      title.innerHTML = '<span style="font-family: Arial, Helvetica, sans-serif">'+text+'</span>';
      content.appendChild(title);
      var streetview = document.createElement("DIV");
      streetview.style.width = "350px";
      streetview.style.height = "200px";
      content.appendChild(streetview);
      
      /*
      var content = document.createElement("DIV")
      
      var title = document.createElement("DIV");
      title.innerHTML = '<div class="titulo_infowindow">'+text+'</div>';
      content.appendChild(title);
      
      var streetview = document.createElement("DIV");
      
      //streetview.style.width = "350px";
      //streetview.style.height = "200px";
      streetview.innerHTML = '<div class="streetview_infowindow"></div>';
      content.appendChild(streetview);
      */
      
      var infowindow = new google.maps.InfoWindow({
        content: content
      });
      infowindowArray[num_marcador] = infowindow;

      google.maps.event.addListener(marker, 'click', function() {
            for (i = 0; i < infowindowArray.length; i++) {
                     infowindowArray[i].close();
            }
          //stepDisplay.setContent(content);
          //stepDisplay.open(map, marker);
          infowindow.open(map_canvas, marker);
      }); 

      
      google.maps.event.addListener(infowindow,'closeclick', function() { 
                    map_canvas.getStreetView().setVisible(false);
                    map_canvas.setStreetView(null);
      });

       
      // Handle the DOM ready event to create the StreetView panorama
      // as it can only be created once the DIV inside the infowindow is loaded in the DOM.
      google.maps.event.addListenerOnce(infowindow, "domready", function() {
        
        var panorama = new google.maps.StreetViewPanorama(streetview, {
            navigationControl: false,
            enableCloseButton: false,
            addressControl: false,
            linksControl: true,
            visible: true,
            streetViewControl: false,
            position: marker.getPosition()
        });
        
        map_canvas.setStreetView(panorama);
        
            var markerPanoramaFinRuta = new google.maps.Marker({
                position: pos_final,
                draggable: false,
                map: panorama,
               // icon: '',
                //shadow: iconos_ruta.sombra,
                clickable: true
            });
       
      });

}

/**
* Remover acentos
* 
* @param str
* 
* @returns {String}
*/
 function remove_accent(str) {
     var map={'À':'A','Á':'A','Ç':'C','È':'E','É':'E','Ì':'I','Í':'I','Ò':'O','Ó':'O','Ù':'U','Ú':'U'};
     var res='';
     for (var i=0;i<str.length;i++){
         c=str.charAt(i);
         res+=map[c]||c;
         console.log(map[c]);
     }
     return res;
 }
 
 var normalize = (function() {
  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
      from ="ÁÉÍÓÚáéíóú";
      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
      to = "AEIOUaeiou";
      mapping = {};
 
  for(var i = 0, j = from.length; i < j; i++ ){
      mapping[ from.charAt( i ) ] = to.charAt( i );
     //console.log( mapping[ from.charAt( i ) ]); 
  }
  return function( str ) {
      var ret = [];
      for( var i = 0, j = str.length; i < j; i++ ) {
          var c = str.charAt( i );
          console.log(c);
          if( mapping.hasOwnProperty( str.charAt( i ) ) )
              ret.push( mapping[ c ] ); 
          else
              ret.push( c );
      }
      return ret.join( '' );
  }
 
})(); 

/**
* Obtiene solo el nombre de la ciudadm cuando se incluye el mpio separado por comas
* 
* @param ciudadSrch
*/
function nombreCiudad(ciudadSrch){
      if( ciudadSrch.indexOf( "," ) !== -1 ){    
      var arrCiudad = ciudadSrch.toUpperCase().split(',');  
       var ciudad = arrCiudad[0];
     }else{
         var ciudad = ciudadSrch;
     }
   return ciudad;  
}   