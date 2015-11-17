<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=1">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('')}}img/favicons/favicon48x48.ico">
        <title>Surticréditos | Consulta estado de cuenta</title>
        
        <!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        {{ get_title() }}
        {# Jquery#}
        {{ javascript_include('library/jquery/jquery-1.11.3.min.js') }}
        {# base de bootstrap#}
        {{ stylesheet_link('library/bootstrap-3.3.4/css/bootstrap.css') }}
        {{ javascript_include('library/bootstrap-3.3.4/js/bootstrap.min.js') }}
        {{ stylesheet_link('css/styles.css') }}
        
        <script type="text/javascript">
            var myBaseURL = '{{url('')}}';
        </script>
        {% block header %}<!-- custom header code -->{% endblock %}
    </head>
    <body>
        <div class="header clearfix">
            <div class="container">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="txt">
                            <a role="menuitem" class="txt" tabindex="-1" href="{{url('index')}}">INICIO</a>
                        </li>
                    {% if userData.role.name == 'admin' %}
                        <li role="presentation" class="">
                            <a role="menuitem" class="txt" tabindex="-1" href="{{url('importdata/index')}}">IMPORTAR ARCHIVOS</a>
                        </li>
                    {% endif %}
                        <li role="presentation" class="custom">
                            <a role="menuitem" tabindex="-1" href="{{url('user/passedit')}}">
                                <i class="glyphicon glyphicon-lock"></i>
                            </a>
                        </li>
                        <li role="presentation" class="custom">
                            <a role="menuitem" tabindex="-1" href="{{url('session/logout')}}">
                                <i class="glyphicon glyphicon-log-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <a href="http://surticreditos.com/" target="_blank">
                    <img src="{{url('')}}img/Surticreditos-01.png" height="70" />
                </a>
            </div>
        </div>
            
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    {% block content %}<!-- custom content body code -->{% endblock %}
                </div>    
            </div>
        </div>  
                
        <footer class="footer">
            <p style="float: left;">&copy; Sigma Engine 2015, Todos los derechos reservados</p>
            <div style="float: right;">
                <p>
                    ERP by:
                    <img src="{{url('')}}img/DATANEXT.jpg" height="30" />
                </p>
            </div>
        </footer>           
    </body>
</html>