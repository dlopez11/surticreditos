{% extends "templates/default.volt" %}
{% block header %}
    <script type="text/javascript">
        function download () {
            $.ajax({
                    url: "{{url('data/create')}}",
                    type: "POST",
                    data: {
                            id: {{buy.idBuy}}
                    },
                    error: function(error){
                            console.log(error);
                    },
                    success: function(data){
                            window.location = '{{url('data/download')}}/' + data[0];
                    }
        });
}
    </script>
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
                        <strong>ID de la Compra:</strong>
                    </td>
                    <td>
                        <strong>Item:</strong>
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
                {% for buy in buys %}
                <tr>
                    <td>{{buy.idBuy}}</td>
                    <td></td>
                    <td>${{buy.value}}</td>
                    <td>${{buy.value - buy.debt}}</td>
                    <td>${{buy.debt}}</td>
                </tr>
                {% endfor %}
            </table>
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

    <div class="col-md-12" align="center">
	<button id="download" onClick="download();" class="btn btn-info btn-sm">Descargar pagos</button>
    </div>
{% endblock %}