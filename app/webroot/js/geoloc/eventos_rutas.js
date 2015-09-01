//Funciones que se cargan en el evento ready
var actuario_id =0; //Id del actuario (global)
var actuarios = null; // Json de actuarios con sus ubicaciones y descripciones (actualizado en get_mapa.ctp)
var loaded = 0; //Se pone a 1 cuando se termina de cargar toda la pagina
var boxes = new Array(); // Array de LatLong de routerboxer
var boxes2 = new Array(); // Array de LatLong de routerboxer parra la segunda parte de las rutas
var boxpolys = null;    //Poligonos de routerbexer
var routeBoxer = null; //Objeto router boxer
var distanciaRBoxer = '0.1'; //Distancia desde la ruta hacia el exterior   
var directionsService = new google.maps.DirectionsService();// Google  servicio de rutas
var i = 0;  
var mapaFocus ='map_canvas'; //En que mapa se tiene el focus
var ulrIconos ='/signo/img/iconos/numeros/' ; //Url donde se ubican los iconos de los puntos

 routeBoxer = new RouteBoxer(); //Objeto RouterBoxer para crear poligonos sobre las rutas dadas
  
   
   


/**
* Hacer las rutas en el mapa y dibujarlas
* @rutas json de las rutas
* @mapa id del mapa
*/
function rutasMapa(rutas,mapa){
     $.each(rutas, function()
     {
        
           //Markers incial  y final
           var origen = new google.maps.LatLng(this.origen.latitud,this.origen.longitud); //Central de actuarios
           var destino = new google.maps.LatLng(this.destino.latitud,this.destino.longitud); //Ultimo punto
           var color = this.color;
           var actuario_id =this.actuario_id;
           var ruta_id = this.ruta_id;
           var origenOrdenVisita = this.origen.orden_visita;
           var origenDescripcion =  this.origen.descripcion;
           var ultimoPunto = null;
           i++;
                
         
           var waypts = []; //Puntos intermedios o hitos
           var waypts2 = []; //Puntos intermedios o hitos si se pasan de 9
           var contHitos = 1;
           //console.log('Total Hitos: '+this.hitos.length + ' Actuario Id ' +actuario_id);
            $.each(this.hitos, function()
             {
               if(contHitos<9){ // para no revasar el serivcio de google
                 var wayppos = new google.maps.LatLng(this.latitud,this.longitud);
                 waypts.push({
                    location: wayppos,
                    stopover:true
                  });
               }else if( contHitos==9){ // Este Sera el destino final si la ruta tiene mas de 8 hitos
                   ultimoPunto = destino;
                   destino = new google.maps.LatLng(this.latitud,this.longitud);// EL ultimo punto es el noveno HITO                    
               }
               if(contHitos>9){//Los hitos extras                      
                   var wayppos = new google.maps.LatLng(this.latitud,this.longitud);
                 waypts2.push({
                    location: wayppos,
                    stopover:true
                  });
               }
               
               //console.log('Hito No:'+contHitos);       
               contHitos= contHitos+1; 
               if(contHitos>18){
                   return false; //Limitante hasta 18 notificaciones mas la central
               }                
             });   
            
          
          //directionsDisplay.setPanel(document.getElementById("directionsPanel"));
        
          var request = {
            origin: origen,
            destination: destino,
            waypoints: waypts, 
            travelMode: google.maps.TravelMode.DRIVING,
           // preserveViewport: false
          //  optimizeWaypoints :true
          };
          GdirectionService(request,color,origenOrdenVisita,origen,origenDescripcion,mapa,actuario_id,1); //llamamos al serviico de google
          
       if(ultimoPunto!=null){ 
             var request2 = {
                origin: destino,
                destination: ultimoPunto,
                waypoints: waypts2, 
                travelMode: google.maps.TravelMode.DRIVING,
              //   preserveViewport: false
              //  optimizeWaypoints :true
              };
             GdirectionService(request2,color,origenOrdenVisita,origen,origenDescripcion,mapa,actuario_id,2); //llamamos al serviico de google  
       }     
          
     });
    
    
}
/**
* Funcion para el Direction Service de Google
* 
* @param request   objeto request de google
* @param color color de la linea de la ruta
* @param origenOrdenVisita   No. de orden del punto inicial de la ruta
* @param origen Lat y Long del origne de la ruta
* @param origenDescripcion Descripcion del origen de la ruta (va en un window box)                     
* @param mapa mapa donde se pondran las rutas
* @param actuario_id id del actuario a la cual perteneces la ruta
*/
function GdirectionService(request,color,origenOrdenVisita,origen,origenDescripcion,mapa,actuario_id,no_request)  {
     directionsDisplay = new google.maps.DirectionsRenderer();                    
     
       directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
               var polylineOptionsActual = {
                  strokeColor: '#'+color,
                  strokeOpacity: 1.0,
                  strokeWeight: 3
                  };             
               // directionsDisplay = new google.maps.DirectionsRenderer();  
                if (mapa instanceof Array) {//Si es un arreglo de mapas
                     for(var indice in mapa) {
                        // console.log(indice);
                        //preserveViewport: true, conserva la ubicacion del mapa.
                         directionsDisplay[indice] = new google.maps.DirectionsRenderer({suppressMarkers: true, polylineOptions: polylineOptionsActual,preserveViewport:true});
                         directionsDisplay[indice].setMap(mapa[indice]);                 
                         directionsDisplay[indice].setDirections(response);           
                         // var icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+origenOrdenVisita+'|f9f90c|000000' ;
                          var icon ={
                           url: ulrIconos+'central.png',
                            size: new google.maps.Size(27, 31),
                            origin: new google.maps.Point(0, 0),
                            //anchor: new google.maps.Point(0, 23),
                            scaledSize: new google.maps.Size(27, 31)

                           }
                          setMarker(mapa[indice],'inicial',origen,'Inicio',icon,'',origenDescripcion);//Central
                     }
                }else{ //Es el objeto del mapa en si
                     directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true, polylineOptions: polylineOptionsActual});
                     directionsDisplay.setMap(mapa);                 
                     directionsDisplay.setDirections(response);  
                     // var icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+origenOrdenVisita+'|f9f90c|000000' ;
                     var icon ={
                           url: ulrIconos+'central.png',
                            size: new google.maps.Size(27, 31),
                            origin: new google.maps.Point(0, 0),
                            //anchor: new google.maps.Point(0, 23),
                            scaledSize: new google.maps.Size(27, 31)

                           }
                           setMarker(mapa,'inicial',origen,'Inicio',icon,'',origenDescripcion);   //CENTRAL      
                }   
                 // Box around the overview path of the first route
              var path = response.routes[0].overview_path;                    
                 
               if(no_request==1){//Si es nuevo elemento
                  //boxes[actuario_id]  = new Array();
                  //console.log("Rutas actuario Id "+ actuario_id );
                 // boxes[actuario_id].concat(routeBoxer.box(path, distanciaRBoxer));//20130608 para que pueda soportar el calculo de rutas multiples
                  boxes[actuario_id] = routeBoxer.box(path, distanciaRBoxer);
               }else{   
                  boxes2[actuario_id]=routeBoxer.box(path, distanciaRBoxer);//20130608 para que pueda soportar el calculo de rutas multiples
                // $("#consolaMsg").append( ' Push sobre actuario id '+ actuario_id);
               }
             // console.log('id: '+actuario_id);                       
            }else{
              //  alert('algo salio mal al crear las rutas:' + status );
                //console.log(google.maps.DirectionsStatus);
                console.log(' algo salio mal, REF actuario_id: '+actuario_id +' , ruta_id: '+ ruta_id + ' , Status: ' + status);     
                 $("#consolaMsg").append(' algo salio mal, REF actuario_id: '+actuario_id +' , ruta_id: '+ ruta_id + ' , Status: ' + status);                
            }
          });
}

 /**
 * Dibujar puuntos de una ruta sobre un mapa dado
 * @rutas json con el contenido de las rutas
 * @mapa id del mapa a desplegar
 */
