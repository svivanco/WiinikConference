<div class="col-md-3"></div>
<div class="col-md-6"><div class="center">
    <?php
    echo $this->Html->image('LogoSistema_400.png');
    ?></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Acceso al Sistema</h3>
        </div>
        <div class="panel-body well2">
    
            <?php
            echo $this->Form->create('CoUser',array('role'=>'form'));
                echo $this->Form->input('login',array('autocomplete'=>'off','label'=>false,'placeholder'=>'Nombre de Usuario','class'=>'form-control islogin','div'=>array('class'=>'form-group')));
                echo $this->Form->input('password',array('label'=>false,'placeholder'=>'Clave de Acceso','class'=>'form-control ispassword','div'=>array('class'=>'form-group')));
                echo $this->Form->submit('Acceder',array('class'=>'btn btn-primary col-md-12'));
            echo $this->Form->end();
            ?>
                     
        </div>
    </div>
    <?php echo $this->Session->flash('auth',array('element'=>'flashmessage')); ?>
</div>
<div class="col-md-3"></div>



<script type="text/javascript">
var Login = document.getElementById("CoUserLogin").value;
if(Login == "")
{
    document.getElementById("CoUserLogin").focus();    
}
else
{
    document.getElementById("CoUserPassword").focus();
}
	
$(document).ready(function(){

    // Call Prevue.js para mostrar y ocultar el password
    $('.ispassword').prevue();

	background1="<? echo $this->webroot."img/backgrounds/bg1.jpg"; ?>";
	background2="<? echo $this->webroot."img/backgrounds/bg2.jpg"; ?>";
	background3="<? echo $this->webroot."img/backgrounds/bg3.jpg"; ?>";		
	background3="<? echo $this->webroot."img/backgrounds/bg4.jpg"; ?>";		
	background3="<? echo $this->webroot."img/backgrounds/bg5.jpg"; ?>";		

	// Duration is the amount of time in between slides,
	// and fade is value that determines how quickly the next image will fade in
	$.backstretch([background1
	, background2
	, background3
	], {duration: 3000, fade: 750});
	

});	

</script>