{% extends "templates/default.volt" %}
{% block header %}
    {{ stylesheet_link('css/session-styles.css') }}
    {{ stylesheet_link('library/twitter-bootstrap-wizard-master/prettify.css') }}

    {{ javascript_include('library/twitter-bootstrap-wizard-master/jquery.bootstrap.wizard.js') }}
    {{ javascript_include('library/twitter-bootstrap-wizard-master/prettify.js') }}
    
    <script type="text/javascript">
        var csvone = "{{url('importdata/importfileone')}}";
        var csvtwo = "{{url('importdata/importfiletwo')}}";
        var csvthree = "{{url('importdata/importfilethree')}}";
    </script>
    
    {{ javascript_include('js/importclientone.js') }}
    {{ javascript_include('js/importclienttwo.js') }}
    {{ javascript_include('js/importclientthree.js') }}
    
    <script>
        $(document).ready(function() {
            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
            }});
        });
    </script>    
{% endblock %}
{% block content %}
    <div class="row">
        <div class="space"></div>
        <div id="rootwizard">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <ul>
                            <li><a href="#tab1" data-toggle="tab">Actualizar Usuarios</a></li>
                            <li><a href="#tab2" data-toggle="tab">Actualizar Compras</a></li>
                            <li><a href="#tab3" data-toggle="tab">Actualizar Recibos</a></li>
                         </ul>
                    </div>
                </div>
            </div>

            <div id="bar" class="progress progress-striped active">
                <div class="bar"></div>
            </div>

            <div class="tab-content">
                <div class="tab-pane" id="tab1">                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>Actualizar usuarios desde archivo .csv</h1>
                            <hr />            
                        </div>        
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <p>
                                Aquí podrá actualizar la información de sus clientes desde un archivo de Excel en formato CSV.                
                            </p>
                            <p>
                                El archivo debe ser una tabla sin encabezado que debe tener los siguientes campos: Cédula,
                                nombre, dirección, telefono o celular, email y ciudad. Por ejemplo:
                            </p>
                            <p>
                                <img src="{{url('img/import/fileOne.png')}}">
                            </p>
                            <p>
                                Al guardar el documento, seleccione tipo de archivo: <strong>(*.csv)</strong> que significa: delimitado por comas.
                            </p>
                            <p>
                                El tamaño del archivo no debe superar 1 MB.
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">            
                            <form id="subida">
                                <input type="file" id="csv" name="csv" />
                                <br />                                
                                <a id="up" class="btn btn-success"role="button" data-toggle="tooltip" data-placement="right" title="Importar">
                                    <span class="glyphicon glyphicon glyphicon-ok"></span>
                                </a>                                
                                <div id="respuesta"></div>
                            </form>
                        </div>
                    </div>
                </div>
                    
                <div class="tab-pane" id="tab2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>Actualizar compras desde archivo .csv</h1>
                            <hr />            
                        </div>                            
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <p>
                                Aquí podrá actualizar la información de las compras realizadas por sus clientes desde un archivo
                                de Excel en formato CSV.                
                            </p>
                            <p>
                                El archivo debe ser una tabla sin encabezado que debe tener los siguientes campos: Cédula del comprador,
                                nombre del producto, ID de la compra, valor de la compra, fecha de compra y saldo a la fecha. Por ejemplo:
                            </p>
                            <p>
                                <img src="{{url('img/import/fileTwo.png')}}">
                            </p>
                            <p>
                                La fecha debe esta en el siguiente formato: mes/día/año.
                            </p>
                            <p>
                                Al guardar el documento, seleccione tipo de archivo: <strong>(*.csv)</strong> que significa: delimitado por comas.
                            </p>
                            <p>
                                El tamaño del archivo no debe superar 1 MB.
                            </p>
                            <br />
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">            
                            <form id="subidados">
                                <input type="file" id="csvtwo" name="csvtwo" />
                                <br />                                
                                <a id="uptwo" class="btn btn-success"role="button" data-toggle="tooltip" data-placement="right" title="Importar">
                                    <span class="glyphicon glyphicon glyphicon-ok"></span>
                                </a>                                
                                <div id="respuestados"></div>
                            </form>
                        </div>
                    </div>                        
                </div>
                    
                <div class="tab-pane" id="tab3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>Actualizar recibos desde archivo .csv</h1>
                            <hr />            
                        </div>                            
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <p>
                                Aquí podrá actualizar la información de los recibos de pago cancelados por sus clientes desde un archivo
                                de Excel en formato CSV.                
                            </p>
                            <p>
                                El archivo debe ser una tabla sin encabezado que debe tener los siguientes campos: Número de recibo,
                                ID de la compra, valor y fecha de pago. Por ejemplo:
                            </p>
                            <p>
                                <img src="{{url('img/import/fileThree.png')}}">
                            </p>
                            <p>
                                La fecha debe esta en el siguiente formato: mes/día/año.
                            </p>
                            <p>
                                Al guardar el documento, seleccione tipo de archivo: <strong>(*.csv)</strong> que significa: delimitado por comas.
                            </p>
                            <p>
                                El tamaño del archivo no debe superar 1 MB.
                            </p>
                            <br />
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">            
                            <form id="subidatres">
                                <input type="file" id="csvthree" name="csvthree" />
                                <br />                                
                                <a id="upthree" class="btn btn-success"role="button" data-toggle="tooltip" data-placement="right" title="Importar">
                                    <span class="glyphicon glyphicon glyphicon-ok"></span>
                                </a>                                
                                <div id="respuestatres"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <ul class="pager wizard">
                    <li class="previous first" style="display:none;"><a href="#">First</a></li>
                    <li class="previous"><a href="#">Anterior</a></li>
                    <li class="next last" style="display:none;"><a href="#">Last</a></li>
                    <li class="next"><a href="#">Siguiente</a></li>
                </ul>
            </div>	
        </div>
    </div>
    
{% endblock %}