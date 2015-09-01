var map;
var panorama;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var directionsServiceRuta = new google.maps.DirectionsService();
var geocoder = new google.maps.Geocoder();

var currentDirections = null;
var boundary_ruta = new google.maps.LatLngBounds();

var coordenadas_ubicacion_x=0;
var coordenadas_ubicacion_y=0;
var tipomapa = 'mapa';
var giroscopio = 0;
var watchID = null;
var watchID2 = null;


function initialize() 
{   
	//alert(sessvars.policia.CatPatrulla.CatZona.nombre);
	google.maps.visualRefresh = true;
    directionsDisplay = new google.maps.DirectionsRenderer();

        var latlng =  new google.maps.LatLng(18.5195848,-88.3024187);
        var myOptions = {       
            zoom: 13,       
            center: latlng,
            disableDefaultUI: false,  
            navigationControl: true,   
            mapTypeControl: true,
            streetViewControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP     
        };     
        
       map = new google.maps.Map(document.getElementById("map"), myOptions);	   
	   directionsDisplay.setMap(map);  

	   panoramaOptions = {
		position: latlng,
		pov: {
		  heading: 34,
		  pitch: 10,
	   	  zoom: 1
		}
	  };
	  
	  panorama = new  google.maps.StreetViewPanorama(document.getElementById('panoramadiv'),panoramaOptions);
	  map.setStreetView(panorama);


			
            var iconos_ruta = {  
                mi_posicion: new google.maps.MarkerImage(   
                 'librerias/iconos_mapa/car.png',   
                  new google.maps.Size(32, 37),
                  new google.maps.Point(0, 0),
                  new google.maps.Point(16,37)
                ),
                notif_pendiente: new google.maps.MarkerImage(   
                 'librerias/iconos_mapa/notificacion_pendiente.png',   
                  new google.maps.Size(32, 37),
                  new google.maps.Point(0, 0),
                  new google.maps.Point(16,37)
                ),
                notif_entregada: new google.maps.MarkerImage(   
                 'librerias/iconos_mapa/notificacion_entregada.png',   
                  new google.maps.Size(32, 37),
                  new google.maps.Point(0, 0),
                  new google.maps.Point(16,37)
                ),
                central: new google.maps.MarkerImage(   
                 'librerias/iconos_mapa/central_actuarios.png',   
                  new google.maps.Size(32, 37),
                  new google.maps.Point(0, 0),
                  new google.maps.Point(16,37)
                ),
                sombra: new google.maps.MarkerImage(   
                 'librerias/iconos_mapa/shadow-car.png',   
                  new google.maps.Size(54, 37),
                  new google.maps.Point(0, 0),
                  new google.maps.Point(16,37)
                )};           
 
            
            MarcadorFinRuta = new google.maps.Marker({
                position: null,
                draggable: false,
                animation: google.maps.Animation.BOUNCE,
                map: map,
                icon: iconos_ruta.notif_pendiente,
                shadow: iconos_ruta.sombra,
                clickable: true
            });
			
			
			MarcadorInicioRuta = new google.maps.Marker({
                position: null,
                draggable: false,
                map: map,
                icon: iconos_ruta.mi_posicion,
                shadow: iconos_ruta.sombra
            });

            MarcadorCentralAct = new google.maps.Marker({
                position: null,
                draggable: false,
                map: map,
                icon: iconos_ruta.central,
                shadow: iconos_ruta.sombra,
                clickable: false
            });
	
		   /*
		    panorama = map.getStreetView();
            var panoOptions = {
             pov: {heading:0, pitch:0, zoom:1},
             enableCloseButton: true
             };
             panorama.setOptions(panoOptions);
			*/
			
			
			
} 



function trazar_ruta(latitud,longitud)
{
//Limpiamos direcciones	
 //$("#mapaDirections").html('');
 
//Obtenemos las coordenadas de la sucursal
coordenadas_ubicacion_x = 18.5321598;//position.coords.longitude;
coordenadas_ubicacion_y = -88.2896087; //position.coords.latitude;
//alert("en X"+coordenadas_ubicacion_x);
//alert("en y"+coordenadas_ubicacion_y);

//coordenadas_ubicacion_x = position.coords.longitude;
//coordenadas_ubicacion_y = position.coords.latitude;

coordenadas_destino_x = latitud;
coordenadas_destino_y = longitud;

//alert("Imprimiendo ruta..");
//Ocultamos la Vista de streetView si estuviera abierta
panorama.setVisible(false);

var start=new google.maps.LatLng(coordenadas_ubicacion_x, coordenadas_ubicacion_y);
var end=new google.maps.LatLng(coordenadas_destino_x, coordenadas_destino_y);

var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.TravelMode.DRIVING
  };
//MarcadorInicioRuta.setPosition(new google.maps.LatLng(coordenadas_ubicacion_y, coordenadas_ubicacion_x));
//map.setCenter(new google.maps.LatLng(position.coords.latitude,position.coords.longitude));

 directionsService.route(request, function(response, status) 
 {
    if (status == google.maps.DirectionsStatus.OK) 
	{
      directionsDisplay.setDirections(response);
      directionsDisplay.setPanel(document.getElementById('mapaDirections'));
    }
  });
  
  
}


////****************** Untested
function onSuccessCompas(heading) 
{
    var toggle = panorama.getVisible();
    if (toggle == true && giroscopio == 1)
	{
       var panoOptions = {
            pov: {heading:heading.trueHeading, pitch:0, zoom:1},
            enableCloseButton: false
            };
       panorama.setOptions(panoOptions);            
	}
}


function streetview()
{
        var toggle = panorama.getVisible();
        if (toggle == false) {
            $("#texto_streetview").html('Cerrar StreetView');
            $("#ventanaswitchgiros").show();
            panorama.setVisible(true);
            panorama.setPosition(map.getCenter());
            //watchID2 = navigator.compass.watchHeading(onSuccessCompas, onError, { frequency: 300 });
        } else {
            $("#texto_streetview").html('StreetView');
            $("#ventanaswitchgiros").hide();
              if (watchID2 != null)
              {
                navigator.compass.clearWatch(watchID2);
                watchID2 = null;
              }
          panorama.setVisible(false);
        }

}

function streetViewNoti(latitud,longitud)
{
		var ubicacion= new google.maps.LatLng(latitud,longitud); 
        var toggle = panorama.getVisible();

			//alert("Cargando Vista StreetView");
            $("#texto_streetview").html('Cerrar StreetView');
            $("#ventanaswitchgiros").show();
            panorama.setVisible(true);
            panorama.setPosition(ubicacion);
            //watchID2 = navigator.compass.watchHeading(onSuccessCompas, onError, { frequency: 300 });
}



function onError(error) 
{
  $("#info_coordenadas").html('Sin posici&oacute;n');
}

function donde_estoy()
{
  //alert("UbicacionX="+coordenadas_ubicacion_y);
  latlng=new google.maps.LatLng(coordenadas_ubicacion_x, coordenadas_ubicacion_y);
  map.setCenter(latlng);
  //map.setCenter(new google.maps.LatLng(18.512819,-88.30204));
  map.setZoom(12);
  
  var marker = new google.maps.Marker({
						  position: latlng,
						  map: map,
						  title: 'Aqui Estoy'
					  });
}

