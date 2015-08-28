{% extends "templates/clean.volt" %}
{% block header %}
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
{% endblock %}
{% block content %}
    <div align="center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form class="form-horizontal" action="{{url('session/recoverpass')}}" method="post">
                <div class="form-group">
                    <img src="{{url('')}}img/Surticreditos-01.png" height="90" />
                </div>
                    
                <div class="form-group">
                    <h3>Recuperar contraseña</h3>
                    <br>
                    <div class="col-md-offset-1 col-md-10">
                        <input type="number" class="form-control" name="cedula" placeholder="Ingrese su número de Cédula">
                    </div>
                  </div>

                  <div class="form-group" align="right">
                    <div class="col-md-offset-1 col-md-10">
                        <a href="{{url('session/login')}}" class="btn btn-sm btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-sm btn-success">Recuperar</button>
                    </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}