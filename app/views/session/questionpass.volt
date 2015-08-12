{% extends "templates/clean.volt" %}
{% block header %}
    {{ stylesheet_link('css/session-styles.css') }}
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
{% endblock %}
{% block content %}
    <div align="center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form class="form-horizontal" action="{{url('session/questionpass')}}" method="post">
                {{flashSession.output()}}
                <div class="form-group">
                  <h1>Para generar su nueva contraseña por favor responda las siguientes preguntas:</h1>
                  <br>
                  <div class="col-sm-12">                      
                      <input type="text" class="form-control" name="phone" placeholder="¿Cual es su número de telefono?">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                      <input type="text" class="form-control" name="city" placeholder="¿Cual es su ciudad de nacimiento?">
                  </div>
                </div>                        

                <div class="form-group" align="right">
                  <div class="col-sm-offset-2 col-sm-10">
                    <a href="{{url('session/login')}}" class="btn btn-danger"role="button" data-toggle="tooltip" data-placement="top" title="Cancelar">
                        <span class="glyphicon glyphicon glyphicon-remove"></span>
                    </a>
                    <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Continuar">
                        <span class="glyphicon glyphicon glyphicon-ok"></span>
                    </button>
                  </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}