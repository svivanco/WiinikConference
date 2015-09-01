<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<script type="text/javascript">
var statSend = false;
function checkSubmit() 
{   
    if (!statSend) 
    {
        statSend = true;
        document.getElementById('btnGuardar').disabled = true;
        return true;
    } 
    else 
    {
        alert("El formulario ya se esta enviando...");
        return false;
    }
}
</script>
<div class="col-md-2 well">
    <h3><?php echo "Acciones"; ?></h3>
    <ul class="nav">

<?php if (strpos($action, 'add') === false): ?>
        <li><?php echo "<?php echo \$this->Form->postLink('Eliminar', array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, __('Realmente desea eliminar el registro con Id %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
<?php endif; ?>
        <li><?php echo "<?php echo \$this->Html->link('Listado', array('action' => 'index')); ?>"; ?></li>
        <?php
        /*$done = array();
        foreach ($associations as $type => $data) {
            foreach ($data as $alias => $details) {
                if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                    echo "\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
                    echo "\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
                    $done[] = $details['controller'];
                }
            }
        }*/
        ?>
    </ul>
</div>
<div class="col-md-10">
    <h3>
        <?php 
        $nombreAccion = ($action == "add")?'Nuevo':'Editar';
        printf("<?php echo __('%s %s'); ?>", $nombreAccion, $singularHumanName); 
        ?>
    </h3>
    <?php echo "<?php echo \$this->Form->create('{$modelClass}',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>\n"; ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Form->input('{$field}',array('between'=>'<div class=\"col-sm-4\">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}',array('between'=>'<div class=\"col-sm-4\">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
    $botonTexto = ($action == "add")?'Guardar':'Actualizar';
    echo "<?php echo \$this->Form->submit('$botonTexto',array('class'=>'btn btn-primary','id'=>'btnGuardar'));\n";
	echo "\necho \$this->Form->end(); ?>\n";
?>
</div>
