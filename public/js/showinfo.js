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
            
            var tab = $('<div class="row">\n\
                            <div class="col-md-12">\n\
                                <table class="table table-bordered">\n\
                                    <tr style="border-bottom: 2px solid transparent;">\n\
                                        <td colspan="3" style="font-size: 1.3em; font-weight: bold">Crédito No. '+ data[0].code +'</td>\n\
                                    </tr>\n\
                                    <tr>\n\
                                        <td style="border-right: 2px solid transparent;">Total: <span style="color: #337ab7; font-size: 1.2em;">'+ data[0].value +'</span></td>\n\
                                        <td style="border-right: 2px solid transparent;">Valor Cancelado: <span style="color: #449d44; font-size: 1.2em;">'+ data[0].dif +'</span></td>\n\
                                        <td>Saldo: <span style="color: #848484; font-size: 1.2em;">'+ data[0].debt +'</span></td>\n\
                                    </tr>\n\
                                    <tr>\n\
                                        <td>Número del recibo:</td>\n\
                                        <td>Fecha de pago:</td>\n\
                                        <td>Valor cancelado:</td>\n\
                                    </tr>\n\
                                        ' + td + '\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                        <div class="row">\n\
                            <div class="col-md-12" align="right">\n\
                            <p><em>La información suministrada puede no estar actualizada.</em></p></div>\n\
                        </div>"');

            $('#container').append(tab);
        });
    });
});