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
            <form class="form-horizontal" action="{{url('session/login')}}" method="post">
                {{flashSession.output()}}
                <div class="form-group">
                  <h1>Surticreditos</h1>
                  <br>
                  <div class="col-sm-12">
                      <input type="number" class="form-control" name="id" id="id" placeholder="Ingrese su número de cédula">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su contraseña">
                  </div>
                </div>                        

                <div class="form-group" align="right">
                  <div class="col-sm-offset-2 col-sm-10">
                    <a href="{{url('session/recoverpass')}}" class="btn btn-primary"role="button" data-toggle="tooltip" data-placement="top" title="Recuperar contraseña">
                        <span class="glyphicon glyphicon glyphicon-lock"></span>
                    </a>
                    <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Iniciar sesión">
                        <span class="glyphicon glyphicon glyphicon-ok"></span>
                    </button>
                  </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}