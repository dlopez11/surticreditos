{% extends "templates/default.volt" %}
{% block header %}
    {{ stylesheet_link('css/session-styles.css') }}
    {# Select 2 #}
    {{ javascript_include('library/select2/js/select2.min.js') }}
    {{ stylesheet_link('library/select2/css/select2.min.css') }}

    <script type="text/javascript">
        $(function () {
            
          $(".select2").select2();
          
          $(".select2").on("select2:select", function (e) { 
              var id = $(".select2").val();
              
              $.getJSON("{{url('data/get')}}/" + id, function( data ) {
                  $('#container').empty();
                  
                  var tab = $('<div class="col-md-12">\n\
                                    <h1>\n\
                                        <span class="glyphicon glyphicon-credit-card"></span>\n\
                                        Información del Credito\n\
                                    </h1>\n\
                                </div>\n\
                                <div class="row">\n\
                                    <div class="col-md-12">\n\
                                        <table class="table table-bordered">\n\
                                            <tr>\n\
                                                <td>Número del credito:</td>\n\
                                                <td>Valor total del credito</td>\n\
                                                <td>Valor cancelado hasta la fecha:</td>\n\
                                                <td>Saldo por cancelar:</td>\n\
                                            </tr>\n\
                                            <tr>\n\
                                                <td>'+ data.code +'</td>\n\
                                                <td>'+ data.value +'</td>\n\
                                                <td>'+ data.dif +'</td>\n\
                                                <td>'+ data.debt +'</td>\n\
                                            </tr>\n\
                                        </table>\n\
                                    </div>\n\
                                </div>');
                  
                  $('#container').append(tab);
              });
          });
        });
    </script>
{% endblock %}
{% block content %}
    <div class="row">
        <div class="col-md-12">
               {{flashSession.output()}}
        </div>
    </div>
    
    <div class="col-md-12">
        <div>
            <h1>
                <span class="glyphicon glyphicon glyphicon-user"></span>
                Información personal
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                {% for user in users %}
                <tr>
                    <td>
                        <strong>
                            {{user.name}}
                            <br />
                            CC: {{user.idUser}}
                        </strong>                            
                    </td>                    
                    <td>{{user.class}}</td>  
                    <td>{{user.address}}</td>                                    
                </tr>
                
                <tr>                    
                    <td>{{user.email}}</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.city}}</td>
                </tr>
                {% endfor %}
            </table>
        </div>
    </div>

    <div class="space"></div>
            
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <select class="form-control select2">
                <option value="0">Seleccione su credito</option>
                {% for buy in buys %}
                    <option value="{{buy.idBuy}}">{{buy.idBuy}}</option>
                {% endfor %}
            </select>
        </div>
    </div>
    
    <div class="space"></div>
    
    <div class="row" id="container">
        <div class="col-md-12">
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12" align="right">
            <p>
                <em>
                    La información suministrada puede no estar actualizada.
                </em>
            </p>
        </div>
    </div>
{% endblock %}