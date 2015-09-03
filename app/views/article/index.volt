{% extends "templates/default.volt" %}
{% block header %}

{% endblock %}
{% block content %}
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Historial de pagos</h2>
            <p></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">        
                <tr>
                    <td>
                        <strong>Número de Recibo:</strong>
                    </td>
                    <td>
                        <strong>Fecha de pago:</strong>
                    </td>
                    <td>
                        <strong>Valor:</strong>
                    </td>
                </tr>
                {% for payment in payments %}
                <tr>
                    <td>{{payment.idPayment}}</td>
                    <td>{{payment.date}}</td>
                    <td>${{payment.receiptValue}}</td>
                </tr>
                {% endfor %}
            </table>
        </div>
    </div>
{% endblock %}