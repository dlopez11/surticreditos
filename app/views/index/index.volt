{% extends "templates/default.volt" %}
{% block header %}
    {{ stylesheet_link('css/session-styles.css') }}
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
                        <strong>{{user.name}}</strong>
                    </td>
                    <td>{{user.email}}</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.city}}</td>                    
                </tr>
                
                <tr>                    
                    <td>{{user.idUser}}</td>
                    <td>{{user.class}}</td>                    
                    <td>{{user.address}}</td>
                </tr>
                {% endfor %}
            </table>
        </div>
    </div>

    <div class="space"></div>
            
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">            
            <select class="form-control">
                {% for buy in buys %}
                <option value="1">Seleccione su credito</option>
                <option value="1">{{buy.name}}</option>
            </select>
        </div>
    </div>
    
    <div class="space"></div>

    <div class="col-md-12">
        <div>
            <h1>
                <span class="glyphicon glyphicon-credit-card"></span>
                Información del Credito
            </h1>
        </div>
    </div>        
            
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">                
                <tr>
                    <td>Valor total del credito:</td>
                    <td>Valor cancelado hasta la fecha:</td>
                    <td>Valor por cancelar:</td>                    
                </tr>
                <tr>
                    <td>{{buy.value}}</td>
                    <td>{{buy.balance}}</td>
                    <td>{{buy.value - buy.balance}}</td>
                </tr>               
                {% endfor %}
            </table>
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