function puntosRuta(rutas, mapa){     
      /// if(typeof(puntosUnicos)==='undefined') puntosUnicos = false;
   // var restults = function(rutas){      
         $.each(rutas, function()
     {
        // $("#consola").append(this.puntos.latitud +', ');
        //console.log(this.puntos);
          var posicion = new google.maps.LatLng(this.puntos.latitud,this.puntos.longitud);    
          if(this.puntos.status==2){
             var color = this.puntos.color;      
             var fontColor = '000000';   
             var chst = 'd_map_pin_letter';
             var pin_style =''   ;
             var star_fill_color='';
          }else{
              var Xcolor = $.xcolor.opacity(this.puntos.color, 'lightgrey', '0.65'); //Establecemos colores mas opacos para los puntos ya cubiertos
              var color =Xcolor.getHex().replace('#', ''); 
              var fontColor = '4a2230';
              var chst = 'd_map_xpin_letter';
              var pin_style ='pin_star|'
              var star_fill_color='|'+this.puntos.color;
          }       
         //icon = 'http://chart.apis.google.com/chart?chst='+chst+'&chld='+pin_style+this.puntos.orden_visita+'|'+color+'|' + fontColor+star_fill_color ;  
             
         //Cambio 20130608 iconos ahora son desde archivos no se generan en la api de google pues esta a punto de ser dadda de baja
          if(this.puntos.status==2){              
            urlImg =ulrIconos+this.puntos.color+'/number_'+this.puntos.orden_visita+'.png';
          }else{
            urlImg =ulrIconos+this.puntos.color+'/notificado/number_'+this.puntos.orden_visita+'.png';
          }
          if(this.puntos.orden_visita<=0){  //si es un error
            urlImg =ulrIconos+'number_-1.png';  
          }
            var icon ={
                url: urlImg,
                //size: new google.maps.Size(27, 31),
                origin: new google.maps.Point(0, 0),
                //anchor: new google.maps.Point(0, 23),
                scaledSize: new google.maps.Size(28, 32)
            }
             if (mapa instanceof Array) {//Si es un arreglo de mapas
                     for(var indice in mapa) {
                         setMarkersRuta(mapa[indice],indice+this.puntos.id,posicion,this.puntos.titulo,icon,'',this.puntos.descripcion,this.puntos.actuario_id);    
                     }
             }else{           
                 setMarkersRuta(mapa,this.puntos.id,posicion,this.puntos.titulo,icon,'',this.puntos.descripcion,this.puntos.actuario_id);    
             }
          //setMarkersRutaMultiMap(mapa,mapa,this.puntos.id,posicion,this.puntos.titulo,icon,'',this.puntos.descripcion,this.puntos.actuario_id);    

     });   
      //};;
  };


  
