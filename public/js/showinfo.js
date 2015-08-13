$(function () {

    $(".select2").on("select2:select", function (e) { 
        var id = $(".select2").val();

        $.getJSON(url + id, function( data ) {
            $('#container').empty();

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
                                        <td>'+ data.code +'</td>\n\
                                        <td>'+ data.value +'</td>\n\
                                        <td>'+ data.dif +'</td>\n\
                                        <td>'+ data.debt +'</td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div>\n\
                        </div>');

            $('#container').append(tab);
        });
    });
});