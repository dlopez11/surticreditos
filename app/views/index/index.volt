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
        <div class="col-md-4">
            <table class="table table-bordered">
                {% for user in users %}
                <tr>
                    <td>Nombre:</td>
                    <td>{{user.name}}</td>
                </tr>
                <tr>
                    <td>Cédula:</td>
                    <td>{{user.idUser}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{user.email}}</td>
                </tr>
                <tr>
                    <td>Clase:</td>
                    <td>{{user.class}}</td>
                </tr>
                <tr>
                    <td>Telefono:</td>
                    <td>{{user.phone}}</td>
                </tr>
                <tr>
                    <td>Celular:</td>
                    <td>{{user.cellphone}}</td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td>{{user.address}}</td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td>{{user.city}}</td>
                </tr>
                {% endfor %}
            </table>
        </div>

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
                {% for buy in buys %}
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
{% endblock %}