/**
* Funcion que se llama al dar clic sobre el acordion de actuarios
*/
function triggerSelect(id){
    actuario_id = id;
    callMapa();    
}

/**
* SE llama cuando se selecciona un elemendot del dropbox actuario_id
*/
function callSelected(id){
       if(id ==undefined){
           actuario_id =  $("#actuario_id option:selected").val();
       }else{
            actuario_id = id; 
       }   
       //Si se llamo a ver todos de nuevo cargamos todo el mapa
        if(actuario_id==''){
           document.location.reload(true);            
       }else{
        $(".actuarios").hide();
        $("#actuario_"+actuario_id).show();  //Mostramos el bloque seleccionado        
        callMapa();
        $("#accordion-actuario").accordion( "resize" );
         $("#accordion-actuario").accordion({
             header: 'h5',
             active: false,
            collapsible: true  //,
           // autoHeight: false 
         }); //Acordion de los actuarios
       }
       /*
       if($("#actuario_id option:selected").val()==''){
           document.location.reload(true);            
       }else{
        $(".actuarios").hide();
        $("#actuario_"+$("#actuario_id option:selected").val()).show();  //Mostramos el bloque seleccionado 
        actuario_id = $("#actuario_id option:selected").val();
        callMapa();
        $("#accordion-actuario").accordion( "resize" );
         $("#accordion-actuario").accordion({
             header: 'h5',
             active: false,
            collapsible: true  //,
           // autoHeight: false 
         }); //Acordion de los actuarios
       }
       */
}
function callSelected2(id){
       if(id ==undefined){
           actuario_id =  $("#actuario_id option:selected").val();
       }else{
            actuario_id = id; 
       }   
       //Si se llamo a ver todos de nuevo cargamos todo el mapa
        if(actuario_id==''){
           document.location.reload(true);            
       }else{
        $(".actuarios").hide();
        $("#actuario_"+actuario_id).show();  //Mostramos el bloque seleccionado      
     
        $("#accordion-actuario").accordion( "resize" );
         $("#accordion-actuario").accordion({
             header: 'h5',
             active: false,
            collapsible: true  //,
           // autoHeight: false 
         }); //Acordion de los actuarios
       }
     
}

/**
* Hace zoom sobre un nodo de la ruta
*/
function muetraNodoRuta(id,x,y,map){
     //  alert ('x: '+x+', y: '+y);
       map.setCenter(new google.maps.LatLng(x,y));
       showInfoMarkersRuta(id);//Mostramos la burbuja de informacion
      //  map_canvas.setZoom(18);
}

