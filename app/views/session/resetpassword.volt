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
            <form class="form-horizontal" action="{{url('session/setnewpass')}}" method="post">
                <input type="hidden" name="uniq" value="{{uniq}}"/>
                {{flashSession.output()}}
                <div class="form-group">
                  <h1>Genere su nueva contraseña</h1>
                  <br>
                  <div class="col-sm-12">                      
                      <input type="password" class="form-control" name="pass1" placeholder="Ingrese su nueva contraseña">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                      <input type="password" class="form-control" name="pass2" placeholder="Repita su contraseña">
                  </div>
                </div>                        

                <div class="form-group" align="right">
                  <div class="col-sm-offset-2 col-sm-10">
                    <a href="{{url('session/login')}}" class="btn btn-danger"role="button" data-toggle="tooltip" data-placement="top" title="Cancelar">
                        <span class="glyphicon glyphicon glyphicon-remove"></span>
                    </a>
                    <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Generar contraseña">
                        <span class="glyphicon glyphicon glyphicon-ok"></span>
                    </button>
                  </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}