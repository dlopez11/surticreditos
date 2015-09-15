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
    
    <h4 class="text-center">Crédito No. <em>{{idBuy}}</em></h4><br>        

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">                
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <strong>Referencia:</strong>
                        </td>
                        <td>
                            <strong>Nombre del articulo:</strong>
                        </td>
                        <td>
                            <strong>Cantidad:</strong>
                        </td>
                    </tr>
                    {% for b in buys %}
                    <tr>                        
                        <td>{{b.article.reference}}</td>
                        <td>{{b.article.name}}</td>
                        <td>{{b.article.quantity}}</td>
                    </tr>
                    {% endfor %}
                </table>                
            </div>
            <div class="col-md-6">                
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <strong>Fecha de factura:</strong>
                        </td>
                        <td>
                            <strong>Valor total:</strong>
                        </td>
                        <td>
                            <strong>Valor cancelado:</strong>
                        </td>
                        <td>
                            <strong>Saldo:</strong>
                        </td>
                    </tr>
                    {% for b in buys %}
                    <tr>                    
                        <td>{{b.buy.date}}</td>
                        <td>${{b.buy.value}}</td>
                        <td>${{b.buy.value - b.buy.debt}}</td>
                        <td>${{b.buy.debt}}</td>
                    </tr>
                        {% break %}
                    {% endfor %}
                </table>
            </div>            
        </div>
    </div>
    
    <hr />
    
    <div class="col-md-12" align="right">
	<a href="{{url('payment/downloadpdf')}}/{{idBuy}}" id="download" class="btn btn-info btn-sm">Descargar pagos</a>
        <p></p>
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
    
    <div class="col-md-12" align="right">
	<a href="{{url('payment/downloadpdf')}}/{{idBuy}}" id="download" class="btn btn-info btn-sm">Descargar pagos</a>
        <p></p>
    </div>
    
    <div class="row">
        <div class="col-md-12" align="right">
            <p>
                <em>Información sujeta a verificación.</em>
            </p>
        </div>
    </div>
{% endblock %}