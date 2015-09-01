<?
	echo $this->Html->css('jstree');
	echo $this->Html->css('multi-select');
	echo $this->Html->script('jstree.min');
	echo $this->Html->script('jquery.multi-select');	
?>

<div class="col-md-5">
    <h2>Asignar Permisos de Aplicaci&oacute;n</h2>
    <fieldset>
        <legend>Seleccione un Controlador...</legend>
        *Sensible en Acentos
            <div id="SearchBox">
              <input placeholder="Encuentre.." value="" name="SearchInput" id="SearchInput">
            </div>
            
       <div>
		  <ul class="tree">
        <?php
		
	 foreach($controllers as $controlador => $dataController)
        {
			echo '<li>';
			echo '<span class="controlador"><i class="glyphicons sort"></i>'.$controlador.'</span>';
				echo  '<ul>';
			   foreach($dataController as $metodo=> $value)
		        {
					//pr($value);
					echo '<li>';
					echo '<span>'.'<a  href="javascript:cargarGrupoPermisos(\''.$value['id'].'\');">'.$value['nombrePermiso'].'</a>'.'</span>';
					echo '</li>';      
				}
				echo  '</ul>';
			
			echo '</li>';            
        }
        ?>
			  </ul>		        
		</div>
    </fieldset>

</div>

<div class="col-md-6 well affix">
    <h3>Permisos por Grupo</h3>
    <div id="gruposPermisos">
    </div>    
    
</div>


<script>
//$('#permisos').jstree();

function cargarGrupoPermisos(permiso)
{
	<?
	$grupo_permiso = $this->Ajax->remoteFunction( 
            array( 
                 'url' => array('controller' => 'CoPermissions', 'action' => 'edit_ajax'), 
                 'update' => 'gruposPermisos', 
                 'complete' => 'convert_combo()',                        										                       
                 'data'=>'({id : permiso})',
                 'type'=>'get',
                 'indicator'=>'progress_prog',
                    ) 
            );
			
	echo $grupo_permiso;
	?>

	
}


	jQuery.expr[':'].containsIgnoreCase = function (n, i, m) 
	{
		return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
	};
	
	jQuery(function() 
	{    
		jQuery('#SearchInput').keyup(
			function() 
			{
			   var searchTerms = jQuery(this).val();
			
			   jQuery('.tree li').each(function() 
			   {			   
				  jQuery(this).toggle(jQuery(this).is(':containsIgnoreCase(' + searchTerms + ')'));
			   });
			}
		);
	 
		
	});

	
	jQuery('.controlador').click(function()
	{   
        jQuery(this).next('ul').slideToggle();
    });

	//Por default ocultamos los metodos
	jQuery('.controlador').next('ul').hide();


	/*jQuery('parent_li').click(function()
	{    //alert('as');
        jQuery(this).next('ul').slideToggle();
    });
	*/
	
	
	
/*
$(function () 
{
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Colapsar');
    
	$('.tree li.parent_li > span').on('click', function (e) 
	{
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) 
		{
            children.hide('fast');
            $(this).attr('title', 'Expandir').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } 
		else 
		{
            children.show('fast');
            $(this).attr('title', 'Colapsar').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });

});
*/



</script>