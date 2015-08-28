{% extends "templates/default.volt" %}
{% block header %}
    {# Select 2 #}
    {{ javascript_include('library/select2/js/select2.min.js') }}
    {{ stylesheet_link('library/select2/css/select2.min.css') }}   

    <script type="text/javascript">
        var url = "{{url('data/get')}}/";
        $(function () {            
            $(".select2").select2();                    
        });
        
        function download () {
            var id = $(".select2").val();
            
            if (id > 0) {
                $.ajax({
                    url: "{{url('data/create')}}",
                    type: "POST",
                    data: {
                        id: id
                    },
                    error: function(error){
                        console.log(error);
                    },
                    success: function(data){
                        window.location = '{{url('data/download')}}/' + data[0];
                    }
                });  
            }  
        }
    </script>
    
    {{ javascript_include('js/showinfo.js') }}
    
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
    
    <div class="space"></div>
    <br>   
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="col-md-10">
                <select class="form-control select2">
                    <option value="0">Seleccione su credito</option>
                    {% for buy in buys %}
                        <option value="{{buy.idBuy}}">{{buy.idBuy}}</option>
                    {% endfor %}
                </select>
            </div>                                       
            <div class="col-md-2">
                <button id="download" onClick="download();" class="btn btn-info btn-sm">Descargar pagos</button>
            </div>
        </div>
    </div>
    <br>
    <div class="space"></div>
    
    <div class="row" id="container">
        <div class="col-md-12">
            
        </div>
    </div>
    
    
{% endblock %}