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
            <form class="form-horizontal" action="{{url('session/changepass')}}" method="post">
                <div class="form-group">
                    <img src="{{url('')}}img/Surticreditos-01.png" height="90" />
                    <br>
                    <br>
                    {{flashSession.output()}}
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <h3>Genere su nueva contraseña</h3>
                        <br />
                        <input type="password" class="form-control" name="password" placeholder="Ingrese su nueva contraseña">
                        <br />
                        <input type="password" class="form-control" name="password2" placeholder="Repita su contraseña">
                    </div>
                  </div>                        

                <div class="form-group" align="right">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-sm btn-success">Generar contraseña</button>
                    </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}