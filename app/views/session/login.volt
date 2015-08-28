{% extends "templates/clean.volt" %}
{% block header %}
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
                <div class="form-group">
                    <img src="{{url('')}}img/Surticreditos-01.png" height="90" />
                    <br>
                    <br>
                    {{flashSession.output()}}
                </div>
                    
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-10">
                        <input type="number" class="form-control" name="id" id="id" placeholder="Ingrese su número de cédula">
                        <br>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su contraseña">
                    </div>
                </div>                        

                <div class="form-group" align="right">
                  <div class="col-md-offset-1 col-md-10">
                    <a href="{{url('session/recoverpass')}}" class="btn btn-sm btn-primary">Recuperar contraseña</a>
                    <button type="submit" class="btn btn-sm btn-success">Iniciar sesión</button>
                  </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}