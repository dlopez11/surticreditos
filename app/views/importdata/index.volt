{% extends "templates/default.volt" %}
{% block header %}
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

            {#<div id="bar" class="progress progress-striped active">
                <div class="bar"></div>
            </div>#}

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
                                Aquí podrá actualizar la información de sus clientes desde un archivo en formato CSV.                
                                Al momento de guardar el documento de texto plano se debera agregar la extensión 
                                <strong>(*.csv)</strong> al nombre del archivo.
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <form id="subida">
                                <label>
                                    <input type="checkbox" name="update" id="update" />                                
                                    <strong>
                                    Actualizar los datos de los usuarios que ya se encuentren en la base de datos.
                                    </strong>
                                </label>
                                <br />
                                <p>
                                    <em>
                                        Si habilita esta opción se reemplazara la información de los usuarios que ya se 
                                        encuentran en la base de datos por la información que esté en el archivo, este proceso
                                        podría tardar más de lo habitual.
                                    </em>
                                </p>
                                <br />
                                <input type="file" id="csvone" name="csvone" />
                                <br />                                
                                <a id="upone" class="btn btn-success" role="button">Importar</a>                                
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
                                Aquí podrá actualizar la información de las compras realizadas por sus clientes 
                                desde un archivo en formato CSV.                
                            </p>
                            <p>
                                Al momento de guardar el documento de texto plano se debera agregar la extensión 
                                <strong>(*.csv)</strong> al nombre del archivo.
                            </p>
                            <br />
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">            
                            <form id="subidados">
                                <input type="file" id="csvtwo" name="csvtwo" />
                                <br />                                
                                <a id="uptwo" class="btn btn-success" role="button">Importar</a>                                
                                <div id="respuestados"></div>
                            </form>
                        </div>
                    </div>                        
                </div>
                    
                <div class="tab-pane" id="tab3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>Actualizar recibos de pago desde archivo .csv</h1>
                            <hr />            
                        </div>                            
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <p>
                                Aquí podrá actualizar la información de los recibos de pago desde un archivo en
                                formato CSV.                
                            </p>
                            <p>
                                Al momento de guardar el documento de texto plano se debera agregar la extensión 
                                <strong>(*.csv)</strong> al nombre del archivo.
                            </p>
                            <br />
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">            
                            <form id="subidatres">
                                <input type="file" id="csvthree" name="csvthree" />
                                <br />                                
                                <a id="upthree" class="btn btn-success" role="button">Importar</a>                                
                                <div id="respuestatres"></div>
                            </form>
                        </div>
                    </div>
                </div>                
            </div>	
        </div>
    </div>
    
{% endblock %}