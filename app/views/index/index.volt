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
                  console.log(data)
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