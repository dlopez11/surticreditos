<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('')}}images/favicons/favicon48x48.ico">
        <title>Surticreditos</title>
        
        <!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        {{ get_title() }}
        {# Jquery#}
        {{ javascript_include('library/jquery/jquery-1.11.3.min.js') }}
        {{ stylesheet_link('css/styles.css') }}
        {# base de bootstrap#}
        {{ stylesheet_link('library/bootstrap-3.3.4/css/bootstrap.css') }}
        {{ javascript_include('library/bootstrap-3.3.4/js/bootstrap.min.js') }}
        
        <script type="text/javascript">
            var myBaseURL = '{{url('')}}';
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        {% block header %}<!-- custom header code -->{% endblock %}
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="{{url('index')}}" data-toggle="tooltip" data-placement="bottom" title="Inicio">
                                <span class="glyphicon glyphicon-dashboard"></span>
                            </a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="{{url('importdata/index')}}" data-toggle="tooltip" data-placement="bottom" title="Actualizar datos">
                                <span class="glyphicon glyphicon glyphicon-upload"></span>
                            </a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="{{url('user/passedit')}}" data-toggle="tooltip" data-placement="bottom" title="Cambiar contraseña">
                                <span class="glyphicon glyphicon glyphicon-lock"></span>
                            </a>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a role="menuitem" tabindex="-1" href="{{url('session/logout')}}" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión">
                                <span class="glyphicon glyphicon glyphicon-log-out"></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    {% block content %}<!-- custom content body code -->{% endblock %}
                </div>    
            </div>
        </div>  
                
        <footer class="footer">
            <p style="float: left;">&copy; Sigma Engine 2015, Todos los derechos reservados</p>                  
        </footer>           
    </body>
</html>