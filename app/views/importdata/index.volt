{% extends "templates/default.volt" %}
{% block header %}
    {{ stylesheet_link('css/session-styles.css') }}
    {{ stylesheet_link('library/twitter-bootstrap-wizard-master/bootstrap/css/bootstrap.min.css') }}
    {{ stylesheet_link('library/twitter-bootstrap-wizard-master/prettify.css') }}

    {{ javascript_include('library/twitter-bootstrap-wizard-master/bootstrap/js/bootstrap.min.js') }}
    {{ javascript_include('library/twitter-bootstrap-wizard-master/jquery.bootstrap.wizard.js') }}
    {{ javascript_include('library/twitter-bootstrap-wizard-master/prettify.js') }}
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
                            <li><a href="#tab1" data-toggle="tab">Primer Archivo</a></li>
                            <li><a href="#tab2" data-toggle="tab">Segundo Archivo</a></li>
                            <li><a href="#tab3" data-toggle="tab">Tercer Archivo</a></li>
                         </ul>
                    </div>
                </div>
            </div>

            <div id="bar" class="progress progress-striped active">
                <div class="bar"></div>
            </div>

            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    1
                </div>
                <div class="tab-pane" id="tab2">
                    2
                </div>
                <div class="tab-pane" id="tab3">
                    3
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