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
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        
    <?php echo $this->tag->stylesheetLink('css/session-styles.css'); ?>

    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('importdata/updatefile'); ?>" data-toggle="tooltip" data-placement="bottom" title="Actualizar datos">
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
                    
    <div class="row">
        <div class="col-md-12">
               <?php echo $this->flashSession->output(); ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <div>
            <h1>
                <span class="glyphicon glyphicon glyphicon-user"></span>
                Información personal
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <table class="table table-bordered">
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo $user->name; ?></td>
                </tr>
                <tr>
                    <td>Cédula:</td>
                    <td><?php echo $user->idUser; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $user->email; ?></td>
                </tr>
                <tr>
                    <td>Clase:</td>
                    <td><?php echo $user->class; ?></td>
                </tr>
                <tr>
                    <td>Telefono:</td>
                    <td><?php echo $user->phone; ?></td>
                </tr>
                <tr>
                    <td>Celular:</td>
                    <td><?php echo $user->cellphone; ?></td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td><?php echo $user->address; ?></td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td><?php echo $user->city; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div class="col-md-12">
            <div>
                <h1>
                    <span class="glyphicon glyphicon-credit-card"></span>
                    Información del Credito
                </h1>
            </div>
        </div>
            
        <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php foreach ($buys as $buy) { ?>
                <tr>
                    <td>Valor total del credito:</td>
                    <td>Valor cancelado hasta la fecha:</td>
                    <td>Valor por cancelar:</td>                    
                </tr>
                <tr>
                    <td><?php echo $buy->value; ?></td>
                    <td><?php echo $buy->balance; ?></td>
                    <td><?php echo $buy->value - $buy->balance; ?></td>
                </tr>               
                <?php } ?>
            </table>
        </div>
    </div>

                </div>    
            </div>
        </div>  
                
        <footer class="footer">
            <p style="float: left;">&copy; Sigma Engine 2015, Todos los derechos reservados</p>                  
        </footer>           
    </body>
</html>