 /**
 * Funciones de GoogleMapHelper    /app/View/Helper/GooglemapHelper.php
 */
 
 //VARIABLES GLOBALES
 var markers = new Array(); // Marcadores unicos   administrales
 var markersIds = new Array(); //Ids de marcadores
 var oneMarkerId ; //Unico marcador
 var geocoder = new google.maps.Geocoder(); //Geocoder
 var bounds = new google.maps.LatLngBounds();  //Centrar el mapa
 var defaultZoom =10; //zoom default  
 var mapsIdArray = new Array(); //Arreglo de nombre de los ids de los mapas
 
 /**
 * Funcion Geocoder a partir de una direccion
 */
 function geocodeAddress(address, action, map,markerId, markerTitle, markerIcon, markerShadow, windowText) {
                geocoder.geocode( { 'address': address}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                      //alert(results[0].geometry.location);
                      if(action =='setCenter'){
                          setCenterMap(results[0].geometry.location);
                      }
                      if(action =='setMarker'){
                          setMarker(map,markerId,results[0].geometry.location,markerTitle, markerIcon, markerShadow,windowText);
                      }
                  } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                    return null;
                  }
                });
 }
            
 function geocodeOneAddress(address, action, map, markerTitle, markerIcon, markerShadow, windowText,txtLat,txtLong) {
               var ne = new google.maps.LatLng(20.559081300890256, -86.92335890606046);
               var sw = new google.maps.LatLng(20.255970171570105, -86.93159865215421);
                geocoder.geocode( { 'address': address}, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    //alert(results[0].geometry.location.lng());
                      if(action =='setCenter'){
                          setCenterMap(results[0].geometry.location);
                      }
                     // console.log(results);
                      if(action =='setMarker'){
                          setOneMarker(map,results[0].geometry.location,markerTitle, markerIcon, markerShadow,windowText);
                          map.setCenter(results[0].geometry.location)   ;
                          // setMarker('map_canvas','ID',results[0].geometry.location,markerTitle, markerIcon, markerShadow,windowText);
                          if(txtLat!=''){
                            document.getElementById(txtLat).value = results[0].geometry.location.lat();
                            document.getElementById(txtLong).value = results[0].geometry.location.lng();
                          }
                        
                      }
                  } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                    return null;
                  }
                });
 }
 
 /**
 * Agregar un marcador unico al mapa dado
 */
 function setMarker(map,id,position,title,icon,shadow,content){
                var index = markers.length;
                //markersIds[markersIds.length] = id;
                markers[index] = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: icon,
                    shadow: shadow,
                    title:title
                });
                 if(content != ''){
                     var infowindow = new google.maps.InfoWindow({
                        content: content
                    });
                     google.maps.event.addListener(markers[index], 'click', function() {
                        infowindow.open(map,markers[index]);
                    });
                }
                 /* Centrar el mapa con varios puntos  */   
                            
                bounds.extend(position);   
                map.fitBounds(bounds);                            
 }
 
 /**
 * Agregar varios marcadores administrados a traves de su id al mapa
 */
 function setReplaceMarker(map,id,position,title,icon,shadow,content,center){
                var index = markers.length;
               if (markersIds[id] != undefined){
                  markersIds[id].setPosition(position);//Actualizamos la posicion  
                  google.maps.event.clearListeners( markersIds[id], 'click');  //removemos el listener               
               }else{     
               // markersIds[id] = id; 
                  markersIds[id] = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: icon,
                    shadow: shadow,
                    title:title
                  });
                   
                }
                 if(content != ''){
                         //var 
                         google.maps.event.addListener(markersIds[id], 'click', function() {
                            infowindow = new google.maps.InfoWindow({
                              content: content
                            });
                            infowindow.open(map,markersIds[id]);
                        });
                  }
                  
                if(center != ''){ //Si  se pide que se centre en esa posicion se centra el mapa
                  if(map.getZoom()== defaultZoom){ //Si  es igual al zoom default entoces lo acercamos
                      map.setZoom(15);
                   }
                   map.setCenter(position)   ;
                  
                   
                }
                /* Centrar el mapa con varios puntos
                var bounds = new google.maps.LatLngBounds();
                bounds.extend(position);
                map.fitBounds(bounds);
                */

 }
/**
* Agregar un solo marcador
*/ 
 function setOneMarker(map,position,title,icon,shadow,content){

             //  oneMarkerId = id;
             if (oneMarkerId != undefined){
                oneMarkerId.setPosition(position);
                  google.maps.event.clearListeners(oneMarkerId, 'click');  //removemos el listener               
             }else{  
              oneMarkerId = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: icon,
                    shadow: shadow,
                    title:title
                });
               } 
                 if(content != ''){
                     var infowindow = new google.maps.InfoWindow({
                        content: content
                    });
                     google.maps.event.addListener(oneMarkerId, 'click', function() {
                        infowindow.open(map,oneMarkerId);
                    });
                }
 }
 
  //Borrar todos los puntos
  function clearMarkers(){
                 for(var i in  markersIds){
                    markersIds[i].setMap(null);
                 }
                 markersIds = new Array();    
  } 