<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap');
        echo $this->Html->css('bootstrap-theme');
        echo $this->Html->script(array('jquery'));
		echo $this->Html->script('ckeditor/ckeditor');
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header role="banner" class="navbar navbar-default navbar-fixed-top">
            <h1><div class="logo">
                <?php
                echo $this->Html->image('LogoSistema.png');
                ?>
                </div>
            </h1>
                <nav role="navigation" class="collapse navbar-collapse">
                    <?php
                  //  echo $menuApp;
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                                      
                	</nav>
        </header>
        <div class="content" style="margin-top: 180px;margin-left: 30px;margin-right: 30px;">
            <div class="row">
                <div class="col-md-12 well">
                    <?php echo $this->Session->flash(); ?>
                    <div class="row">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->element('sql_dump'); ?>
                </div>
            </div>
        </div>
        <?php
        echo $this->Html->script(array('bootstrap'));
        ?>    
    </body>
</html>