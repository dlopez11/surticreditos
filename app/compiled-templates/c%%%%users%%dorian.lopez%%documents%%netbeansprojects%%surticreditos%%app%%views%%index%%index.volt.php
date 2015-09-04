<!DOCTYPE html>
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
        
    
    <?php echo $this->tag->javascriptInclude('library/select2/js/select2.min.js'); ?>
    <?php echo $this->tag->stylesheetLink('library/select2/css/select2.min.css'); ?>   

    <script type="text/javascript">
        var url = "<?php echo $this->url->get('data/get'); ?>/";                    
    </script>
    

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
                    
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Consulte su Estado de Crédito</h2>
            <p></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
               <?php echo $this->flashSession->output(); ?>
        </div>
    </div>
    
    <div class="row block">
        <div class="col-md-12">
            <h3>
                <?php echo $user->name; ?>
            </h3>
            <div class="xs-text">CC: <?php echo $user->idUser; ?></div>
            <div class="xs-text"><?php echo $user->email; ?></div>     
            <div class="xs-text"><?php echo $user->address; ?> - <?php echo $user->city; ?></div>
            <div class="xs-text"><?php echo $user->phone; ?></div>   
        </div>
    </div>   
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Créditos</h2>
            <p></p>
        </div>
    </div>
    
    <?php foreach ($buys as $b) { ?>
    <div class="row">
        <div class="col-md-12">            
            <table class="table table-bordered">                
                <tr style="border-bottom: 2px solid transparent;">
                    <td colspan="3" style="font-size: 1.3em; font-weight: bold">
                        <a href="<?php echo $this->url->get('payment/index'); ?>/<?php echo $b->buy->idBuy; ?>"><?php echo $b->article->name; ?> (<?php echo $b->buy->idBuy; ?>)</a>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid transparent;">Total: <span style="color: #337ab7; font-size: 1.2em;">$<?php echo $b->buy->value; ?></span></td>
                    <td style="border-right: 2px solid transparent;">Valor Cancelado: <span style="color: #449d44; font-size: 1.2em;">$<?php echo $b->buy->value - $b->buy->debt; ?></span></td>
                    <td>Saldo: <span style="color: #848484; font-size: 1.2em;">$<?php echo $b->buy->debt; ?></span></td>
                </tr>
            </table>
        </div>
    </div>
    <?php } ?>
    
    <div class="row">
        <div class="col-md-12" align="right">
            <p>
                <em>La información suministrada puede no estar actualizada.</em>
            </p>
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