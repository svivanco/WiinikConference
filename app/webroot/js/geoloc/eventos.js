//Funciones para mostrar/ocular el panel
$(document).ready(function() {                       
    $("#panelHide").click(function () {                           
                     $("#notificacionesPanel").hide('slide', {direction: 'left'}, 100);     
                     $("#mapBox").attr("class", "grid_16");                      
                      $("#panelShowDiv").show();
    }); 
     $("#panelShow").click(function () {                           
                     $("#notificacionesPanel").show('slide', {direction: 'right'}, 100);     
                     $("#mapBox").attr("class", "grid_12");    
                     $("#panelShowDiv").hide();                  
    });

});