/**
* Establecemos la ubicacion del mapa y ocultamos el dialog   MM
*/
function setUbicacionMapa(latitud,longitud,zoom,map,dialogId){
    setUbicacion(latitud,longitud,zoom,map);
    $("#"+dialogId).dialog("close");
    return false;
}
/**
* Establecemos la ubicacikon y el zoom en un punto determinado del mapa
*/
function setUbicacion(latitud,longitud, zoom,map){
    map.setCenter(new google.maps.LatLng(latitud,longitud));
    map.setZoom(zoom);
  //  console.log('ubicacion');

}
/**
* Verifica si un actuario esta sobrte su ruta si no lo esta entonces mandamos a llamar a una notificacion
*/
function actuarioSobreRuta(urlServer){
    var evento;
    if(actuarios!=null &&  boxes.length >0){//Si hay un actuario definido y las rutas definidas
      $.each(actuarios, function()
     {  
         if(boxesContains(this.latitud,this.longitud,this.actuario_id)==false){
             //console.log(this.nombre_completo+' ID. '+this.actuario_id +' Fuera de ruta');
            if(loaded == 1 ){ //Mostramos la notificaciones y ALMACENAMOS en la BD el evento por medio de requeste de ajax
              evento = this.nombre_completo+' fuera de ruta';           
              var notyActuarios = noty({text: evento ,layout:'topRight',type:'warning', timeout:10000, dismissQueue: true}); 
              //Guardamos la informacion
              //obtenemos el id de la ruta del actuario.
              ruta_id = 0;
              actuario_id_ruta =  this.actuario_id;
               $.each(rutas, function()   //Buscamos la ruta del actuario para guardarla en el historico
               {
                  if(this.actuario_id == actuario_id_ruta){
                      ruta_id = this.ruta_id;
                      //console.log(  '- ruta '+ this.ruta_id + ' , actuario_id '+actuario_id_ruta);
                  } 
               });
              var datos  = {};   //Objeto del data
              datos.actuario_id =this.actuario_id; 
              datos.evento = evento;
              datos.latitud = this.latitud;
              datos.longitud = this.longitud;
              datos.ruta_id = ruta_id;
              saveEvento(urlServer,datos);
            }       
         }
         
     });
    }
   
    
}

//Guardamos eventos en el servidor para futura inspeccion
function saveEvento(urlServer,datos){  
      $.ajax({
        async:true, 
        type:'GET', 
        url:urlServer, //Url destino para guardar
        data:datos, //Tipo ({actuario_id :1,texto:'Texto ejemplo'})
         cache:false
        });/*.done(function( msg ) {
            alert( "Data Saved: " + msg );
            });;    */
}

/**
 * The HomeControl adds a control to the map
 * the control DIV as an argument.
 * @parametros id del div, mapa, id del dialog
 */

function HomeControl(controlDiv, map,dialogId,imgUrl) {
    if(typeof imgUrl == 'undefined')  imgUrl = '../img/'  
    
   
  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map.
  controlDiv.style.padding = '5px';

  // Set CSS for the control border.
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = 'Transparent';
  controlUI.style.borderStyle = 'solid';
  //controlUI.style.borderWidth = '1px';
  controlUI.style.cursor = 'pointer';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Opciones del Mapa';
  controlUI.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.4)';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.   backgroundImage url("../img/opcionesreposo.png")
  var controlText = document.createElement('div');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '13px';
//  controlText.style.paddingLeft = '4px';
 // controlText.style.paddingRight = '4px';
 // controlText.style.paddingTop = '1px';
   controlText.style.backgroundColor = 'white';
   controlText.style.backgroundImage ='url("'+imgUrl+'opciones.png")' ;;
   controlText.style.width = '38px';
   controlText.style.height = '25px';
 // controlText.innerHTML = '<strong>Opciones</strong>';
  controlUI.appendChild(controlText);

  // Setup the click event listeners. desplegamos las opciones para ubicar el mapa MM
  google.maps.event.addDomListener(controlUI, 'click', function() {
       $('#'+dialogId).dialog( 'open' );;    //Se envia el nombre del mapa como parametro para saber a que mapa se hace referencia
       mapaFocus= map; //Asignamos a la var mapaFocus el mapa del cual hace referencia el dialog
  });
}

