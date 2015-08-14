<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>        
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
    
    <?php echo $this->tag->javascriptInclude('library/select2/js/select2.min.js'); ?>
    <?php echo $this->tag->stylesheetLink('library/select2/css/select2.min.css'); ?>   

    <script type="text/javascript">
        var url = "<?php echo $this->url->get('data/get'); ?>/";
        $(function () {            
            $(".select2").select2();                    
        });
        
        function download () {
            var id = $(".select2").val();
            
            if (id > 0) {
                $.ajax({
                    url: "<?php echo $this->url->get('data/create'); ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    error: function(error){
                        console.log(error);
                    },
                    success: function(data){
                        window.location = '<?php echo $this->url->get('data/download'); ?>/' + data[0];
                    }
                });  
            }  
        }
    </script>
    
    <?php echo $this->tag->javascriptInclude('js/showinfo.js'); ?>
    

    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('index'); ?>">Inicio</a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('importdata/index'); ?>">Importar archivos</a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('user/passedit'); ?>">Cambiar contraseña</a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="<?php echo $this->url->get('session/logout'); ?>">Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>
                    
                <a href="http://www.google.com/" target="_blank">
                    <img src="<?php echo $this->url->get(''); ?>img/Surticreditos-01.png" height="60" />
                </a>
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
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td>
                        <strong>
                            <?php echo $user->name; ?>
                            <br />
                            CC: <?php echo $user->idUser; ?>
                        </strong>                            
                    </td>                    
                    <td><?php echo $user->class; ?></td>  
                    <td><?php echo $user->address; ?></td>                                    
                </tr>
                
                <tr>                    
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->phone; ?></td>
                    <td><?php echo $user->city; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="space"></div>
            
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="col-md-10">
                <select class="form-control select2">
                    <option value="0">Seleccione su credito</option>
                    <?php foreach ($buys as $buy) { ?>
                        <option value="<?php echo $buy->idBuy; ?>"><?php echo $buy->idBuy; ?></option>
                    <?php } ?>
                </select>
            </div>                                       
            <div class="col-md-2">
                <button id="download" onClick="download();" class="btn btn-info btn-sm">Descargar pagos</button>
            </div>
        </div>
    </div>
    
    <div class="space"></div>
    
    <div class="row" id="container">
        <div class="col-md-12">
            
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