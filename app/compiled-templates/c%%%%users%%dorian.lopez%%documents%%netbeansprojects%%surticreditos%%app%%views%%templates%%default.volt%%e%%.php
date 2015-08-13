a:5:{i:0;s:1311:"<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->url->get(''); ?>images/favicons/favicon48x48.ico">
        <title>Surticreditos</title>
        
        <!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php echo $this->tag->getTitle(); ?>
        
        <?php echo $this->tag->javascriptInclude('library/jquery/jquery-1.11.3.min.js'); ?>
        <?php echo $this->tag->stylesheetLink('css/styles.css'); ?>
        
        <?php echo $this->tag->stylesheetLink('library/bootstrap-3.3.4/css/bootstrap.css'); ?>
        <?php echo $this->tag->javascriptInclude('library/bootstrap-3.3.4/js/bootstrap.min.js'); ?>
        
        <script type="text/javascript">
            var myBaseURL = '<?php echo $this->url->get(''); ?>';
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        ";s:6:"header";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:27:"<!-- custom header code -->";s:4:"file";s:35:"../app/views/templates/default.volt";s:4:"line";i:27;}}i:1;s:2007:"
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('index'); ?>" data-toggle="tooltip" data-placement="bottom" title="Inicio">
                                <span class="glyphicon glyphicon-home"></span>
                            </a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('importdata/index'); ?>" data-toggle="tooltip" data-placement="bottom" title="Importar archivos">
                                <span class="glyphicon glyphicon glyphicon-upload"></span>
                            </a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('user/passedit'); ?>" data-toggle="tooltip" data-placement="bottom" title="Cambiar contraseña">
                                <span class="glyphicon glyphicon glyphicon-lock"></span>
                            </a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('session/logout'); ?>" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión">
                                <span class="glyphicon glyphicon glyphicon-log-out"></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    ";s:7:"content";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:33:"<!-- custom content body code -->";s:4:"file";s:35:"../app/views/templates/default.volt";s:4:"line";i:60;}}i:2;s:284:"
                </div>    
            </div>
        </div>  
                
        <footer class="footer">
            <p style="float: left;">&copy; Sigma Engine 2015, Todos los derechos reservados</p>                  
        </footer>           
    </body>
</html>";}