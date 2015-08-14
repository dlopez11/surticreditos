<!DOCTYPE html>
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
        </script>
        
    <?php echo $this->tag->stylesheetLink('css/session-styles.css'); ?>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

    </head>
    <body>
        <div class="container">
            
    <div align="center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form class="form-horizontal" action="<?php echo $this->url->get('session/recoverpass'); ?>" method="post">
                <?php echo $this->flashSession->output(); ?>
                <div class="form-group">
                  <h1>Recuperar contraseña</h1>
                  <br>
                  <div class="col-sm-12">
                      <input type="number" class="form-control" name="cedula" placeholder="Ingrese su número de Cédula">
                  </div>
                </div>
                
                <div class="form-group" align="right">
                  <div class="col-sm-offset-2 col-sm-10">
                    <a href="<?php echo $this->url->get('session/login'); ?>" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Recuperar</button>
                  </div>
                </div>
            </form>
        </div>                    
    </div>

        </div>
    </body>
</html>