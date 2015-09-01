var coordenadas_ubicacion_x=0;
var coordenadas_ubicacion_y=0;
var posicion_correcta = 1;
var ubicacion_x_punto = 0;
var agregar_punto_anonimo = 0;
var browserSupportFlag =  new Boolean();
  
var map;
var panorama;


var directionsDisplay;
var currentDirections = null;

var pictureSource;   // picture source
var destinationType; // sets the format of returned value 
var tipomapa = 'mapa';
var giroscopio = 0;
var watchID = null;
var watchID2 = null;
var encabezado_ruta_json = '';
var ruta_json = '';
var num_foto = 0;
var estatus_registro_dia_trabajo = 0;
var ruta_id_actual = 0;
var reloj_tiempo_transcurrido;
var segundos, minutos, horas;
var markersArray = [];
var directionsDisplayLista = [];
//Por default se asigna un ID para debug en PC, el ID es reemplazado cuando corre en dispositivos 
var id_dispositivo='d61d13eaff461c6d';