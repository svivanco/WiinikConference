
<?
//pr($catAcciones);
//echo $this->Form->input('CoUser.municipio_id',array('div'=>false,'label'=>false));
echo $this->Form->input('CoUser.municipio_id',array('between'=>'<div class="col-sm-8">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
if(count($municipios)==0)
echo "<div class='label-warning'>No existen municipios para esta entidad.</div>";
?>
