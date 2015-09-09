{% extends "templates/default.volt" %}
{% block header %}
    {# Select 2 #}
    {{ javascript_include('library/select2/js/select2.min.js') }}
    {{ stylesheet_link('library/select2/css/select2.min.css') }}   

    <script type="text/javascript">
        var url = "{{url('data/get')}}/";                    
    </script>
    
{% endblock %}
{% block content %}
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Consulte su Estado de Crédito</h2>
            <p></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
               {{flashSession.output()}}
        </div>
    </div>
    
    <div class="row block">
        <div class="col-md-12">
            <h3>
                {{user.name}}
            </h3>
            <div class="xs-text">CC: {{user.idUser}}</div>
            <div class="xs-text">{{user.email}}</div>     
            <div class="xs-text">{{user.address}} - {{user.city}}</div>
            <div class="xs-text">{{user.phone}}</div>   
        </div>
    </div>   
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Créditos</h2>
            <p></p>
        </div>
    </div>
    
    {% for b in buys %}
    <div class="row">
        <div class="col-md-12">            
            <table class="table table-bordered">                
                <tr style="border-bottom: 2px solid transparent;">
                    <td colspan="3" style="font-size: 1.3em; font-weight: bold">
                        <a href="{{url('payment/index')}}/{{b.buy.idBuy}}">({{b.buy.idBuy}}) {{b.article.name}}</a>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid transparent;">Referencia: <span style="color: #337ab7; font-size: 1.2em;">{{b.article.reference}}</span></td>
                    <td>Fecha de compra: <span style="color: #848484; font-size: 1.2em;">{{b.buy.date}}</span></td>
                </tr>
            </table>
        </div>
    </div>
    {% endfor %}
    
    <div class="row">
        <div class="col-md-12" align="right">
            <p>
                <em>Información sujeta a verificación.</em>
            </p>
        </div>
    </div>    
{% endblock %}