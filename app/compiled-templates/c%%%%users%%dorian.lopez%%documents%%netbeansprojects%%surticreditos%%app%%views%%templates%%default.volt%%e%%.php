a:5:{i:0;s:1184:"<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->url->get(''); ?>img/favicons/favicon48x48.ico">
        <title>Surticreditos</title>
        
        <!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php echo $this->tag->getTitle(); ?>
        
        <?php echo $this->tag->javascriptInclude('library/jquery/jquery-1.11.3.min.js'); ?>
        
        <?php echo $this->tag->stylesheetLink('library/bootstrap-3.3.4/css/bootstrap.css'); ?>
        <?php echo $this->tag->javascriptInclude('library/bootstrap-3.3.4/js/bootstrap.min.js'); ?>
        <?php echo $this->tag->stylesheetLink('css/styles.css'); ?>
        
        <script type="text/javascript">
            var myBaseURL = '<?php echo $this->url->get(''); ?>';
        </script>
        ";s:6:"header";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:27:"<!-- custom header code -->";s:4:"file";s:35:"../app/views/templates/default.volt";s:4:"line";i:23;}}i:1;s:1866:"
    </head>
    <body>
        <div class="header clearfix">
            <div class="container">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="txt">
                            <a role="menuitem" class="txt" tabindex="-1" href="<?php echo $this->url->get('index'); ?>">INICIO</a>
                        </li>
                    <?php if ($this->userData->role->name == 'admin') { ?>
                        <li role="presentation" class="">
                            <a role="menuitem" class="txt" tabindex="-1" href="<?php echo $this->url->get('importdata/index'); ?>">IMPORTAR ARCHIVOS</a>
                        </li>
                    <?php } ?>
                        <li role="presentation" class="custom">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('user/passedit'); ?>">
                                <i class="glyphicon glyphicon-lock"></i>
                            </a>
                        </li>
                        <li role="presentation" class="custom">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('session/logout'); ?>">
                                <i class="glyphicon glyphicon-log-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <a href="http://surticreditos.com/" target="_blank">
                    <img src="<?php echo $this->url->get(''); ?>img/Surticreditos-01.png" height="70" />
                </a>
            </div>
        </div>
            
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    ";s:7:"content";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:33:"<!-- custom content body code -->";s:4:"file";s:35:"../app/views/templates/default.volt";s:4:"line";i:60;}}i:2;s:497:"
                </div>    
            </div>
        </div>  
                
        <footer class="footer">
            <p style="float: left;">&copy; Sigma Engine 2015, Todos los derechos reservados</p>
            <div style="float: right;">
                <p>
                    ERP by:
                    <img src="<?php echo $this->url->get(''); ?>img/DATANEXT.jpg" height="30" />
                </p>
            </div>
        </footer>           
    </body>
</html>";}