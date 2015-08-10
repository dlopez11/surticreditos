$(function(){
    $('#uptwo').click(function(){

        var comprobar = $('#csvtwo').val().length;

        if(comprobar > 0){
            var formulario = $('#subidados');
            var archivos = new FormData();
            var url = csvtwo;

            for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 
                archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));
            }
            $.ajax({                
                url: url,
                type: 'POST',
                contentType: false, 
                data: archivos,
                processData:false,
                beforeSend : function (){
                    $('#respuestados').html('<label style="padding-top:10px; color:blue;">Cargando...</label>');
                },
                success: function(data){                   
                    if(data.length > 0){
                        $('#respuestados').html('<label style="padding-top:10px; color:green;">'+ data +'</label>');	
                        $('#subidados')[0].reset();
                        return false;
                    }
                },
                error: function (data) {                    
                    var status = JSON.parse(data.responseText);
                    $('#respuestados').html('<label style="padding-top:10px; color:red;">'+ status +'</label>');
                    return false;
                }
    });    
        }
        else         
        {            
            alert('Selecciona un archivo CSV para importar.');
            return false;
        }
    });
    
    return false;
});
