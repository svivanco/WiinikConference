    
<?php
if(!empty($metodos)):
    echo $this->Form->create('CoPermission',array('role'=>'form','class'=>'form-inline','action'=>'save_permissions'));
        ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Accion</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    Marcar Todos/Ninguno: <input type = "checkbox" id = "check_all_none"></input>
<br/>
                        <?php
                        $i = 0;
                        foreach($metodos as $metodo)
                        {
                            $disabledCheck = ($metodo['registrado'])?' disabled="disabled" checked':"";
                            ?>
                            <tr>
                                <td>
                                    <input id="<?php echo $i; ?>" class = "others" type="checkbox" name="data[CoPermission][permiso][]" value="<?php echo $metodo['nombrePermiso'] ?>"<?php echo $disabledCheck; ?>/>&nbsp;<?php echo $metodo['nombreAccion']; ?>
                                </td>
                                <td>
                                    <?php echo ($metodo['registrado'])?"<span class='label label-success'>REGISTRADA</span>":"<span class='label label-warning'>SIN REGISTRAR</span>"; ?>
                                </td>                             
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Asignar permisos a los Grupos...</h5>
                <?php
                echo $this->Form->input('CoGroup',array('div'=>false,'label'=>false));
                ?>
            </div>
        </div>
        <?php
        echo $this->Form->submit('Guardar',array('div'=>false,'class'=>'btn btn-primary'));
    echo $this->Form->end();
endif;
?>

    <script type="text/javascript">
   
$('#check_all_none').click(function () {
    if ( $(this).is(':checked') ){
        $('.others').prop("checked", true);
    }
    else{
        $('.others').removeAttr("checked");
    }

});
    </script>