/**
 * The HomeControl adds a control to the map
 * the control DIV as an argument.
 * @parametros id del div, mapa, id del dialog
 */

function MapTypeControl(controlDiv, map,imgUrl) {
   if(typeof imgUrl == 'undefined') imgUrl = '../img/' ;
   //console.log(imgUrl);
  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map.
  controlDiv.style.padding = '5px';

  // Set CSS for the control border.
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = 'Transparent';
  controlUI.style.borderStyle = 'solid';
  //controlUI.style.borderWidth = '1px';
  controlUI.style.cursor = 'pointer';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Opciones del Mapa';
  controlUI.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.4)';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.   backgroundImage url("../img/opcionesreposo.png")
  var controlText = document.createElement('div');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '13px';
//  controlText.style.paddingLeft = '4px';
 // controlText.style.paddingRight = '4px';
 // controlText.style.paddingTop = '1px';
   controlText.style.backgroundColor = 'white';
   controlText.style.backgroundImage ='url("'+imgUrl+'mapa.png")';
   controlText.style.width = '60px';
   controlText.style.height = '25px';
   controlText.style.display = 'inline-block';
 // controlText.innerHTML = '<strong>Opciones</strong>';
  controlUI.appendChild(controlText);
  
   // Set CSS for the control interior.  
  var controlText2 = document.createElement('div');
  controlText2.style.fontFamily = 'Arial,sans-serif';
  controlText2.style.fontSize = '13px';
   controlText2.style.backgroundColor = 'white';
   controlText2.style.backgroundImage ='url("'+imgUrl+'satelite.png")';
   controlText2.style.width = '60px';
   controlText2.style.height = '25px';
   controlText2.style.display = 'inline-block';
 controlUI.appendChild(controlText2);
  
  // Setup the click event listeners. desplegamos las opciones para ubicar el mapa MM
  google.maps.event.addDomListener(controlText, 'click', function() {
         map.setMapTypeId (  google.maps.MapTypeId.ROADMAP);
  });
  
   google.maps.event.addDomListener(controlText2, 'click', function() {
         map.setMapTypeId (  google.maps.MapTypeId.SATELLITE);
  });
  
}
  
 
 
