<?php
if($usuario['count'] != 0)
{
    ?>
    <script type="text/javascript">
    document.getElementById('CoUserNombre').value = "<?php echo utf8_encode($usuario[0]['givenname'][0]); ?>";
    document.getElementById('CoUserPaterno').value = "<?php echo utf8_encode($usuario[0]['sn'][0]); ?>";
    document.getElementById('CoUserEmail').value = "<?php echo utf8_encode($usuario[0]['mail'][0]); ?>";
    </script>
    <?php
}
else
{
    ?>
    <script type="text/javascript">
    document.getElementById('CoUserNombre').value = "";
    document.getElementById('CoUserPaterno').value = "";
    document.getElementById('CoUserEmail').value = "";
    alert('El usuario no se encontro en el directorio activo!');
    </script>
    <?php
}
?>