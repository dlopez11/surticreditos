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
            <form class="form-horizontal" action="{{url('session/questionpass')}}" method="post">
                <div class="form-group">
                    <img src="{{url('')}}img/Surticreditos-01.png" height="90" />
                    <br>
                    <br>
                    {{flashSession.output()}}
                </div>

                <div class="form-group">
                  <div class="col-md-offset-1 col-md-10">
                      <h3>Por favor responda las siguientes preguntas:</h3>
                      <br />
                      <input type="text" class="form-control" name="phone" placeholder="¿Cual es su número de telefono?">
                      <br />
                      <input type="text" class="form-control" name="city" placeholder="¿Cual es su ciudad de nacimiento?">
                  </div>
                </div>                        

                <div class="form-group" align="right">
                    <div class="col-md-offset-1 col-md-10">
                        <a href="{{url('session/login')}}" class="btn btn-sm btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-sm btn-success">Continuar</button>
                    </div>
                </div>
            </form>
        </div>                    
    </div>
{% endblock %}