// Draw the array of boxes as polylines on the map
function drawBoxes(boxes,mapa) {
        incialI=0;
           boxpolys = new Array();
      for(var key  in boxes){ 
         // boxpolys = new Array(boxes[key].length);        
          for (var i = incialI; i < boxes[key].length; i++) {         
            boxpolys[key+i] = new google.maps.Rectangle({
              bounds: boxes[key][i],
              fillOpacity: 0,
              strokeOpacity: 1.0,
              strokeColor: '#000000',
              strokeWeight: 1,
              map: mapa   //MM
            });                       
          }
          inicialI = i; //console.log('actuario id: '+key); 
      } 
      //Dibujamos el  boxes2
      j= boxpolys.length;
      incialI=0;     
          
      for(var key  in boxes2){ //DUplicamos los boxes para albergar la segunda ruta de los actuarios
         // boxpolys = new Array(boxes[key].length);        
          for (var i = incialI; i < boxes2[key].length; i++) {         
            boxpolys[key+j] = new google.maps.Rectangle({
              bounds: boxes2[key][i],
              fillOpacity: 0,
              strokeOpacity: 1.0,
              strokeColor: '#000000',
              strokeWeight: 1,
              map: mapa   //MM
            }); 
            j++;                      
          }
          inicialI = i; //console.log('actuario id: '+key); 
      } 
    }
    
    // Clear boxes currently on the map
    function clearBoxes() {
      if (boxpolys != null) {
       // for (var i = 0; i < boxpolys.length; i++) {
       for( var key in boxpolys){
          boxpolys[key].setMap(null);         
        }
      }
      boxpolys = null;
    }
   
   /**
   * Verifica si un punto dado se encuentra dentro de alguno de los boxes 
   * @return boolean
   */
    function boxesContains(latitud,longitud,actuario_id){
        puntoContenido = false; 
       
        for (var i in boxes[actuario_id]) {
            var bounds = boxes[actuario_id][i];
            // Perform search over this bounds 
            if (bounds.contains(new google.maps.LatLng(latitud,longitud))==true){ //Si esta contenido
                //console.log('contenida en box: '+i);
                puntoContenido = true;
            }
        }
        if( boxes2[actuario_id]!=undefined){ //buscamos tambie en elsegundo boxes
           for (var i in boxes2[actuario_id]) {
            var bounds = boxes2[actuario_id][i];
            // Perform search over this bounds 
            if (bounds.contains(new google.maps.LatLng(latitud,longitud))==true){ //Si esta contenido
                //console.log('contenida en box: '+i);
                puntoContenido = true;
            }
        }
        }
        return puntoContenido;
    }
 /**
 * activamos o desactivamos mapas
 */
 function miniMapas(){
 
   $('#checkbox-overlay-1').change(function () { //map_canvas
    if ($(this).is(':checked')){//Checado
         if( $('#checkbox-overlay-2').is(':checked')){
            $("#map_canvas").attr("class", "grid_8"); 
             $("#map2").attr("class", "grid_8");                        
         }else{
            $("#map_canvas").attr("class", "grid_16");              
         }
          $("#map_canvas").show();         
        google.maps.event.trigger(mapsIdArray['map_canvas'], 'resize');            
        google.maps.event.trigger(mapsIdArray['map2'], 'resize');  
           
    }else{
         if( $('#checkbox-overlay-2').is(':checked')){
            $("#map2").attr("class", "grid_16");   
             google.maps.event.trigger(mapsIdArray['map2'], 'resize');          
         }
          $("#map_canvas").hide();
        }
       CheckedAll();   
   });
    $('#checkbox-overlay-2').change(function () { //map2
    if ($(this).is(':checked')){//Checado
         if( $('#checkbox-overlay-1').is(':checked')){
            $("#map_canvas").attr("class", "grid_8"); 
             $("#map2").attr("class", "grid_8");                        
         }else{
            $("#map2").attr("class", "grid_16");              
         }
          $("#map2").show();            
        google.maps.event.trigger(mapsIdArray['map_canvas'], 'resize');            
        google.maps.event.trigger(mapsIdArray['map2'], 'resize');  
        
    }else{
         if( $('#checkbox-overlay-1').is(':checked')){
            $("#map_canvas").attr("class", "grid_16");   
             google.maps.event.trigger(mapsIdArray['map_canvas'], 'resize');          
         }
          $("#map2").hide();         
    }
      CheckedAll();   
   }); 
   $('#checkbox-overlay-3').change(function () { //map3
    if ($(this).is(':checked')){//Checado
         if( $('#checkbox-overlay-4').is(':checked')){
            $("#map4").attr("class", "grid_8"); 
             $("#map3").attr("class", "grid_8");                        
         }else{
            $("#map3").attr("class", "grid_16");              
         }
          $("#map3").show();           
        google.maps.event.trigger(mapsIdArray['map3'], 'resize');            
        google.maps.event.trigger(mapsIdArray['map4'], 'resize');  
        
    }else{
         if( $('#checkbox-overlay-4').is(':checked')){
            $("#map4").attr("class", "grid_16");   
             google.maps.event.trigger(mapsIdArray['map4'], 'resize');          
         }
          $("#map3").hide();         
    }
      CheckedAll();   
   }); 
   $('#checkbox-overlay-4').change(function () { //map4
    if ($(this).is(':checked')){//Checado
         if( $('#checkbox-overlay-3').is(':checked')){
            $("#map4").attr("class", "grid_8"); 
             $("#map3").attr("class", "grid_8");                        
         }else{
            $("#map4").attr("class", "grid_16");              
         }
          $("#map4").show();          
        google.maps.event.trigger(mapsIdArray['map3'], 'resize');            
        google.maps.event.trigger(mapsIdArray['map4'], 'resize');  
        
    }else{
         if( $('#checkbox-overlay-3').is(':checked')){
            $("#map3").attr("class", "grid_16");   
             google.maps.event.trigger(mapsIdArray['map3'], 'resize');          
         }
          $("#map4").hide();         
    }
      CheckedAll();   
   });   
       
    //console.log('Mapa '+  ' miniminzado') ;    
 }
  /**
  * Verificamos si los checkboxes estan verificados
  */
 function CheckedAll(){      
        cont = 0;
     $('input[type=checkbox]').each(function () {
           if (this.checked) {
               console.log($(this).val()); 
             checkboxActual = $(this).val();
            // $("#"+checkboxActual).height(300);
             cont++;// console.log(cont);               
             $('#'+checkboxActual).height(300);              }
               
           }); 
    if(cont==1){
        $('#'+checkboxActual).height(600);
        google.maps.event.trigger(mapsIdArray[checkboxActual], 'resize');
    }
 }