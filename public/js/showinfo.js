$(function () {

    $(".select2").on("select2:select", function (e) { 
        var id = $(".select2").val();

        $.getJSON(url + id, function( data ) {
            $('#container').empty();
            
            var td = '';
                
            for(var i = 0; i < data[1].length; i++){
                td += '<tr>';
                td += '<td>' + data[1][i].id + '</td>';
                td += '<td>' + data[1][i].date + '</td>';
                td += '<td>' + data[1][i].value + '</td>';
                td += '</tr>';
            }
            
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
                                        <td>'+ data[0].code +'</td>\n\
                                        <td>'+ data[0].value +'</td>\n\
                                        <td>'+ data[0].dif +'</td>\n\
                                        <td>'+ data[0].debt +'</td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                        <div class="col-md-12">\n\
                            <h1>\n\
                                <span class="glyphicon glyphicon-list-alt"></span>\n\
                                Historial de pagos\n\
                            </h1>\n\
                        </div>\n\
                        <div class="row">\n\
                            <div class="col-md-12">\n\
                                <table class="table table-bordered">\n\
                                    <tr>\n\
                                        <td>Número del recibo:</td>\n\
                                        <td>Fecha de pago:</td>\n\
                                        <td>Valor cancelado:</td>\n\
                                    </tr>\n\
                                    ' + td + '\n\
                                </table>\n\
                            </div>\n\
                        </div>');

            $('#container').append(tab);
        });
    });
});