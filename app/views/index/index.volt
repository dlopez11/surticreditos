{% extends "templates/default.volt" %}
{% block header %}
    {{ stylesheet_link('css/session-styles.css') }}
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
    </script>
    
    {{ javascript_include('js/showinfo.js') }}
    
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
                <a id="download" onClick="download();" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="right" title="Descargar historial de pagos">
                    <span class="glyphicon glyphicon glyphicon-download-alt"></span>
                </a> 
            </div>
        </div>
    </div>
    
    <div class="space"></div>
    
    <div class="row" id="container">
        <div class="col-md-12">
            
        </div>
    </div>
{% endblock %}