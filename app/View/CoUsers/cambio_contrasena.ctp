<div class="col-md-3 well text-left">
    <ul class="nav nav-list">
        <li class="nav-header">Acciones</li>
        <li><?php echo $this->Html->link(__('<i class="icon-remove"></i>Cancelar'),'/', array('escape'=>false)); ?></li>
    </ul>
</div>
<div class="col-md-6 text-left"><?php
     echo $this->Form->create('CoUser',array('role'=>'form','class'=>'form-horizontal'));
        ?>
        <fieldset>
            <legend>Cambio de contrase&ntilde;a</legend>
            <?php
            echo $this->Form->input('password_actual',array('type'=>'password','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-4','text'=>'Clave de Acceso actual'),'div'=>array('class'=>'form-group')));
            echo $this->Form->input('password',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-4','text'=>'Clave de Acceso nueva'),'div'=>array('class'=>'form-group')));
            echo $this->Form->input('password_repit',array('type'=>'password','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-4','text'=>'Confirme Clave de Acceso'),'div'=>array('class'=>'form-group')));
            ?>
        </fieldset>
        <?php
        echo $this->Form->button('Cambiar contrase&ntilde;a',array('class'=>'btn btn-primary'));
    echo $this->Form->end();
    ?>
</div>